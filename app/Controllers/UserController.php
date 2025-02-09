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
use App\Models\AlamatToko;
use Google_Client;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $barang;
    protected $user;
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
        $this->user = new Model_Auth();
        $this->transaksi = new Transaksi();
        $this->alamat = new AlamatToko(); 
        $this->pager = \Config\Services::pager();
    }

    public function home() 
{
    
    $barang = $this->barang->findAll();  
    
    if (!$barang) {
        $barang = [];
    }

    $ratingBarang = [];
    $jumlahRating = [];

    foreach ($barang as &$value) {
        $avgRating = $this->db->table('ratingbarang')->where('idbarang', $value['id'])->selectAvg('rating')->get()->getRowArray();
        $ratingBarang[$value['id']] = isset($avgRating['rating']) ? round($avgRating['rating'] * 2) / 2 : 0;
        $jumlahRating[$value['id']] = $this->db->table('ratingbarang')->where('idbarang', $value['id'])->countAllResults();


        $alamat = $this->alamat->getAlamatByUser($value['pemilik']);
        if (!$alamat) {
            $alamat = [
                'kelurahan' => 'Alamat tidak tersedia',
            ];
        }
        $value['alamat'] = $alamat;
    }

    // Prepare data for the view
    $data = [
        'barang' => $barang, // Pass all products to the view
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
    ];

    // Return the view with the data
    return view('user/home', $data);
}

    public function myaccount()
    {

        $userId = session()->get('id'); 
        $user   = $this->user->getLogin($userId);

        
        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'Pengguna tidak ditemukan. Silakan login kembali.');
        }


        return view('user/myaccount', [
            'user' => $user,
            'kategori' => $this->kategori->getSubKategori(),
            'menu' => 'myaccount', 
        ]);
    }


    public function updateProfile()
    {
        $userId = session()->get('id');


        $validation = \Config\Services::validation();
        $validation->setRules([
            'username'   => 'required|min_length[3]|max_length[50]',
            'email'      => 'required|valid_email|max_length[100]',
            'no_hp'      => 'required|max_length[15]|numeric',
            'alamat'     => 'permit_empty|max_length[255]',
            'foto_profil'=> 'permit_empty|is_image[foto_profil]|max_size[foto_profil,1024]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // Ambil data pengguna saat ini
        $user = $this->user->getLogin($userId);
        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'Pengguna tidak ditemukan. Silakan login kembali.');
        }

        // Proses upload gambar profil jika ada
        $fotoProfil = $this->request->getFile('foto_profil');
        $newFileName = $user['foto_profil']; // Default to the current profile picture

        if ($fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            // Generate a new file name if the upload is valid
            $newFileName = $fotoProfil->getRandomName();

            // Move the uploaded file to the 'uploads/profiles' directory
            $fotoProfil->move('uploads/profiles', $newFileName);

            // Hapus gambar lama jika ada
            if ($user['foto_profil'] && file_exists('uploads/profiles/' . $user['foto_profil'])) {
                unlink('uploads/profiles/' . $user['foto_profil']);
            }
        }

        // Data untuk diperbarui
        $data = [
            'username'    => $this->request->getPost('username'),
            'email'       => $this->request->getPost('email'),
            'no_hp'       => $this->request->getPost('no_hp'),
            'alamat'      => $this->request->getPost('alamat'),
            'foto_profil' => $newFileName, // Update with the new file name
        ];

        // Update ke database
        $this->user->update_register($data, $userId);

        // Redirect dengan pesan sukses
        return redirect()->to('/myaccount')->with('success', 'Profil berhasil diperbarui.');
    }


    public function detail($id)
    {
        // Ambil data barang
        $barang = $this->barang->find($id);

        $ratingData = $this->db->table('ratingbarang')
            ->select('AVG(rating) as avg_rating, COUNT(*) as total_review')
            ->where('idbarang', $id)
            ->get()
            ->getRowArray();
    
        $rating = $ratingData ? round($ratingData['avg_rating'] * 2) / 2 : 0;
        $totalReview = $ratingData ? $ratingData['total_review'] : 0;
        $dataRating = $this->db->table('ratingbarang')
            ->where('idbarang', $id)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
    
    
        $fotoBarang = $this->fotoBarang->where('id_barang', $id)->findAll();
        if (empty($fotoBarang)) {
            $fotoBarang = [['foto' => 'default-placeholder.jpg']];
        }
    
        $variasi = $this->variasi->data_opsi($id);
    
        $kategori = $this->kategori->getSubKategori();
    
        $pemilikBarang = $this->db->table('user')
            ->select('nama_toko, alamat')
            ->where('id', $barang['pemilik'])
            ->get()
            ->getRowArray();
    
        $alamatToko = $this->alamat->getAlamatByUser($barang['pemilik']);
        if (!$alamatToko) {
            $alamatToko = [
                'provinsi' => 'Alamat tidak tersedia',
                'kabupaten' => 'Alamat tidak tersedia',
                'kecamatan' => 'Alamat tidak tersedia',
                'kelurahan' => 'Alamat tidak tersedia',
            ];
        }
    
        $barang['alamat_user'] = $pemilikBarang['alamat'];
        $barang['alamat_toko'] = $alamatToko; 
    
        // Data untuk dikirim ke view
        $data = [
            'barang' => $barang,
            'rating' => $rating,
            'totalReview' => $totalReview,
            'foto_barang' => $fotoBarang,
            'variasi' => $variasi,
            'kategori' => $kategori,
            'cart' => \Config\Services::cart(),
            'menu' => 'shop',
            'dataRating' => $dataRating,
            'pemilik_barang' => $pemilikBarang, 
        ];
    
        // Tampilkan view dengan data
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
        } else {
            
            $barang = $this->barang->find($id);

            
            $foto = '';
            if ($this->request->getFile('foto')->isValid()) {
                $fotoFile = $this->request->getFile('foto');
                $fotoName = $fotoFile->getRandomName(); 
                $fotoFile->move('uploads/foto/', $fotoName); 
                $foto = $fotoName; 
            }

            
            $data = [
                'idbarang' => $id,
                'iduser' => session()->get('id'),
                'rating' => $this->request->getPost('rating'),
                'comment' => $this->request->getPost('comment'),
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'foto' => $foto, 
                'status' => 'Non Active' 
            ];

            
            $this->db->table('ratingbarang')->insert($data);

            return redirect()->to('user/detail/' . $id);
        }
    }
   

    public function shop()
    {
        // Mengambil data input wilayah dan memastikan formatnya sesuai
        $provinsi = trim(ucwords(strtolower(urldecode($this->request->getGet('provinsi')))));
        $kabupaten = trim(ucwords(strtolower(urldecode($this->request->getGet('kabupaten')))));
        $kecamatan = trim(ucwords(strtolower(urldecode($this->request->getGet('kecamatan')))));
        $kelurahan = trim(ucwords(strtolower(urldecode($this->request->getGet('kelurahan')))));
    
        // Mendapatkan data produk berdasarkan kategori
        $kategoriNama = 'barang';
        $barang = $this->barang->getBarangByNamaKategori($kategoriNama);
    
        // Jika semua wilayah dipilih, filter produk berdasarkan wilayah
        if ($provinsi && $kabupaten && $kecamatan && $kelurahan) {
            $barang = array_filter($barang, function ($item) use ($provinsi, $kabupaten, $kecamatan, $kelurahan) {
                return (
                    strtolower($item['provinsi']) === strtolower($provinsi) &&
                    strtolower($item['kabupaten']) === strtolower($kabupaten) &&
                    strtolower($item['kecamatan']) === strtolower($kecamatan) &&
                    strtolower($item['kelurahan']) === strtolower($kelurahan)
                );
            });
        }
    
        $barangIds = array_column($barang, 'id');
        shuffle($barang);
        $rating = [];
    
        if (!empty($barangIds)) {
            $ratings = $this->db->table('ratingbarang')
                ->whereIn('idbarang', $barangIds)
                ->select('idbarang, AVG(rating) as avg_rating')
                ->groupBy('idbarang')
                ->get()
                ->getResultArray();
    
            foreach ($ratings as $r) {
                $rating[$r['idbarang']] = round($r['avg_rating'] * 2) / 2; // Bulatkan ke 0.5
            }
        }
    
        $data = [
            'barang' => $barang,
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'shop',
            'rating' => $rating,
        ];
    
        return view('user/shop', $data);
    }
    

    

    public function filter_toko()
    {
        // Ambil data wilayah dari request
        $provinsi = $this->request->getVar('provinsi');
        $kabupaten = $this->request->getVar('kabupaten');
        $kecamatan = $this->request->getVar('kecamatan');
        $kelurahan = $this->request->getVar('kelurahan');
    
        if (empty($provinsi) || empty($kabupaten) || empty($kecamatan) || empty($kelurahan)) {
            return $this->response->setJSON(['error' => 'Semua parameter wilayah harus diisi.'])->setStatusCode(400);
        }
    
        $barang = $this->barang->getBarangByWilayah($provinsi, $kabupaten, $kecamatan, $kelurahan);

        log_message('info', 'Data barang yang dikembalikan: ' . json_encode($barang));
    
        if (empty($barang)) {
            return $this->response->setJSON(['message' => 'Tidak ada produk yang ditemukan berdasarkan filter wilayah.'])->setStatusCode(404);
        }
    
        return $this->response->setJSON($barang);
    }
    
    public function jasa()
    {
        // Ambil filter lokasi dari input GET
        $provinsi = trim(ucwords(strtolower(str_replace(["PROVINSI", "+"], ["", " "], $this->request->getGet('provinsi')))));
        $kabupaten = trim(ucwords(strtolower(str_replace(["KABUPATEN", "+"], ["", " "], $this->request->getGet('kabupaten')))));
        $kecamatan = trim(ucwords(strtolower(str_replace(["KECAMATAN", "+"], ["", " "], $this->request->getGet('kecamatan')))));
        $kelurahan = trim(ucwords(strtolower(str_replace(["KELURAHAN", "+"], ["", " "], $this->request->getGet('kelurahan')))));
    
        // Ambil data barang berdasarkan kategori 'jasa'
        $kategoriNama = 'jasa';
        $barang = $this->barang->getBarangByNamaKategori($kategoriNama);
    
        // Filter barang berdasarkan lokasi jika filter lokasi diberikan
        if ($provinsi && $kabupaten && $kecamatan && $kelurahan) {
            $barang = array_filter($barang, function ($item) use ($provinsi, $kabupaten, $kecamatan, $kelurahan) {
                return (
                    strtolower($item['provinsi']) === strtolower($provinsi) &&
                    strtolower($item['kabupaten']) === strtolower($kabupaten) &&
                    strtolower($item['kecamatan']) === strtolower($kecamatan) &&
                    strtolower($item['kelurahan']) === strtolower($kelurahan)
                );
            });
        }
    
        // Tambahkan pengacakan barang di sini
        $barang = array_values($barang); // Pastikan array memiliki indeks yang benar
        shuffle($barang); // Acak urutan barang
    
        // Ambil ID barang untuk menghitung rating
        $barangIds = array_column($barang, 'id');
        $rating = [];
    
        if (!empty($barangIds)) {
            $ratings = $this->db->table('ratingbarang')
                ->whereIn('idbarang', $barangIds)
                ->select('idbarang, AVG(rating) as avg_rating')
                ->groupBy('idbarang')
                ->get()
                ->getResultArray();
    
            // Buat array rating dengan ID barang sebagai key
            foreach ($ratings as $r) {
                $rating[$r['idbarang']] = round($r['avg_rating'] * 2) / 2; // Bulatkan ke 0.5
            }
        }
    
        // Siapkan data untuk dikirim ke view
        $data = [
            'barang' => $barang,
            'kategori' => $this->kategori->getSubKategori(),
            'cart' => \Config\Services::cart(),
            'menu' => 'jasa',
            'rating' => $rating,
        ];
    
        // Return view
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
    $variasi = $this->request->getVar('variasi'); // Ambil variasi yang dipilih
    $id_user = $this->session->get('id');
    $options = [];

    // Pastikan jika ada variasi yang dipilih, simpan dalam options
    if ($variasi) {
        // Pastikan hanya satu variasi yang dipilih
        if (is_array($variasi)) {
            // Jika ada lebih dari satu variasi, kembalikan error
            return redirect()->back()->with('error', 'Hanya satu variasi yang bisa dipilih.');
        }
        // Simpan variasi yang dipilih dalam options
        $options['variasi'] = $variasi;  
    }

    // Cek apakah variasi diperlukan dan belum dipilih
    if ($this->request->getPost('has_variasi') == 1) {
        if (empty($variasi)) {
            return redirect()->back()->with('error', 'Anda belum memilih spesifikasi');
        }
    }

    // Ambil jumlah dan ID barang
    $qty = $this->request->getPost('jumlah');
    $id = $this->request->getPost('id');
    
    // Ambil data barang dari database berdasarkan ID
    $jumlahbarang = $this->db->table('barang')->where('id', $id)->get()->getRow();

    // Cek stok yang tersedia
    $jumlahbarangisa = $jumlahbarang->jumlah_barang - $qty;
    if ($jumlahbarangisa < 0) {
        return redirect()->back()->with('error', 'Jumlah barang tidak mencukupi, stok yang tersedia adalah ' . $jumlahbarang->jumlah_barang);
    }

    // Masukkan item ke dalam keranjang (cart)
    $cart->insert(array(
        'id'        => $this->request->getPost('id'),
        'qty'       => $qty,
        'price'     => $this->request->getPost('harga_barang'),
        'name'      => $this->request->getPost('judul_barang'),
        'variasi'   => $variasi,  // Menyertakan variasi jika ada
        'id_barang' => $this->request->getPost('id_barang'),
        'options'   => $options,  // Menyimpan variasi dalam options
        'id_user'   => $id_user
    ));

    // Redirect ke halaman keranjang belanja
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
        $variasi = $this->request->getVar('variasi');
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
                    'variasi' => $variasi[$key],
                    'verifikasi' => 1,
                ];
            }
            $this->transaksi->insertBatch($data);
            $this->cart->destroyByUser($id_user);
        }
        session()->setFlashdata('pesan', 'Pesanan berhasil dibuat');
        return redirect()->to('cart');
    }

    public function transactionHistory()
    {
        $transactionModel = new Transaksi();

        // Ambil ID user yang sedang login
        $userId = session()->get('id');

        // Cek apakah user sudah login
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil filter yang diterima dari URL (GET)
        $filters = $this->request->getGet();

        // Build query untuk mengambil transaksi sesuai filter
        $builder = $transactionModel
            ->select('transaksi.*, barang.judul_barang, barang.harga_barang, barang.foto_barang')
            ->join('barang', 'barang.id = transaksi.id_barang')
            ->where('transaksi.id_user', $userId)
            ->orderBy('transaksi.created_at', 'DESC');

        // Filter berdasarkan status
        if (!empty($filters['status'])) {
            $builder->where('transaksi.verifikasi', $filters['status']);
        }

        // Filter berdasarkan rentang tanggal
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $builder->where('transaksi.created_at >=', $filters['start_date'])
                    ->where('transaksi.created_at <=', $filters['end_date']);
        }

        // Filter berdasarkan total minimal
        if (!empty($filters['min_total'])) {
            $builder->where('transaksi.total >=', $filters['min_total']);
        }

        // Filter berdasarkan total maksimal
        if (!empty($filters['max_total'])) {
            $builder->where('transaksi.total <=', $filters['max_total']);
        }

        // Ambil transaksi yang telah difilter
        $transactions = $builder->findAll();

        // Kirim data ke view
        $data = [
            'kategori' => $this->kategori->getSubKategori(),
            'transactions' => $transactions,
            'filters' => $filters, // Kirimkan filter ke view
            'menu' => 'transaction_history',
        ];

        // Return view dengan data transaksi yang telah difilter
        return view('user/transaction_history', $data);
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
                $userModel = new Model_Auth();
                $userId = session()->get('user_id'); // Adjust this according to how you get the user ID
                $user = $userModel->find($userId);

                return view('user/profile', ['username' => $user['username']]);
            }
            public function search()
            {
                // Membuat instance dari model Barang
                $barang = new Barang();
            
                // Ambil input pencarian dari form
                $title = $this->request->getVar('title');
            
                // Ambil hasil pencarian berdasarkan judul
                $barang = !empty($title) ? $barang->searchProductsByTitle($title) : [];
            
                $data = [
                    'kategori' => $this->kategori->getSubKategori(),
                    'menu' => 'cart',
                    'barang' => $barang,
                    'title'=> $title,
                ];

                // Return view dengan data pencarian
                return view('user/hasil_pencarian', $data);
            }

            public function subkategori()
            {

                $barangModel = new Barang();

                $subkategoriNama = $this->request->getGet('subkategori_nama');
                $barang = $barangModel->getProductsBySubkategori($subkategoriNama);

                $data = [
                    'kategori' => $this->kategori->getSubKategori(),
                    'menu' => 'cart',
                    'barang' => $barang,
                    'subkategori' => $subkategoriNama,
                ];

                return view('user/hasil_pencarian', $data);
            }
            




}


