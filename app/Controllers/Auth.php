<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $db = \Config\Database::connect();
        $usersModel = new UsersModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $usersModel->getUsersByUsername($username);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Username tidak ditemukan');
        }

        if ($user['status'] != 'aktif') {
            return redirect()->to('/login')->with('error', 'Akun nonaktif');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->to('/login')->with('error', 'Password salah');
        }

        $idAnggota = null;
        $idPetugas = null;

        // ================= ANGGOTA =================
        if ($user['role'] == 'anggota') {

            $anggota = $db->table('anggota')
                ->where('user_id', $user['id'])
                ->get()
                ->getRowArray();

            if (!$anggota) {
                $db->table('anggota')->insert([
                    'user_id' => $user['id'],
                    'tanggal_daftar' => date('Y-m-d')
                ]);

                $idAnggota = $db->insertID();
            } else {
                $idAnggota = $anggota['id_anggota'];
            }
        }

        // ================= PETUGAS =================
        if ($user['role'] == 'petugas') {

            $petugas = $db->table('petugas')
                ->where('user_id', $user['id'])
                ->get()
                ->getRowArray();

            if (!$petugas) {
                $db->table('petugas')->insert([
                    'user_id' => $user['id'],
                    'jabatan' => 'petugas'
                ]);

                $idPetugas = $db->insertID();
            } else {
                $idPetugas = $petugas['id_petugas'];
            }
        }

        // ================= SESSION =================
        $session->set([
            'id'         => $user['id'],
            'nama'       => $user['nama'],
            'role'       => $user['role'],
            'id_anggota' => $idAnggota,
            'id_petugas' => $idPetugas,
            'foto'       => $user['foto'] ?? null,
            'logged_in'  => true
        ]);

        // ================= REDIRECT CLEAN =================
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}