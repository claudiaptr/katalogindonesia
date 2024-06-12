<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKategori extends Model
{
    protected $table            = 'sub_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_sub_kategori','slug','id_kategori'];

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

    public function getSubKategori($slug = false)  {
        if ($slug == false) {
           return $this->findAll();
        }
        return $this->where(['slug'=>$slug])->first();
    }
}
