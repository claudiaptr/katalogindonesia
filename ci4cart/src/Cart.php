<?php

namespace CodeIgniterCart {

    /**
     * The Cart class is a basic port of the CodeIgniter 3 cart module for CodeIgniter 4.
     *
     * @package    CodeIgniterCart
     * @copyright  Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
     * @copyright  Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
     * @link       https://github.com/jason-napolitano/CodeIgniter4-Cart-Module
     * @link       https://codeigniter.com/user_guide/libraries/cart.html
     * @license    http://opensource.org/licenses/MIT
     * @author     EllisLab Dev Team
     * @since      1.0.0
     * @deprecated 3.0.0
     */
    class Cart
    {
        public $productIdRules = '\.a-z0-9_-';
        public $productNameRules = '\w \-\.\:';
        public $productNameSafe = true;
        protected $cartContents = [];
        protected $session;

        public function __construct()
        {
            $this->session = session();
            $this->cartContents = $this->session->get('cart_contents');
            if ($this->cartContents === null) {
                $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
            }

            log_message('info', 'Cart Class Initialized');
        }

        public function insert($items = []): bool
        {
            $session = \Config\Services::session();
            $id_user = $session->get('id');

            if (!is_array($items) || count($items) === 0) {
                log_message('error', 'The insert method must be passed an array containing data.');
                return false;
            }

            $save_cart = false;
            if (isset($items['id'])) {
                $items['id_user'] = $id_user;
                if (($rowid = $this->_insert($items))) {
                    $save_cart = true;
                }
            } else {
                foreach ($items as $val) {
                    if (is_array($val) && isset($val['id'])) {
                        $val['id_user'] = $id_user;
                        if ($this->_insert($val)) {
                            $save_cart = true;
                        }
                    }
                }
            }

            if ($save_cart === true) {
                $this->saveCart();
                return $rowid ?? true;
            }

            return false;
        }
        protected function _insert($items = [])
        {
            if (!is_array($items) || count($items) === 0) {
                log_message('error', 'The insert method must be passed an array containing data.');
                return false;
            }

            if (!isset($items['id'], $items['qty'], $items['price'], $items['name'], $items['id_user'])) {
                log_message('error', 'The cart array must contain a product ID, quantity, price, name, and user ID.');
                return false;
            }

            $items['qty'] = (float)$items['qty'];

            if ($items['qty'] === 0) {
                return false;
            }

            if (!preg_match('/^[' . $this->productIdRules . ']+$/i', $items['id'])) {
                log_message('error', 'Invalid product ID.');
                return false;
            }

            if ($this->productNameSafe && !preg_match('/^[' . $this->productNameRules . ']+$/i' . (true ? 'u' : ''), $items['name'])) {
                log_message('error', 'Invalid product name.');
                return false;
            }

            $items['price'] = (float)$items['price'];

            if (isset($items['options']) && count($items['options']) > 0) {
                $rowid = md5($items['id'] . serialize($items['options']) . $items['id_user']);
            } else {
                $rowid = md5($items['id'] . $items['id_user']);
            }

            $session = \Config\Services::session();
            $id_user = $session->get('id');
            // Set id_user pada item
            $items['id_user'] = $id_user;

            // Memastikan item yang diinsert berbeda berdasarkan id_user
            $old_quantity = isset($this->cartContents[$rowid]['qty']) ? (int)$this->cartContents[$rowid]['qty'] : 0;
            $items['rowid'] = $rowid;
            $items['qty'] += $old_quantity;
            $this->cartContents[$rowid] = $items;

            $this->saveCart();

            return $rowid;
        }



        protected function saveCart(): bool
        {
            $this->cartContents['total_items'] = $this->cartContents['cart_total'] = 0;
            foreach ($this->cartContents as $key => $val) {
                if (!is_array($val) || !isset($val['price'], $val['qty'])) {
                    continue;
                }

                $this->cartContents['cart_total'] += ($val['price'] * $val['qty']);
                $this->cartContents['total_items'] += $val['qty'];
                $this->cartContents[$key]['subtotal'] = ($this->cartContents[$key]['price'] * $this->cartContents[$key]['qty']);
            }

            if (count($this->cartContents) <= 2) {
                $this->session->remove('cart_contents');
                return false;
            }

            $this->session->set('cart_contents', $this->cartContents);

            // Debug: Log the cart contents
            log_message('debug', 'Cart Contents: ' . print_r($this->cartContents, true));

            return true;
        }


        public function total()
        {
            return $this->cartContents['cart_total'];
        }
        public function totalByUser($id_user): float
        {
            $total = 0;
            foreach ($this->cartContents as $item) {
                if (isset($item['id_user']) && $item['id_user'] == $id_user) {
                    $total += $item['subtotal'];
                }
            }
            return $total;
        }


        public function remove($rowid): bool
        {
            unset($this->cartContents[$rowid]);
            $this->saveCart();
            return true;
        }

        public function totalItems()
        {
            return $this->cartContents['total_items'];
        }

        public function contents($newest_first = false): array
        {
            $cart = ($newest_first) ? array_reverse($this->cartContents) : $this->cartContents;
            unset($cart['total_items'], $cart['cart_total']);
            return $cart;
        }

        public function getItem($row_id)
        {
            return (in_array($row_id, ['total_items', 'cart_total'], true) || !isset($this->cartContents[$row_id]))
                ? false
                : $this->cartContents[$row_id];
        }

        public function hasOptions($row_id = ''): bool
        {
            return (isset($this->cartContents[$row_id]['options']) && count($this->cartContents[$row_id]['options']) !== 0);
        }

        public function productOptions($row_id = '')
        {
            return $this->cartContents[$row_id]['options'] ?? [];
        }

        public function formatNumber($n = ''): string
        {
            return ($n === '') ? '' : number_format((float)$n, 2);
        }

        public function destroy(): void
        {
            $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
            $this->session->remove('cart_contents');
        }

        public function contentsByUser($id_user, $newest_first = false): array
        {
            $cart = ($newest_first) ? array_reverse($this->cartContents) : $this->cartContents;
            unset($cart['total_items'], $cart['cart_total']);

            $userCart = [];
            foreach ($cart as $rowid => $item) {
                if (isset($item['id_user']) && $item['id_user'] == $id_user) {
                    $userCart[$rowid] = $item;
                }
            }

            // Debug: Log the user cart contents
            log_message('debug', 'User Cart Contents: ' . print_r($userCart, true));

            return $userCart;
        }

        public function totalItemsByUser($id_user): int
        {
            $totalItems = 0;
            foreach ($this->cartContents as $item) {
                if (isset($item['id_user']) && $item['id_user'] == $id_user) {
                    $totalItems += $item['qty'];
                }
            }

            // Debug: Log the total items for user
            log_message('debug', 'Total Items for User: ' . $totalItems);

            return $totalItems;
        }
    }
}
