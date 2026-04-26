<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">📄 Detail Denda</h4>

        <a href="<?= base_url('denda') ?>" class="btn btn-outline-secondary">
            ← Kembali
        </a>

    </div>

    <!-- INFO CARD -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-danger text-white">
            <strong>💰 Informasi Denda</strong>
        </div>

        <div class="card-body">

            <table class="table table-borderless">

                <tr>
                    <th width="200">Nama Anggota</th>
                    <td><?= esc($denda['nama_anggota']) ?></td>
                </tr>

                <tr>
                    <th>Petugas</th>
                    <td><?= esc($denda['nama_petugas']) ?></td>
                </tr>

                <tr>
                    <th>ID Peminjaman</th>
                    <td>#<?= esc($denda['id_peminjaman']) ?></td>
                </tr>

                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?= $denda['tanggal_pinjam'] ?></td>
                </tr>

                <tr>
                    <th>Jatuh Tempo</th>
                    <td><?= $denda['tanggal_kembali'] ?></td>
                </tr>

                <tr>
                    <th>Dikembalikan</th>
                    <td><?= $denda['tanggal_dikembalikan'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Total Denda</th>
                    <td class="fw-bold text-danger">
                        Rp <?= number_format($denda['jumlah_denda'],0,',','.') ?>
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ($denda['status'] == 'sudah_bayar'): ?>
                            <span class="badge bg-success">✔ Lunas</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                </tr>

                <!-- VERIFIKASI -->
                <tr>
                    <th>Verifikasi</th>
                    <td>
                        <?php if (!empty($denda['verified_by'])): ?>
                            <span class="text-success fw-semibold">
                                ✔ Diverifikasi oleh <?= esc($denda['nama_verifikator']) ?>
                            </span>
                            <br>
                            <small class="text-muted">
                                <?= $denda['verified_at'] ?>
                            </small>
                        <?php else: ?>
                            <span class="text-warning">
                                Belum diverifikasi
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>

            </table>

        </div>

    </div>

    <!-- BUKU -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">
            <strong>📚 Buku yang Dipinjam</strong>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <?php foreach ($buku as $b): ?>

                    <div class="col-6 col-md-3">

                        <div class="card h-100 shadow-sm border-0">

                            <img src="<?= base_url('uploads/buku/' . ($b['cover'] ?? 'default.png')) ?>"
                                 class="card-img-top"
                                 style="height:180px; object-fit:cover;">

                            <div class="card-body text-center">

                                <div class="fw-semibold text-truncate">
                                    <?= esc($b['judul']) ?>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

    <!-- AKSI -->
    <div class="d-flex gap-2">

        <?php if ($denda['status'] == 'belum_bayar'): ?>
            <a href="<?= base_url('denda/bayar/'.$denda['id_denda']) ?>"
               class="btn btn-danger"
               onclick="return confirm('Bayar denda?')">
                💰 Bayar
            </a>
        <?php endif; ?>

        <?php if (
            session()->get('role') == 'petugas' &&
            $denda['status'] == 'sudah_bayar' &&
            empty($denda['verified_by'])
        ): ?>
            <a href="<?= base_url('denda/verifikasi/'.$denda['id_denda']) ?>"
               class="btn btn-primary"
               onclick="return confirm('Verifikasi denda?')">
                ✔ Verifikasi
            </a>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>