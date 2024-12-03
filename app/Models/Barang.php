<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; 
    protected $protectFields    = false; 
    protected $allowedFields    = [
        'foto_barang', 
        'deskripsi_barang', 
        'id_kategori_barang', 
        'id_sub_kategori_barang', 
        'judul_barang', 
        'harga_barang', 
        'pemilik', 
        'jumlah_barang',
        'diskon', 
        'harga_setelah_diskon'
    ];

    // Dates
    protected $useTimestamps = false; // Set to true if you want to use timestamps
    protected $dateFormat    = 'datetime'; // Format for the date
    protected $createdField  = 'created_at'; // Field for creation timestamp
    protected $updatedField  = 'updated_at'; // Field for update timestamp
    protected $deletedField  = 'deleted_at'; // Field for soft delete

    // Callbacks
    protected $allowCallbacks = true; // Enable or disable callbacks
    // You can define your callbacks here

    /**
     * Get all products that are verified and belong to a category by name.
     *
     * @param string $kategoriNama
     * @return array
     */
    public function getBarangByNamaKategori($kategoriNama)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->join('kategori', 'kategori.id = barang.id_kategori_barang'); // Join with kategori table
        $builder->where('barang.verifikasi', 3);
        $builder->where('LOWER(kategori.nama_kategori)', strtolower($kategoriNama)); // Case insensitive match
        $builder->orderBy('RAND()'); // Optional: Random order

        $query = $builder->get();
        return $query->getResultArray(); // Return as an array
    }

    /**
     * Get the newest products with a limit.
     *
     * @param int $limit
     * @return array
     */
    public function getNewBarang($limit = 6)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit($limit);
        return $builder->get()->getResultArray();
    }

    /**
     * Get a specific product by ID.
     *
     * @param int $id
     * @return array
     */
    public function getProduct($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Get a random selection of products with addresses.
     *
     * @param int $limit
     * @return array
     */
    public function getBarangWithAlamat($limit)
{
    return $this->select('barang.*, alamat_toko.kelurahan')
                ->join('user', 'barang.pemilik = user.id', 'inner')
                ->join('alamat_toko', 'user.id = alamat_toko.user', 'inner')
                ->limit($limit)
                ->findAll();
}

public function getBarangWithAlamatPaginated($limit = 12, $page = 1)
{
    // Count the total records for pagination
    $totalRecords = $this->db->table('barang')->countAllResults();

    // Get the data with limit and offset
    $barang = $this->db->table('barang')
        ->join('alamat_toko', 'barang.pemilik = alamat_toko.user', 'left')
        ->join('user', 'barang.pemilik = user.id', 'left')
        ->limit($limit, ($page - 1) * $limit)  // Pagination: offset
        ->get()->getResultArray();

    // Return both the results and total records for pagination
    return [
        'barang' => $barang,
        'total' => $totalRecords
    ];
}
}

