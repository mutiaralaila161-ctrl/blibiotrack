<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            <i class="bi bi-arrow-return-left"></i> Data Pengembalian
        </h4>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($pengembalian)): ?>

                    <?php $no = 1; foreach ($pengembalian as $p): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td class="fw-semibold">
                                <?= esc($p['nama_anggota'] ?? '-') ?>
                            </td>

                            <td>
                                <span class="text-muted">
                                    <?= esc($p['tanggal_dikembalikan'] ?? '-') ?>
                                </span>
                            </td>

                            <!-- DENDA -->
                            <td>
                                <?php if (!empty($p['jumlah_denda']) && $p['jumlah_denda'] > 0): ?>
                                    <span class="badge bg-danger">
                                        Rp <?= number_format($p['jumlah_denda'],0,',','.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success">
                                        Tidak ada denda
                                    </span>
                                <?php endif; ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data pengembalian
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>