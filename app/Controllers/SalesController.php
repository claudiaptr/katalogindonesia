<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\Kategori;
use App\Models\Opsi;
use App\Models\SubKategori;
use App\Models\Variasi;

class SalesController extends BaseController
{
    protected $barang;
    protected $fotoBarang, $kategori, $sub_kategori, $variasi, $opsi;
    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
        $this->sub_kategori = new SubKategori();
        $this->variasi = new Variasi();
        $this->opsi = new Opsi();
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
            ->where('barang.pemilik', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/barang/view_barang', $data);
    }
    public function add_barang()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategori->findAll(),
            'sub_ketgori' => $this->sub_kategori->findAll(),
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
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must choose a kategori.',
                ],
            ],
            'id_sub_kategori_barang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must choose a sub kategoi.',
                ],
            ],
            'foto_barang' => [
                'rules'  => 'uploaded[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png]  ',
                'errors' => [
                    'uploaded' => 'You must choose a foto barang.',
                    'mime_in' => 'Only image files are allowed (jpg, jpeg, png).',
                ],
            ],
            'harga_barang' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a harga barang.',
                ],
            ],
            'jumlah_barang' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'You must input a jumlah barang.',
                ],
            ],
            'deskripsi_barang' => [
                'rules'  => 'required',
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
        $foto_barang = $this->request->getFile('foto_barang');


        $nama_foto = $foto_barang->getRandomName();
        $foto_barang->move('barang', $nama_foto);

        $this->barang->save([
            'pemilik' => $this->request->getVar('pemilik'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'harga_barang' => $this->request->getVar('harga_barang'),
            'id_kategori_barang' =>  $this->request->getVar('id_kategori_barang'),
            'id_sub_kategori_barang' =>  $this->request->getVar('id_sub_kategori_barang'),
            'foto_barang' =>  $nama_foto,
            'jumlah_barang' =>  $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' =>  $this->request->getVar('deskripsi_barang'),
        ]);

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

        session()->setFlashdata('pesan', 'data berhasil ditambah');
        return redirect()->to('/sales/view_barang');
    }
    public function edit_barang($id)
    {

        $barang = $this->barang->find($id);
        $barang['harga_barang'] = number_format($barang['harga_barang'], 0, ',', '.');
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
        session()->setFlashdata('pesan', 'data berhasil diupdate');

        return redirect()->to('/sales/view_barang')->with('success', 'Data barang berhasil diperbarui.');
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

            return redirect()->to('/sales/view_barang')->with('message', 'Barang berhasil dihapus');
        } else {
            return redirect()->to('/sales/view_barang')->with('error', 'Barang tidak ditemukan');
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
            'validation'=> \Config\Services::validation(),
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

    public function update_opsi($id)
    {
        // Tambahkan debugging
        $requestData = $this->request->getPost();
        

        // Validasi input
        $validate = $this->validate([
            'nama_opsi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must input a Nama Opsi.',
                ],
            ],
            'harga' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must input a Harga Opsi.',
                    'numeric' => 'Harga Opsi must be a number.',
                ],
            ],
        ]);

        if (!$validate) {
            $validation = \Config\Services::validation();
            $error = \Config\Services::validation()->getErrors();
            $errorString = implode(' ', $error);
            session()->setFlashdata('error', $errorString);
            return redirect()->back()->with('validation', $validation)->withInput();
        }

        // Memperbarui data opsi
        $this->opsi->update($id, [
            'nama_opsi' => $this->request->getVar('nama_opsi'),
            'harga' => $this->request->getVar('harga'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil diupdate');
        return redirect()->to('/sales/view_tambah_variasi/')->with('success', 'Opsi berhasil diperbarui.');
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
        
        return redirect()->to('/sales/view_tambah_variasi/'.$id_barang)->with('success', 'Opsi baru berhasil ditambahkan.');
    }
    public function deleteOpsi($id)
    {
        if ($this->opsi->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }
}
