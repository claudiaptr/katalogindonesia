<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'menu'=> 'dashboard',
            'sub_menu'=>''
        ];
        return view('admin/dashboard',$data);
    }

    
}
