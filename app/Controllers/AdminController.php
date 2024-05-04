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
        session();
        $data = [
            'validation'=>\Config\Services::validation()
        ];
        return view('admin/iklan_carausel/tambah_iklan',$data);
    }
    public function store_iklan_carausel()  {

        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
           return redirect()->to('admin/add_iklan_carausel')->withInput()->with('validation',$validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'),'-',true);
        $this->iklancarausel->save([
            'foto_iklan' => $this->request->getVar('foto_iklan'),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug'=> $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        return redirect()->to('/admin/view_iklan_carausel');
    }
    public function edit_iklan_carausel($slug)
    {
        session();
        $data = [
            'validation'=>\Config\Services::validation(),
            'iklan'=> $this->iklancarausel->getIklanCarausel($slug)

        ];
        return view('admin/iklan_carausel/edit_iklan',$data);
    }

    public function update_iklan_carausel($id)  {

        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
           return redirect()->to('admin/edit_iklan_carausel'.$this->request->getVar('slug'))->withInput()->with('validation',$validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'),'-',true);
        $this->iklancarausel->save([
            'id'=>$id,
            'foto_iklan' => $this->request->getVar('foto_iklan'),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug'=> $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        return redirect()->to('/admin/view_iklan_carausel');
    }

    public function delete_iklan_carusel($id){
        $this->iklancarausel->delete($id);
        return redirect()->to('/admin/view_iklan_carausel');
    }
}
