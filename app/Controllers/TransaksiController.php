<?php

namespace App\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Model_Auth;

class TransaksiController extends BaseController
{
    protected $kategori;
    public function __construct()
    {
        $this->kategori = new Kategori();
    }

    public function detail($id)
{
    $transactionModel = new Transaksi();
    $barang = new Barang();  

    $transaction = $transactionModel->select('transaksi.*, barang.judul_barang, barang.foto_barang, barang.harga_barang, barang.pemilik')
        ->join('barang', 'barang.id = transaksi.id_barang')
        ->where('transaksi.id', $id)
        ->first();

    if (!$transaction) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
    }

    $userModel = new Model_Auth(); 
    $toko = $userModel->select('nama_toko')
        ->where('id', $transaction['pemilik'])  
        ->first();

    if (!$toko) {
        $toko = ['nama_toko' => 'Nama Toko Tidak Tersedia'];
    }

    $data = [
        'kategori'    => $this->kategori->getSubKategori(),
        'transaction' => $transaction,
        'toko'        => $toko,  
        'menu'        => 'transaction_history',
    ];

    // Return view dengan data
    return view('user/transaksi_detail', $data);
}

public function updateStatus($id)
{
    $transactionModel = new Transaksi();
    $transaction = $transactionModel->find($id);
    
    if (!$transaction) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction tidak ditemukan');
    }

    if ($transaction['verifikasi'] == 4) {
        $transactionModel->update($id, ['verifikasi' => 5]);
        session()->setFlashdata('success', 'Transaksi Selesai!');
    }
    
    return redirect()->to('/user/transaction-history');
}


}
