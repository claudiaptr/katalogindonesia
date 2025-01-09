<?php

namespace App\Controllers;

use App\Models\Transaksi;
// use App\Models\TransaksiModel;
use App\Models\Kategori;
use App\Models\Model_Auth;

class TransaksiController extends BaseController
{
    protected $kategori;
    public function __construct()
    {
        $this->kategori = new Kategori();
    }

    public function index()
    {
        $transactionModel = new Transaksi();

        // Mendapatkan data user yang sedang login
        $session = session();
        $userId = $session->get('id'); // Pastikan 'id' tersedia di session

        // Filter berdasarkan inputan
        $filters = $this->request->getGet();
        $builder = $transactionModel->where('id_user', $userId);

        if (!empty($filters['status'])) {
            $builder->where('verifikasi', $filters['status']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $builder->where('created_at >=', $filters['start_date'])
                    ->where('created_at <=', $filters['end_date']);
        }

        if (!empty($filters['min_total'])) {
            $builder->where('total >=', $filters['min_total']);
        }

        if (!empty($filters['max_total'])) {
            $builder->where('total <=', $filters['max_total']);
        }

        $transactions = $builder->findAll();

        return view('user/transaction_history', [
            'transactions' => $transactions,
            'filters'      => $filters,
        ]);
    }

    public function detail($id)
{
    $transactionModel = new Transaksi();

    $transaction = $transactionModel->find($id);
    if (!$transaction) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaction not found');
    }

    $data = [
        'kategori' => $this->kategori->getSubKategori(),
        'transaction' => $transaction,
        'menu' => 'transaction_history',
    ];

    // Return view dengan data
    return view('user/transaksi_detail', $data);
}

}
