<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Peminjaman</h2>

<a href="<?= base_url('peminjaman/create') ?>">+ Pinjam Buku</a>

<br><br>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= esc(session()->getFlashdata('success')) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<table border="1" cellpadding="6">
    <tr>
        <th>No</th>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Buku Dipinjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($peminjaman)): ?>
        <?php $no = 1; foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $no++ ?></td>

            <td><?= esc($p['anggota']) ?></td>
            <td><?= esc($p['petugas'] ?? '-') ?></td>
            <td><?= esc($p['daftar_buku'] ?? '-') ?></td>
            <td><?= esc($p['tanggal_pinjam']) ?></td>
            <td><?= esc($p['tanggal_kembali'] ?? '-') ?></td>

            <td>
                <?= ($p['status'] == 'dipinjam')
                    ? '<span style="color:red">Dipinjam</span>'
                    : '<span style="color:green">Kembali</span>' ?>
            </td>

            <!-- ================= AKSI (SUDAH DIRAPIKAN) ================= -->
            <td>

                <!-- DETAIL -->
                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>">
                    Detail
                </a>

                |

                <!-- RETURN SEMUA -->
                <?php if ($p['status'] == 'dipinjam'): ?>
                    <a href="<?= base_url('peminjaman/kembali/' . $p['id_peminjaman']) ?>"
                       onclick="return confirm('Kembalikan semua buku?')"
                       style="color:green">
                        Return
                    </a>
                <?php else: ?>
                    <span>-</span>
                <?php endif; ?>

                |

                <!-- HAPUS -->
                <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                   onclick="return confirm('Hapus data peminjaman ini?')"
                   style="color:red">
                    Hapus
                </a>

            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" style="text-align:center;">Belum ada data peminjaman</td>
        </tr>
    <?php endif; ?>

</table>

<?= $this->endSection() ?>