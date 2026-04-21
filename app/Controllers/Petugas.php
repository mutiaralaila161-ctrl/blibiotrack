<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\UsersModel;

class Petugas extends BaseController
{
    protected $petugas;
    protected $user;

    public function __construct()
    {
        $this->petugas = new PetugasModel();
        $this->user = new UsersModel();
    }

    // ================= INDEX =================
    public function index()
    {
        $data['petugas'] = $this->petugas->getPetugasWithUser();
        return view('petugas/index', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('petugas/create');
    }

    // ================= STORE =================
    public function store()
    {
        // simpan ke users
        $user_id = $this->user->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'petugas',
            'status'   => 'aktif'
        ]);

        // simpan ke petugas
        $this->petugas->insert([
            'user_id' => $user_id,
            'jabatan' => $this->request->getPost('jabatan'),
        ]);

        return redirect()->to('/petugas');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $petugas = $this->petugas->find($id);
        $user = $this->user->find($petugas['user_id']);

        return view('petugas/edit', [
            'petugas' => $petugas,
            'user'    => $user
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $petugas = $this->petugas->find($id);

        // update user
        $this->user->update($petugas['user_id'], [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ]);

        if ($this->request->getPost('password')) {
            $this->user->update($petugas['user_id'], [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);
        }

        // update petugas
        $this->petugas->update($id, [
            'jabatan' => $this->request->getPost('jabatan'),
        ]);

        return redirect()->to('/petugas');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $petugas = $this->petugas->find($id);

        if ($petugas) {
            $this->user->delete($petugas['user_id']);
            $this->petugas->delete($id);
        }

        return redirect()->to('/petugas');
    }
}