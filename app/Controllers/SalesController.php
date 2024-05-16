<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;

class SalesController extends BaseController
{
    protected $barang;
    protected $fotoBarang;
    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
    }
    public function home()
    {
        return view('sales/home');
    }
    public function view_barang()
    {
        return view('sales/barang/view_barang');
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
    
        $data['id'] = $kd; 
        
        return view('sales/barang/add_barang', $data);
    }
    public function store_barang()
    {
        $foto_barang = $this->request->getFile('foto_barang');
    
       
    
        $nama_foto = $foto_barang->getRandomName();
        $foto_barang->move('barang', $nama_foto);
    
        $this->barang->save([
            'id' => $this->request->getVar('id'),
            'judul_barang' => $this->request->getVar('judul_barang'),
            'jenis_barang' =>  $this->request->getVar('jenis_barang'),
            'foto_barang' =>  $nama_foto,
            'jumlah_barang' =>  $this->request->getVar('jumlah_barang'),
            'deskripsi_barang' =>  $this->request->getVar('deskripsi_barang'),
        ]);
    
        // $files = $this->request->getFileMultiple('foto_detail');
    
        // if ($files) {
        //     foreach ($files as $file) {
        //         if ($file->isValid() && !$file->hasMoved()) {
        //             $file->move('fotobarang');
    
        //             $this->fotoBarang->save([
        //                 'foto_barang_lain' => $file->getName(),
        //                 'id_barang' => $this->request->getVar('id'),
        //             ]);
        //         } else {
        //             return redirect()->back()->with('error', 'One or more detail images failed to upload.');
        //         }
        //     }
        // }
    
        return redirect()->to('/sales/view_barang');
    }
    
}
