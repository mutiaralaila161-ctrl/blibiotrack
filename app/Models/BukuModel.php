<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $allowedFields = [
        'isbn',
        'judul',
        'id_kategori',
        'id_penulis',
        'id_penerbit',
        'tahun_terbit',
        'jumlah',
        'tersedia',
        'deskripsi',
        'cover'
    ];

    // ================= GET BUKU (FULL JOIN + SEARCH + FIX DUPLICATE) =================
    public function getBuku($keyword = null)
    {
        $builder = $this->db->table('buku')
            ->select('
                buku.*,
                kategori.nama_kategori,
                penulis.nama_penulis,
                penerbit.nama_penerbit,
                rak.nama_rak
            ')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->groupBy('buku.id_buku'); // 🔥 PENTING: cegah duplikat dari buku_rak

        // ================= SEARCH =================
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('buku.judul', $keyword)
                ->orLike('buku.isbn', $keyword)
                ->orLike('penulis.nama_penulis', $keyword)
                ->orLike('kategori.nama_kategori', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    // ================= GET DETAIL BUKU (RECOMMENDED) =================
    public function getBukuById($id)
    {
        return $this->db->table('buku')
            ->select('
                buku.*,
                kategori.nama_kategori,
                penulis.nama_penulis,
                penerbit.nama_penerbit,
                rak.nama_rak
            ')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('buku_rak', 'buku_rak.id_buku = buku.id_buku', 'left')
            ->join('rak', 'rak.id_rak = buku_rak.id_rak', 'left')
            ->where('buku.id_buku', $id)
            ->groupBy('buku.id_buku')
            ->get()
            ->getRowArray();
    }
}