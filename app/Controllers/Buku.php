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
        $this->db = db_connect();
    }

    // ================= INDEX =================
    public function index()
{
    $keyword = $this->request->getGet('keyword');

    $builder = $this->db->table('buku')
        ->select('
            buku.*,
            kategori.nama_kategori,
            penulis.nama_penulis,
            penerbit.nama_penerbit,
            rak.nama_rak
        ')
        ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
        ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
        ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
        ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
        ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
        ->groupBy('buku.id_buku')
        ->limit(100);

    if (!empty($keyword)) {
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
            'penulis'  => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak'      => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= STORE =================
    public function store()
    {
        // VALIDASI
        $rules = [
            'isbn' => 'required',
            'judul' => 'required',
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'id_penerbit' => 'required',
            'id_rak' => 'required',
            'jumlah' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->validator);
        }

        // UPLOAD COVER
        $file = $this->request->getFile('cover');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        // SIMPAN BUKU
        $this->buku->insert([
            'isbn' => $this->request->getPost('isbn'),
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tersedia' => $this->request->getPost('jumlah'), // AUTO
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $namaFile
        ]);

        $id_buku = $this->buku->getInsertID();

        // SIMPAN RAK (ANTI DUPLICATE)
        $id_rak = $this->request->getPost('id_rak');

        if ($id_buku && $id_rak) {
            $this->db->table('buku_rak')->insert([
                'id_buku' => $id_buku,
                'id_rak' => $id_rak
            ]);
        }

        return redirect()->to('/buku')->with('success', 'Data berhasil ditambahkan');
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
        $buku = $this->buku->find($id);

        $file = $this->request->getFile('cover');
        $namaFile = $buku['cover'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($namaFile) && file_exists('uploads/buku/' . $namaFile)) {
                unlink('uploads/buku/' . $namaFile);
            }

            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        $this->buku->update($id, [
            'isbn' => $this->request->getPost('isbn'),
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tersedia' => $this->request->getPost('jumlah'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $namaFile
        ]);

        // UPDATE RAK
        $id_rak = $this->request->getPost('id_rak');

        if ($id_rak) {
            $this->db->table('buku_rak')
                ->where('id_buku', $id)
                ->delete();

            $this->db->table('buku_rak')->insert([
                'id_buku' => $id,
                'id_rak' => $id_rak
            ]);
        }

        return redirect()->to('/buku')->with('success', 'Data berhasil diupdate');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $buku = $this->buku->find($id);

        if (!$buku) {
            return redirect()->to('/buku')->with('error', 'Data tidak ditemukan');
        }

        // hapus relasi
        $this->db->table('buku_rak')->where('id_buku', $id)->delete();

        // hapus cover
        if (!empty($buku['cover'])) {
            $path = FCPATH . 'uploads/buku/' . $buku['cover'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // hapus buku
        $this->buku->delete($id);

        return redirect()->to('/buku')->with('success', 'Data berhasil dihapus');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $data['buku'] = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->get()
            ->getRowArray();

        return view('buku/detail', $data);
    }

    // ================= PRINT =================
    public function print()
{
    return view('buku/print', [
        'buku' => $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->limit(500) 
            ->get()
            ->getResultArray()
    ]);
}

    // ================= WA =================
    public function wa($id)
    {
        $b = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->get()
            ->getRowArray();

        $pesan = "DATA BUKU\n\n";
        $pesan .= "Judul: " . $b['judul'] . "\n";
        $pesan .= "Rak: " . $b['nama_rak'] . "\n";

        return redirect()->to("https://wa.me/6285175017991?text=" . urlencode($pesan));
    }
}