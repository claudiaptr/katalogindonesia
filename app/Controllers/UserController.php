<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\Kategori;

class UserController extends BaseController
{
    protected $barang;
    protected $fotoBarang;
    protected $kategori;
    
    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
    }
    public function home()
    {
        helper('form');
        $data = [
            'barang' => $this->barang->getRandomBarang(6),
            'barang_baru' => $this->barang->getNewBarang(6),
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/home', $data);
    }
    public function detail($id)
    {
        $data = [
            'barang' => $this->barang->find($id),
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'kategori' => $this->kategori->getSubKategori()
        ];

        return view('user/detail', $data);
    }
    public function contact()
    {
        $data = [
            
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/contact',$data);
    }

    public function shop()
    {
        $data = [
            
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/shop',$data);
    }
    public function checkout()
    {
        $data = [
            
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/checkout',$data);
    }
    public function cart()
    {
        $data = [
            
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/cart',$data);
    }
    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        $data = json_encode($response);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    public function add_chart()  {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => 'sku_1234ABCD',
            'qty'     => 1,
            'price'   => '19.56',
            'name'    => 'T-Shirt',
            'options' => array('Size' => 'L', 'Color' => 'Red')
         ));
         return redirect()->to(base_url('user/cek'));
    }
}
