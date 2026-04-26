<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">💰 Data Denda</h4>

    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Peminjaman</th>
                        <th>Anggota</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php $no = 1; foreach ($denda as $d): ?>

                    <?php
                        $status = $d['status'] ?? 'belum_bayar';
                    ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td class="fw-semibold">
                            #<?= esc($d['id_peminjaman']) ?>
                        </td>

                        <td><?= esc($d['nama_anggota'] ?? '-') ?></td>

                        <td><?= esc($d['tanggal_dikembalikan'] ?? '-') ?></td>

                        <td class="fw-semibold text-danger">
                            Rp <?= number_format($d['jumlah_denda'] ?? 0,0,',','.') ?>
                        </td>

                        <!-- STATUS -->
                        <td>

                            <?php if ($status === 'belum_bayar'): ?>

                                <span class="badge bg-danger">Belum Dibayar</span>

                            <?php elseif ($status === 'menunggu_verifikasi'): ?>

                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>

                            <?php elseif ($status === 'lunas'): ?>

                                <span class="badge bg-success">✔ Lunas</span>

                            <?php else: ?>

                                <span class="badge bg-secondary">-</span>

                            <?php endif; ?>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <?php if ($status === 'belum_bayar'): ?>

                                <?php if (session()->get('role') === 'anggota'): ?>
                                    <a href="<?= base_url('peminjaman/bayarDenda/'.$d['id_denda']) ?>"
                                       class="btn btn-sm btn-primary"
                                       onclick="return confirm('Bayar denda sekarang?')">
                                        💰 Bayar
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">
                                        Menunggu pembayaran
                                    </span>
                                <?php endif; ?>

                            <?php elseif ($status === 'menunggu_verifikasi'): ?>

                                <?php if (session()->get('role') === 'petugas'): ?>
                                    <a href="<?= base_url('peminjaman/verifikasiDenda/'.$d['id_denda']) ?>"
                                       class="btn btn-sm btn-success">
                                        ✔ Verifikasi
                                    </a>
                                <?php else: ?>
                                    <span class="text-warning small">
                                        Menunggu verifikasi petugas
                                    </span>
                                <?php endif; ?>

                            <?php elseif ($status === 'lunas'): ?>

                                <span class="text-success small fw-semibold">
                                    ✔ Sudah Lunas
                                </span>

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