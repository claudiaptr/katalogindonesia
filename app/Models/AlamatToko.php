<?php
namespace App\Models;

use CodeIgniter\Model;

class AlamatToko extends Model
{
    protected $table            = 'alamat_toko';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;

    // Menambahkan user sebagai kolom untuk menghubungkan dengan tabel user
    protected $allowedFields    = [
        'user',       // Menggunakan 'user' sebagai kolom yang menghubungkan dengan ID pengguna
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Method untuk mengambil alamat berdasarkan user
    public function getAlamatByUser($userId)
    {
        return $this->where('user', $userId)->first();
    }
}
