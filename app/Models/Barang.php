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
        $result = $query->getResultArray();

        // Add check to ensure the result is valid
        if (isset($result) && !empty($result)) {
            return $result;
        } else {
            // Handle the case where no data is found
            return [];
        }
    }

    public function getProductsBySubkategori($subkategoriNama)
    {

        if (empty($subkategoriNama)) {
            return [];
        }

        $builder = $this->db->table('barang');

        $builder->join('sub_kategori', 'sub_kategori.id = barang.id_sub_kategori_barang', 'inner');
        $builder->where('sub_kategori.nama_sub_kategori', $subkategoriNama);

        $result = $builder->get()->getResultArray();

        if (isset($result) && !empty($result)) {
            return $result;
        } else {
            return [];
        }
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

        $result = $builder->get()->getResultArray();

        if (isset($result) && !empty($result)) {
            return $result;
        } else {
            return [];
        }
    }

    /**
     * Get a specific product by ID.
     *
     * @param int $id
     * @return array
     */
    public function getProduct($id)
    {
        $product = $this->where('id', $id)->first();

        if ($product === null) {
            // Handle error or return default values
            return [];
        }

        return $product;
    }

    /**
     * Get a random selection of products with addresses.
     *
     * @param int $limit
     * @return array
     */
    public function getBarangWithAlamat($limit)
    {
        $result = $this->select('barang.*, alamat_toko.kelurahan')
            ->join('user', 'barang.pemilik = user.id', 'inner')
            ->join('alamat_toko', 'user.id = alamat_toko.user', 'inner')
            ->limit($limit)
            ->findAll();

        if (isset($result) && !empty($result)) {
            return $result;
        } else {
            return [];
        }
    }

    /**
     * Get the paginated results for barang with alamat.
     *
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getBarangByWilayah($provinsi = null, $kabupaten = null, $kecamatan = null, $kelurahan = null)
    {
        $builder = $this->db->table($this->table);

        // Seleksi kolom yang diperlukan
        $builder->select('
        barang.*, 
        alamat_toko.id AS id_alamat, 
        alamat_toko.provinsi,
        alamat_toko.kabupaten,
        alamat_toko.kecamatan,
        alamat_toko.kelurahan
    ');

        // Join dengan alamat_toko
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');

        // Memastikan barang yang sudah diverifikasi
        $builder->where('barang.verifikasi', 3);

        // Jika ada filter provinsi
        if (!empty($provinsi)) {
            $builder->where('alamat_toko.provinsi', $provinsi);
        }

        // Jika ada filter kabupaten
        if (!empty($kabupaten)) {
            $builder->where('alamat_toko.kabupaten', $kabupaten);
        }

        // Jika ada filter kecamatan
        if (!empty($kecamatan)) {
            $builder->where('alamat_toko.kecamatan', $kecamatan);
        }

        // Jika ada filter kelurahan
        if (!empty($kelurahan)) {
            $builder->where('alamat_toko.kelurahan', $kelurahan);
        }

        // Acak hasil untuk variasi tampilan
        $builder->orderBy('RAND()');

        // Eksekusi query dan kembalikan hasil
        return $builder->get()->getResultArray();
    }


    /**
     * Search products by title.
     *
     * @param string $title
     * @return array
     */
    public function searchProductsByTitle($title = '')
    {
        $builder = $this->db->table('barang')
            ->select('barang.*, kategori.nama_kategori')
            ->join('kategori', 'barang.id_kategori_barang = kategori.id');

        if (!empty($title)) {
            $builder->like('judul_barang', $title);
        }


        $result = $builder->get()->getResultArray();

        if (isset($result) && !empty($result)) {
            return $result;
        } else {
            return [];
        }
    }
}
