<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Auth extends Model
{
   protected $table            = 'user';
   protected $primaryKey       = 'id';
   protected $useAutoIncrement = true;
   protected $returnType       = 'array';
   protected $useSoftDeletes   = false;
   protected $protectFields    = false;
   protected $allowedFields    = [];

   public function save_register($data)
   {
      $this->db->table('user')->insert($data);
   }
   public function update_register($data,$id)
   {
      $this->db->table('user')->where('id',$id)->update($data);
   }
   public function Ceklogin($email)
   {
       return $this->db->table('user')
                       ->where('email', $email)
                       ->get()
                       ->getRowArray();   
   }
   public function getLogin($userId)
{

    return $this->db->table('user')
                    ->where('id', $userId)
                    ->get()
                    ->getRowArray();  
}

public function getUserData()
{
    return $this->findAll();
}
}
