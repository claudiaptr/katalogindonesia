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
        $data = [
            'menu' => 'iklan',
            'sub_menu' => 'iklan_tetap',
            'iklan'=> $this->iklantetap->getIklanTetap()
        ];
       
        return view('admin/iklan_tetap/view_iklan_tetap',$data);
    }

    public function add_iklan_tetap()
    {
        $data = [
            'menu' => 'iklan',
            'sub_menu' => 'iklan_tetap'
        ];
        return view('admin/iklan_tetap/tambah_iklan_tetap',$data);
    }

    public function store_iklan_tetap()  {

        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
           return redirect()->to('admin/add_iklan_tetap')->withInput()->with('validation',$validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'),'-',true);
        $foto_iklan = $this->request->getFile('foto_iklan');
        $foto_iklan->move('img');
        $nama_foto = $foto_iklan->getName();
        $this->iklantetap->save([
            'foto_iklan' => $nama_foto,
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug'=> $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil ditambah');
        return redirect()->to('/admin/view_iklan_tetap');
    }


    public function edit_iklan_tetap($slug)
    {
        session();
        $data = [
            'validation'=>\Config\Services::validation(),
            'iklan'=> $this->iklantetap->getIklantetap($slug),
            'menu' => 'iklan',
            'sub_menu' => 'iklan_tetap'

        ];
        return view('admin/iklan_tetap/edit_iklan_tetap',$data);
    }

    public function update_iklan_tetap($id)  {
        $foto = $this->request->getFile('foto_iklan');

        if ($foto->getError() == 4) {
            $this->request->getVar('foto_lama');
        } else {
            $foto->move('img');
            unlink('img/'.$this->request->getVar('foto_lama'));
        }
        
        if (!$this->validate([
            'judul_iklan' => 'required'
        ])) {
            $validation = \Config\Services::validation();
           return redirect()->to('admin/edit_iklan_tetap'.$this->request->getVar('slug'))->withInput()->with('validation',$validation);
        }
        $slug = url_title($this->request->getVar('judul_iklan'),'-',true);
        $this->iklantetap->save([
            'id'=>$id,
            'foto_iklan' => $foto->getName(),
            'isi_iklan' => $this->request->getVar('isi_iklan'),
            'slug'=> $slug,
            'judul_iklan' => $this->request->getVar('judul_iklan'),
        ]);
        session()->setFlashdata('pesan', 'data berhasil diedit');
        return redirect()->to('/admin/view_iklan_tetap');
    }

    public function delete_iklan_tetap($id){
        $foto = $this->iklantetap->find($id);
        unlink('img/'. $foto['foto_iklan']);
        $this->iklantetap->delete($id);
        return redirect()->to('/admin/view_iklan_tetap');
    }
}
