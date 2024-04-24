<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function home()
    {
        return view('user/home');
    }
}
