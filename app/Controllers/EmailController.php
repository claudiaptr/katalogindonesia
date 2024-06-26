<?php

namespace App\Controllers;

use App\Controllers\getMethod;
use CodeIgniter\Controller;

class EmailController extends Controller
{
    public function index()
    {
        if ($this->request->getMethod() == 'post') {

            $email_tujuan = $this->request->getVar('email_tujuan');
            $subject = $this->request->getVar('subject');
            $pesan = $this->request->getVar('pesan');

            $email = \Config\Services::email();
            $email->setTo($email_tujuan);
            $email->setFrom('erdifirnanto@gmail.com', 'Katalog Indonesia');

            $email->setSubject($subject);
            $email->setMessage($pesan);

            if ($email->send()) {
                echo 'Email Berhasil Dikirim';
            } else {
                $data = $email->printDebugger(['headers']);
                echo 'Email Gagal Dikirim. Debug info: ' . $data;
            }
        } else {
            return view('user/contact');
        }
    }
}
    // public function isi_ini()
    // {
    //     $validation =  \Config\Services::validation();

    //     $validation->setRules([
    //         'name' => 'required',
    //         'email' => 'required|valid_email',
    //         'subject' => 'required',
    //         'message' => 'required'
    //     ]);

    //     if (!$validation->withRequest($this->request)->run()) {
    //         return view('contact_form', [
    //             'validation' => $this->validator,
    //         ]);
    //     }

    //     $email = \Config\Services::email();

    //     $email->setFrom('your_email@gmail.com', 'Your Name');
    //     $email->setTo('konkiti.pt@gmail.com');
    //     $email->setSubject($this->request->getPost('subject'));
    //     $email->setMessage($this->request->getPost('message'));

    //     if ($email->send()) {
    //         return redirect()->to('/contact')->with('message', 'Your message has been sent successfully.');
    //     } else {
    //         return redirect()->to('/contact')->with('message', 'There was an error sending your message.');
    //     }
    // }

    
    // function send()
    // {
    //     $email = \Config\Services::email();

    //     $alamat_email = "konkiti.pt@gmail.com";
    //     $email->setTo($alamat_email);

    //     $alamat_pengirim = "erdifirnanto@gmail.com@gmail.com";
    //     $email->setFrom($alamat_pengirim);

    //     $subject = "Test Email";
    //     $email->setSubject($subject);

    //     $isi_pesan = " Semoga sembuh bambang";
    //     $email->setMessage($isi_pesan);

    //     if ($email->send()) {
    //         echo "<h1>Pesan terkirim</h1>";
    //     } else {
    //         echo "<h1>Pesan GAGAL</h1>";
    //         $data_error = $email->printDebugger();
    //         print_r($data_error);
    //     }
    // }
