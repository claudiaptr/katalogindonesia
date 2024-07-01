<?php

namespace App\Models;

use CodeIgniter\Model;

class Opsi extends Model
{
    protected $table            = 'opsi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_opsi','id_variasi','harga'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    public function getHargaBerdasarkanVariasi($id_variasi)
    {
        // Contoh query sederhana, sesuaikan dengan logika bisnis Anda
        
        $builder = $this->db->table($this->table);
        $builder->select('harga');
        $builder->where('nama_opsi', $id_variasi);
        $query = $builder->get();
        $result = $query->getRowArray();

        return $result['harga'] ?? 0;
    }
}
