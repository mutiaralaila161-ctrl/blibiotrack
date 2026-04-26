<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-arrow-return-left"></i> Form Pengembalian Buku
    </h4>

    <!-- ================= INFO PEMINJAMAN ================= -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">
            <strong>📌 Informasi Peminjaman</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-borderless mb-0">

                <tr>
                    <th width="200">ID Peminjaman</th>
                    <td><?= $peminjaman['id_peminjaman'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Nama Anggota</th>
                    <td><?= esc($peminjaman['nama_anggota'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Nama Petugas</th>
                    <td><?= esc($peminjaman['nama_petugas'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?= esc($peminjaman['tanggal_pinjam'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <?php if (($peminjaman['status'] ?? '') == 'kembali'): ?>
                            <span class="badge bg-success">✔ Sudah Dikembalikan</span>
                        <?php else: ?>
                            <span class="badge bg-danger">📌 Masih Dipinjam</span>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>

        </div>

    </div>

    <!-- ================= LIST BUKU ================= -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-dark text-white">
            <strong>📚 Buku yang Dipinjam</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
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
                                         width="60"
                                         class="rounded shadow-sm">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <td class="fw-semibold">
                                <?= esc($d['judul']) ?>
                            </td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= esc($d['jumlah']) ?>
                                </span>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Tidak ada data buku
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- ================= BUTTON ================= -->
    <div class="d-flex gap-2">

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