<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            <i class="bi bi-file-earmark-text"></i> Detail Peminjaman
        </h4>

        <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </div>

<?php
    $today = date('Y-m-d');

    if (($peminjaman['status'] ?? '') == 'kembali') {
        $status = 'Kembali';
        $badge  = 'bg-success';
        $notif  = '';
    } elseif (!empty($peminjaman['tanggal_kembali']) && $today > $peminjaman['tanggal_kembali']) {
        $status = 'Terlambat';
        $badge  = 'bg-danger';
        $notif  = '⚠️ Telat mengembalikan';
    } elseif (!empty($peminjaman['tanggal_kembali']) && $today == date('Y-m-d', strtotime($peminjaman['tanggal_kembali'].' -1 day'))) {
        $status = 'Hampir Telat';
        $badge  = 'bg-warning text-dark';
        $notif  = '🔔 Besok harus dikembalikan';
    } else {
        $status = 'Dipinjam';
        $badge  = 'bg-primary';
        $notif  = '';
    }
?>

    <!-- ================= INFO CARD ================= -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-dark text-white">
            <strong>📌 Informasi Peminjaman</strong>
        </div>

        <div class="card-body">

            <table class="table table-borderless mb-0">

                <tr>
                    <th width="200">ID Peminjaman</th>
                    <td><?= esc($peminjaman['id_peminjaman']) ?></td>
                </tr>

                <tr>
                    <th>Anggota</th>
                    <td><?= esc($peminjaman['nama_anggota'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Petugas</th>
                    <td><?= esc($peminjaman['nama_petugas'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?= esc($peminjaman['tanggal_pinjam']) ?></td>
                </tr>

                <tr>
                    <th>Tanggal Kembali</th>
                    <td><?= esc($peminjaman['tanggal_kembali']) ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <span class="badge <?= $badge ?>">
                            <?= $status ?>
                        </span>

                        <?php if (!empty($notif)): ?>
                            <div class="mt-2 text-danger fw-semibold">
                                <?= $notif ?>
                            </div>
                        <?php endif; ?>

                    </td>
                </tr>

            </table>

            <!-- ================= DENDA ================= -->
            <?php if (!empty($peminjaman['denda']) && $peminjaman['denda'] > 0): ?>

                <div class="alert alert-danger mt-3 mb-0">

                    💰 <strong>Denda:</strong>
                    Rp <?= number_format($peminjaman['denda'], 0, ',', '.') ?>

                    <br>

                    <?php if (($peminjaman['status_denda'] ?? 'belum_bayar') == 'belum_bayar'): ?>
                        <span class="badge bg-danger mt-2">Belum Dibayar</span>
                    <?php else: ?>
                        <span class="badge bg-success mt-2">Sudah Dibayar</span>
                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

    <!-- ================= BUKU ================= -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <strong>📚 Buku yang Dipinjam</strong>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <?php if (!empty($detail)): ?>

                    <?php foreach ($detail as $d): ?>

                        <div class="col-6 col-md-3">

                            <div class="card h-100 shadow-sm border-0">

                                <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.png')) ?>"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover;">

                                <div class="card-body text-center">

                                    <div class="fw-semibold text-truncate">
                                        <?= esc($d['judul'] ?? '-') ?>
                                    </div>

                                    <span class="badge bg-info mt-2">
                                        1 Buku
                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="col-12 text-center text-muted py-4">
                        Tidak ada buku
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>