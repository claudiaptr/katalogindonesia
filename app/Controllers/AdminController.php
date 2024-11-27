<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\IklanCarausel;
use App\Models\Kategori;
use App\Models\Model_Auth;
use App\Models\Pernarikan;
use App\Models\SubKategori;
use App\Models\Transaksi;
use App\Models\Variasi;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    //kontruktor untuk menambahkan model
    protected $iklancarausel, $kategori, $sub_kategori, $barang, $variasi, $fotoBarang, $transaksi, $user, $penarikan;
    public function __construct()
    {
        $this->sub_kategori = new SubKategori();
        $this->iklancarausel = new IklanCarausel();
        $this->fotoBarang = new GambarBarang();
        $this->variasi = new Variasi();
        $this->kategori = new Kategori();
        $this->barang = new Barang();
        $this->transaksi = new Transaksi();
        $this->user = new Model_Auth();
        $this->penarikan = new Pernarikan();
    }

    // view iklan carausel
    public function view_iklan_carausel()
    {
        $data = [
            'iklan' => $this->iklancarausel->getIklanCarausel(),
            'menu' => 'iklan',
            'sub_menu' => 'iklan_carausel',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()

        ];
        return view('admin/iklan_carausel/view_iklan', $data);
    }
    // tampilan tambah iklan carausel
    public function add_iklan_carausel()
    {
        session();
        $data = [
            'validation' => \Config\Services::validation(),
            'menu' => 'iklan',
            'sub_menu' => 'iklan_carausel',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/iklan_carausel/tambah_iklan', $data);
    }
    // proses tambah iklan carausel
    public function store_iklan_carausel()
    {

        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('admin/add_iklan_carausel')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'), '-', true);
        $foto_iklan = $this->request->getFile('foto_iklan');
        $foto_iklan->move('img');
        $nama_foto = $foto_iklan->getName();
        $this->iklancarausel->save([
            'foto_iklan' => $nama_foto,
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug' => $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        return redirect()->to('/admin/view_iklan_carausel');
    }
    // tampilan edit iklan carausel
    public function edit_iklan_carausel($slug)
    {
        session();
        $data = [
            'validation' => \Config\Services::validation(),
            'iklan' => $this->iklancarausel->getIklanCarausel($slug),
            'menu' => 'iklan',
            'sub_menu' => 'iklan_carausel',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/iklan_carausel/edit_iklan', $data);
    }
    // proses update iklan carausel
    public function update_iklan_carausel($id)
    {
        $foto = $this->request->getFile('foto_iklan');
        if ($foto->getError() == 4) {
            $this->request->getVar('foto_lama');
        } else {
            $foto->move('img');
            unlink('img/' . $this->request->getVar('foto_lama'));
        }
        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('admin/edit_iklan_carausel' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'), '-', true);
        $this->iklancarausel->save([
            'id' => $id,
            'foto_iklan' => $foto->getName(),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug' => $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),

        ]);
        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('/admin/view_iklan_carausel');
    }
    // proses hapus data iklan carausel
    public function delete_iklan_carusel($id)
    {
        $foto = $this->iklancarausel->find($id);
        unlink('img/' . $foto['foto_iklan']);
        $this->iklancarausel->delete($id);
        return redirect()->to('/admin/view_iklan_carausel');
    }

    // tampilan view kategri
    public function view_kategori()
    {
        $data = [
            'kategori' => $this->kategori->findAll(),
            'menu' => 'ketegori',
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/kategori/view_kategori', $data);
    }

    // tampilan tambah kategori
    public function add_kategori()
    {
        $data = [
            'menu' => 'ketegori',
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/kategori/tambah_kategori', $data);
    }

    // proses tambah kategori
    public function store_kategori()
    {
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);
        $this->kategori->save([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'slug' => $slug,
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        return redirect()->to('admin/view_kategori');
    }

    // tampilan edit kategori
    public function edit_kategori($slug)
    {
        $data = [
            'menu' => 'ketegori',
            'sub_menu' => '',
            'kategori' => $this->kategori->getKategori($slug),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/kategori/edit_kategori', $data);
    }
    // proses update kategori
    public function update_kategori($id)
    {
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);
        $this->kategori->save([
            'id' => $id,
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'slug' => $slug,
        ]);
        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('/admin/view_kategori');
    }
    // hapus kategori
    public function delete_kategori($id)
    {
        $this->kategori->delete($id);
        return redirect()->to('/admin/view_kategori');
    }
    // tampilan sub kategori
    public function view_sub_kategori()
    {
        $data = [
            'menu' => 'sub_ketegori',
            'sub_kategori' => $this->sub_kategori->findAll(),
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/sub_kategori/view', $data);
    }
    // tampilan tambah sub kategori
    public function add_sub_kategori()
    {
        $data = [
            'menu' => 'sub_ketegori',
            'sub_menu' => '',
            'kategori' => $this->kategori->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/sub_kategori/add', $data);
    }
    // proses tambah sub kategori
    public function store_sub_kategori()
    {
        $slug = url_title($this->request->getVar('nama_sub_kategori'), '-', true);

        $this->sub_kategori->save([
            'nama_sub_kategori' => $this->request->getVar('nama_sub_kategori'),
            'slug' => $slug,
            'id_kategori' => $this->request->getVar('id_kategori'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        return redirect()->to('admin/view_sub_kategori');
    }
    public function edit_sub_kategori($slug)
    {
        $data = [
            'menu' => 'sub_ketegori',
            'sub_menu' => '',
            'kategori' => $this->kategori->findAll(),
            'sub_kategori' => $this->sub_kategori->getSubKategori($slug),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/sub_kategori/edit', $data);
    }


    public function update_sub_kategori($id)
    {
        $slug = url_title($this->request->getVar('nama_sub_kategori'), '-', true);

        $this->sub_kategori->save([
            'id' => $id,
            'nama_sub_kategori' => $this->request->getVar('nama_sub_kategori'),
            'slug' => $slug,
            'id_kategori' => $this->request->getVar('id_kategori'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('admin/view_sub_kategori');
    }
    public function delete_sub_kategori($id)
    {
        $this->sub_kategori->delete($id);
        return redirect()->to('/admin/view_sub_kategori');
    }
    public function view_belum_verifikasi()
    {
        $data = [
            'menu' => 'verifikasi',
            'sub_menu' => 'belum_verifikasi',
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('verifikasi', 1)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults(),
        ];

        return view('admin/belum_verifikasi/view_blm_verifikasi', $data);
    }
    public function view_sudah_verifikasi()
    {
        $data = [
            'menu' => 'verifikasi',
            'sub_menu' => 'sudah_verifikasi',
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('verifikasi', 3)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/sudah_verifikasi/view_sdh_verifikasi', $data);
    }
    public function view_tolak_verifikasi()
    {
        $data = [
            'menu' => 'verifikasi',
            'sub_menu' => 'tolak_verifikasi',
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('verifikasi', 2)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/tolak_verifikasi/view_tlk_verifikasi', $data);
    }
    public function detail_barang($id)
    {
        $data = [
            'menu' => 'verifikasi',
            'sub_menu' => '',
            'barang' => $this->barang->find($id),
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->data_opsi($id),
            'kategori' => $this->kategori->getSubKategori(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/belum_verifikasi/detail_blm_verifikasi', $data);
    }
    public function verifikasi_barang($id)
    {
        $this->barang->save([
            'id' => $id,
            'verifikasi' => 3,
        ]);
        session()->setFlashdata('pesan', 'data berhasil diverifikasi');
        return redirect()->to('/admin/belum_verifikasi');
    }
    public function tolak_verifikasi_barang($id)
    {
        $this->barang->save([
            'id' => $id,
            'verifikasi' => 2,
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditolak');
        return redirect()->to('/admin/belum_verifikasi');
    }
    // pembayaran
    public function verifikasi_blm_pembayaran()
    {
        $data = [
            'menu' => 'pembayaran',
            'sub_menu' => 'belum_verifikasi_pembayaran',
            'transaksi' => $this->transaksi
                ->select('transaksi.*, barang.judul_barang, barang.pemilik, user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('transaksi.verifikasi', 1)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults(),
            'jumlah_verifikasi_pembayaran' => $this->transaksi->where('verifikasi', 1)->countAllResults()
        ];
        // $coba = $this->transaksi
        // ->select('transaksi.*, barang.judul_barang, barang.pemilik, user.username')
        // ->join('barang', 'barang.id = transaksi.id_barang')
        // ->join('user', 'user.id = transaksi.id_user')
        // ->where('transaksi.verifikasi', 1)->findAll();
        // dd($coba);

        return view('admin/pembayaran/view_blm_verifikasi', $data);
    }
    public function detail_pembayaran($id)
    {
        $data = [
            'menu' => 'pembayaran',
            'sub_menu' => '',
            'transaksi' => $this->transaksi
                ->select('transaksi.*, barang.judul_barang, barang.pemilik, user_transaksi.username as username_transaksi, user_barang.username as username_pemilik')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('user as user_transaksi', 'user_transaksi.id = transaksi.id_user') // Alias untuk user yang terkait dengan transaksi
                ->join('user as user_barang', 'user_barang.id = barang.pemilik') // Alias untuk user yang terkait dengan barang
                ->find($id),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/pembayaran/detail_pembayaran', $data);
    }
    public function verifikasi_pembayaran($id)
    {
        $this->transaksi->save([
            'id' => $id,
            'verifikasi' => 3,
        ]);
        session()->setFlashdata('pesan', 'data berhasil diverifikasi');
        return redirect()->to('/admin/verifikasi_blm_pembayaran');
    }
    public function view_sudah_verifikasi_pembayaran()
    {
        $data = [
            'menu' => 'pembayaran',
            'sub_menu' => 'sudah_verifikasi_pembayaran',
            'transaksi' => $this->transaksi
                ->select('transaksi.*, barang.judul_barang, barang.pemilik, user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('transaksi.verifikasi', 3)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/pembayaran/view_sdh_verifikasi', $data);
    }



    public function tolak_verifikasi_pembayaran($id)
    {
        $this->transaksi->save([
            'id' => $id,
            'verifikasi' => 2,
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditolak');
        return redirect()->to('/admin/verifikasi_tlk_pembayaran');
    }
    public function view_tolak_verifikasi_pembayaran()
    {
        $data = [
            'menu' => 'pembayaran',
            'sub_menu' => 'tolak_verifikasi_pembayaran',
            'transaksi' => $this->transaksi
                ->select('transaksi.*, barang.judul_barang, barang.pemilik, user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('transaksi.verifikasi', 2)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/pembayaran/view_tlk_verifikasi', $data);
    }
    // transfer
    public function view_transfer()
    {
        $data = [
            'menu' => 'transfer',
            'sub_menu' => '',
            'penjual' => $this->user
                ->where('level', 2)->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/transfer/view_transfer', $data);
    }
    public function add_transfer($id)
    {
        $data = [
            'menu' => 'transfer',
            'user' => $this->user->find($id),
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/transfer/add_transfer', $data);
    }
    public function store_transfer($id)
    {
        // Ambil saldo tambahan dari request
        $saldoTambahan = $this->request->getVar('saldo');

        // Ambil data pengguna berdasarkan ID
        $pengguna = $this->user->find($id);

        if ($pengguna) {
            // Tambahkan saldo tambahan ke saldo saat ini
            $saldoBaru = $pengguna['saldo'] + $saldoTambahan;

            // Simpan saldo baru ke database
            $this->user->save([
                'id' => $id,
                'saldo' => $saldoBaru,
            ]);

            // Set flashdata untuk pesan sukses
            session()->setFlashdata('pesan', 'Data berhasil diverifikasi');
        } else {
            // Set flashdata untuk pesan gagal
            session()->setFlashdata('error', 'Pengguna tidak ditemukan');
        }

        // Redirect ke halaman tertentu
        return redirect()->to('/admin/view_transfer');
    }
    // penarikan
    public function view_blm_penarikan()
    {
        $data = [
            'menu' => 'penarikan',
            'sub_menu' => 'belum_verifikasi_penarikan',
            'penarikan' => $this->penarikan
                ->select('penarikan.*, user.id as user_id, user.*')
                ->join('user', 'user.id = penarikan.id_user')
                ->findAll(),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/penarikan/view_blm_verifikasi', $data);
    }
    public function verifikasi_penarikan($id)
    {
        $data = [
            'menu' => 'penarikan',
            'sub_menu' => 'belum_verifikasi_penarikan',
            'penarikan' => $this->penarikan->find($id),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/penarikan/verifikasi_penarikan', $data);
    }
    public function edit_verifikasi_penarikan($id)
    {
        $data = [
            'menu' => 'penarikan',
            'sub_menu' => 'belum_verifikasi_penarikan',
            'penarikan' => $this->penarikan->find($id),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/penarikan/edit_penarikan', $data);
    }
    public function store_verifikasi_penarikan($id)
    {
        $id_user_penarikan = $this->penarikan->find($id);
        $id_user = $id_user_penarikan['id_user'];
        $saldoPengurangan = $id_user_penarikan['jumlah_penarikan'];
        $pengguna = $this->user->find($id_user);
        $saldoBaru = $pengguna['saldo'] - $saldoPengurangan;

        $bukti_penarikan = $this->request->getFile('bukti_penarikan');
        $nama_foto = $bukti_penarikan->getRandomName();
        $bukti_penarikan->move('penarikan', $nama_foto);
        $this->penarikan->save([
            'id' => $id,
            'bukti_pembayaran' => $nama_foto,
            'verifikasi_penarikan' => 3,
        ]);

        $this->user->save([
            'id' => $pengguna['id'],
            'saldo' => $saldoBaru,
        ]);

        session()->setFlashdata('pesan', 'data berhasil diverifikasi');
        return redirect()->to('admin/verifikasi_blm_penarikan');
    }
    public function update_verifikasi_penarikan($id)
    {
        $bukti_penarikan = $this->request->getFile('bukti_penarikan');
        $nama_foto = $bukti_penarikan->getRandomName();
        $bukti_penarikan->move('penarikan', $nama_foto);
        $this->penarikan->save([
            'id' => $id,
            'bukti_pembayaran' => $nama_foto,
            'verifikasi_penarikan' => 3,
        ]);

        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('admin/verifikasi_blm_penarikan');
    }
    public function detail_penarikan($id)
    {
        $data = [
            'menu' => 'penarikan',
            'sub_menu' => '',
            'penarikan' => $this->penarikan
                ->select('penarikan.*, user.id as user_id, user.*')
                ->join('user', 'user.id = penarikan.id_user')
                ->find($id),
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/penarikan/detail_penarikan', $data);
    }
    public function tolak_verifikasi_penarikan($id)
    {
        $this->penarikan->save([
            'id' => $id,
            'verifikasi' => 2,
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditolak');
        return redirect()->to('/admin/verifikasi_blm_penarikan');
    }

    public function dataPengguna()
    {
        $userModel = new Model_Auth();

        // Set pagination per page
        $perPage = 8;

        // Get the paginated users list
        $users = $userModel->paginate($perPage);

        // Modify the user data to add 'role' field
        foreach ($users as &$user) {
            switch ($user['level']) {
                case '1':
                    $user['role'] = 'Admin';
                    break;
                case '2':
                    $user['role'] = 'Penjual';
                    break;
                case '3':
                    $user['role'] = 'Pembeli';
                    break;
                default:
                    $user['role'] = 'Unknown';
                    break;
            }
        }

        // Prepare data to pass to view
        $data = [
            'users' => $users,
            'menu' => 'data_pengguna',
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults(),
            'pager' => $userModel->pager,  // Pass the pager to the view for pagination
        ];

        return view('admin/data_pengguna/data_pengguna', $data);
    }

    public function editDataPengguna($id)
    {
        $userModel = new Model_Auth();

        // Ambil data pengguna berdasarkan ID
        $user = $userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan!');
            return redirect()->to('/admin/data_pengguna');
        }

        // Data untuk ditampilkan di halaman edit
        $data = [
            'user' => $user,
            'menu' => 'data_pengguna',
            'sub_menu' => '',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults(),
        ];

        return view('admin/data_pengguna/edit_data_pengguna', $data);
    }



    public function updateDataPengguna()
    {
        $userModel = new Model_Auth();

        // Get form data
        $id = $this->request->getPost('id');
        $level = $this->request->getPost('level');

        // Prepare the data for updating
        $data = [
            'level' => $level,
        ];

        // Update the user data based on ID
        if ($userModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data pengguna berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data pengguna!');
        }

        return redirect()->to('/admin/data_pengguna');
    }
}
