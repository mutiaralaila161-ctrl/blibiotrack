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
    $builder = $this->db->table('pengembalian p');

    $builder->select('
        p.id_pengembalian,
        p.id_peminjaman,
        p.tanggal_dikembalikan,

        pm.tanggal_pinjam,
        pm.tanggal_kembali,
        pm.status AS status_peminjaman,

        ua.nama AS nama_anggota,
        up.nama AS nama_petugas,

        d.jumlah_denda
    ')

    // peminjaman
    ->join('peminjaman pm', 'pm.id_peminjaman = p.id_peminjaman', 'left')

    // anggota
    ->join('anggota a', 'a.id_anggota = pm.id_anggota', 'left')
    ->join('users ua', 'ua.id_user = a.id_user', 'left')

    // petugas
    ->join('petugas pt', 'pt.id_petugas = pm.id_petugas', 'left')
    ->join('users up', 'up.id_user = pt.id_user', 'left')

    // denda
    ->join('denda d', 'd.id_pengembalian = p.id_pengembalian', 'left');

    // filter anggota login
    if (session()->get('role') === 'anggota') {
        $builder->where('a.id_user', session()->get('id_user'));
    }

    $data['pengembalian'] = $builder->get()->getResultArray();

    return view('pengembalian/index', $data);
}

    // ================= FORM =================
    public function form($id_peminjaman)
{
    $peminjaman = $this->db->table('peminjaman p')
        ->select('
            p.*,
            ua.nama AS nama_anggota,
            up.nama AS nama_petugas
        ')
        ->join('anggota a', 'a.id_anggota = p.id_anggota', 'left')
        ->join('users ua', 'ua.id_user = a.id_user', 'left')

        ->join('petugas pt', 'pt.id_petugas = p.id_petugas', 'left')
        ->join('users up', 'up.id_user = pt.id_user', 'left')

        ->where('p.id_peminjaman', $id_peminjaman)
        ->get()
        ->getRowArray();

    $detail = $this->db->table('detail_peminjaman dp')
        ->select('b.judul, b.cover')
        ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
        ->where('dp.id_peminjaman', $id_peminjaman)
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