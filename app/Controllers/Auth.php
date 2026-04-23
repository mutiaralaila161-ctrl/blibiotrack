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

        // ambil user berdasarkan username
        $users = $usersModel->getUsersByUsername($username);

        // ================= USER TIDAK ADA =================
        if (!$users) {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }

        // ================= CEK STATUS AKUN =================
        if ($users['status'] != 'aktif') {
            $session->setFlashdata('error', 'Akun Anda telah dinonaktifkan oleh admin');
            return redirect()->to('/login');
        }

        // ================= CEK PASSWORD =================
        if (!password_verify($password, $users['password'])) {
            $session->setFlashdata('salahpw', 'Password salah');
            return redirect()->to('/login');
        }

        // ================= SET SESSION LOGIN =================
        $session->set([
            'id'        => $users['id'],
            'nama'      => $users['nama'],
            'email'     => $users['email'],
            'username'  => $users['username'],
            'role'      => $users['role'],
            'foto'      => $users['foto'],
            'status'    => $users['status'],
            'logged_in' => true
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