<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    // ================= LOGIN =================
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $model = new UsersModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->getUsersByUsername($username);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Username tidak ditemukan');
        }

        if ($user['status'] != 'aktif') {
            return redirect()->to('/login')->with('error', 'Akun nonaktif');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Password salah');
        }

        $session->set([
            'id_user' => $user['id_user'],
            'nama'    => $user['nama'],
            'role'    => $user['role'],
            'foto'   => $user['foto'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    // ================= REGISTER FORM =================
    public function registerForm()
    {
        return view('auth/register');
    }

    // ================= REGISTER PROCESS =================
    public function register()
    {
        $model = new UsersModel();

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$nama || !$username || !$password) {
            return redirect()->back()->with('error', 'Data wajib diisi');
        }

        $cek = $model->where('username', $username)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Username sudah dipakai');
        }

        $model->insert([
            'nama'     => $nama,
            'email'    => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'anggota',
            'status'   => 'aktif'
        ]);

        return redirect()->to('/login')->with('success', 'Berhasil daftar');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}