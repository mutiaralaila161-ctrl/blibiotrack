<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>🏢 Data Penerbit</h2>

    <br>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('penerbit/create') ?>">
        + Tambah Penerbit
    </a>

    <br><br>

    <!-- SEARCH -->
    <form method="get" action="<?= base_url('penerbit') ?>">

        <input type="text"
               name="keyword"
               placeholder="Cari penerbit..."
               value="<?= esc($_GET['keyword'] ?? '') ?>">

        <button type="submit">Cari</button>
        <a href="<?= base_url('penerbit') ?>">Reset</a>

    </form>

    <br>

    <!-- FLASH -->
    <?php if (session()->getFlashdata('success')): ?>
        <div>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <br>

    <!-- TABLE -->
    <table border="1" cellpadding="5" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Penerbit</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($penerbit)): ?>

            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

            <?php foreach ($penerbit as $p): ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><?= esc($p['nama_penerbit']) ?></td>
                <td><?= esc($p['alamat']) ?></td>

                <td>

                    <a href="<?= base_url('penerbit/edit/' . $p['id_penerbit']) ?>">
                        Edit
                    </a>

                    |

                    <a href="<?= base_url('penerbit/delete/' . $p['id_penerbit']) ?>"
                       onclick="return confirm('Hapus data penerbit ini?')">
                        Hapus
                    </a>

                </td>

            </tr>
            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="4">Belum ada data penerbit</td>
            </tr>

        <?php endif; ?>

    </table>

    <br>

    <!-- PAGINATION -->
    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>