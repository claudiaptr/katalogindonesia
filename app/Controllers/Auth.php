<?php

namespace App\Controllers;

use App\Models\Model_Auth;

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
                'rules' => 'required|is_unique[user.no_hp]',
                'errors' => [
                    'required' => 'You must choose a Nomor Handphone.',
                    'is_unique'=> 'Nomor HP telah digunakan'
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => 'You must choose a Email.',
                    'is_unique'=> 'email telah digunakan'
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
                'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                'level' => 3
            );
            $this->Model_Auth->save_register($data);
            session()->setFlashdata('pesan', 'Register Berhasil !!!');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
        
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
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'You must enter an Email.',
                    'valid_email' => 'Please enter a valid Email address.',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must enter a Password.',
                ],
            ],
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getVar('password');
            $authModel = new Model_Auth();
            $user = $authModel->Ceklogin($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->setUserSession($user);
                return redirect()->to(session()->get('level') == 1 ? base_url('admin/dashboard') : base_url('/'));
            } else {
                session()->setFlashdata('error', 'Login Failed, Email and Password do not match!');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'))->withInput();
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'log' => true,
            'username' => $user['username'],
            'email' => $user['email'],
            'level' => $user['level'],
            'id' => $user['id'],
        ];
        session()->set($data);
    }
    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('level');
        session()->remove('foto_user');
        session()->remove('id');
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
            $id =  session()->get('id');
            $data = array(
                'nama_toko' => $this->request->getPost('nama_toko'),
                'alamat' => $this->request->getPost('alamat'),
                'level' => 2,
            );
            $this->Model_Auth->update_register($data,$id);
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
