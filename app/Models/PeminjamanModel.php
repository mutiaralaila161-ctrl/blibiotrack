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
    return $this->db->table('peminjaman p')
        ->select('
            p.id_peminjaman,
            p.tanggal_pinjam,
            p.tanggal_kembali,
            p.status,
            u.nama as anggota,
            pt.nama as petugas,
            GROUP_CONCAT(b.judul SEPARATOR ", ") as daftar_buku
        ')
        ->join('anggota a', 'a.id_anggota = p.id_anggota', 'left')
        ->join('users u', 'u.id = a.user_id', 'left')

        ->join('petugas pg', 'pg.id_petugas = p.id_petugas', 'left')
        ->join('users pt', 'pt.id = pg.user_id', 'left')

        ->join('detail_peminjaman dp', 'dp.id_peminjaman = p.id_peminjaman', 'left')
        ->join('buku b', 'b.id_buku = dp.id_buku', 'left')

        ->groupBy('p.id_peminjaman')
        ->orderBy('p.id_peminjaman', 'DESC')
        ->get()
        ->getResultArray();
}
}