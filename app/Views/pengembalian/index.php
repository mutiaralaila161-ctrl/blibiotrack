<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>📦 Data Pengembalian</h2>

    <br>

    <table border="1" cellpadding="5" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Kembali</th>
            <th>Denda</th>
            <th>Status</th>
        </tr>

        <?php if (!empty($pengembalian)): ?>

            <?php $no = 1; foreach ($pengembalian as $p): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= esc($p['nama_anggota'] ?? '-') ?></td>

                <td><?= esc($p['tanggal_dikembalikan'] ?? '-') ?></td>

                <!-- DENDA -->
                <td>
                    <?php if (!empty($p['jumlah_denda']) && $p['jumlah_denda'] > 0): ?>
                        Rp <?= number_format($p['jumlah_denda'],0,',','.') ?>
                    <?php else: ?>
                        Tidak ada
                    <?php endif; ?>
                </td>

                <!-- STATUS DENDA -->
                <td>
                    <?php if (!empty($p['status_denda'])): ?>

                        <?php if ($p['status_denda'] == 'belum_bayar'): ?>
                            Belum Bayar
                        <?php else: ?>
                            Lunas
                        <?php endif; ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="5">Belum ada data pengembalian</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>