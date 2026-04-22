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
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        return view('peminjaman/index', [
            'peminjaman' => $this->peminjaman->getFullData()
        ]);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('peminjaman/create', [
            'buku' => $this->buku->findAll(),

            'anggota' => $this->db->table('anggota')
                ->select('anggota.id_anggota, users.nama')
                ->join('users', 'users.id = anggota.user_id')
                ->get()->getResultArray(),

            'petugas' => $this->db->table('petugas')
                ->select('petugas.id_petugas, users.nama')
                ->join('users', 'users.id = petugas.user_id')
                ->get()->getResultArray(),
        ]);
    }

    // ================= STORE =================
    public function store()
    {
        $id_anggota = $this->request->getPost('id_anggota');
        $id_petugas = $this->request->getPost('id_petugas');
        $id_buku    = $this->request->getPost('id_buku');

        // 🔥 CEK LIMIT 2 BUKU AKTIF
        $total = $this->db->table('detail_peminjaman dp')
            ->join('peminjaman p', 'p.id_peminjaman = dp.id_peminjaman')
            ->where('p.id_anggota', $id_anggota)
            ->where('p.status', 'dipinjam')
            ->countAllResults();

        if ($total >= 2) {
            return redirect()->back()->with('error', 'Maksimal 2 buku yang sedang dipinjam!');
        }

        $buku = $this->buku->find($id_buku);

        if (!$buku || $buku['tersedia'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        // SIMPAN PEMINJAMAN
        $this->peminjaman->insert([
            'id_anggota' => $id_anggota,
            'id_petugas' => $id_petugas,
            'tanggal_pinjam' => date('Y-m-d'),
            'status' => 'dipinjam'
        ]);

        $id_peminjaman = $this->peminjaman->insertID();

        // DETAIL
        $this->db->table('detail_peminjaman')->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => 1
        ]);

        // STOK
        $this->buku->update($id_buku, [
            'tersedia' => $buku['tersedia'] - 1
        ]);

        return redirect()->to(base_url('peminjaman'))
            ->with('success', 'Berhasil meminjam buku');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $data = $this->db->table('peminjaman')
            ->select('
                peminjaman.id_peminjaman,
                peminjaman.tanggal_pinjam,
                peminjaman.tanggal_kembali,
                peminjaman.status,
                buku.id_buku,
                buku.judul,
                buku.cover,
                u.nama as anggota,
                p.nama as petugas
            ')
            ->join('detail_peminjaman dp', 'dp.id_peminjaman = peminjaman.id_peminjaman')
            ->join('buku', 'buku.id_buku = dp.id_buku')
            ->join('anggota a', 'a.id_anggota = peminjaman.id_anggota')
            ->join('users u', 'u.id = a.user_id')
            ->join('petugas pt', 'pt.id_petugas = peminjaman.id_petugas')
            ->join('users p', 'p.id = pt.user_id')
            ->where('peminjaman.id_peminjaman', $id)
            ->get()->getResultArray();

        return view('peminjaman/detail', ['data' => $data]);
    }

    // ================= RETURN PER BUKU =================
    public function kembali($id_peminjaman, $id_buku)
    {
        $detail = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('id_buku', $id_buku)
            ->get()->getRowArray();

        if (!$detail) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $buku = $this->buku->find($id_buku);

        $this->buku->update($id_buku, [
            'tersedia' => $buku['tersedia'] + 1
        ]);

        $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->where('id_buku', $id_buku)
            ->delete();

        // cek sisa buku
        $sisa = $this->db->table('detail_peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->countAllResults();

        if ($sisa == 0) {
            $this->peminjaman->update($id_peminjaman, [
                'status' => 'kembali',
                'tanggal_kembali' => date('Y-m-d')
            ]);
        }

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }

    public function delete($id)
{
    // ambil data peminjaman
    $peminjaman = $this->db->table('peminjaman')
        ->where('id_peminjaman', $id)
        ->get()->getRowArray();

    if (!$peminjaman) {
        return redirect()->to('/peminjaman')
            ->with('error', 'Data tidak ditemukan');
    }

    // ambil detail buku
    $detail = $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->get()->getResultArray();

    // kembalikan stok buku (kalau masih dipinjam)
    foreach ($detail as $d) {
        $buku = $this->buku->find($d['id_buku']);

        if ($buku) {
            $this->buku->update($d['id_buku'], [
                'tersedia' => $buku['tersedia'] + $d['jumlah']
            ]);
        }
    }

    // hapus detail dulu
    $this->db->table('detail_peminjaman')
        ->where('id_peminjaman', $id)
        ->delete();

    // hapus peminjaman
    $this->peminjaman->delete($id);

    return redirect()->to('/peminjaman')
        ->with('success', 'Data peminjaman berhasil dihapus');
}
}