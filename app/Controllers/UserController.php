<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\GambarBarang;
use App\Models\IklanCarausel;
use App\Models\Kategori;
use App\Models\Opsi;
use App\Models\Variasi;
use App\Models\IklanTetap;

class UserController extends BaseController
{
    protected $barang;
    protected $fotoBarang;
    protected $kategori, $variasi, $opsi, $iklancarausel;
    protected $iklantetap;

    public function __construct()
    {
        $this->barang = new Barang();
        $this->fotoBarang = new GambarBarang();
        $this->kategori = new Kategori();
        $this->variasi = new Variasi();
        $this->opsi = new Opsi();
        $this->iklancarausel = new IklanCarausel();
        $this->iklantetap = new IklanTetap();
    }
    public function home()
    {
        helper('form');
        $data = [
            'barang' => $this->barang->getRandomBarang(8),
            'barang_baru' => $this->barang->getNewBarang(8),
            'kategori' => $this->kategori->getSubKategori(),
            'iklan_tetap_1' => $this->iklantetap->find(1),
            'iklan_tetap_2' => $this->iklantetap->find(2),
            'iklan_tetap_3' => $this->iklantetap->find(3),
            'iklan_tetap_4' => $this->iklantetap->find(4),
            'iklan_carausel'=>$this->iklancarausel->findAll()
        ];
        return view('user/home', $data);
    }
    public function detail($id)
    {

        $data = [
            'barang' => $this->barang->find($id),
            'foto_barang' => $this->fotoBarang->where('id_barang', $id)->findAll(),
            'variasi' => $this->variasi->data_opsi($id),
            'kategori' => $this->kategori->getSubKategori()
        ];

        return view('user/detail', $data);
    }
    public function contact()
    {
        $data = [

            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/contact', $data);
    }

    public function shop()
    {
        $data = [

            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/shop', $data);
    }
    public function checkout()
    {
        $data = [

            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/checkout', $data);
    }
    public function cart()
    {
        $data = [
            'cart' => \Config\Services::cart(),
            'kategori' => $this->kategori->getSubKategori()
        ];
        return view('user/cart', $data);
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
        $options = [];
        if ($variasi && is_array($variasi)) {
           
            foreach ($variasi as $variation) {
                $options[$variation] = $this->request->getVar($variation); // Get the selected option for this variation
            }
        }
        $cart->insert(array(
            'id'      => $this->request->getPost('id'),
            'qty'     => $this->request->getPost('jumlah'),
            'price'   => $this->request->getPost('harga_barang'),
            'name'    => $this->request->getPost('judul_barang'),
            'options' => $options
        ));
        return redirect()->to('user/cart');
    }
    public function delete_chart()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to('user/cart');
    }
}
