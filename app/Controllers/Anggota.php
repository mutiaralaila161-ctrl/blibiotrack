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
        $this->user = new UsersModel();
    }

    // ================= INDEX =================
    public function index()
    {
        $data['anggota'] = $this->anggota->getAnggotaWithUser();
        return view('anggota/index', $data);
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $anggota = $this->anggota->find($id);
        $user = $this->user->find($anggota['user_id']);

        return view('anggota/edit', [
            'anggota' => $anggota,
            'user'    => $user
        ]);
    }

    // ================= STORE =================
    public function store()
    {
        $user_id = $this->user->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'anggota',
            'status'   => 'aktif'
        ]);

        $this->anggota->insert([
            'user_id' => $user_id,
            'nis'     => $this->request->getPost('nis'),
            'alamat'  => $this->request->getPost('alamat'),
            'no_hp'   => $this->request->getPost('no_hp'),
            'tanggal_daftar' => date('Y-m-d'),
        ]);

        return redirect()->to('/anggota');
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $anggota = $this->anggota->find($id);

        $this->user->update($anggota['user_id'], [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ]);

        if ($this->request->getPost('password')) {
            $this->user->update($anggota['user_id'], [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);
        }

        $this->anggota->update($id, [
            'nis'    => $this->request->getPost('nis'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp'  => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/anggota');
    }

    // ================= DELETE (NONAKTIFKAN USER) =================
    public function delete($id)
    {
        $anggota = $this->anggota->find($id);

        if ($anggota) {
            $this->user->update($anggota['user_id'], [
                'status' => 'nonaktif'
            ]);
        }

        return redirect()->back()->with('success', 'Anggota dinonaktifkan');
    }

    // ================= AKTIFKAN =================
    public function aktifkan($id)
    {
        $anggota = $this->anggota->find($id);

        $this->user->update($anggota['user_id'], [
            'status' => 'aktif'
        ]);

        return redirect()->back()->with('success', 'Anggota diaktifkan');
    }

    // ================= NONAKTIFKAN =================
    public function nonaktifkan($id)
    {
        $anggota = $this->anggota->find($id);

        $this->user->update($anggota['user_id'], [
            'status' => 'nonaktif'
        ]);

        return redirect()->back()->with('success', 'Anggota dinonaktifkan');
    }
    public function dashboard()
{
    return view('anggota/dashboard');
}
}