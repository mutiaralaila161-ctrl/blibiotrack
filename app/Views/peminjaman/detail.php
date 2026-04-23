<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">
    <h4>📄 Detail Peminjaman</h4>
    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">← Kembali</a>
</div>

<?php
    $today = date('Y-m-d');

    // ================= STATUS =================
    if ($peminjaman['status'] == 'kembali') {
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

<!-- ================= DATA PEMINJAMAN ================= -->
<div class="card mb-3 shadow">
    <div class="card-body">

        <h5>Informasi Peminjaman</h5>

        <table class="table table-borderless">
            <tr>
                <th width="180">ID</th>
                <td>: <?= esc($peminjaman['id_peminjaman']) ?></td>
            </tr>
            <tr>
                <th>Anggota</th>
                <td>: <?= esc($peminjaman['nama_anggota'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Petugas</th>
                <td>: <?= esc($peminjaman['nama_petugas'] ?? '-') ?></td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>: <?= esc($peminjaman['tanggal_pinjam']) ?></td>
            </tr>
            <tr>
                <th>Tanggal Kembali</th>
                <td>: <?= esc($peminjaman['tanggal_kembali']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge <?= $badge ?>">
                        <?= $status ?>
                    </span>

                    <?php if (!empty($notif)): ?>
                        <div class="mt-2 text-danger fw-bold">
                            <?= $notif ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <!-- ================= DENDA ================= -->
        <?php if (!empty($peminjaman['denda']) && $peminjaman['denda'] > 0): ?>
            <div class="alert alert-danger mt-3">

                💰 <strong>Denda:</strong> Rp <?= number_format($peminjaman['denda']) ?>

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

<!-- ================= BUKU DIPINJAM ================= -->
<div class="card shadow">
    <div class="card-body">

        <h5>📚 Buku yang Dipinjam</h5>

        <div class="row">

            <?php if (!empty($detail)): ?>
                <?php foreach ($detail as $d): ?>

                    <div class="col-md-3 mb-3">

                        <div class="card h-100 shadow-sm">

                            <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.png')) ?>"
                                 class="card-img-top"
                                 style="height:200px;object-fit:cover;">

                            <div class="card-body text-center">

                                <h6 class="mb-1"><?= esc($d['judul']) ?></h6>

                                <small class="text-muted">
                                    Jumlah: <?= esc($d['jumlah']) ?>
                                </small>

                                <br>

                                <?php if ($d['status_kembali'] == 'belum'): ?>
                                    <span class="badge bg-danger mt-2">Belum Kembali</span>
                                <?php else: ?>
                                    <span class="badge bg-success mt-2">Sudah Kembali</span>
                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>
            <?php else: ?>

                <div class="col-12 text-center text-muted">
                    Tidak ada buku
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>

</div>

<?= $this->endSection() ?>