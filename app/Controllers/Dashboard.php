<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $model = new DashboardModel();

        $data = [
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),

            'totalBuku' => $model->totalBuku(),
            'totalPeminjaman' => $model->totalPeminjaman(),
            'totalUser' => $model->totalUser(),
        ];

        return view('dashboard/index', $data);
    }
}