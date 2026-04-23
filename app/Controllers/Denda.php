<?php

namespace App\Controllers;

class Denda extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX (SEMUA DENDA) =================
    public function index()
    {
        $data = $this->db->table('denda')
            ->select('denda.*, peminjaman.id_peminjaman')
            ->join('pengembalian', 'pengembalian.id_pengembalian = denda.id_pengembalian', 'left')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
            ->get()
            ->getResultArray();

        return view('denda/index_list', [
            'denda' => $data
        ]);
    }

    // ================= DETAIL =================
    public function detail($id_pengembalian)
    {
        $denda = $this->db->table('denda')
            ->where('id_pengembalian', $id_pengembalian)
            ->get()
            ->getRowArray();

        if (!$denda) {
            return redirect()->to('/denda')->with('error', 'Tidak ada denda');
        }

        return view('denda/detail', [
            'denda' => $denda
        ]);
    }

    // ================= BAYAR =================
    public function bayar($id_denda)
    {
        $this->db->table('denda')
            ->where('id_denda', $id_denda)
            ->update([
                'status' => 'sudah_bayar'
            ]);

        return redirect()->back()->with('success', 'Denda berhasil dibayar');
    }
}