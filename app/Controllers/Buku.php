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

        return view('buku/index', [
            'buku' => $this->buku->getBuku($keyword)
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
            return redirect()->back()->withInput()
                ->with('validation', $this->validator);
        }

        // upload cover
        $file = $this->request->getFile('cover');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        // insert buku
        $this->buku->insert([
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

        $id_buku = $this->buku->getInsertID();
        $id_rak  = $this->request->getPost('id_rak');

        // cegah duplicate rak
        $cek = $this->db->table('buku_rak')
            ->where(['id_buku' => $id_buku, 'id_rak' => $id_rak])
            ->get()->getRow();

        if (!$cek && $id_rak) {
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
            'penulis'  => $this->db->table('penulis')->get()->getResultArray(),
            'penerbit' => $this->db->table('penerbit')->get()->getResultArray(),
            'rak'      => $this->db->table('rak')->get()->getResultArray(),
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $buku = $this->buku->find($id);

        if (!$buku) {
            return redirect()->to('/buku')->with('error', 'Data tidak ditemukan');
        }

        // cover
        $file = $this->request->getFile('cover');
        $namaFile = $buku['cover'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($namaFile) && file_exists(FCPATH . 'uploads/buku/' . $namaFile)) {
                unlink(FCPATH . 'uploads/buku/' . $namaFile);
            }

            $namaFile = $file->getRandomName();
            $file->move('uploads/buku', $namaFile);
        }

        $lama = (int)$buku['jumlah'];
        $baru = (int)$this->request->getPost('jumlah');

        $this->buku->update($id, [
            'isbn' => $this->request->getPost('isbn'),
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah' => $baru,
            'tersedia' => $buku['tersedia'] + ($baru - $lama),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'cover' => $namaFile
        ]);

        // update rak (clean)
        $id_rak = $this->request->getPost('id_rak');

        if ($id_rak) {
            $this->db->table('buku_rak')->where('id_buku', $id)->delete();

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

        $this->db->table('buku_rak')->where('id_buku', $id)->delete();

        if (!empty($buku['cover'])) {
            $file = FCPATH . 'uploads/buku/' . $buku['cover'];
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $this->buku->delete($id);

        return redirect()->to('/buku')->with('success', 'Data berhasil dihapus');
    }

    // ================= DETAIL (FIXED) =================
    public function detail($id)
    {
        $buku = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit, rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->get()->getRowArray();

        if (!$buku) {
            return redirect()->to('/buku')->with('error', 'Data tidak ditemukan');
        }

        return view('buku/detail', ['buku' => $buku]);
    }

    // ================= PRINT =================
    public function print()
    {
        return view('buku/print', [
            'buku' => $this->buku->getBuku()
        ]);
    }

    // ================= WHATSAPP =================
    public function wa($id)
    {
        $b = $this->db->table('buku')
            ->select('buku.*, rak.nama_rak')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->get()->getRowArray();

        if (!$b) {
            return redirect()->to('/buku')->with('error', 'Data tidak ditemukan');
        }

        $pesan = "DATA BUKU\n\n";
        $pesan .= "Judul: {$b['judul']}\n";
        $pesan .= "Rak: {$b['nama_rak']}\n";

        return redirect()->to("https://wa.me/6285175017991?text=" . urlencode($pesan));
    }
}