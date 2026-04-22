<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $allowedFields = [
        'id_anggota',
        'id_petugas',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    // ================= LIST PEMINJAMAN =================
    public function getFullData()
    {
        return $this->db->table('peminjaman')
            ->select('
                peminjaman.id_peminjaman,
                peminjaman.tanggal_pinjam,
                peminjaman.tanggal_kembali,
                peminjaman.status,
                users.nama as anggota,
                GROUP_CONCAT(buku.judul SEPARATOR ", ") as daftar_buku
            ')
            ->join('detail_peminjaman dp', 'dp.id_peminjaman = peminjaman.id_peminjaman')
            ->join('buku', 'buku.id_buku = dp.id_buku')
            ->join('anggota a', 'a.id_anggota = peminjaman.id_anggota')
            ->join('users', 'users.id = a.user_id')
            ->groupBy('peminjaman.id_peminjaman')
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->get()
            ->getResultArray();
    }
}