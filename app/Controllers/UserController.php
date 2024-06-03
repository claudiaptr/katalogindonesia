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
      
        $data = [
            'barang' => $this->barang->getRandomBarang(6),
            'barang_baru'=> $this->barang->getNewBarang(6),
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/home',$data);
    }
    public function detail($id)
    {
        $data = [
            'barang' => $this->barang->find($id),
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll()
        ];

        return view('user/detail',$data);
    }
    public function contact()
    {
        return view('user/contact');
    }

    public function shop()
    {
        return view('user/shop');
    }
    public function checkout()
    {
        return view('user/checkout');
    }
    public function cart()
    {
        return view('user/cart');
    }
}
