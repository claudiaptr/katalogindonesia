<?php

namespace App\Controllers;

use App\Models\Model_Auth;
use App\Models\ModelPenjual;

class Auth extends BaseController
{
    protected $Model_Auth;
    public function __construct()
    {
        helper('form');
        $this->Model_Auth = new Model_Auth();
    }
    public function register()
    {

        return view('register');
    }
    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Username.',
                ],
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a password.',
                ],
            ],
            'no_hp' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Nomor Handphone.',
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Email.',
                ],
            ],
            'retype_password' => [
                'label' => 'retype Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a retype Password.',
                ],
            ],
        ])) {
            $data = array(
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'level' => 3
            );
            $this->Model_Auth->save_register($data);
            session()->setFlashdata('pesan', 'Register Berhasil !!!');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        }
        return redirect()->to(base_url('auth/login'));
    }
    public function login()
    {
        return view('login');
    }
    public function cek_login()
    {
        if ($this->validate([

            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Email.',
                ],
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a password.',
                ],
            ],
        ])) {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek = $this->Model_Auth->Ceklogin($email, $password);
            if ($cek) {
                session()->set('log', true);
                session()->set('username', $cek['username']);
                session()->set('email', $cek['email']);
                session()->set('level', $cek['level']);
                session()->set('id', $cek['id']);
                if (session()->get('level') == 1) {
                    return redirect()->to(base_url('admin/dashboard'));
                } else {
                    return redirect()->to(base_url('/'));
                }
            } else {
                session()->setFlashdata('pesan', 'Login Gagal, Username dan Password Tidak Cocok !!!');
                return redirect()->to(base_url('auth/login'));
            }
        } else {

            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'));
        }
    }
    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('level');
        session()->remove('foto_user');
        session()->setFlashdata('pesan', 'Logout Sukses !!!');
        return redirect()->to(base_url('/'));
    }

    public function daftar_penjual()
    {

        return view('daftar_penjual');
    }
    public function add_penjual()
    {
        if ($this->validate([
            'nama_toko' => [
                'label' => 'Nama Toko',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Nama Toko.',
                ],
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must choose a Alamat.',
                ],
            ],

        ])) {
            $data = array(
                'id' => session()->get('id'),
                'nama_toko' => $this->request->getPost('nama_toko'),
                'alamat' => $this->request->getPost('alamat'),
                'level' => 2,
            );
            $this->Model_Auth->update_register($data);
            session()->remove('log');
            session()->remove('username');
            session()->remove('level');
            session()->remove('foto_user');
            session()->setFlashdata('pesan', 'Pendaftaran Berhasil, silahkan Login kembali !!!');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('daftar/penjual'));
        }
    }
}
