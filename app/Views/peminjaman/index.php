<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            <i class="bi bi-journal-bookmark"></i> Data Peminjaman
        </h4>

        <?php if (session()->get('role') != 'admin'): ?>
            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Pinjam
            </a>
        <?php endif; ?>

    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Petugas</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($peminjaman)): ?>

                    <?php $no = 1; foreach ($peminjaman as $p): ?>

                        <?php $denda = $p['denda'] ?? 0; ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td class="fw-semibold">
                                <?= esc($p['nama_anggota'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($p['nama_petugas'] ?? '-') ?>
                            </td>

                            <!-- BUKU -->
                            <td>
                                <div class="d-flex flex-wrap gap-2">

                                    <?php foreach ($p['detail'] ?? [] as $d): ?>

                                        <div class="text-center" style="width:80px;">

                                            <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.jpg')) ?>"
                                                 class="img-fluid rounded shadow-sm"
                                                 style="height:90px; object-fit:cover;">

                                            <small class="d-block text-truncate">
                                                <?= esc($d['judul'] ?? '-') ?>
                                            </small>

                                        </div>

                                    <?php endforeach; ?>

                                </div>
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <small>
                                    <strong>Pinjam:</strong> <?= esc($p['tanggal_pinjam']) ?><br>

                                    <strong>Kembali:</strong>

                                    <?php if (!empty($p['tanggal_dikembalikan'])): ?>
                                        <span class="text-success">
                                            <?= esc($p['tanggal_dikembalikan']) ?> (dikembalikan)
                                        </span>
                                    <?php else: ?>
                                        <?= esc($p['tanggal_kembali']) ?> (deadline)
                                    <?php endif; ?>
                                </small>
                            </td>

                            <!-- STATUS -->
                            <td>

                                <span class="badge" style="background:<?= $p['warna'] ?? '#6c757d' ?>">
                                    <?= $p['status_label'] ?? 'Tidak diketahui' ?>
                                </span>

                                <div class="mt-1 small text-muted">

                                    <?php if (($p['status_label'] ?? '') == 'Menunggu Approval'): ?>
                                        Menunggu konfirmasi peminjaman

                                    <?php elseif (($p['status_label'] ?? '') == 'Dipinjam'): ?>
                                        Buku sedang dipinjam

                                    <?php elseif (($p['status_label'] ?? '') == 'Menunggu Konfirmasi Kembali'): ?>
                                        Menunggu verifikasi pengembalian
                                    <?php endif; ?>

                                </div>

                                <!-- ICON STATUS KEMBALI -->
                                <?php if (!empty($p['tanggal_dikembalikan'])): ?>
                                    <div class="mt-1">

                                        <?php if (($p['status_kembali'] ?? '') == 'Tepat Waktu'): ?>
                                            <span class="text-success fs-5" title="Tepat Waktu">✔</span>
                                        <?php elseif (($p['status_kembali'] ?? '') == 'Terlambat'): ?>
                                            <span class="text-danger fs-5" title="Terlambat">❌</span>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>

                            </td>

                            <!-- DENDA -->
                            <td>
                                <?php if ($denda > 0): ?>
                                    <span class="text-danger fw-bold">
                                        Rp <?= number_format($denda,0,',','.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td class="text-nowrap">

                                <a class="btn btn-sm btn-outline-primary"
                                   href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                                    Detail
                                </a>

                                <?php if (session()->get('role') == 'petugas' && ($p['status_label'] ?? '') == 'Menunggu Approval'): ?>
                                    <a class="btn btn-sm btn-success"
                                       href="<?= base_url('peminjaman/approve/'.$p['id_peminjaman']) ?>">
                                        ✔
                                    </a>

                                    <a class="btn btn-sm btn-danger"
                                       href="<?= base_url('peminjaman/reject/'.$p['id_peminjaman']) ?>">
                                        ✖
                                    </a>
                                <?php endif; ?>

                                <?php if (empty($p['tanggal_dikembalikan'])): ?>
                                    <a class="btn btn-sm btn-warning"
                                       href="<?= base_url('pengembalian/form/'.$p['id_peminjaman']) ?>">
                                        Kembali
                                    </a>
                                <?php endif; ?>

                                <?php if ($denda > 0): ?>
                                    <a class="btn btn-sm btn-danger"
                                       href="<?= base_url('transaksi/create/'.$p['id_peminjaman']) ?>">
                                        💰
                                    </a>
                                <?php endif; ?>

                                <?php if (in_array(session()->get('role'), ['admin','petugas'])): ?>
                                    <a class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Hapus?')"
                                       href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>">
                                        🗑
                                    </a>
                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Belum ada data peminjaman
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>