<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>🏷️ Data Kategori</h2>

    <br>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('kategori/create') ?>">
        + Tambah Kategori
    </a>

    <br><br>

    <!-- SEARCH -->
    <form method="get" action="<?= base_url('kategori') ?>">

        <input type="text"
               name="keyword"
               placeholder="Cari kategori..."
               value="<?= esc($_GET['keyword'] ?? '') ?>">

        <button type="submit">Cari</button>
        <a href="<?= base_url('kategori') ?>">Reset</a>

    </form>

    <br>

    <!-- FLASH MESSAGE -->
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
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($kategori)): ?>

            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

            <?php foreach ($kategori as $k): ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><?= esc($k['nama_kategori']) ?></td>

                <td>

                    <a href="<?= base_url('kategori/edit/' . $k['id_kategori']) ?>">
                        Edit
                    </a>

                    |

                    <a href="<?= base_url('kategori/delete/' . $k['id_kategori']) ?>"
                       onclick="return confirm('Hapus kategori ini?')">
                        Hapus
                    </a>

                </td>

            </tr>
            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="3">Belum ada data kategori</td>
            </tr>

        <?php endif; ?>

    </table>

    <br>

    <!-- PAGINATION -->
    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>