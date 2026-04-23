<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h2>📦 Form Pengembalian Buku</h2>

    <!-- ================= INFO PEMINJAMAN ================= -->
    <div class="card mt-3">
        <div class="card-header">
            <strong>📌 Informasi Peminjaman</strong>
        </div>

        <div class="card-body">
            <table class="table table-bordered">

                <tr>
                    <th>ID Peminjaman</th>
                    <td><?= $peminjaman['id_peminjaman'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Nama Anggota</th>
                    <td><?= $peminjaman['nama_anggota'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Nama Petugas</th>
                    <td><?= $peminjaman['nama_petugas'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?= $peminjaman['tanggal_pinjam'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <?php if (($peminjaman['status'] ?? '') == 'kembali'): ?>
                            <span class="text-success">✔ Sudah Dikembalikan</span>
                        <?php else: ?>
                            <span class="text-danger">📌 Masih Dipinjam</span>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <!-- ================= LIST BUKU ================= -->
    <div class="card mt-4">
        <div class="card-header">
            <strong>📚 Buku yang Dipinjam</strong>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (!empty($detail)): ?>
                    <?php $no = 1; foreach ($detail as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <?php if (!empty($d['cover'])): ?>
                                    <img src="<?= base_url('uploads/buku/' . $d['cover']) ?>"
                                         width="60">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td><?= esc($d['judul']) ?></td>

                            <td><?= esc($d['jumlah']) ?></td>

                            <td>
                                <?php if (($d['status_kembali'] ?? '') == 'kembali'): ?>
                                    <span class="text-success">✔ Kembali</span>
                                <?php else: ?>
                                    <span class="text-warning">📌 Dipinjam</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data buku</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>

    <!-- ================= BUTTON ================= -->
    <div class="mt-4">

        <?php if (($peminjaman['status'] ?? '') != 'kembali'): ?>
            <a href="<?= base_url('pengembalian/proses/' . $peminjaman['id_peminjaman']) ?>"
               class="btn btn-success"
               onclick="return confirm('Yakin ingin mengembalikan semua buku?')">
                🔁 Kembalikan Semua Buku
            </a>
        <?php else: ?>
            <button class="btn btn-secondary" disabled>
                ✔ Sudah Dikembalikan
            </button>
        <?php endif; ?>

        <a href="<?= base_url('peminjaman') ?>" class="btn btn-primary">
            ← Kembali
        </a>

    </div>

</div>

<?= $this->endSection() ?>