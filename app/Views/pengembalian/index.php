<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-info text-white py-3 rounded-top-4">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-box-arrow-in-down me-2"></i> Data Pengembalian
            </h5>
        </div>

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead class="table-info">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Kembali</th>
                            <th>Denda</th>
                            <th>Aksi</th>
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
                                    <i class="bi bi-calendar-event me-1 text-secondary"></i>
                                    <?= esc($p['tanggal_dikembalikan'] ?? '-') ?>
                                </td>

                                <!-- DENDA -->
                                <td>
                                    <?php if (!empty($p['jumlah_denda']) && $p['jumlah_denda'] > 0): ?>
                                        <span class="badge bg-danger px-3 py-2">
                                            Rp <?= number_format($p['jumlah_denda'],0,',','.') ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success px-3 py-2">
                                            Tidak ada
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- AKSI -->
                                <td>

                                    <?php if (session()->get('role') == 'anggota'): ?>

                                        <?php if (!empty($p['jumlah_denda']) && $p['jumlah_denda'] > 0): ?>

                                            <a href="<?= base_url('transaksi/create/' . $p['id_pengembalian']) ?>"
                                               class="btn btn-sm btn-danger shadow-sm">
                                                <i class="bi bi-cash-coin"></i> Bayar Denda
                                            </a>

                                        <?php else: ?>

                                            <span class="text-success small">
                                                ✔ Tidak ada denda
                                            </span>

                                        <?php endif; ?>

                                    <?php else: ?>

                                        <span class="text-muted small">-</span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="5" class="text-muted py-4">
                                    Belum ada data pengembalian
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>