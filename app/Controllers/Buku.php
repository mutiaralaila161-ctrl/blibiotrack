<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $builder = $this->db->table('buku')
            ->select('buku.*, 
                      kategori.nama_kategori,
                      penulis.nama_penulis,
                      penerbit.nama_penerbit,
                      rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->groupBy('buku.id_buku');

        if ($keyword) {
            $builder->like('buku.judul', $keyword);
        }

        return view('buku/index', [
            'buku' => $builder->get()->getResultArray()
        ]);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('buku/create', [
            'kategori' => $this->db->table('kategori')->get()->getResultArray(),
            'penulis' => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak' => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= STORE =================
    public function store()
    {
        $data = $this->request->getPost();

        // cover upload FIX
        $file = $this->request->getFile('cover');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move(FCPATH . 'uploads/buku', $name);
            $data['cover'] = $name;
        }

        $this->buku->insert($data);
        $id = $this->buku->getInsertID();

        $id_rak = $this->request->getPost('id_rak');

        if ($id_rak) {
            $this->db->table('buku_rak')->insert([
                'id_buku' => $id,
                'id_rak' => $id_rak
            ]);
        }

        return redirect()->to('/buku');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        return view('buku/edit', [
            'buku' => $this->buku->find($id),
            'kategori' => $this->db->table('kategori')->get()->getResultArray(),
            'penulis' => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak' => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $data = $this->request->getPost();

        $file = $this->request->getFile('cover');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $old = $this->buku->find($id);

            if (!empty($old['cover']) && file_exists(FCPATH . 'uploads/buku/' . $old['cover'])) {
                unlink(FCPATH . 'uploads/buku/' . $old['cover']);
            }

            $name = $file->getRandomName();
            $file->move(FCPATH . 'uploads/buku', $name);

            $data['cover'] = $name;
        }

        $this->buku->update($id, $data);

        $id_rak = $this->request->getPost('id_rak');

        if ($id_rak) {
            $this->db->table('buku_rak')
                ->where('id_buku', $id)
                ->update(['id_rak' => $id_rak]);
        }

        return redirect()->to('/buku');
    }

    // ================= DELETE (FIX ERROR WHERE) =================
    public function delete($id)
    {
        if (!$id) {
            return redirect()->to('/buku');
        }

        // hapus relasi dulu (AMAN)
        $this->db->table('buku_rak')
            ->where('id_buku', $id)
            ->delete();

        // hapus buku
        $this->buku->delete($id);

        return redirect()->to('/buku');
    }
}