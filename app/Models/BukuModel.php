<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $allowedFields = [
        'isbn','judul','id_kategori','id_penulis','id_penerbit',
        'tahun_terbit','jumlah','tersedia','deskripsi','cover'
    ];

    public function getBuku()
    {
        return $this->db->table('buku')
            ->select('buku.*, 
                      kategori.nama_kategori,
                      penulis.nama_penulis,
                      penerbit.nama_penerbit,
                      rak.nama_rak')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->groupBy('buku.id_buku')
            ->get()
            ->getResultArray();
    }
}