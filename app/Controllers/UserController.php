<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function home()
    {
        return view('user/home');
    }
    public function detail()
    {
        return view('user/detail');
    }
    public function contact()
    {
        return view('user/contact');
    }

    public function shop()
    {
        return view('user/shop');
    }
}
