<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= LIST =================
    public function index()
{
    $builder = $this->db->table('transaksi');

    $builder->select('
        transaksi.*,
        peminjaman.id_peminjaman,
        users.nama AS nama_anggota,
        users.id AS user_id
    ')
    ->join('peminjaman', 'peminjaman.id_peminjaman = transaksi.id_peminjaman', 'left')
    ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
    ->join('users', 'users.id = anggota.user_id', 'left')
    ->where('transaksi.jenis', 'denda');

    // 🔥 FILTER KHUSUS ANGGOTA
    if (session()->get('role') == 'anggota') {
        $builder->where('users.id', session()->get('id'));
    }

    $builder->orderBy('transaksi.id_transaksi', 'DESC');

    $data = $builder->get()->getResultArray();

    // STATUS
    foreach ($data as &$t) {
        if ($t['status'] == 'belum_bayar') {
            $t['status_label'] = 'Belum Bayar';
            $t['warna'] = 'red';

        } elseif ($t['status'] == 'menunggu_verifikasi') {
            $t['status_label'] = 'Menunggu Verifikasi';
            $t['warna'] = 'orange';

        } elseif ($t['status'] == 'lunas') {
            $t['status_label'] = 'Lunas';
            $t['warna'] = 'green';

        } else {
            $t['status_label'] = 'Tidak diketahui';
            $t['warna'] = 'gray';
        }
    }

    return view('transaksi/index', ['transaksi' => $data]);
}

    // ================= FORM =================
    public function create($id_peminjaman)
{
    // 🔒 HANYA PETUGAS
    if (session()->get('role') != 'petugas') {
        return redirect()->to('/transaksi')->with('error', 'Akses ditolak');
    }

    $peminjaman = $this->db->table('peminjaman')
        ->select('peminjaman.*, users.nama AS nama_anggota')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
        ->join('users', 'users.id = anggota.user_id')
        ->where('id_peminjaman', $id_peminjaman)
        ->get()->getRowArray();

    return view('transaksi/create', [
        'peminjaman' => $peminjaman
    ]);
}

    // ================= SIMPAN =================
   public function save()
{
    // 🔒 HANYA PETUGAS
    if (session()->get('role') != 'petugas') {
        return redirect()->to('/transaksi')->with('error', 'Akses ditolak');
    }

    $this->db->table('transaksi')->insert([
        'id_peminjaman' => $this->request->getPost('id_peminjaman'),
        'jenis'         => 'denda',
        'jumlah'        => $this->request->getPost('jumlah'),
        'status'        => 'belum_bayar',
        'tanggal'       => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/transaksi')->with('success', 'Transaksi dibuat');
}

    // ================= BAYAR (ANGGOTA) =================
    public function bayar($id)
    {
        if (session()->get('role') != 'anggota') {
            return redirect()->back();
        }

        $this->db->table('transaksi')
            ->where('id_transaksi', $id)
            ->update([
                'status' => 'menunggu_verifikasi'
            ]);

        return redirect()->back()->with('success', 'Menunggu verifikasi petugas');
    }

    // ================= VERIFIKASI (PETUGAS) =================
    public function verifikasi($id)
    {
        if (session()->get('role') != 'petugas') {
            return redirect()->back();
        }

        $this->db->table('transaksi')
            ->where('id_transaksi', $id)
            ->update([
                'status' => 'lunas'
            ]);

        return redirect()->back()->with('success', 'Pembayaran diverifikasi');
    }
}