<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\UsersModel;

class Anggota extends BaseController
{
    protected $anggota;
    protected $user;

    public function __construct()
    {
        $this->anggota = new AnggotaModel();
        $this->user = new UsersModel(); // pakai ini
    }

    // ================= INDEX =================
    public function index()
    {
        $data['anggota'] = $this->anggota->getAnggotaWithUser();
        return view('anggota/index', $data);
    }

    // ================= CREATE =================
    public function edit($id)
{
    $anggota = $this->anggota->find($id);

    // ambil data user juga
    $user = $this->user->find($anggota['user_id']);

    $data = [
        'anggota' => $anggota,
        'user'    => $user
    ];

    return view('anggota/edit', $data);
}

    // ================= STORE =================
    public function store()
    {
        // 1. simpan ke users
        $user_id = $this->user->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'anggota', // penting
            'status'   => 1
        ]);

        // 2. simpan ke anggota
        $this->anggota->insert([
            'user_id'        => $user_id,
            'nis'            => $this->request->getPost('nis'),
            'alamat'         => $this->request->getPost('alamat'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'tanggal_daftar' => date('Y-m-d'),
        ]);

        return redirect()->to('/anggota');
    }

    public function update($id)
{
    $anggota = $this->anggota->find($id);

    // ================= UPDATE USERS =================
    $this->user->update($anggota['user_id'], [
        'nama'     => $this->request->getPost('nama'),
        'email'    => $this->request->getPost('email'),
        'username' => $this->request->getPost('username'),
    ]);

    // update password kalau diisi
    if ($this->request->getPost('password')) {
        $this->user->update($anggota['user_id'], [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);
    }

    // ================= UPDATE ANGGOTA =================
    $this->anggota->update($id, [
        'nis'    => $this->request->getPost('nis'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp'  => $this->request->getPost('no_hp'),
    ]);

    return redirect()->to('/anggota');
}

    // ================= DELETE =================
    public function delete($id)
    {
        $anggota = $this->anggota->find($id);

        if ($anggota) {
            $this->user->delete($anggota['user_id']);
            $this->anggota->update($id, [
    'status' => 'nonaktif'
]);

return redirect()->back()->with('success', 'Anggota dinonaktifkan');

public function aktifkan($id)
{
    $this->anggota->update($id, [
        'status' => 'aktif'
    ]);

    return redirect()->back()->with('success', 'Anggota berhasil diaktifkan');
}
        }

        return redirect()->to('/anggota');
    }
    public function nonaktifkan($id)
{
    $this->anggota->update($id, [
        'status' => 'nonaktif'
    ]);

    return redirect()->back()->with('success', 'Anggota dinonaktifkan');
}
}