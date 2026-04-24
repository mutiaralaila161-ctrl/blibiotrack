<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\DetailPeminjamanModel;
use App\Models\BukuModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $detail;
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->detail     = new DetailPeminjamanModel();
        $this->buku       = new BukuModel();
        $this->db         = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $builder = $this->db->table('peminjaman');

        $builder->select('
            peminjaman.*,
            users_anggota.nama as nama_anggota,
            users_petugas.nama as nama_petugas,
            pengembalian.tanggal_dikembalikan,
            pengembalian.denda
        ');

        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left');
        $builder->join('users as users_anggota', 'users_anggota.id = anggota.user_id', 'left');

        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as users_petugas', 'users_petugas.id = petugas.user_id', 'left');

        $builder->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left');

        // 🔥 FILTER KHUSUS ANGGOTA
        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id_anggota', session()->get('id_anggota'));
        }

        $data = $builder->get()->getResultArray();

        foreach ($data as &$p) {

            // DETAIL BUKU
            $p['detail'] = $this->db->table('detail_peminjaman')
                ->select('detail_peminjaman.*, buku.judul, buku.cover')
                ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
                ->where('detail_peminjaman.id_peminjaman', $p['id_peminjaman'])
                ->get()->getResultArray();

            $today = date('Y-m-d');
            $jatuhTempo = $p['tanggal_kembali'];

            $telat = max(0, floor((strtotime($today) - strtotime($jatuhTempo)) / 86400));
            $p['denda_realtime'] = $telat * 1000;

            // STATUS
            if (!empty($p['tanggal_dikembalikan'])) {
                $p['status_label'] = 'Kembali';
            } elseif ($telat > 0) {
                $p['status_label'] = 'Terlambat';
            } else {
                $p['status_label'] = 'Dipinjam';
            }
        }

        return view('peminjaman/index', [
            'peminjaman' => $data
        ]);
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $builder = $this->db->table('peminjaman');

        $builder->select('
            peminjaman.*,
            users_anggota.nama as nama_anggota,
            users_petugas.nama as nama_petugas,
            pengembalian.tanggal_dikembalikan,
            pengembalian.denda
        ');

        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left');
        $builder->join('users as users_anggota', 'users_anggota.id = anggota.user_id', 'left');

        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as users_petugas', 'users_petugas.id = petugas.user_id', 'left');

        $builder->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left');

        $builder->where('peminjaman.id_peminjaman', $id);

        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id_anggota', session()->get('id_anggota'));
        }

        $peminjaman = $builder->get()->getRowArray();

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        $detail = $this->db->table('detail_peminjaman')
            ->select('detail_peminjaman.*, buku.judul, buku.cover')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
            ->where('detail_peminjaman.id_peminjaman', $id)
            ->get()->getResultArray();

        return view('peminjaman/detail', [
            'peminjaman' => $peminjaman,
            'detail'     => $detail
        ]);
    }
}