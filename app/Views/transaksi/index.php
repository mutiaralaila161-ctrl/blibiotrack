<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-cash-stack"></i> Data Transaksi Denda
        </h4>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>

                <?php $no=1; foreach($transaksi as $t): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($t['nama_anggota'] ?? '-') ?></td>

                        <td>
                            <span class="text-muted">
                                <?= esc($t['tanggal']) ?>
                            </span>
                        </td>

                        <td class="fw-semibold">
                            Rp <?= number_format($t['jumlah'],0,',','.') ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php if ($t['status'] == 'belum_bayar'): ?>
                                <span class="badge bg-danger">Belum Bayar</span>

                            <?php elseif ($t['status'] == 'menunggu_verifikasi'): ?>
                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>

                            <?php elseif ($t['status'] == 'lunas'): ?>
                                <span class="badge bg-success">Lunas</span>

                            <?php endif; ?>
                        </td>

                        <!-- AKSI -->
                        <td class="text-nowrap">

                            <!-- ANGGOTA -->
                            <?php if (session()->get('role') == 'anggota'): ?>

                                <?php if ($t['status'] == 'belum_bayar'): ?>
                                    <a href="<?= base_url('transaksi/bayar/'.$t['id_transaksi']) ?>"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-cash"></i> Bayar
                                    </a>

                                <?php elseif ($t['status'] == 'menunggu_verifikasi'): ?>
                                    <span class="text-warning fw-semibold">
                                        ⏳ Menunggu Verifikasi
                                    </span>

                                <?php elseif ($t['status'] == 'lunas'): ?>
                                    <span class="text-success fw-semibold">
                                        ✔ Lunas
                                    </span>
                                <?php endif; ?>

                            <?php endif; ?>


                            <!-- PETUGAS -->
                            <?php if (session()->get('role') == 'petugas'): ?>

                                <?php if ($t['status'] == 'menunggu_verifikasi'): ?>
                                    <a href="<?= base_url('transaksi/verifikasi/'.$t['id_transaksi']) ?>"
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i> Verifikasi
                                    </a>

                                <?php elseif ($t['status'] == 'lunas'): ?>
                                    <span class="text-success fw-semibold">
                                        ✔ Sudah Diverifikasi
                                    </span>

                                <?php else: ?>
                                    <span class="text-danger fw-semibold">
                                        Belum dibayar
                                    </span>
                                <?php endif; ?>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>