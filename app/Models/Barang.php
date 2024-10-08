<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // Change to true if you implement soft deletes
    protected $protectFields    = false; // Change to true if you want to protect certain fields
    protected $allowedFields    = [
        'foto_barang', 
        'deskripsi_barang', 
        'id_kategori_barang', 
        'id_sub_kategori_barang', 
        'judul_barang', 
        'harga_barang', 
        'pemilik', 
        'jumlah_barang'
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
     * Get all products that are verified and belong to the 'barang' category.
     *
     * @param string|null $provinsi
     * @param string|null $kabupaten
     * @param string|null $kecamatan
     * @param string|null $kelurahan
     * @return array
     */

     public function getBarangByKategori($kategoriId)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3);
        $builder->where('barang.id_kategori_barang', $kategoriId); // Filter by kategori
        $builder->orderBy('RAND()'); // Optional: Random order

        $query = $builder->get();
        return $query->getResultArray(); // Return as an array
    }

     

    public function getBarang($provinsi = null, $kabupaten = null, $kecamatan = null, $kelurahan = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3); // Assuming 3 means verified
        $builder->where('barang.id_kategori_barang', 1); // Only include items from 'barang' category
        
        if ($provinsi) {
            $builder->where('alamat_toko.provinsi', $provinsi);
        }
        // Add additional filters if needed
        $builder->orderBy('RAND()'); // Randomize results
        return $builder->get()->getResultArray();
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
    public function getAlamatToko($limit = 6)
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3);
        $builder->orderBy('RAND()');
        $builder->limit($limit);
        return $builder->get()->getResultArray();
    }
}
