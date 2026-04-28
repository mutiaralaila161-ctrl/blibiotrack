<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">📄 Detail Peminjaman</h4>
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-secondary">
            ← Kembali
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

<!-- ================= INFORMASI ================= -->
        <div class="card shadow mb-4 border-0">

    <div class="card-header bg-primary text-white">
        📌 Informasi Peminjaman
    </div>

    <div class="card-body">

        <table class="table table-striped table-hover">

            <tr>
                <th style="width:200px; color:#333;">ID Peminjaman</th>
                <td>: <?= esc($peminjaman['id_peminjaman'] ?? '-') ?></td>
            </tr>

            <tr>
                <th style="width:200px; color:#333;">Nama Anggota</th>
                <td>: <?= esc($peminjaman['nama_anggota'] ?? '-') ?></td>
            </tr>

            <tr>
                <th style="width:200px; color:#333;">Nama Petugas</th>
                <td>: <?= esc($peminjaman['nama_petugas'] ?? '-') ?></td>
            </tr>

            <tr>
                <th style="width:200px; color:#333;">Tanggal Pinjam</th>
                <td>: <?= esc($peminjaman['tanggal_pinjam'] ?? '-') ?></td>
            </tr>

            <tr>
                <th style="width:200px; color:#333;">Tanggal Kembali</th>
                <td>: <?= esc($peminjaman['tanggal_kembali'] ?? '-') ?></td>
            </tr>

            <tr>
                <th style="width:200px; color:#333;">Status</th>
                <td>
                    <span class="badge <?= $badge ?> px-3 py-2">
                        <?= $status ?>
                    </span>

                    <?php if (!empty($notif)): ?>
                        <div class="text-danger fw-semibold mt-2">
                            <?= $notif ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>

        </table>

    </div>
</div>

</div>

<!-- ================= DENDA ================= -->
<?php if (!empty($peminjaman['denda']) && $peminjaman['denda'] > 0): ?>
<div class="alert alert-danger">
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

<!-- ================= BUKU ================= -->
<div class="card shadow border-0">

    <div class="card-header bg-info text-white">
        📚 Buku yang Dipinjam
    </div>

    <div class="card-body">

        <div class="row g-3">

            <?php if (!empty($buku)): ?>

                <?php foreach ($buku as $d): ?>

                    <div class="col-md-3">

                        <div class="card h-100 shadow-sm">

                            <!-- COVER -->
                            <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.png')) ?>"
                                 class="card-img-top"
                                 style="height:200px; object-fit:cover;">

                            <div class="card-body text-center">

                                <!-- JUDUL -->
                                <h6 class="fw-bold text-truncate">
                                    <?= esc($d['judul'] ?? '-') ?>
                                </h6>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12 text-center text-muted py-4">
                    Tidak ada buku yang dipinjam
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>

</div>

<?= $this->endSection() ?>