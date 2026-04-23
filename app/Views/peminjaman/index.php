<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>📚 Data Peminjaman</h2>

    <br>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('peminjaman/create') ?>">
        + Tambah Peminjaman
    </a>

    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Petugas</th>
            <th>Buku</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($peminjaman)): ?>

            <?php $no = 1; foreach ($peminjaman as $p): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= esc($p['nama_anggota'] ?? '-') ?></td>
                <td><?= esc($p['nama_petugas'] ?? '-') ?></td>

                <!-- BUKU -->
                <td>
                    <?php if (!empty($p['detail'])): ?>
                        <?php foreach ($p['detail'] as $d): ?>

                            <div>
                                <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.png')) ?>"
                                     width="40">
                                <br>
                                <?= esc($d['judul']) ?>
                            </div>
                            <hr>

                        <?php endforeach; ?>
                    <?php else: ?>
                        Tidak ada buku
                    <?php endif; ?>
                </td>

                <!-- TANGGAL -->
                <td>
                    Pinjam: <?= esc($p['tanggal_pinjam']) ?><br>
                    Kembali: <?= esc($p['tanggal_kembali']) ?><br>

                    <?php if (!empty($p['notifikasi'])): ?>
                        ⚠️ <?= $p['notifikasi'] ?>
                    <?php endif; ?>
                </td>

                <!-- STATUS -->
                <td>
                    <?php if ($p['status_label'] == 'Terlambat'): ?>
                        Terlambat
                    <?php elseif ($p['status_label'] == 'Hampir Telat'): ?>
                        Hampir Telat
                    <?php elseif ($p['status_label'] == 'Kembali'): ?>
                        Kembali
                    <?php else: ?>
                        Dipinjam
                    <?php endif; ?>
                </td>

                <!-- AKSI -->
                <td>

                    <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                        Detail
                    </a>

                    |

                    <?php if ($p['status'] != 'kembali'): ?>
                        <a href="<?= base_url('pengembalian/form/'.$p['id_peminjaman']) ?>">
                            Kembalikan
                        </a>
                    <?php endif; ?>

                    <!-- DENDA -->
                    <?php if ($p['status'] == 'kembali' && !empty($p['id_pengembalian'])): ?>
                        |
                        <a href="<?= base_url('denda/create/'.$p['id_pengembalian']) ?>">
                            Denda
                        </a>
                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7">Belum ada data peminjaman</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>