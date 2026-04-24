<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // ================= LOGIN PAGE =================
    public function login()
    {
        return view('auth/login');
    }

    // ================= PROSES LOGIN (FIX FULL) =================
    public function prosesLogin()
{
    $session = session();
    $usersModel = new UsersModel();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $users = $usersModel->getUsersByUsername($username);

    if (!$users) {
        return redirect()->to('/login')->with('error', 'Username tidak ditemukan');
    }

    if ($users['status'] != 'aktif') {
        return redirect()->to('/login')->with('error', 'Akun nonaktif');
    }

    if (!password_verify($password, $users['password'])) {
        return redirect()->to('/login')->with('error', 'Password salah');
    }

    // 🔥 AMBIL ID ANGGOTA
    $idAnggota = null;

    if ($users['role'] == 'anggota') {
        $anggota = \Config\Database::connect()
            ->table('anggota')
            ->where('user_id', $users['id'])
            ->get()
            ->getRowArray();

        if (!$anggota) {
            return redirect()->to('/login')->with('error', 'Data anggota tidak ditemukan');
        }

        $idAnggota = $anggota['id_anggota'];
    }

    // 🔥 SET SESSION
    $session->set([
        'id'          => $users['id'],
        'id_anggota'  => $idAnggota,
        'nama'        => $users['nama'],
        'role'        => $users['role'],
        'logged_in'   => true
    ]);

    return redirect()->to('/dashboard');
}
    // ================= LOGOUT =================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}