<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kategori','slug'];

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
    public function getSubKategori()
    {
        $builder = $this->db->table('kategori');
        $builder->select('kategori.id, kategori.nama_kategori as kategori_nama, kategori.slug as kategori_slug, sub_kategori.nama_sub_kategori, sub_kategori.slug as sub_kategori_slug');
        $builder->join('sub_kategori', 'sub_kategori.id_kategori = kategori.id', 'left');
        $query = $builder->get();
        $results = $query->getResultArray();
        $kategori = [];
        foreach ($results as $row) {
            if (!isset($kategori[$row['id']])) {
                $kategori[$row['id']] = [
                    'id' => $row['id'],
                    'kategori_nama' => $row['kategori_nama'],
                    'kategori_slug' => $row['kategori_slug'],
                    'sub_kategori' => []
                ];
            }
            if ($row['nama_sub_kategori']) {
                $kategori[$row['id']]['sub_kategori'][] = [
                    'nama_sub_kategori' => $row['nama_sub_kategori'],
                    'sub_kategori_slug' => $row['sub_kategori_slug']
                ];
            }
        }

        return $kategori;
    }
    public function SubKategori($id_kategori) {
        return $this->db->table('sub_kategori')->where('id_kategori',$id_kategori)->get()->getResultArray();
    }

    public function getKategori($slug = false)  {
        if ($slug == false) {
           return $this->findAll();
        }
        return $this->where(['slug'=>$slug])->first();
    }
}
