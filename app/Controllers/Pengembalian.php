<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\DetailPeminjamanModel;
use App\Models\BukuModel;

class Pengembalian extends BaseController
{
    protected $peminjaman;
    protected $pengembalian;
    protected $detail;
    protected $buku;
    protected $db;

    public function __construct()
    {
        $this->peminjaman   = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
        $this->detail       = new DetailPeminjamanModel();
        $this->buku         = new BukuModel();
        $this->db           = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $data['pengembalian'] = $this->db->table('pengembalian')
            ->select('
                pengembalian.*,
                users.nama as nama_anggota,
                denda.jumlah_denda,
                denda.status as status_denda
            ')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('users', 'users.id = anggota.user_id', 'left')
            ->join('denda', 'denda.id_pengembalian = pengembalian.id_pengembalian', 'left')
            ->get()
            ->getResultArray();

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
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
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

        // ================= SIMPAN PENGEMBALIAN =================
        $this->pengembalian->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => date('Y-m-d')
        ]);

        $id_pengembalian = $this->pengembalian->getInsertID();

        // ================= AMBIL DATA PEMINJAMAN =================
        $peminjaman = $this->peminjaman->find($id_peminjaman);

        // ================= HITUNG DENDA OTOMATIS =================
        $denda = 0;

        $tgl_pinjam = strtotime($peminjaman['tanggal_pinjam']);

        // batas 3 hari
        $batas = strtotime('+3 days', $tgl_pinjam);

        $now = time();

        if ($now > $batas) {

            // hitung hari keterlambatan
            $hari_telat = ceil(($now - $batas) / 86400);

            // tarif per hari
            $tarif = 2000;

            $denda = $hari_telat * $tarif;
        }

        // ================= SIMPAN DENDA =================
        if ($denda > 0) {

            // cegah double insert
            $cek = $this->db->table('denda')
                ->where('id_pengembalian', $id_pengembalian)
                ->get()
                ->getRowArray();

            if (!$cek) {
                $this->db->table('denda')->insert([
                    'id_pengembalian' => $id_pengembalian,
                    'jumlah_denda'    => $denda,
                    'status'          => 'belum_bayar'
                ]);
            }
        }

        // ================= UPDATE STATUS PEMINJAMAN =================
        $this->peminjaman->update($id_peminjaman, [
            'status' => 'kembali'
        ]);

        $db->transComplete();

        return redirect()->to('/pengembalian')
            ->with('success',
                $denda > 0
                    ? 'Buku dikembalikan. Denda Rp ' . number_format($denda,0,',','.')
                    : 'Buku dikembalikan tanpa denda'
            );
    }
}