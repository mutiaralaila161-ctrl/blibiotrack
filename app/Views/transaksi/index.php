<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-cash-stack"></i> Data Transaksi Denda
    </h4>

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

                        <td><?= esc($t['tanggal'] ?? '-') ?></td>

                        <td>
                            Rp <?= number_format($t['jumlah'],0,',','.') ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <span class="badge bg-<?= $t['warna'] ?>">
                                <?= $t['status_label'] ?>
                            </span>
                        </td>

                        <!-- AKSI -->
                        <td>

                            <?php if (session()->get('role') == 'anggota'): ?>

                                <?php if ($t['status'] == 'belum_bayar'): ?>
                                    <a href="<?= base_url('transaksi/bayar/'.$t['id_transaksi']) ?>"
                                       class="btn btn-sm btn-danger">
                                        Bayar
                                    </a>

                                <?php elseif ($t['status'] == 'menunggu_verifikasi'): ?>
                                    <span class="text-warning">Menunggu verifikasi</span>

                                <?php else: ?>
                                    <span class="text-success">Lunas</span>
                                <?php endif; ?>

                            <?php endif; ?>


                            <?php if (in_array(session()->get('role'), ['petugas', 'admin'])): ?>

    <?php if ($t['status'] == 'menunggu_verifikasi'): ?>
        <a href="<?= base_url('transaksi/verifikasi/'.$t['id_transaksi']) ?>"
           class="btn btn-sm btn-success">
            Verifikasi
        </a>

    <?php elseif ($t['status'] == 'lunas'): ?>
        <span class="text-success fw-semibold">✔ Lunas</span>

    <?php else: ?>
        <span class="text-muted">-</span>
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