<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Auth extends Model
{

   public function save_register($data)
   {
      $this->db->table('user')->insert($data);
   }
   public function update_register($data,$id)
   {
      $this->db->table('user')->where('id',$id)->update($data);
   }
   public function Ceklogin($email, $password)
   {
      return $this->db->table('user')->where([
         'email' => $email,
         'password' => $password,
      ])->get()->getRowArray();
   }
   public function getLogin($data)
   {
      return $this->db->table('user')->where([
         'id' => $data
      ])->get()->getRowArray();
   }
}
