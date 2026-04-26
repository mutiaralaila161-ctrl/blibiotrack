<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    protected $peminjaman;
    protected $pengembalian;
    protected $db;

    public function __construct()
    {
        $this->peminjaman   = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
        $this->db           = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $builder = $this->db->table('pengembalian');

        $builder->select('
            pengembalian.*,
            peminjaman.tanggal_kembali,
            users.nama AS nama_anggota,
            denda.jumlah_denda,
            peminjaman.id_anggota
        ')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users', 'users.id = anggota.user_id', 'left')
        ->join('denda', 'denda.id_pengembalian = pengembalian.id_pengembalian', 'left');

        // 🔥 FIX FILTER ROLE
        if (session()->get('role') === 'anggota') {
            $builder->where('anggota.user_id', session()->get('id'));
        }

        $data['pengembalian'] = $builder->get()->getResultArray();

        return view('pengembalian/index', $data);
    }

    // ================= FORM =================
    public function form($id_peminjaman)
    {
        $peminjaman = $this->db->table('peminjaman')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        $detail = $this->db->table('detail_peminjaman')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
            ->where('id_peminjaman', $id_peminjaman)
            ->get()
            ->getResultArray();

        return view('pengembalian/form', compact('peminjaman','detail'));
    }

    // ================= PROSES =================
    public function proses($id_peminjaman)
{
    $db = $this->db;
    $db->transStart();

    $tanggal_dikembalikan = date('Y-m-d');

    // ================= DATA PEMINJAMAN =================
    $peminjaman = $this->peminjaman->find($id_peminjaman);

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // ================= UPDATE STATUS =================
    $this->peminjaman->update($id_peminjaman, [
        'status' => 'menunggu_kembali'
    ]);

    // ================= HITUNG DENDA =================
    $deadline = $peminjaman['tanggal_kembali'];

    $telat = max(0, floor(
        (strtotime($tanggal_dikembalikan) - strtotime($deadline)) / 86400
    ));

    $denda = $telat * 2000;

    // ================= SIMPAN PENGEMBALIAN =================
    $this->pengembalian->insert([
        'id_peminjaman' => $id_peminjaman,
        'tanggal_dikembalikan' => $tanggal_dikembalikan
    ]);

    $id_pengembalian = $this->pengembalian->getInsertID();

    // ================= SIMPAN DENDA =================
    if ($denda > 0) {
        $this->db->table('denda')->insert([
            'id_pengembalian' => $id_pengembalian,
            'jumlah_denda' => $denda,
            'status' => 'belum_bayar'
        ]);
    }

    $db->transComplete();

    return redirect()->to('/pengembalian')
        ->with('success',
            $denda > 0
                ? 'Terlambat ' . $telat . ' hari. Denda Rp ' . number_format($denda,0,',','.')
                : 'Dikembalikan tepat waktu'
        );
}
}