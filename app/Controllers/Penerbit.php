<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbit;

    public function __construct()
    {
        $this->penerbit = new PenerbitModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->penerbit;

        if ($keyword) {
            $builder = $builder->like('nama_penerbit', $keyword);
        }

        $data['penerbit'] = $builder->paginate(10);
        $data['pager'] = $this->penerbit->pager;

        return view('penerbit/index', $data);
    }

    public function create()
    {
        return view('penerbit/create');
    }

    public function store()
    {
        $this->penerbit->save([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['penerbit'] = $this->penerbit->find($id);
        return view('penerbit/edit', $data);
    }

    public function update($id)
    {
        $this->penerbit->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        if ($id > 0) {
            $this->penerbit->delete($id);
        }

        return redirect()->to('/penerbit')->with('success', 'Data berhasil dihapus');
    }
}