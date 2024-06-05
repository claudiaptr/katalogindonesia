<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\Kategori;
use App\Models\SubKategori;

class SalesController extends BaseController
{
    protected $barang;
    protected $fotoBarang, $kategori,$sub_kategori;
    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
        $this->sub_kategori = new SubKategori();
    }
    public function home()
    {
        $data =[
            'menu' => 'dashboard',
        ];
        return view('sales/home',$data);
    }
    public function view_barang()
    {
        $id = session()->get('id');
        $data = [
            'barang' => $this->barang->where('pemilik', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/barang/view_barang', $data);
    }
    public function add_barang()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT MAX(RIGHT(id, 6)) as kode FROM barang");
        $result = $query->getRow();

        $kd = "";
        if ($result && $result->kode !== null) {
            $tmp = ((int)$result->kode) + 1;
            $kd = sprintf("%06s", $tmp);
        } else {
            $kd = "000001";
        }

        $data = [
            'id' => $kd,
            'kategori' => $this->kategori->findAll(),
            'sub_ketgori' => $this->sub_kategori->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/barang/add_barang', $data);
    }
    public function store_barang()
    {
        $foto_barang = $this->request->getFile('foto_barang');

        // if (!$foto_barang->isValid()) {
        //     return redirect()->back()->with('error', $foto_barang->getErrorString().'('.$foto_barang->getError().')');
        // }

        $nama_foto = $foto_barang->getRandomName();
        $foto_barang->move('barang', $nama_foto);

        $this->barang->save([
            'id' => $this->request->getVar('id'),
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

        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move('fotobarang');

                    $this->fotoBarang->save([
                        'foto_barang_lain' => $file->getName(),
                        'id_barang' => $this->request->getVar('id'),
                    ]);
                } else {
                    return redirect()->back()->with('error', 'One or more detail images failed to upload.');
                }
            }
        }

        return redirect()->to('/sales/view_barang');
    }
    public function edit_barang($id)
    {
        $data = [
            'iklan' => $this->barang->find($id),
            'foto_detail' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'menu' => 'barang',
        ];

        return view('sales/barang/edit_barang', $data);
    }
    public function sub_kategori()  {
        $id_kategori = $this->request->getPost('id_kategori');
        $kat = $this->kategori->SubKategori($id_kategori);
        echo '  <option value="">Pilih Barang</option>';
        foreach ( $kat as $key ){
            echo " <option value=".$key['id'].">".$key['nama_sub_kategori']." </option>";
        }
    }
    public function view_tambah_variasi($id)  {
        $data = [
            'menu' => 'barang'
        ];
        return view('sales/barang/tambah_variasi', $data);
    }
}
