<?php

namespace App\Controllers;

class Denda extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= LIST DENDA =================
    public function index()
    {
        $builder = $this->db->table('denda');

        $builder->select('
            denda.*,
            peminjaman.id_peminjaman,
            peminjaman.tanggal_kembali,
            pengembalian.tanggal_dikembalikan,
            users.nama AS nama_anggota,
            verif.nama AS nama_petugas
        ')
        ->join('pengembalian', 'pengembalian.id_pengembalian = denda.id_pengembalian', 'left')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman', 'left')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users', 'users.id = anggota.user_id', 'left')
        ->join('petugas', 'petugas.id_petugas = denda.verified_by', 'left')
        ->join('users AS verif', 'verif.id = petugas.user_id', 'left');

        $data = $builder->get()->getResultArray();

        foreach ($data as &$d) {

            $today = date('Y-m-d');

            $telat = false;
            if (!empty($d['tanggal_kembali'])) {
                $telat = strtotime($today) > strtotime($d['tanggal_kembali']);
            }

            // ================= STATUS LOGIC =================
            if ($d['status'] == 'lunas') {
                $d['status_real'] = 'LUNAS';
                $d['warna'] = 'green';

            } elseif ($d['status'] == 'menunggu_verifikasi') {
                $d['status_real'] = 'MENUNGGU VERIFIKASI';
                $d['warna'] = 'orange';

            } elseif ($telat) {
                $d['status_real'] = 'TELAT';
                $d['warna'] = 'red';

            } else {
                $d['status_real'] = 'BELUM BAYAR';
                $d['warna'] = 'blue';
            }
        }

        return view('denda/index', ['denda' => $data]);
    }

    // ================= BAYAR DENDA =================
    public function bayar($id)
    {
        if (session()->get('role') != 'anggota') {
            return redirect()->back();
        }

        $this->db->table('denda')
            ->where('id_denda', $id)
            ->update([
                'status' => 'menunggu_verifikasi'
            ]);

        return redirect()->back()->with('success', 'Menunggu verifikasi petugas');
    }

    // ================= VERIFIKASI =================
    public function verifikasi($id)
    {
        if (session()->get('role') != 'petugas') {
            return redirect()->back();
        }

        $this->db->table('denda')
            ->where('id_denda', $id)
            ->update([
                'status' => 'lunas',
                'verified_by' => session()->get('id_petugas'),
                'verified_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->back()->with('success', 'Denda berhasil dilunasi');
    }
}