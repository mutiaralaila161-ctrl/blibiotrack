<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    $kategori = $this->kategori;

    if ($keyword) {
        $kategori = $kategori->like('nama_kategori', $keyword);
    }

    $data['kategori'] = $kategori->paginate(10);
    $data['pager'] = $this->kategori->pager;

    return view('kategori/index', $data);
}

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $this->kategori->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategori->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $this->kategori->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
{
    $this->kategori->delete($id);

    return redirect()->to('/kategori')
        ->with('success', 'Data berhasil dihapus');
}
}