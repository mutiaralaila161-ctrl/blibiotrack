<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table      = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';

    protected $allowedFields = [
        'id_peminjaman',
        'tanggal_dikembalikan',
        'denda'
    ];

    // 🔥 FIX: biar tidak error data kosong
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // 🔥 OPTIONAL (tapi sangat disarankan)
    protected $skipValidation = true;
}