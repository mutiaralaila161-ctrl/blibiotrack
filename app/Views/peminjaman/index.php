<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>📚 Data Peminjaman</h2>

    <br>

    <a href="<?= base_url('peminjaman/create') ?>">
        + Tambah Peminjaman
    </a>

    <br><br>

    <table border="1" cellpadding="6" cellspacing="0">

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

        <?php if (!empty($peminjaman)): ?>

            <?php $no = 1; foreach ($peminjaman as $p): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= esc($p['nama_anggota'] ?? '-') ?></td>
                <td><?= esc($p['nama_petugas'] ?? '-') ?></td>

                <!-- BUKU -->
                <td>
                    <?php foreach ($p['detail'] as $d): ?>
                        <div>
                            <img src="<?= base_url('uploads/buku/' . ($d['cover'] ?? 'default.png')) ?>" width="40"><br>
                            <?= esc($d['judul']) ?>
                        </div>
                        <hr>
                    <?php endforeach; ?>
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
                    <?php if ($p['status_label'] == 'Kembali'): ?>
                        <span style="color:green;">Kembali</span>
                    <?php elseif ($p['status_label'] == 'Terlambat'): ?>
                        <span style="color:red;">Terlambat</span>
                    <?php elseif ($p['status_label'] == 'Hampir Telat'): ?>
                        <span style="color:orange;">Hampir Telat</span>
                    <?php else: ?>
                        <span style="color:blue;">Dipinjam</span>
                    <?php endif; ?>
                </td>

                <!-- DENDA -->
                <td>
                    <?php if (!empty($p['tanggal_dikembalikan'])): ?>

                        <?php if (($p['denda'] ?? 0) > 0): ?>

                            Rp <?= number_format($p['denda'],0,',','.') ?><br>

                            <?php if (($p['status_pengembalian'] ?? 'belum_lunas') == 'belum_lunas'): ?>
                                <span style="color:red;">Belum Lunas</span><br>
                                <a href="<?= base_url('denda/bayar/'.$p['id_peminjaman']) ?>"
                                   onclick="return confirm('Bayar denda?')">
                                   Bayar
                                </a>
                            <?php else: ?>
                                <span style="color:green;">Lunas</span>
                            <?php endif; ?>

                        <?php else: ?>
                            <span style="color:green;">Tidak ada</span>
                        <?php endif; ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <!-- AKSI -->
                <td>

                    <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                        Detail
                    </a>

                    <?php if ($p['status'] != 'kembali'): ?>
                        | 
                        <a href="<?= base_url('pengembalian/form/'.$p['id_peminjaman']) ?>">
                            Kembalikan
                        </a>
                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="8">Belum ada data peminjaman</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>