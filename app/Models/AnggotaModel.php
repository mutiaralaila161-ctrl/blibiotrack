public function getAnggotaWithUser()
{
    return $this->db->table('anggota')
        ->select('anggota.*, users.nama, users.email')
        ->join('users', 'users.id = anggota.user_id', 'left')
        ->get()
        ->getResultArray();
}