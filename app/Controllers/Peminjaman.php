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
        pengembalian.id_pengembalian
    ');

    $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left');
    $builder->join('users as users_anggota', 'users_anggota.id = anggota.user_id', 'left');

    $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
    $builder->join('users as users_petugas', 'users_petugas.id = petugas.user_id', 'left');

    // 🔥 JOIN PENGEMBALIAN
    $builder->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left');

    $dataPeminjaman = $builder->get()->getResultArray();

    foreach ($dataPeminjaman as &$p) {

        // ================= DETAIL BUKU =================
        $p['detail'] = $this->db->table('detail_peminjaman')
            ->select('detail_peminjaman.*, buku.judul, buku.cover')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
            ->where('detail_peminjaman.id_peminjaman', $p['id_peminjaman'])
            ->get()
            ->getResultArray();

        // ================= STATUS =================
        $today = date('Y-m-d');

        if ($p['status'] == 'kembali') {

            $p['status_label'] = 'Kembali';
            $p['warna'] = '';
            $p['notifikasi'] = '';

        } else {

            if (!empty($p['tanggal_kembali']) && $today > $p['tanggal_kembali']) {

                $p['status_label'] = 'Terlambat';
                $p['warna'] = 'table-danger';
                $p['notifikasi'] = '⚠️ Telat mengembalikan';

            } elseif (!empty($p['tanggal_kembali']) && $today == date('Y-m-d', strtotime($p['tanggal_kembali'].' -1 day'))) {

                $p['status_label'] = 'Hampir Telat';
                $p['warna'] = 'table-warning';
                $p['notifikasi'] = '🔔 Besok harus dikembalikan';

            } else {

                $p['status_label'] = 'Dipinjam';
                $p['warna'] = '';
                $p['notifikasi'] = '';
            }
        }
    }

    return view('peminjaman/index', [
        'peminjaman' => $dataPeminjaman
    ]);
}
    // ================= DETAIL =================
    public function detail($id)
    {
        $builder = $this->db->table('peminjaman');

        $builder->select('
            peminjaman.*,
            COALESCE(users_anggota.nama, "-") as nama_anggota,
            COALESCE(users_petugas.nama, "-") as nama_petugas
        ');

        $builder->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left');
        $builder->join('users as users_anggota', 'users_anggota.id = anggota.user_id', 'left');

        $builder->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left');
        $builder->join('users as users_petugas', 'users_petugas.id = petugas.user_id', 'left');

        $peminjaman = $builder
            ->where('peminjaman.id_peminjaman', $id)
            ->get()
            ->getRowArray();

        if (!$peminjaman) {
            return redirect()->to('/peminjaman')->with('error', 'Data tidak ditemukan');
        }

        // ================= DETAIL BUKU =================
        $detail = $this->db->table('detail_peminjaman')
            ->select('detail_peminjaman.*, buku.judul, buku.cover')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
            ->where('detail_peminjaman.id_peminjaman', $id)
            ->get()
            ->getResultArray();

        // ================= AMBIL DENDA =================
        $denda = $this->db->table('denda')
            ->select('denda.*')
            ->join('pengembalian', 'pengembalian.id_pengembalian = denda.id_pengembalian')
            ->where('pengembalian.id_peminjaman', $id)
            ->get()
            ->getRowArray();

        if ($denda) {
            $peminjaman['denda'] = $denda['jumlah_denda'];
            $peminjaman['status_denda'] = $denda['status'];
        } else {
            $peminjaman['denda'] = 0;
        }

        return view('peminjaman/detail', [
            'peminjaman' => $peminjaman,
            'detail'     => $detail
        ]);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('peminjaman/create', [
            'buku' => $this->buku->findAll(),

            'anggota' => $this->db->table('anggota')
                ->select('anggota.id_anggota, users.nama')
                ->join('users', 'users.id = anggota.user_id', 'left')
                ->get()->getResultArray(),

            'petugas' => $this->db->table('petugas')
                ->select('petugas.id_petugas, users.nama')
                ->join('users', 'users.id = petugas.user_id', 'left')
                ->get()->getResultArray()
        ]);
    }

    // ================= SAVE =================
    public function save()
    {
        $db = $this->db;
        $db->transStart();

        $id_anggota = $this->request->getPost('id_anggota');
        $anggota = $this->db->table('anggota')
    ->where('id_anggota', $id_anggota)
    ->get()
    ->getRowArray();

if ($anggota['status'] == 'nonaktif') {
    return redirect()->back()->with('error', 'Anggota tidak aktif');
}

        $id_buku = $this->request->getPost('id_buku') ?? [];
        $jumlah  = $this->request->getPost('jumlah') ?? [];

        if (empty($id_buku)) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku');
        }

        // ================= TANGGAL 3 HARI =================
        $tanggal_pinjam   = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali  = date('Y-m-d', strtotime($tanggal_pinjam . ' +3 days'));

        $this->peminjaman->insert([
            'id_anggota'       => $id_anggota,
            'id_petugas'       => $this->request->getPost('id_petugas'),
            'tanggal_pinjam'   => $tanggal_pinjam,
            'tanggal_kembali'  => $tanggal_kembali,
            'status'           => 'dipinjam'
        ]);

        $id_peminjaman = $this->peminjaman->getInsertID();

        foreach ($id_buku as $i => $buku_id) {

            $buku = $this->buku->find($buku_id);
            if (!$buku) continue;

            $qty = (int)($jumlah[$i] ?? 1);

            if ($buku['jumlah'] < $qty) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Stok buku tidak cukup');
            }

            $this->detail->insert([
                'id_peminjaman'  => $id_peminjaman,
                'id_buku'        => $buku_id,
                'jumlah'         => $qty,
                'status_kembali' => 'belum'
            ]);

            $this->buku->update($buku_id, [
                'jumlah' => $buku['jumlah'] - $qty
            ]);
        }

        $db->transComplete();

        if (!$db->transStatus()) {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }

        return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil');
    }
}