<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuRakModel extends Model
{
    protected $table = 'buku_rak';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_buku',
        'id_rak'
    ];

    // ambil rak berdasarkan buku
    public function getRakByBuku($id_buku)
    {
        return $this->db->table('buku_rak')
            ->select('buku_rak.*, rak.nama_rak, rak.lokasi')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak')
            ->where('buku_rak.id_buku', $id_buku)
            ->get()
            ->getResultArray();
    }

    // hapus relasi buku
    public function deleteByBuku($id_buku)
    {
        return $this->where('id_buku', $id_buku)->delete();
    }

    // cek duplikat
    public function isExist($id_buku, $id_rak)
    {
        return $this->where([
            'id_buku' => $id_buku,
            'id_rak' => $id_rak
        ])->first();
    }
}