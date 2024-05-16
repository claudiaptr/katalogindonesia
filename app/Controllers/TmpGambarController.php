<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\ResponseInterface;

class TmpGambarController extends BaseController
{
    public function upload()
    {
        $data = $this->request->getFile('foto_lain');
        $namaFoto = $data->getRandomName();
        $data->move('tmp', $namaFoto);
    }
}
