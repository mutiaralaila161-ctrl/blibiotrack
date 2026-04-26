<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function totalBuku()
    {
        return $this->db->table('buku')->countAllResults();
    }

    public function totalPeminjaman()
    {
        return $this->db->table('peminjaman')->countAllResults();
    }

    public function totalUser()
    {
        return $this->db->table('users')->countAllResults();
    }
}