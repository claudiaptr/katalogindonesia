<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\IklanCarausel;
use App\Models\Kategori;
use App\Models\Opsi;
use App\Models\Variasi;
use App\Models\IklanTetap;
use App\Models\Transaksi;
use App\Models\Model_Auth;
use App\Models\CartModel;
use App\Models\WishlistModel;
use App\Models\UserModel;
use Google_Client;

class UserController extends BaseController
{
    protected $barang;
    protected $fotoBarang;
    protected $kategori, $variasi, $opsi, $iklancarausel;
    protected $iklantetap, $cart, $session, $transaksi;
    protected $wishlistModel;


    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
        $this->variasi = new Variasi();
        $this->opsi = new Opsi();
        $this->iklancarausel = new IklanCarausel();
        $this->iklantetap = new IklanTetap();
        $this->cart = \Config\Services::cart();
        $this->session = \Config\Services::session();
        $this->transaksi = new Transaksi();
    }

    public function home()
    {

        $data = [
            'barang' => $this->barang->getAlamatToko(8),
            'barang_baru' => $this->barang->getNewBarang(8),
            'kategori' => $this->kategori->getSubKategori(),
            'iklan_tetap_1' => $this->iklantetap->find(1),
            'iklan_tetap_2' => $this->iklantetap->find(2),
            'iklan_tetap_3' => $this->iklantetap->find(3),
            'iklan_tetap_4' => $this->iklantetap->find(4),
            'iklan_carausel' => $this->iklancarausel->findAll(),
            'cart' => \Config\Services::cart(),
            'menu' => 'dashboard',
        ];
        return view('user/home', $data);
    }

    public function myaccount()
{
    $userId = session()->get('user_id');

    $cartModel = new CartModel();
    $userModel = new Model_Auth();

    $total_cart = 0;
    if ($userId) {
        $total_cart = $cartModel->totalItemsByUser($userId);
    }

    // Ambil kategori untuk ditampilkan di view
    $kategori = $this->kategori->getSubKategori();

    $data = [
        'user' => $userModel->getLogin($userId),
        'total_cart' => $total_cart,
        'kategori' => $kategori,
        'menu' => 'myaccount', // Menambahkan menu ke data
        'username' => $userModel,
    ];

    return view('user/myaccount', $data); // Panggil view myaccount
}

    public function detail($id)
    {

        $data = [
            'barang' => $this->barang->find($id),
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->data_opsi($id),
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'shop',
        ];

        return view('user/detail', $data);
    }

    public function shop()
    {
        // Fetch only barang items (ID = 1)
        $data = [
            'barang' => $this->barang->getBarangByKategori(1),
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'shop',
        ];
        return view('user/shop', $data);
    }



    public function filter_toko()
    {
        $provinsi = $this->request->getVar('provinsi');
        $kabupaten = $this->request->getVar('kabupaten');
        $kecamatan = $this->request->getVar('kecamatan');
        $kelurahan = $this->request->getVar('kelurahan');

        // Panggil model untuk mengambil data barang sesuai filter
        $barang = $this->barang->getbarang($provinsi, $kabupaten, $kecamatan, $kelurahan);
        log_message('info', 'Data barang yang dikembalikan: ' . json_encode($barang));
        // Mengembalikan data barang dalam bentuk JSON
        return $this->response->setJSON($barang);
    }



    // Jasa
    public function jasa()
    {
        helper('form');

        // Fetch only jasa items (ID = 2)
        $data = [
            'barang' => $this->barang->getBarangByKategori(2), // Get items by category ID 2
            'barang_baru' => $this->barang->getNewBarang(8), // Get new items, adjust as needed
            'kategori' => $this->kategori->getSubKategori(),
            'menu' => 'jasa',
            'iklan_tetap_1' => $this->iklantetap->find(1),
            'iklan_tetap_2' => $this->iklantetap->find(2),
            'iklan_tetap_3' => $this->iklantetap->find(3),
            'iklan_tetap_4' => $this->iklantetap->find(4),
            'iklan_carausel' => $this->iklancarausel->findAll()
        ];

        return view('user/jasa', $data);
    }



    public function contact()
    {
        $data = [

            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'contact',
        ];
        return view('user/contact', $data);
    }
    public function tracking()
    {
        $data = [

            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'tracking',
        ];
        return view('user/tracking', $data);
    }


    public function checkout()
    {
        $data = [
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'checkout',
        ];
        return view('user/checkout', $data);
    }
    public function cart()
    {
        $data = [
            'cart' => \Config\Services::cart(),
            'kategori' => $this->kategori->getSubKategori(),
            'menu' => 'cart',
        ];
        return view('user/cart', $data);
    }
    public function delete_cart($id)
    {
        $this->cart->remove($id);
        return redirect()->to('cart');
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
    public function add_chart()
    {

        $cart = \Config\Services::cart();
        $variasi = $this->request->getVar('variasi');
        $id_user = $this->session->get('id');
        $options = [];

        if ($variasi && is_array($variasi)) {

            foreach ($variasi as $variation) {
                $options[$variation] = $this->request->getVar($variation); // Get the selected option for this variation
            }
        }
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => $this->request->getPost('jumlah'),
            'price'   => $this->request->getPost('harga_barang'),
            'name'    => $this->request->getPost('judul_barang'),
            'id_barang'    => $this->request->getPost('id_barang'),
            'options' => $options,
            'id_user' => $id_user
        ));
        return redirect()->to('cart');
    }
    public function harga_barang()
    {
        $request = service('request');
        $variasi = $request->getVar('variasi'); // Ambil nilai dari inputan radio
        $harga_awal = $request->getVar('harga_barang_awal'); // Ambil harga awal dari form
        // Inisialisasi harga akhir dengan harga awal
        $harga_akhir = $harga_awal;
        // Proses untuk mendapatkan harga variasi berdasarkan nilai $variasi
        $hargaModel = new Opsi();
        foreach ($variasi as $variasi_item) {
            $opsi = $request->getVar($variasi_item);
            $harga_variasi = $hargaModel->getHargaBerdasarkanVariasi($opsi);
            $harga_akhir += $harga_variasi;
        }
        // Kirim kembali harga dalam format JSON
        return $this->response->setJSON(['harga' => $harga_akhir]);
    }
    public function hapus_semua()
    {
        $this->cart->destroy();
        return redirect()->to('cart');
    }

    public function transaksi()
    {
        $id_user = $this->request->getVar('id_user');
        $id_barang = $this->request->getVar('id_barang');
        $sub_total = $this->request->getVar('sub_total');
        $total = $this->request->getVar('total');
        $jumlah = $this->request->getVar('jumlah');
        $nomortelp = $this->request->getVar('nomortelp');
        $alamat = $this->request->getVar('alamat');
        $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');
        $nama_foto = $bukti_pembayaran->getRandomName();
        $bukti_pembayaran->move('transaksi', $nama_foto);
        $options = $this->request->getVar('options');
        if (is_array($id_barang) && is_array($sub_total) && is_array($jumlah)) {
            $data = [];
            foreach ($id_barang as $key => $barang_id) {
                $data[] = [
                    'id_user' => $id_user,
                    'id_barang' => $barang_id,
                    'sub_total' => $sub_total[$key],
                    'jumlah' => $jumlah[$key],
                    'options' => $options[$key],
                    'total' => $total,
                    'nomortelp' => $nomortelp,
                    'alamat' => $alamat,
                    'bukti_pembayaran' => $nama_foto,
                    'verifikasi' => 1,
                ];
            }
            $this->transaksi->insertBatch($data);
            $this->cart->destroyByUser($id_user);
        }
        session()->setFlashdata('pesan', 'Pesanan berhasil dibuat');
        return redirect()->to('cart');
    }

        public function wishlist()
        {
            $wishlistModel = new WishlistModel();
            $id_user = session()->get('id');
            $wishlist = $wishlistModel->getWishlistByUser($id_user);

            return view('user/wishlist', [
                'wishlist' => $wishlist,
                'kategori' => $this->kategori->getSubKategori(),
                'menu' => 'wishlist',
            ]);
        }

        public function addToWishlist($id_barang)
        {
            $wishlistModel = new WishlistModel();
            $id_user = session()->get('id');

            // Pastikan data yang diperlukan ada
            if ($id_user && $id_barang) {
                $wishlistModel->insert([
                    'id_user' => $id_user,
                    'id_barang' => $id_barang,
                ]);

                return redirect()->to('user/wishlist')->with('message', 'Product added to wishlist!');
            }

                return redirect()->to('user/wishlist')->with('error', 'Failed to add product to wishlist.');
            }


            public function delete_wishlist($id)
            {
                $wishlistModel = new WishlistModel();
                $id_user = session()->get('id');

                // Ensure the wishlist item belongs to the logged-in user
                if ($wishlistModel->where(['id' => $id, 'id_user' => $id_user])->first()) {
                    $wishlistModel->delete($id);
                    return redirect()->to('user/wishlist')->with('message', 'Product removed from wishlist!');
                }

                return redirect()->to('user/wishlist')->with('error', 'Failed to remove product from wishlist.');
            }

            public function profile()
            {
                // Assuming you have a model to get user data
                $userModel = new UserModel();
                $userId = session()->get('user_id'); // Adjust this according to how you get the user ID
                $user = $userModel->find($userId);

                return view('user/profile', ['username' => $user['username']]);
            }

    }

