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
    protected $allowedFields    = ['foto_barang','deskripsi_barang','id_kategori_barang','id_sub_kategori_barang','judul_barang','harga_barang','pemilik','jumlah_barang'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
    public function getRandomBarang($limit = 6)
    {
        
        return $this->orderBy('RAND()')->where('verifikasi',3)->findAll($limit);
    }
    public function getNewBarang($limit = 6)
    {
        $builder = $this->db->table('barang');
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit($limit);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function get_product($id) {
        $query = $this->db->table('barang')->where('id', $id);
        return $query->get();
    }

    public function getAlamatToko($limit = 6)
    {
        $builder = $this->db->table('barang');
        $builder->select('barang.*, alamat_toko.id AS id_alamat, alamat_toko.provinsi, alamat_toko.kabupaten, alamat_toko.kecamatan, alamat_toko.kelurahan');
        $builder->join('alamat_toko', 'barang.pemilik = alamat_toko.user');
        $builder->where('barang.verifikasi', 3);
        $builder->orderBy('RAND()');
        $builder->limit($limit);
        $query = $builder->get();
        return $query->getResultArray();
    }
   
   
    
}
