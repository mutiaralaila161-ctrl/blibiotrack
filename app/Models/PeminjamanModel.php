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

    public function getFullData()
{
    return $this->db->table('peminjaman')
        ->select('
            peminjaman.id_peminjaman,
            peminjaman.status,
            buku.judul,
            u.nama as anggota,
            p.nama as petugas
        ')
        ->join('detail_peminjaman dp', 'dp.id_peminjaman = peminjaman.id_peminjaman')
        ->join('buku', 'buku.id_buku = dp.id_buku')
        ->join('anggota a', 'a.id_anggota = peminjaman.id_anggota')
        ->join('users u', 'u.id = a.user_id')
        ->join('petugas pt', 'pt.id_petugas = peminjaman.id_petugas')
        ->join('users p', 'p.id = pt.user_id')
        ->get()
        ->getResultArray();
}
}