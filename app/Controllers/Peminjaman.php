<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Peminjaman extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= INDEX =================
    public function index()
    {
        $builder = $this->db->table('peminjaman p');

        $builder->select('
            p.id_peminjaman,
            p.tanggal_pinjam,
            p.tanggal_kembali,
            p.status AS status_peminjaman,

            ua.nama AS nama_anggota,
            up.nama AS nama_petugas,

            pg.tanggal_dikembalikan,
            d.jumlah_denda
        ')
        ->join('anggota a', 'a.id_anggota = p.id_anggota', 'left')
        ->join('users ua', 'ua.id_user = a.id_user', 'left')

        ->join('petugas pt', 'pt.id_petugas = p.id_petugas', 'left')
        ->join('users up', 'up.id_user = pt.id_user', 'left')

        ->join('pengembalian pg', 'pg.id_peminjaman = p.id_peminjaman', 'left')
        ->join('denda d', 'd.id_pengembalian = pg.id_pengembalian', 'left');

        // ================= FILTER ANGGOTA =================
        if (session()->get('role') == 'anggota') {
            $builder->where('a.id_user', session()->get('id_user'));
        }

        $data = $builder->get()->getResultArray();

        foreach ($data as &$p) {

            // ambil buku
            $p['detail'] = $this->db->table('detail_peminjaman dp')
                ->select('b.judul, b.cover')
                ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
                ->where('dp.id_peminjaman', $p['id_peminjaman'])
                ->get()
                ->getResultArray();

            // status default
            $status = $p['status_peminjaman'] ?? 'menunggu';

            $p['status_label'] = 'Menunggu Approval';
            $p['warna'] = 'orange';

            if ($status == 'dipinjam') {
                $p['status_label'] = 'Dipinjam';
                $p['warna'] = 'blue';
            }

            if ($status == 'ditolak') {
                $p['status_label'] = 'Ditolak';
                $p['warna'] = 'red';
            }

            if (!empty($p['tanggal_dikembalikan'])) {
                $p['status_label'] = 'Selesai';
                $p['warna'] = 'green';
            }

            $p['denda'] = $p['jumlah_denda'] ?? 0;
        }

        return view('peminjaman/index', [
            'peminjaman' => $data
        ]);
    }

    // ================= CREATE =================
    public function create()
    {
        $data = [
            'buku' => $this->db->table('buku')->get()->getResultArray(),

            'anggota' => $this->db->table('anggota ag')
                ->select('ag.id_anggota, u.nama')
                ->join('users u', 'u.id_user = ag.id_user', 'left')
                ->get()->getResultArray(),

            'petugas' => $this->db->table('petugas pt')
                ->select('pt.id_petugas, u.nama')
                ->join('users u', 'u.id_user = pt.id_user', 'left')
                ->get()->getResultArray(),
        ];

        return view('peminjaman/create', $data);
    }

    // ================= SAVE =================
    public function save()
    {
        $buku = $this->request->getPost('id_buku');
        $id_anggota = $this->request->getPost('id_anggota');
        $id_petugas = $this->request->getPost('id_petugas');
        $tanggal = $this->request->getPost('tanggal_pinjam');

        if (!$id_anggota || !$id_petugas || !$tanggal || empty($buku)) {
            return redirect()->back()->with('error', 'Data belum lengkap');
        }

        $file = $this->request->getFile('foto_bukti');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti', $namaFile);
        }

        $this->db->table('peminjaman')->insert([
            'id_anggota' => $id_anggota,
            'id_petugas' => $id_petugas,
            'tanggal_pinjam' => $tanggal,
            'tanggal_kembali' => date('Y-m-d', strtotime($tanggal . ' +3 days')),
            'status' => 'menunggu',
            'foto_bukti' => $namaFile
        ]);

        $id = $this->db->insertID();

        foreach ($buku as $b) {
            $this->db->table('detail_peminjaman')->insert([
                'id_peminjaman' => $id,
                'id_buku' => $b
            ]);
        }

        return redirect()->to('/peminjaman')->with('success', 'Berhasil meminjam buku');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $peminjaman = $this->db->table('peminjaman a')
            ->select('a.*, ua.nama AS nama_anggota, up.nama AS nama_petugas')
            ->join('anggota ag', 'ag.id_anggota = a.id_anggota', 'left')
            ->join('users ua', 'ua.id_user = ag.id_user', 'left')
            ->join('petugas pt', 'pt.id_petugas = a.id_petugas', 'left')
            ->join('users up', 'up.id_user = pt.id_user', 'left')
            ->where('a.id_peminjaman', $id)
            ->get()
            ->getRowArray();

        if (!$peminjaman) {
            throw PageNotFoundException::forPageNotFound('Data peminjaman tidak ditemukan');
        }

        $buku = $this->db->table('detail_peminjaman dp')
            ->select('b.judul, b.cover')
            ->join('buku b', 'b.id_buku = dp.id_buku', 'left')
            ->where('dp.id_peminjaman', $id)
            ->get()
            ->getResultArray();

        return view('peminjaman/detail', [
            'peminjaman' => $peminjaman,
            'buku' => $buku
        ]);
    }

    // ================= APPROVE =================
    public function approve($id)
    {
        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update(['status' => 'dipinjam']);

        return redirect()->to('/peminjaman');
    }

    // ================= REJECT =================
    public function reject($id)
    {
        $this->db->table('peminjaman')
            ->where('id_peminjaman', $id)
            ->update(['status' => 'ditolak']);

        return redirect()->to('/peminjaman');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->db->table('detail_peminjaman')->where('id_peminjaman', $id)->delete();
        $this->db->table('peminjaman')->where('id_peminjaman', $id)->delete();

        return redirect()->to('/peminjaman');
    }
}