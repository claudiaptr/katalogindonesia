<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IklanCarausel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $iklancarausel;
    public function __construct()
    {
        $this->iklancarausel = new IklanCarausel();
    }
    public function view_iklan_carausel()
    {
        $data = [
            'iklan'=> $this->iklancarausel->getIklanCarausel()
        ];
        return view('admin/iklan_carausel/view_iklan',$data);
    }
    public function add_iklan_carausel()
    {
        return view('admin/iklan_carausel/tambah_iklan');
    }

    public function store_iklan_carausel()  {
        $slug = url_title($this->request->getVar('judul_iklan'),'-',true);
        $this->iklancarausel->save([
            'foto_iklan' => $this->request->getVar('foto_iklan'),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug'=> $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        return redirect()->to('/admin/view_iklan_carausel');
    }
}
