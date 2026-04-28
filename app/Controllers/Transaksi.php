<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $builder = $this->db->table('transaksi');

        $builder->select('
            transaksi.id_transaksi,
            transaksi.id_peminjaman,
            transaksi.jenis,
            transaksi.jumlah,
            transaksi.status,
            transaksi.tanggal,
            users.nama AS nama_anggota
        ')
        ->join('peminjaman', 'peminjaman.id_peminjaman = transaksi.id_peminjaman', 'left')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users', 'users.id_user = anggota.id_user', 'left')
        ->where('transaksi.jenis', 'denda')
        ->orderBy('transaksi.id_transaksi', 'DESC');

        // FILTER ANGGOTA
        if (in_array(session()->get('role'), ['anggota'])) {
    $builder->where('users.id_user', session()->get('id_user'));
}

        $data = $builder->get()->getResultArray();

        // LABEL STATUS
        foreach ($data as &$t) {

            if ($t['status'] == 'belum_bayar') {
                $t['status_label'] = 'Belum Bayar';
                $t['warna'] = 'danger';

            } elseif ($t['status'] == 'menunggu_verifikasi') {
                $t['status_label'] = 'Menunggu Verifikasi';
                $t['warna'] = 'warning';

            } elseif ($t['status'] == 'lunas') {
                $t['status_label'] = 'Lunas';
                $t['warna'] = 'success';

            } else {
                $t['status_label'] = 'Unknown';
                $t['warna'] = 'secondary';
            }
        }

        return view('transaksi/index', [
            'transaksi' => $data
        ]);
    }
    public function create($id_peminjaman = null)
{
    if (!$id_peminjaman) {
        return redirect()->to('/transaksi')
            ->with('error', 'ID peminjaman tidak dikirim');
    }

    $peminjaman = $this->db->table('peminjaman')
        ->select('peminjaman.*, users.nama AS nama_anggota')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users', 'users.id_user = anggota.id_user', 'left')
        ->where('peminjaman.id_peminjaman', $id_peminjaman)
        ->get()
        ->getRowArray();

    if (!$peminjaman) {
        return redirect()->to('/transaksi')
            ->with('error', 'Data peminjaman tidak ditemukan di database');
    }

    return view('transaksi/create', [
        'peminjaman' => $peminjaman
    ]);
}
public function save()
{
    $this->db->table('transaksi')->insert([
        'id_peminjaman' => $this->request->getPost('id_peminjaman'),
        'jenis'         => 'denda',
        'jumlah'        => $this->request->getPost('jumlah'),
        'status'        => 'belum_bayar',
        'tanggal'       => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dibuat');
}

    // ================= BAYAR (ANGGOTA) =================
    public function bayar($id)
    {
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
    $role = session()->get('role');

    // 🔒 hanya admin & petugas yang boleh verifikasi
    if (!in_array($role, ['admin', 'petugas'])) {
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    $this->db->table('transaksi')
        ->where('id_transaksi', $id)
        ->update([
            'status' => 'lunas'
        ]);

    return redirect()->back()->with('success', 'Denda sudah diverifikasi');
}
}