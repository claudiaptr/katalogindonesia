<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Barang;

class Home extends BaseController
{
    protected $barang;
    public function __construct()
    {
        $this->barang = new Barang();
    }
    public function index()
    {
        $data = [
            'menu'=> 'dashboard',
            'sub_menu'=>'',
            'jumlah_verifikasi' => $this->barang->where('verifikasi', 1)->countAllResults()
        ];
        return view('admin/dashboard',$data);
    }

    
}
