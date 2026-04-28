<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function index()
{
    // 🔒 WAJIB CEK LOGIN
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $bukuModel = new BukuModel();
    $pinjamModel = new PeminjamanModel();
    $userModel = new UsersModel();

    // TOTAL DATA
    $data['totalBuku'] = $bukuModel->countAll();
    $data['totalPeminjaman'] = $pinjamModel->countAll();
    $data['totalUser'] = $userModel->countAll();

    // CHART DATA
    $db = \Config\Database::connect();

    $result = $db->query("
        SELECT MONTH(tanggal_pinjam) as bulan, COUNT(*) as total
        FROM peminjaman
        GROUP BY MONTH(tanggal_pinjam)
    ")->getResult();

    $bulan = [];
    $total = [];

    foreach ($result as $r) {
        $bulan[] = "Bulan " . $r->bulan;
        $total[] = $r->total;
    }

    $data['chartBulan'] = json_encode($bulan);
    $data['chartTotal'] = json_encode($total);

    // SESSION
    $data['nama'] = session()->get('nama');
    $data['role'] = session()->get('role');

    return view('dashboard/index', $data);
}
}