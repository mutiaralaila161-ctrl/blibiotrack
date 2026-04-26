<?php

namespace App\Controllers;

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
        $builder = $this->db->table('peminjaman');

        $builder->select('
            peminjaman.id_peminjaman,
            peminjaman.status AS status_peminjaman,
            peminjaman.tanggal_pinjam,
            peminjaman.tanggal_kembali,
            pengembalian.tanggal_dikembalikan,
            users_anggota.nama AS nama_anggota,
            users_petugas.nama AS nama_petugas,
            denda.jumlah_denda,
            denda.status AS status_denda
        ')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users AS users_anggota', 'users_anggota.id = anggota.user_id', 'left')
        ->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left')
        ->join('users AS users_petugas', 'users_petugas.id = petugas.user_id', 'left')
        ->join('pengembalian', 'pengembalian.id_peminjaman = peminjaman.id_peminjaman', 'left')
        ->join('denda', 'denda.id_pengembalian = pengembalian.id_pengembalian', 'left');

        if (session()->get('role') == 'anggota') {
            $builder->where('anggota.user_id', session()->get('id'));
        }

        $data = $builder->get()->getResultArray();

        foreach ($data as &$p) {

            $p['detail'] = $this->db->table('detail_peminjaman')
                ->select('buku.judul, buku.cover')
                ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
                ->where('id_peminjaman', $p['id_peminjaman'])
                ->get()->getResultArray();

            $p['status_label'] = '-';
            $p['warna'] = 'gray';

            $status = $p['status_peminjaman'] ?? 'menunggu';

            if ($status == 'dipinjam') {
                $p['status_label'] = 'Dipinjam';
                $p['warna'] = 'blue';
            }

            if ($status == 'menunggu') {
                $p['status_label'] = 'Menunggu Approval';
                $p['warna'] = 'orange';
            }

            if (!empty($p['tanggal_dikembalikan'])) {
                $p['status_label'] = 'Transaksi Selesai';
                $p['warna'] = 'green';
            }

            $p['denda'] = $p['jumlah_denda'] ?? 0;
        }

        return view('peminjaman/index', ['peminjaman' => $data]);
    }

    // ================= CREATE =================
    public function create()
    {
        $data = [
            'buku' => $this->db->table('buku')->get()->getResultArray(),
            'anggota' => $this->db->table('anggota')
                ->select('anggota.id_anggota, users.nama')
                ->join('users', 'users.id = anggota.user_id')
                ->get()->getResultArray(),
            'petugas' => $this->db->table('petugas')
                ->select('petugas.id_petugas, users.nama')
                ->join('users', 'users.id = petugas.user_id')
                ->get()->getResultArray(),
        ];

        return view('peminjaman/create', $data);
    }

    // ================= SAVE =================
   public function save()
{
    $buku = $this->request->getPost('id_buku');

    if (empty($buku)) {
        return redirect()->back()->with('error', 'Pilih minimal 1 buku');
    }

    $pinjam = $this->request->getPost('tanggal_pinjam');

    // INSERT PEMINJAMAN
    $this->db->table('peminjaman')->insert([
        'id_anggota' => $this->request->getPost('id_anggota'),
        'id_petugas' => $this->request->getPost('id_petugas'),
        'tanggal_pinjam' => $pinjam,
        'tanggal_kembali' => date('Y-m-d', strtotime($pinjam . ' +3 days')),
        'status' => 'dipinjam'
    ]);

    $id = $this->db->insertID();

    // PASTIKAN ARRAY
    if (!is_array($buku)) {
        $buku = [$buku];
    }

    foreach ($buku as $b) {
        $this->db->table('detail_peminjaman')->insert([
            'id_peminjaman' => $id,
            'id_buku' => $b
        ]);
    }

    return redirect()->to('/peminjaman');
}

    // ================= DETAIL =================
    public function detail($id)
{
    $peminjaman = $this->db->table('peminjaman')
        ->select('
            peminjaman.*,
            users_anggota.nama as nama_anggota,
            users_petugas.nama as nama_petugas
        ')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
        ->join('users AS users_anggota', 'users_anggota.id = anggota.user_id', 'left')
        ->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left')
        ->join('users AS users_petugas', 'users_petugas.id = petugas.user_id', 'left')
        ->where('peminjaman.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    if (!$peminjaman) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $buku = $this->db->table('detail_peminjaman')
        ->select('buku.judul, buku.cover')
        ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
        ->where('detail_peminjaman.id_peminjaman', $id)
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