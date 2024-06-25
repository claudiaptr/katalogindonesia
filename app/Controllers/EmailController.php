<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EmailController extends Controller
{
    public function index()
    {
        return view('contact_form');
    }

    public function send()
    {
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('contact_form', [
                'validation' => $this->validator,
            ]);
        }

        $email = \Config\Services::email();

        $email->setFrom('your_email@gmail.com', 'Your Name');
        $email->setTo('konkiti.pt@gmail.com');
        $email->setSubject($this->request->getPost('subject'));
        $email->setMessage($this->request->getPost('message'));

        if ($email->send()) {
            return redirect()->to('/contact')->with('message', 'Your message has been sent successfully.');
        } else {
            return redirect()->to('/contact')->with('message', 'There was an error sending your message.');
        }
    }
}
