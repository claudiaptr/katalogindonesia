<?php

namespace App\Controllers;

use App\Models\AlamatToko;
use App\Models\Model_Auth;
use Google_Client;
use Google_Service_Oauth2;

class Auth extends BaseController
{
    protected $Model_Auth;
    protected $googleClient;
    protected $alamat_toko;

    public function __construct()
    {
        helper('form');
        $this->Model_Auth = new Model_Auth();
        $this->googleClient = new Google_Client();
        $this->alamat_toko = new AlamatToko();
        
        $this->googleClient->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->googleClient->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->googleClient->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }

    // Register page
    public function register()
    {
        return view('register');
    }

    // Save registration data
    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => ['required' => 'You must choose a Username.']
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => ['required' => 'You must choose a password.']
            ],
            'no_hp' => [
                'label' => 'Nomor Handphone',
                'rules' => 'required|is_unique[user.no_hp]',
                'errors' => ['required' => 'You must choose a Nomor Handphone.', 'is_unique' => 'Nomor HP telah digunakan']
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[user.email]',
                'errors' => ['required' => 'You must choose an Email.', 'is_unique' => 'email telah digunakan']
            ],
            'retype_password' => [
                'label' => 'retype Password',
                'rules' => 'required',
                'errors' => ['required' => 'You must choose a retype Password.']
            ]
        ])) {
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => 3
            ];
            $this->Model_Auth->save_register($data);
            session()->setFlashdata('pesan', 'Register Berhasil !!!');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }

    // Login page
    public function login()
    {
        $data['link'] = $this->googleClient->createAuthUrl();
        return view('login', $data);
    }

    // Handle Google register
    public function register_google()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            
            $row = [
                'username' => $data['name'],
                'email' => $data['email'],
                'foto_profil' => $data['picture'],
                'level' => 3
            ];

            $authModel = new Model_Auth();

            // Check if user already exists
            $existingUser = $authModel->where('email', $data['email'])->first();
            if ($existingUser) {
                $row['id'] = $existingUser['id'];
            }

            $authModel->save($row);

            // Set session data
            $session = [
                'log' => true,
                'username' => $data['name'],
                'email' => $data['email'],
                'level' => $row['level'],
                'id' => $existingUser ? $existingUser['id'] : $authModel->insertID(),
            ];
            session()->set($session);
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/'))->with('error', 'Authentication failed');
        }
    }

    // Check login credentials
    public function cek_login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => ['required' => 'You must enter an Email.', 'valid_email' => 'Please enter a valid Email address.']
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => ['required' => 'You must enter a Password.']
            ]
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getVar('password');
            $authModel = new Model_Auth();
            $user = $authModel->Ceklogin($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->setUserSession($user); 
                session()->setFlashdata('pesan', 'Login Sukses !!!');
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

    // Set user session
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

    // Logout user
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

    // Seller registration page
    public function daftar_penjual()
    {
        return view('daftar_penjual');
    }

}
