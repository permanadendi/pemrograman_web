<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();

        return view('artikel/index', compact('artikel', 'title'));
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];

        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();

        return view('artikel/admin_index', compact('artikel', 'title'));
    }

    public function add()
    {
        helper('form'); // Tambahkan ini

        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
                'slug'  => url_title($this->request->getPost('judul'), '-', true),
            ]);

            return redirect()->to('admin/artikel');
        }

        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title', 'validation'));
    }

    public function edit($id)
    {
        $artikel = new ArtikelModel();
        
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        
        $isDataValid = $validation->withRequest($this->request)->run();
        
        if ($isDataValid) {
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
            ]);
            
            return redirect('admin/artikel');
        }

        // Ambil data lama
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";

        return view('artikel/form_edit', compact('title', 'data'));
    }

    public function delete($id)
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        
        return redirect('admin/artikel');
    }
}