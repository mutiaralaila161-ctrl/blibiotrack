<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>📦 Data Rak</h2>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('rak/create') ?>">
        + Tambah Rak
    </a>

    <br><br>

    <!-- TABLE -->
    <table border="1" cellpadding="5" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Rak</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($rak)): ?>

            <?php $no = 1; foreach ($rak as $r): ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><?= esc($r['nama_rak']) ?></td>
                <td><?= esc($r['lokasi']) ?></td>

                <td>

                    <a href="<?= base_url('rak/edit/'.$r['id_rak']) ?>">
                        Edit
                    </a>

                    |

                    <a href="<?= base_url('rak/delete/'.$r['id_rak']) ?>"
                       onclick="return confirm('Hapus data rak ini?')">
                        Hapus
                    </a>

                </td>

            </tr>
            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="4">Belum ada data rak</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>