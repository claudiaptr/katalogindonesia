<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;

class UserController extends BaseController
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
        $data = [
            'barang' => $this->barang->getRandomBarang(6)
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
