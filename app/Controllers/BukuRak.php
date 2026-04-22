<?php

namespace App\Controllers;

use App\Models\BukuRakModel;

class BukuRak extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BukuRakModel();
    }

    public function index()
    {
        return view('buku_rak/index', [
            'data' => $this->model->findAll()
        ]);
    }

    public function store()
    {
        $id_buku = $this->request->getPost('id_buku');
        $id_rak  = $this->request->getPost('id_rak');

        // cegah double data
        if ($this->model->isExist($id_buku, $id_rak)) {
            return redirect()->back()->with('error', 'Data sudah ada');
        }

        $this->model->insert([
            'id_buku' => $id_buku,
            'id_rak'  => $id_rak
        ]);

        return redirect()->back()->with('success', 'Berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }
}