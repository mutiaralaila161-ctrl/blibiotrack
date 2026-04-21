<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['user_id', 'jabatan'];

    public function getPetugasWithUser()
    {
        return $this->db->table('petugas')
            ->select('petugas.*, users.nama, users.email, users.username')
            ->join('users', 'users.id = petugas.user_id')
            ->get()
            ->getResultArray();
    }
}