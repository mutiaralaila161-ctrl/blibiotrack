<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    protected $users;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    // ================= INDEX =================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $role    = $this->request->getGet('role');

        $builder = $this->users;

        if ($keyword) {
            $builder = $builder->like('nama', $keyword);
        }

        if ($role) {
            $builder = $builder->where('role', $role);
        }

        $data['users'] = $builder->paginate(10);
        $data['pager'] = $this->users->pager;

        return view('users/index', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('users/create');
    }

    // ================= STORE =================
    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama'     => 'required',
            'email'    => 'required|valid_email',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[4]',
            'role'     => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', implode('<br>', $validation->getErrors()));
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = null;

        if ($foto && $foto->isValid()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/users', $namaFoto);
        }

        $this->users->save([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'foto'     => $namaFoto,
            'status'   => 'aktif'
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        return view('users/edit', [
            'user' => $this->users->find($id)
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $user = $this->users->find($id);

        $foto = $this->request->getFile('foto');
        $namaFoto = $user['foto'];

        if ($foto && $foto->isValid() && $foto->getName() != '') {

            if (!empty($user['foto'])) {
                @unlink(FCPATH . 'uploads/users/' . $user['foto']);
            }

            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/users', $namaFoto);
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
            'foto'     => $namaFoto
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->users->update($id, $data);

        return redirect()->to('/users')->with('success', 'User berhasil diupdate');
    }

    // ================= DELETE (AMAN ADMIN) =================
    public function delete($id)
    {
        $user = $this->users->find($id);

        if ($user['role'] == 'admin') {
            return redirect()->back()->with('error', 'Admin tidak bisa dihapus');
        }

        if (!empty($user['foto'])) {
            @unlink(FCPATH . 'uploads/users/' . $user['foto']);
        }

        $this->users->delete($id);

        return redirect()->to('/users')->with('success', 'User dihapus');
    }

    // ================= AKTIF =================
    public function aktifkan($id)
    {
        $user = $this->users->find($id);

        if ($user['role'] == 'admin') {
            return redirect()->back()->with('error', 'Admin selalu aktif');
        }

        $this->users->update($id, ['status' => 'aktif']);

        return redirect()->back()->with('success', 'User diaktifkan');
    }

    // ================= NONAKTIF =================
    public function nonaktifkan($id)
    {
        $user = $this->users->find($id);

        if ($user['role'] == 'admin') {
            return redirect()->back()->with('error', 'Admin tidak bisa dinonaktifkan');
        }

        $this->users->update($id, ['status' => 'nonaktif']);

        return redirect()->back()->with('success', 'User dinonaktifkan');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        return view('users/detail', [
            'user' => $this->users->find($id)
        ]);
    }

    // ================= WA =================
    public function wa($id)
    {
        $user = $this->users->find($id);

        $pesan = "DATA USER\n\n"
            ."Nama: {$user['nama']}\n"
            ."Email: {$user['email']}\n"
            ."Username: {$user['username']}\n"
            ."Role: {$user['role']}";

        return redirect()->to("https://wa.me/6285175017991?text=" . urlencode($pesan));
    }
}