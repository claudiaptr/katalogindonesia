<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Auth extends Model
{
   public function save_register($data){
    $this->db->table('user')->insert($data);
   }
   public function Ceklogin($email, $password){
   return $this->db->table('user')->where([
        'email' => $email,
        'password' => $password,
    ])->get()->getRowArray();
   }
   
}