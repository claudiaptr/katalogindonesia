<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct() {
        
    }
    public function register() {
      
        $data = array(
            // 'nama'       => $nama,
            // 'username'   => $username,
            // 'alamat'     => $alamat,
            // 'gender'     => $gender,
            // 'no_telepon' => $no_telepon,
            // 'no_ktp'     => $no_ktp,    
            // 'password'   => $password,
            // 'role_id'    => $role_id,
                );
        return view('register');
    }
    public function login() {
      
        $data = array(
            // 'nama'       => $nama,
            // 'username'   => $username,
            // 'alamat'     => $alamat,
            // 'gender'     => $gender,
            // 'no_telepon' => $no_telepon,
            // 'no_ktp'     => $no_ktp,    
            // 'password'   => $password,
            // 'role_id'    => $role_id,
                );
        return view('login');
    }
}
