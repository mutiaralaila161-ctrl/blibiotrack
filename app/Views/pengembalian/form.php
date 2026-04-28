<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- TITLE -->
    <div class="mb-3">
        <h4 class="fw-bold">
            <i class="bi bi-arrow-return-left me-1"></i> Form Pengembalian Buku
        </h4>
    </div>

    <!-- ================= INFO PEMINJAMAN ================= -->
    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header bg-primary text-white">
            <strong><i class="bi bi-info-circle me-1"></i> Informasi Peminjaman</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">

                    <tr>
                        <th>ID Peminjaman</th>
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
                            <?php 
                            $status = $peminjaman['status'] ?? 'dipinjam';
                            ?>

                            <?php if ($status == 'kembali'): ?>
                                <span class="badge bg-success px-3 py-2">✔ Sudah Dikembalikan</span>
                            <?php elseif ($status == 'dipinjam'): ?>
                                <span class="badge bg-warning text-dark px-3 py-2">📌 Dipinjam</span>
                            <?php else: ?>
                                <span class="badge bg-secondary px-3 py-2"><?= esc($status) ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>

    <!-- ================= LIST BUKU ================= -->
    <div class="card shadow-sm border-0 rounded-4 mt-4">

        <div class="card-header bg-info text-white">
            <strong><i class="bi bi-book me-1"></i> Buku yang Dipinjam</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">

                    <thead class="table-info">
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
                                             class="rounded shadow-sm"
                                             width="60">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <td class="fw-semibold">
                                    <?= esc($d['judul'] ?? '-') ?>
                                </td>

                                <td>
                                    <?= esc($d['jumlah'] ?? 1) ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-muted py-4">
                                Tidak ada data buku
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- ================= BUTTON ================= -->
    <div class="mt-4 d-flex gap-2">

        <?php if (($peminjaman['status'] ?? '') != 'kembali'): ?>
            <a href="<?= base_url('pengembalian/proses/' . $peminjaman['id_peminjaman']) ?>"
               class="btn btn-success px-4 shadow-sm"
               onclick="return confirm('Yakin ingin mengembalikan semua buku?')">
                <i class="bi bi-arrow-repeat me-1"></i> Kembalikan Semua Buku
            </a>
        <?php else: ?>
            <button class="btn btn-secondary px-4" disabled>
                ✔ Sudah Dikembalikan
            </button>
        <?php endif; ?>

        <a href="<?= base_url('peminjaman') ?>" class="btn btn-primary px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

    </div>

</div>

<?= $this->endSection() ?>