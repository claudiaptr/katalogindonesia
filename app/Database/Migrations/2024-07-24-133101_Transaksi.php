<?php

namespace App\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\AlamatToko;
use App\Models\Kategori;

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
        $barangModel = new Barang();
        $tokoModel = new AlamatToko();

        // Mengambil data transaksi berdasarkan ID
        $transaction = $transactionModel->find($id);
        if (!$transaction) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction not found');
        }

        // Mengambil data barang terkait transaksi
        $barang = $barangModel->find($transaction['id_barang']);
        $toko = $tokoModel->find($barang['pemilik']); 

        $data = [
            'transaction' => $transaction,
            'barang' => $barang,
            'toko' => $toko,
            'statusLabels' => [
                '1' => 'Menunggu Verifikasi',
                '3' => 'Diproses',
                '2' => 'Dikemas',
                '4' => 'Dikirim',
                '5' => 'Selesai'
            ],
            'menu' => 'transaction_history',
        ];

        return view('user/transaksi_detail', $data);
    }

    public function updateStatus($id)
    {
        $transactionModel = new Transaksi();

        $transaction = $transactionModel->find($id);

        if (!$transaction) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction not found');
        }

        if ($transaction['verifikasi'] == 4) {
            $transactionModel->update($id, ['verifikasi' => 5]);
        }

        return redirect()->to('/transactions/detail/' . $id);
    }
}
