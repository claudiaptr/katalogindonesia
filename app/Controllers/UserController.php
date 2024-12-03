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
use App\Models\AlamatToko;
use Google_Client;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $barang;
    protected $fotoBarang;
    protected $kategori, $variasi, $opsi, $iklancarausel;
    protected $iklantetap, $cart, $session, $transaksi;
    protected $wishlistModel;
    protected $alamat;
    protected $db;
    protected $pager;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
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
        $this->alamat = new AlamatToko(); 
        $this->pager = \Config\Services::pager();
    }

    public function home()
    {
        // Pagination setup
        $pager = \Config\Services::pager();  // Make sure pager is available
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;  // Current page, default is 1
        $perPage = 12;  // Limit 12 items per page
    
        // Get paginated data
        $barangData = $this->barang->getBarangWithAlamatPaginated($perPage, $currentPage); // Call the model for pagination
    
        // Extract paginated data
        $barang = $barangData['barang'];  // The list of items
        $total = $barangData['total'];    // Total number of items
    
        // Calculate the total number of pages
        $totalPages = ceil($total / $perPage);  // Using ceil to round up the number of pages
    
        $ratingBarang = [];
        $jumlahRating = [];
    
        if ($barang) {
            foreach ($barang as &$value) {
                // Process ratings
                $avgRating = $this->db->table('ratingbarang')->where('idbarang', $value['id'])->selectAvg('rating')->get()->getRowArray();
                $ratingBarang[$value['id']] = isset($avgRating['rating']) ? round($avgRating['rating'] * 2) / 2 : 0;
                $jumlahRating[$value['id']] = $this->db->table('ratingbarang')->where('idbarang', $value['id'])->countAllResults();
    
                // Process addresses
                $alamat = $this->alamat->getAlamatByUser($value['pemilik']);
                if (!$alamat) {
                    $alamat = [
                        'kelurahan' => 'Alamat tidak tersedia',
                        'kecamatan' => 'Alamat tidak tersedia',
                        'kabupaten' => 'Alamat tidak tersedia',
                        'provinsi' => 'Alamat tidak tersedia'
                    ];
                }
                $value['alamat'] = $alamat;
            }
        }
    
        // Prepare data for view
        $data = [
            'barang' => $barang,
            'ratingBarang' => $ratingBarang,
            'jumlahRatingBarang' => $jumlahRating,
            'kategori' => $this->kategori->getSubKategori(),
            'iklan_tetap_1' => $this->iklantetap->find(1),
            'iklan_tetap_2' => $this->iklantetap->find(2),
            'iklan_tetap_3' => $this->iklantetap->find(3),
            'iklan_tetap_4' => $this->iklantetap->find(4),
            'iklan_carausel' => $this->iklancarausel->findAll(),
            'cart' => \Config\Services::cart(),
            'menu' => 'dashboard',
            'pager' => $pager,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages, // Pass total pages to view for pagination
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

    $kategori = $this->kategori->getSubKategori();

    $user = $userModel->getLogin($userId);


    var_dump($user);  // Memeriksa struktur data yang diterima
    exit;
    // if ($user === null) {
    //     return redirect()->to('/error');  
    // }

    // $data = [
    //     'user' => $user,               
    //     'total_cart' => $total_cart,  
    //     'kategori' => $kategori,      
    //     'menu' => 'myaccount',     
    //     'username' => $user['username'], 
    // ];

    // return view('user/myaccount', $data);
}


    public function detail($id)
    {
        // Mengambil satu barang berdasarkan ID
        $barang = $this->barang->find($id);

        // Mengambil rata-rata rating untuk barang tersebut
        $avgRating = $this->db->table('ratingbarang')->where('idbarang', $id)->selectAvg('rating')->get()->getRowArray();

        // Bulatkan rating ke terdekat 0.5
        $rating = isset($avgRating['rating']) ? round($avgRating['rating'] * 2) / 2 : 0;

        // Menghitung total review untuk barang tersebut
        $totalReview = $this->db->table('ratingbarang')->where('idbarang', $id)->countAllResults();

        // Ambil semua review
        $dataRating = $this->db->table('ratingbarang')->where('idbarang', $id)->orderBy('created_at', 'DESC')->get()->getResult();

        $data = [
            'barang' => $barang,
            'rating' => $rating,
            'totalReview' => $totalReview,
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->data_opsi($id),
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'shop',
            'dataRating' => $dataRating, // Return all reviews
        ];

        return view('user/detail', $data);
    }

    public function review($id)
    {

        if (empty(session()->id)) {
            session()->setFlashdata('errorlogin', 'Anda Harus Login');
            return redirect()->to('auth/login');
        } 
        
        if (empty($this->request->getPost('nama')) || empty($this->request->getPost('rating')) || empty($this->request->getPost('comment')) || empty($this->request->getPost('email'))) {
            return redirect()->back()->with('error', 'Anda belum mengisi semua data');
        }
        
        else {
            // Mengambil satu barang berdasarkan ID
            $barang = $this->barang->find($id);

            $data = [
                'idbarang' => $id,
                'iduser' => session()->get('id'),
                'rating' => $this->request->getPost('rating'),
                'comment' => $this->request->getPost('comment'),
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
            ];

            // dd($data);

            $this->db->table('ratingbarang')->insert($data);

            return redirect()->to('user/detail/' . $id);
        }
    }

    public function shop()
{
    // Fetch barang items berdasarkan nama kategori 'barang'
    $kategoriNama = 'barang'; // Jika ingin mengambil berdasarkan nama kategori
    $barang = $this->barang->getBarangByNamaKategori($kategoriNama); // Mengambil barang berdasarkan nama kategori

    // Ambil rating semua barang yang relevan sekaligus
    $barangIds = array_column($barang, 'id'); // Ambil ID barang dari barang yang sudah diambil
    $ratings = $this->db->table('ratingbarang')
        ->whereIn('idbarang', $barangIds) // Ambil rating berdasarkan ID barang yang ada
        ->select('idbarang, AVG(rating) as avg_rating') // Hitung rata-rata rating per barang
        ->groupBy('idbarang') // Kelompokkan berdasarkan idbarang
        ->get()
        ->getResultArray();

    // Buat array rating dengan ID barang sebagai key
    $rating = [];
    foreach ($ratings as $r) {
        // Bulatkan rating ke terdekat 0.5
        $rating[$r['idbarang']] = round($r['avg_rating'] * 2) / 2;
    }

    // Persiapkan data untuk view
    $data = [
        'barang' => $barang,
        'kategori' => $this->kategori->getSubKategori(),
        'cart' => \Config\Services::cart(),
        'menu' => 'shop',
        'rating' => $rating,
    ];

    // Return view dengan data yang telah disiapkan
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

    $data = [
        'barang' => $this->barang->getBarangByNamaKategori('Jasa'), 
        'barang_baru' => $this->barang->getNewBarang(8),
        'kategori' => $this->kategori->getSubKategori(), 
        'menu' => 'jasa', // Menentukan menu aktif
        'iklan_tetap_1' => $this->iklantetap->find(1), 
        'iklan_tetap_2' => $this->iklantetap->find(2), 
        'iklan_tetap_3' => $this->iklantetap->find(3), 
        'iklan_tetap_4' => $this->iklantetap->find(4), 
        'iklan_carausel' => $this->iklancarausel->findAll() 
    ];

    // Menampilkan view 'user/jasa' dengan data yang telah dipersiapkan
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

        if (empty($this->request->getPost('variasi'))) {
            return redirect()->back()->with('error', 'Anda belum memilih spesifikasi');
        }

        $qty = $this->request->getPost('jumlah');
        $id = $this->request->getPost('id');
        $jumlahbarang = $this->db->table('barang')->where('id', $id)->get()->getRow();

        $jumlahbarangisa = $jumlahbarang->jumlah_barang - $qty;
        if ($jumlahbarangisa < 0) {
            return redirect()->back()->with('error', 'Jumlah barang tidak mencukupi, stok yang tersedia adalah ' . $jumlahbarang->jumlah_barang);
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

            if (!session()->has('id')) {
                return redirect()->to('/auth/login');
            }

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

