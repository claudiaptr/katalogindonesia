<?php

namespace App\Controllers;
use App\Models\IklanTetap;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class IklanController extends BaseController
{
    //iklan tetap
    protected $iklantetap;
    public function __construct()
    {
        $this->iklantetap = new IklanTetap();
    }

    public function view_iklan_tetap()
    {
        $iklan = $this->iklantetap->getIklanTetap();
        return view('admin/iklan_tetap/view_iklan_tetap', compact('iklan'));
    }

    public function add_iklan_tetap()
    {
        return view('admin/iklan_tetap/tambah_iklan_tetap');
    }

    public function store_iklan_tetap()  
    {
        $judul_iklan = $this->request->getVar('judul_iklan');
        $slug = url_title($judul_iklan, '-', true);

        $iklanData = [
            'foto_iklan' => $this->request->getVar('foto_iklan'),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug' => $slug,
            'judul_iklan' => $judul_iklan,
        ];

        $this->iklantetap->save($iklanData);

        return redirect()->to('/admin/view_iklan_tetap');
    }
}
