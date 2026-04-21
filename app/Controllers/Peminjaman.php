<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->buku = new BukuModel();
        $this->db = \Config\Database::connect(); // 🔥 FIX WAJIB
    }

    public function index()
    {
        $data['peminjaman'] = $this->peminjaman->getFullData();
        return view('peminjaman/index', $data);
    }

    public function create()
{
    $data = [
        'buku' => $this->buku->findAll(),
        'anggota' => $this->db->table('anggota')
                    ->select('anggota.id_anggota, users.nama')
                    ->join('users', 'users.id = anggota.user_id')
                    ->get()->getResultArray(),

        'petugas' => $this->db->table('petugas')
                    ->select('petugas.id_petugas, users.nama')
                    ->join('users', 'users.id = petugas.user_id')
                    ->get()->getResultArray(),
    ];

    return view('peminjaman/create', $data);
}

    public function store()
    {
        $id_buku = $this->request->getPost('id_buku');

        $buku = $this->buku->find($id_buku);

        if (!$buku || $buku['tersedia'] <= 0) {
            return redirect()->back()->with('error', 'Stok habis!');
        }

        // 1. simpan peminjaman
        $this->peminjaman->insert([
            'id_anggota' => $this->request->getPost('id_anggota'),
            'id_petugas' => $this->request->getPost('id_petugas'),
            'tanggal_pinjam' => date('Y-m-d'),
            'status' => 'dipinjam'
        ]);

        $id_peminjaman = $this->peminjaman->insertID();

        // 2. simpan detail
        $this->db->table('detail_peminjaman')->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => 1
        ]);

        // 3. update stok
        $this->buku->update($id_buku, [
            'tersedia' => $buku['tersedia'] - 1
        ]);

        return redirect()->to('/peminjaman');
    }

    public function kembali($id)
    {
        $detail = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id)
            ->get()->getRowArray();

        if (!$detail) {
            return redirect()->to('/peminjaman')
                ->with('error', 'Data detail tidak ditemukan');
        }

        // update status
        $this->peminjaman->update($id, [
            'status' => 'kembali',
            'tanggal_kembali' => date('Y-m-d')
        ]);

        // update stok
        $buku = $this->buku->find($detail['id_buku']);

        $this->buku->update($detail['id_buku'], [
            'tersedia' => $buku['tersedia'] + $detail['jumlah']
        ]);

        return redirect()->to('/peminjaman');
    }
}