<?php

namespace App\Models;

use CodeIgniter\Model;

class Variasi extends Model
{
    protected $table            = 'variasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang','nama_variasi'];

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

   
    public function data_opsi($data)
    {
        $builder = $this->db->table('variasi')->where('id_barang',$data);
        $builder->select('variasi.id, variasi.nama_variasi as variasi_nama, opsi.nama_opsi, opsi.harga as harga_opsi');
        $builder->join('opsi', 'opsi.id_variasi = variasi.id', 'left');
        $query = $builder->get();
        $results = $query->getResultArray();
        
        $variasi = [];
        
        foreach ($results as $row) {
            if (!isset($variasi[$row['id']])) {
                $variasi[$row['id']] = [
                    'id' => $row['id'],
                    'variasi_nama' => $row['variasi_nama'],
                    'opsi' => []
                ];
            }
            
            if ($row['nama_opsi']) {
                $variasi[$row['id']]['opsi'][] = [
                    'nama_opsi' => $row['nama_opsi'],
                    'harga_opsi' => $row['harga_opsi']
                ];
            }
        }
    
        return $variasi;
    }
    
    // Validation
}
