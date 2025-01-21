<?php

namespace App\Controllers;


use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\Kategori;
use App\Models\Model_Auth;
use App\Models\Opsi;
use App\Models\Pernarikan;
use App\Models\SubKategori;
use App\Models\Transaksi;
use App\Models\Variasi;
use App\Models\AlamatToko;

class SalesController extends BaseController
{
    protected $barang;
    protected $fotoBarang, $kategori, $sub_kategori, $variasi, $opsi, $transaksi, $penarikan, $user, $alamat_toko;
    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
        $this->sub_kategori = new SubKategori();
        $this->variasi = new Variasi();
        $this->opsi = new Opsi();
        $this->transaksi = new Transaksi();
        $this->penarikan = new Pernarikan();
        $this->user = new Model_Auth();
        $this->alamat_toko = new AlamatToko();
        session();
    }
    public function home()
    {
        $data = [
            'menu' => 'dashboard',
        ];
        return view('sales/home', $data);
    }
    public function view_barang()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('kategori.nama_kategori', 'Barang')
                ->where('barang.pemilik', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/barang/view_barang', $data);
    }
    public function add_barang()
    {

        $kategori_barang = $this->kategori->where('nama_kategori', 'Barang')->first();

        if (!$kategori_barang) {
            return redirect()->back()->with('error', 'Kategori "Barang" tidak ditemukan.');
        }

        $sub_kategori_barang = $this->sub_kategori->where('id_kategori', $kategori_barang['id'])->findAll();

        $data = [
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori_barang,  // Kirim kategori jasa
            'sub_kategori' => $sub_kategori_barang,  // Kirim subkategori yang sesuai
            'menu' => 'barang',
        ];

        return view('sales/barang/add_barang', $data);
    }
    public function store_barang()
    {
        $validate = $this->validate([
            'judul_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Username.',
                ],
            ],
            'id_kategori_barang' => [
                'rules' => 'permit_empty',  // Mengubah menjadi opsional
                'errors' => [
                    'permit_empty' => 'You must choose a kategori.',
                ],
            ],
            'id_sub_kategori_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a sub kategori.',
                ],
            ],
            'foto_barang' => [
                'rules' => 'uploaded[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'You must choose a foto barang.',
                    'mime_in' => 'Only image files are allowed (jpg, jpeg, png).',
                ],
            ],
            'harga_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a harga barang.',
                ],
            ],
            'jumlah_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a jumlah barang.',
                ],
            ],
            'deskripsi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must input a deskripsi.',
                ],
            ],
        ]);

        if (!$validate) {
            $validation = \Config\Services::validation();
            $error = $validation->getErrors();
            $errorString = implode(' + ', $error);
            session()->setFlashdata('error', $errorString);
            return redirect()->back();
        }

        // Menentukan kategori default berdasarkan nama kategori
        $kategoriJasa = $this->kategori->where('nama_kategori', 'Barang')->first();
        $idKategori = $kategoriJasa ? $kategoriJasa['id'] : null; // Jika kategori "Jasa" ditemukan, ambil id-nya, jika tidak set ke null

        // Menangani upload gambar barang
        $foto_barang = $this->request->getFile('foto_barang');
        $nama_foto = $foto_barang->getRandomName();
        $foto_barang->move('barang', $nama_foto);

        // Menyimpan data barang ke database
        $this->barang->save([
            'pemilik' => $this->request->getVar('pemilik'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'id_kategori_barang' => $idKategori,  // Menggunakan kategori default jika tidak dipilih
            'id_sub_kategori_barang' => $this->request->getVar('id_sub_kategori_barang'),
            'foto_barang' => $nama_foto,
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' => $this->request->getVar('deskripsi_barang'),
        ]);

        // Menyimpan foto detail jika ada
        $files = $this->request->getFileMultiple('foto_detail');
        $idBarang = $this->barang->getInsertID();
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move('fotobarang');

                    $this->fotoBarang->save([
                        'foto_barang_lain' => $file->getName(),
                        'id_barang' => $idBarang,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'One or more detail images failed to upload.');
                }
            }
        }

        // Menyimpan variasi jika ada
        $namaVariasi = $this->request->getVar('nama_variasi');
        if ($idBarang && is_array($namaVariasi)) {
            $data = [];
            foreach ($namaVariasi as $nama) {
                $data[] = [
                    'id_barang' => $idBarang,
                    'nama_variasi' => $nama,
                ];
            }
            $this->variasi->insertBatch($data);
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambah');
        return redirect()->to('/sales/barang/view_barang');
    }

    public function edit_barang($id)
    {
        $barang = $this->barang->find($id);

        $barang['harga_barang'] = number_format($barang['harga_barang'], 0, ',', '.');

        $barang['harga_setelah_diskon'] = isset($barang['harga_setelah_diskon']) ?
            number_format($barang['harga_setelah_diskon'], 0, ',', '.') : 0;

        $data = [
            'barang' => $barang,
            'kategori' => $this->kategori->findAll(),
            'sub_ketgori' => $this->sub_kategori->where('id_kategori', $barang['id_kategori_barang'])->findAll(),
            'foto_detail' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->where('id_barang', $id)->findAll(),
            'menu' => 'barang',
            'validation' => \Config\Services::validation(),
        ];

        return view('sales/barang/edit_barang', $data);
    }

    public function update_barang($id)
    {

        $diskon = $this->request->getVar('diskon');
        $harga_barang = $this->request->getVar('harga_barang');

        // Perhitungan harga setelah diskon
        if ($diskon) {

            $harga_setelah_diskon = $harga_barang - ($harga_barang * ($diskon / 100));
        } else {

            $harga_setelah_diskon = $harga_barang;
        }


        $foto_barang = $this->request->getFile('foto_barang');
        if ($foto_barang && $foto_barang->isValid() && !$foto_barang->hasMoved()) {
            $nama_foto = $foto_barang->getRandomName();
            $foto_barang->move('barang', $nama_foto);
        } else {

            $nama_foto = $this->request->getVar('existing_foto_barang'); // Gambar sebelumnya
        }


        $this->barang->update($id, [
            'pemilik' => $this->request->getVar('pemilik'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'harga_barang' => $harga_barang,
            'harga_setelah_diskon' => $harga_setelah_diskon, // Simpan harga setelah diskon
            'id_kategori_barang' => $this->request->getVar('id_kategori_barang'),
            'id_sub_kategori_barang' => $this->request->getVar('id_sub_kategori_barang'),
            'foto_barang' => $nama_foto,
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' => $this->request->getVar('deskripsi_barang'),
            'diskon' => $diskon, // Simpan diskon
        ]);


        $fotoDetails = $this->request->getFiles();
        if (isset($fotoDetails['foto_detail'])) {
            foreach ($fotoDetails['foto_detail'] as $index => $fotoDetail) {
                if ($fotoDetail && $fotoDetail->isValid() && !$fotoDetail->hasMoved()) {
                    $newName = $fotoDetail->getRandomName();
                    $fotoDetail->move('fotobarang', $newName);

                    // Cek apakah ini foto detail lama atau baru
                    $foto_detail_id = $this->request->getPost('foto_detail_id')[$index] ?? null;
                    if ($foto_detail_id) {
                        // Update foto detail yang ada
                        $this->fotoBarang->update($foto_detail_id, ['foto_barang_lain' => $newName]);
                    } else {
                        // Insert foto detail baru
                        $this->fotoBarang->insert([
                            'id_barang' => $id,
                            'foto_barang_lain' => $newName,
                        ]);
                    }
                }
            }
        }

        $variasiNames = $this->request->getPost('nama_variasi');
        $variasiIds = $this->request->getPost('variasi_id');
        if ($variasiNames) {
            foreach ($variasiNames as $index => $nama_variasi) {
                $variasi_id = $variasiIds[$index] ?? null;
                if ($variasi_id) {
                    $this->variasi->update($variasi_id, ['nama_variasi' => $nama_variasi]);
                } else {
                    $this->variasi->insert([
                        'id_barang' => $id,
                        'nama_variasi' => $nama_variasi,
                    ]);
                }
            }
        }

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('/sales/barang/view_barang')->with('success', 'Data barang berhasil diperbarui.');
    }


    public function delete_foto_lain($id)
    {
        $foto = $this->fotoBarang->find($id);
        unlink('fotobarang/' . $foto['foto_barang_lain']);
        $this->fotoBarang->delete($id);
        return redirect()->back();
    }
    public function delete_barang($id)
    {
        // Mengambil data barang
        $barang = $this->barang->find($id);

        if ($barang) {
            // Menghapus foto utama barang jika ada
            if ($barang['foto_barang'] && file_exists('barang/' . $barang['foto_barang'])) {
                unlink('barang/' . $barang['foto_barang']);
            }

            // Mengambil dan menghapus semua foto detail barang
            $fotoDetails = $this->fotoBarang->where('id_barang', $id)->findAll();
            foreach ($fotoDetails as $fotoDetail) {
                if ($fotoDetail['foto_barang_lain'] && file_exists('fotobarang/' . $fotoDetail['foto_barang_lain'])) {
                    unlink('fotobarang/' . $fotoDetail['foto_barang_lain']);
                }
                $this->fotoBarang->delete($fotoDetail['id']);
            }

            // Menghapus semua variasi barang
            $this->variasi->where('id_barang', $id)->delete();

            // Menghapus barang
            $this->barang->delete($id);

            return redirect()->to('/sales/barang/view_barang')->with('message', 'Barang berhasil dihapus');
        } else {
            return redirect()->to('/sales/barang/view_barang')->with('error', 'Barang tidak ditemukan');
        }
    }

    public function sub_kategori()
    {
        $id_kategori = $this->request->getPost('id_kategori');
        $kat = $this->kategori->SubKategori($id_kategori);
        echo '  <option value="">Pilih Barang</option>';
        foreach ($kat as $key) {
            echo " <option value=" . $key['id'] . ">" . $key['nama_sub_kategori'] . " </option>";
        }
    }
    public function view_tambah_variasi($id)
    {
        $data = [
            'menu' => 'barang',
            'variasi' => $this->variasi->where('id_barang', $id)->findAll(),
        ];

        return view('sales/barang/view_variasi', $data);
    }
    public function delete_variasi($id)
    {
        // Cek apakah variasi ada berdasarkan ID
        $variasi = $this->variasi->find($id);

        if (!$variasi) {
            return redirect()->to('/sales/view_tambah_variasi')->with('error', 'Variasi tidak ditemukan.');
        }

        // Hapus variasi berdasarkan ID
        $this->variasi->delete($id);

        return redirect()->to('/sales/view_tambah_variasi')->with('success', 'Variasi berhasil dihapus.');
    }

    public function tambah_opsi($id)
    {
        $variasi = $this->variasi->find($id);
        $data = [
            'menu' => 'barang',
            'variasi' => $variasi,
            'validation' => \Config\Services::validation(),
        ];

        return view('sales/barang/add_opsi', $data);
    }

    public function edit_opsi($id)
    {
        $variasi = $this->variasi->find($id);
        $opsi = $this->opsi->where('id_variasi', $variasi['id'])->findAll();

        $data = [
            'opsi' => $opsi,
            'variasi' => $variasi,
            'menu' => 'barang',
            'validation' => \Config\Services::validation(),
        ];

        return view('sales/barang/edit_opsi', $data);
    }

    public function update_opsi()
    {
        // Tambahkan debugging
        $requestData = $this->request->getPost();
        $nama_opsi = $this->request->getVar('nama_opsi');
        $id_barang = $this->request->getVar('id_barang');
        $harga = $this->request->getVar('harga');
        $id = $this->request->getVar('id');

        // Validasi input
        $rules = [];
        foreach ($nama_opsi as $key => $value) {
            $rules["nama_opsi.$key"] = [
                'rules' => 'required',
                'errors' => [
                    'required' => "You must choose a Username for option " . ($key + 1) . ".",
                ],
            ];
            $rules["harga.$key"] = [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => "You must choose a Harga for option " . ($key + 1) . ".",
                    'numeric' => "The Harga for option " . ($key + 1) . " must be a number.",
                ],
            ];
        }

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $error = \Config\Services::validation()->getErrors();
            $errorString = implode(' ', $error);
            session()->setFlashdata('error', $errorString);
            return redirect()->back()->with('validation', $validation)->withInput();
        }

        // Memperbarui data opsi
        for ($i = 0; $i < count($nama_opsi); $i++) {
            $this->opsi->save([
                'id' => $id[$i],
                'nama_opsi' => $nama_opsi[$i],
                'harga' => $harga[$i],
            ]);
        }
        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('/sales/view_tambah_variasi/' . $id_barang)->with('success', 'Opsi berhasil diperbarui.');
    }
    public function store_opsi()
    {
        // Retrieve input values
        $nama_opsi = $this->request->getVar('nama_opsi');
        $harga = $this->request->getVar('harga');
        $id_variasi = $this->request->getVar('id_variasi');
        $id_barang = $this->request->getVar('id_barang');

        // Validation rules for array elements
        $rules = [];
        foreach ($nama_opsi as $key => $value) {
            $rules["nama_opsi.$key"] = [
                'rules' => 'required',
                'errors' => [
                    'required' => "You must choose a Username for option " . ($key + 1) . ".",
                ],
            ];
            $rules["harga.$key"] = [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => "You must choose a Harga for option " . ($key + 1) . ".",
                    'numeric' => "The Harga for option " . ($key + 1) . " must be a number.",
                ],
            ];
        }
        // Validate input
        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $error = \Config\Services::validation()->getErrors();
            $errorString = implode(' ', $error);
            session()->setFlashdata('error', $errorString);
            return redirect()->back()->with('validation', $validation)->withInput();
        }
        // Insert each option into the database
        for ($i = 0; $i < count($nama_opsi); $i++) {
            $this->opsi->insert([
                'id_variasi' => $id_variasi,
                'nama_opsi' => $nama_opsi[$i],
                'harga' => $harga[$i],
            ]);
        }

        session()->setFlashdata('pesan', 'data berhasil ditambah');

        return redirect()->to('/sales/view_tambah_variasi/' . $id_barang)->with('success', 'Opsi baru berhasil ditambahkan.');
    }
    public function deleteOpsi($id)
    {
        if ($this->opsi->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }
    public function view_pesanan()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.total, transaksi.jumlah, transaksi.options, transaksi.nomortelp, transaksi.alamat, transaksi.bukti_pembayaran, 
                         barang.id as barang_id, barang.foto_barang, barang.judul_barang, barang.harga_barang, barang.verifikasi as verifikasi_barang, barang.jumlah_barang, 
                         kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name, 
                         user.username, transaksi.variasi')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 3)
                ->orderBy('transaksi.created_at', 'DESC')
                ->findAll(),
            'menu' => 'pesanan',
        ];
    
        return view('sales/pesanan/view_pesanan', $data);
    }
    

    


    public function kemas($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        // $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // // update jumlah di tabel barang
        // $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
        //     'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        // ]); 
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 2
        ]);

        return redirect()->to('/sales/view_pesanan');
    }

    public function view_jasa()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('kategori.nama_kategori', 'Jasa')
                ->where('barang.pemilik', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/jasa/view_jasa', $data);
    }

    public function add_jasa()
    {

        $kategori_jasa = $this->kategori->where('nama_kategori', 'Jasa')->first();

        if (!$kategori_jasa) {
            return redirect()->back()->with('error', 'Kategori "Jasa" tidak ditemukan.');
        }

        $sub_kategori_jasa = $this->sub_kategori->where('id_kategori', $kategori_jasa['id'])->findAll();

        $data = [
            'validation' => \Config\Services::validation(),
            'kategori' => $kategori_jasa,  // Kirim kategori jasa
            'sub_kategori' => $sub_kategori_jasa,  // Kirim subkategori yang sesuai
            'menu' => 'barang',
        ];

        return view('sales/jasa/add_jasa', $data);
    }

    public function store_jasa()
    {
        $validate = $this->validate([
            'judul_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Username.',
                ],
            ],
            'id_kategori_barang' => [
                'rules' => 'permit_empty',  // Mengubah menjadi opsional
                'errors' => [
                    'permit_empty' => 'You must choose a kategori.',
                ],
            ],
            'id_sub_kategori_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a sub kategori.',
                ],
            ],
            'foto_barang' => [
                'rules' => 'uploaded[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'You must choose a foto barang.',
                    'mime_in' => 'Only image files are allowed (jpg, jpeg, png).',
                ],
            ],
            'harga_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a harga barang.',
                ],
            ],
            'jumlah_barang' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a jumlah barang.',
                ],
            ],
            'deskripsi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must input a deskripsi.',
                ],
            ],
        ]);

        if (!$validate) {
            $validation = \Config\Services::validation();
            $error = $validation->getErrors();
            $errorString = implode(' + ', $error);
            session()->setFlashdata('error', $errorString);
            return redirect()->back();
        }

        // Menentukan kategori default berdasarkan nama kategori
        $kategoriJasa = $this->kategori->where('nama_kategori', 'Jasa')->first();
        $idKategori = $kategoriJasa ? $kategoriJasa['id'] : null; // Jika kategori "Jasa" ditemukan, ambil id-nya, jika tidak set ke null

        // Menangani upload gambar barang
        $foto_barang = $this->request->getFile('foto_barang');
        $nama_foto = $foto_barang->getRandomName();
        $foto_barang->move('barang', $nama_foto);

        // Menyimpan data barang ke database
        $this->barang->save([
            'pemilik' => $this->request->getVar('pemilik'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'id_kategori_barang' => $idKategori,  // Menggunakan kategori default jika tidak dipilih
            'id_sub_kategori_barang' => $this->request->getVar('id_sub_kategori_barang'),
            'foto_barang' => $nama_foto,
            'jumlah_barang' => $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' => $this->request->getVar('deskripsi_barang'),
        ]);

        // Menyimpan foto detail jika ada
        $files = $this->request->getFileMultiple('foto_detail');
        $idBarang = $this->barang->getInsertID();
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move('fotobarang');

                    $this->fotoBarang->save([
                        'foto_barang_lain' => $file->getName(),
                        'id_barang' => $idBarang,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'One or more detail images failed to upload.');
                }
            }
        }

        // Menyimpan variasi jika ada
        $namaVariasi = $this->request->getVar('nama_variasi');
        if ($idBarang && is_array($namaVariasi)) {
            $data = [];
            foreach ($namaVariasi as $nama) {
                $data[] = [
                    'id_barang' => $idBarang,
                    'nama_variasi' => $nama,
                ];
            }
            $this->variasi->insertBatch($data);
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambah');
        return redirect()->to('/sales/jasa/view_jasa');
    }

    public function edit_jasa($id)
    {
        $barang = $this->barang->find($id);

        $barang['harga_barang'] = number_format($barang['harga_barang'], 0, ',', '.');

        $barang['harga_setelah_diskon'] = isset($barang['harga_setelah_diskon']) ?
            number_format($barang['harga_setelah_diskon'], 0, ',', '.') : 0;

        $data = [
            'barang' => $barang,
            'kategori' => $this->kategori->findAll(),
            'sub_ketgori' => $this->sub_kategori->where('id_kategori', $barang['id_kategori_barang'])->findAll(),
            'foto_detail' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->where('id_barang', $id)->findAll(),
            'menu' => 'barang',
            'validation' => \Config\Services::validation(),
        ];

        return view('sales/barang/edit_barang', $data);
    }

    public function update_jasa($id)
    {
        // Validasi input

        // Mengunggah gambar utama jika ada
        $foto_barang = $this->request->getFile('foto_barang');
        if ($foto_barang && $foto_barang->isValid() && !$foto_barang->hasMoved()) {
            $nama_foto = $foto_barang->getRandomName();
            $foto_barang->move('barang', $nama_foto);
        } else {
            $nama_foto = $this->request->getVar('existing_foto_barang'); // Gambar sebelumnya
        }
        // Memperbarui data barang
        $this->barang->update($id, [
            'pemilik' => $this->request->getVar('pemilik'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            // 'diskon_barang' => $this->request->getVar('diskon_barang'),
            'id_kategori_barang' =>  $this->request->getVar('id_kategori_barang'),
            'id_sub_kategori_barang' =>  $this->request->getVar('id_sub_kategori_barang'),
            'foto_barang' =>  $nama_foto,
            'jumlah_barang' =>  $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' =>  $this->request->getVar('deskripsi_barang'),
        ]);

        // Mengunggah dan memperbarui gambar detail
        $fotoDetails = $this->request->getFiles();
        if (isset($fotoDetails['foto_detail'])) {
            foreach ($fotoDetails['foto_detail'] as $index => $fotoDetail) {
                if ($fotoDetail && $fotoDetail->isValid() && !$fotoDetail->hasMoved()) {
                    $newName = $fotoDetail->getRandomName();
                    $fotoDetail->move('fotobarang', $newName);

                    // Check if this is an existing photo or a new one
                    $foto_detail_id = $this->request->getPost('foto_detail_id')[$index] ?? null;
                    if ($foto_detail_id) {
                        $this->fotoBarang->update($foto_detail_id, ['foto_barang_lain' => $newName]);
                    } else {
                        $this->fotoBarang->insert([
                            'id_barang' => $id,
                            'foto_barang_lain' => $newName,
                        ]);
                    }
                }
            }
        }

        // Handle variasi update
        $variasiNames = $this->request->getPost('nama_variasi');
        $variasiIds = $this->request->getPost('variasi_id');
        if ($variasiNames) {
            // Hapus variasi yang lama terlebih dahulu
            $this->variasi->where('id_barang', $id)->delete();

            // Insert variasi baru
            foreach ($variasiNames as $index => $nama_variasi) {
                $variasi_id = $variasiIds[$index] ?? null;
                if ($variasi_id) {
                    $this->variasi->update($variasi_id, ['nama_variasi' => $nama_variasi]);
                } else {
                    $this->variasi->insert([
                        'id_barang' => $id,
                        'nama_variasi' => $nama_variasi,
                    ]);
                }
            }
        }
        $this->variasi->where('id_barang', $id)->delete();
        foreach ($variasiNames as $index => $nama_variasi) {
            $this->variasi->insert([
                'id_barang' => $id,
                'nama_variasi' => $nama_variasi,
            ]);
        }
        session()->setFlashdata('pesan', 'data berhasil diupdate');
        return redirect()->to('/sales/jasa/view_jasa')->with('success', 'Data Jasa berhasil diperbarui.');
    }

    public function delete_jasa($id)
    {
        // Mengambil data barang
        $barang = $this->barang->find($id);

        if ($barang) {
            // Menghapus foto utama barang jika ada
            if ($barang['foto_barang'] && file_exists('barang/' . $barang['foto_barang'])) {
                unlink('barang/' . $barang['foto_barang']);
            }

            // Mengambil dan menghapus semua foto detail barang
            $fotoDetails = $this->fotoBarang->where('id_barang', $id)->findAll();
            foreach ($fotoDetails as $fotoDetail) {
                if ($fotoDetail['foto_barang_lain'] && file_exists('fotobarang/' . $fotoDetail['foto_barang_lain'])) {
                    unlink('fotobarang/' . $fotoDetail['foto_barang_lain']);
                }
                $this->fotoBarang->delete($fotoDetail['id']);
            }

            // Menghapus semua variasi barang
            $this->variasi->where('id_barang', $id)->delete();

            // Menghapus barang
            $this->barang->delete($id);

            return redirect()->to('/sales/jasa/view_jasa')->with('message', 'Barang berhasil dihapus');
        } else {
            return redirect()->to('/sales/jasa/view_jasa')->with('error', 'Barang tidak ditemukan');
        }
    }

    public function kemas_jasa($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        // $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // // update jumlah di tabel barang
        // $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
        //     'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        // ]); 
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 2
        ]);

        return redirect()->to('/sales/kemasan_jasa');
    }

    public function selesai($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        // $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // // update jumlah di tabel barang
        // $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
        //     'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        // ]);
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 5
        ]);

        return redirect()->to('/sales/selesai_pesanan');
    }

    public function selesaian($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        // $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // // update jumlah di tabel barang
        // $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
        //     'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        // ]);
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 5
        ]);

        return redirect()->to('/sales/selesai_jasa');
    }
    public function kiriman($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // update jumlah di tabel barang
        $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
            'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        ]);
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 4
        ]);

        return redirect()->to('/sales/kiriman_jasa');
    }
    public function kirim($idtransaksi)
    {
        $id = session()->get('id');

        $transaksi = $this->db->table('transaksi')->where('id', $idtransaksi)->get()->getRowArray();
        $jumlahbarang = $this->db->table('barang')->where('id', $transaksi['id_barang'])->get()->getRowArray();
        // update jumlah di tabel barang
        $this->db->table('barang')->where('id', $transaksi['id_barang'])->update([
            'jumlah_barang' => $jumlahbarang['jumlah_barang'] - $transaksi['jumlah']
        ]);
        $this->db->table('transaksi')->where('id', $idtransaksi)->update([
            'verifikasi' => 4
        ]);

        return redirect()->to('/sales/kirim_pesanan');
    }
    public function kemas_pesanan()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name,user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 2)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Barang')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/kemas_pesanan', $data);
    }
        public function kemasan_jasa()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name, user.username, transaksi.options')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 2)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Jasa')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/kemas_jasa', $data);
    }

    public function selesai_pesanan()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name,user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 5)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Barang')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/selesai_pesanan', $data);
    }
    public function selesai_jasa()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name,user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 5)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Jasa')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/selesai_jasa', $data);
    }
    public function kirim_pesanan()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name,user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 4)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Barang')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/kirim_pesanan', $data);
    }
    public function kiriman_jasa()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->transaksi
                ->select('transaksi.id as transaksi_id, transaksi.verifikasi as verifikasi_transaksi, transaksi.*, barang.id as barang_id, barang.verifikasi as verifikasi_barang, barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name,user.username')
                ->join('barang', 'barang.id = transaksi.id_barang')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->join('user', 'user.id = transaksi.id_user')
                ->where('barang.pemilik', $id)
                ->where('transaksi.verifikasi', 4)
                ->orderBy('transaksi.created_at', 'DESC')
                ->where('kategori.nama_kategori', 'Jasa')
                ->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/pesanan/kiriman_jasa', $data);
    }
    public function view_diskon()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->barang
                ->select('barang.*, kategori.nama_kategori as kategori_name, sub_kategori.nama_sub_kategori as sub_kategori_name')
                ->join('kategori', 'kategori.id = barang.id_kategori_barang')
                ->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang')
                ->where('barang.pemilik', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/diskon/view_diskon', $data);
    }
    public function add_diskon()
    {
        $data = [
            'barang' => $this->barang->findAll(), // Fetch products from the barang model
            'validation' => \Config\Services::validation(), // Load validation service
        ];

        return view('sales/diskon/add_diskon', $data);
    }

    public function add_penarikan()
    {
        $data = [
            'menu' => 'penarikan',
        ];

        return view('sales/penarikan/add_penarikan', $data);
    }
    public function view_penarikan()
    {
        $id = session()->get('id');
        $data = [
            'menu' => 'penarikan',
            'penarikan' => $this->penarikan->where('id_user', $id)->findAll(),
        ];
        return view('sales/penarikan/view_penarikan', $data);
    }
    public function foto_bukti($id)
    {
        $data = [
            'menu' => 'penarikan',
            'penarikan' => $this->penarikan->find($id),
        ];
        return view('sales/penarikan/bukti_penarikan', $data);
    }
    public function store_penarikan()
    {
        // Retrieve input values
        $bank = $this->request->getVar('bank');
        $rekening = $this->request->getVar('rekening');
        $jumlah_penarikan = $this->request->getVar('jumlah_penarikan');
        $username_penarikan = $this->request->getVar('username_penarikan');
        $id_user = session()->get('id');
        $user = $this->user->find($id_user);
        if ($user['saldo'] > $jumlah_penarikan) {
            $this->penarikan->save([
                'bank' => $bank,
                'nomor_rekening' => $rekening,
                'jumlah_penarikan' => $jumlah_penarikan,
                'username_penarikan' => $username_penarikan,
                'id_user' => $id_user,
            ]);
            session()->setFlashdata('pesan', 'Penarikan Berhasil Mohon Menunggu Untuk Divalidasi');
            return redirect()->to('/sales/view_penarikan');
        } else {
            session()->setFlashdata('error', 'Saldo Kurang');
            return redirect()->back();
        }
    }

    public function daftar_penjual()
    {
        return view('daftar_penjual');
    }

    // Add seller details
    public function add_penjual()
    {
        if ($this->validate([
            'nama_toko' => [
                'label' => 'Nama Toko',
                'rules' => 'required',
                'errors' => ['required' => 'You must choose a Nama Toko.']
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => ['required' => 'You must choose a Alamat.']
            ]
        ])) {
            $id = session()->get('id');
            $data = [
                'nama_toko' => $this->request->getPost('nama_toko'),
                'alamat' => $this->request->getPost('alamat'),
                'level' => 3, // Level pendaftar (tetap level 3 saat pendaftaran)
            ];

            // Update penjual data
            $this->user->update_register($data, $id);

            // Save alamat toko
            $this->alamat_toko->save([
                'provinsi' => $this->request->getPost('provinsi'),
                'kabupaten' => $this->request->getPost('kabupaten'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kelurahan' => $this->request->getPost('kelurahan'),
                'user' => $id,
            ]);

            session()->setFlashdata('pesan', 'Pendaftaran Penjual berhasil! Menunggu verifikasi admin.');

            // Redirect ke halaman beranda atau halaman lainnya
            return redirect()->to('user/home'); // Sesuaikan URL sesuai rute yang sesuai
        }
    }

    public function profilepenjual()
    {
        // Ambil ID pengguna yang sedang login dari session
        $userId = session()->get('id'); // Pastikan session id diatur saat login
        $user   = $this->user->getLogin($userId);

        // Pastikan data user ditemukan
        if (!$user) {
            return redirect()->to('/auth/login')->with('error', 'Pengguna tidak ditemukan. Silakan login kembali.');
        }

        // Kirim data ke view dengan menambahkan 'menu' => 'profile'
        return view('sales/profilepenjual', [
            'user' => $user,
            'menu' => 'profile', // Menambahkan menu dengan nilai 'profile'
        ]);
    }

    public function updateProfile()
    {
        $userId = session()->get('id'); // ID user dari session

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username'   => 'required|min_length[3]|max_length[50]',
            'email'      => 'required|valid_email|max_length[100]',
            'no_hp'      => 'required|max_length[15]|numeric',
            'nama_toko'  => 'required|max_length[100]',
            'alamat'     => 'permit_empty|max_length[255]',
            'foto_profil' => 'permit_empty|is_image[foto_profil]|max_size[foto_profil,1024]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
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
        $newFileName = $fotoProfil->isValid() && !$fotoProfil->hasMoved()
            ? $fotoProfil->getRandomName()
            : $user['foto_profil']; // Gunakan gambar lama jika tidak ada upload baru

        if ($fotoProfil->isValid() && !$fotoProfil->hasMoved()) {
            $fotoProfil->move('uploads/profiles', $newFileName); // Pindahkan file ke direktori

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
            'nama_toko'   => $this->request->getPost('nama_toko'),
            'alamat'      => $this->request->getPost('alamat'),
            'foto_profil' => $newFileName,
        ];

        // Update ke database
        $this->user->update_register($data, $userId);

        // Redirect dengan pesan sukses
        return redirect()->to('/sales/profilepenjual')->with('success', 'Profil berhasil diperbarui.');
    }
}
