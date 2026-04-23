<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>📚 Data Buku</h2>

    <a href="<?= base_url('buku/create') ?>">
        + Tambah Buku
    </a>

    <br><br>

    <!-- ================= SEARCH ================= -->
    <form method="get" action="<?= base_url('buku') ?>">

        <input type="text"
               name="keyword"
               placeholder="Cari judul buku..."
               value="<?= esc($keyword ?? '') ?>">

        <button type="submit">Cari</button>

        <a href="<?= base_url('buku') ?>">Reset</a>

        <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>" target="_blank">
            Print
        </a>

    </form>

    <br>

    <!-- ================= FLASH ================= -->
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green;">
            <?= session()->getFlashdata('success') ?>
        </p>
    <?php endif; ?>

    <!-- ================= TABLE ================= -->
    <table border="1" cellpadding="6" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Cover</th>
            <th>ISBN</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Rak</th>
            <th>Jumlah</th>
            <th>Tersedia</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($buku)): ?>
            <?php $no = 1; foreach ($buku as $b): ?>
                <tr>

                    <td><?= $no++ ?></td>

                    <!-- COVER -->
                    <td>
                        <?php if (!empty($b['cover'])): ?>
                            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                                 width="50">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td><?= esc($b['isbn'] ?? '-') ?></td>
                    <td><?= esc($b['judul'] ?? '-') ?></td>
                    <td><?= esc($b['nama_kategori'] ?? '-') ?></td>
                    <td><?= esc($b['nama_penulis'] ?? '-') ?></td>
                    <td><?= esc($b['nama_penerbit'] ?? '-') ?></td>
                    <td><?= esc($b['tahun_terbit'] ?? '-') ?></td>
                    <td><?= esc($b['nama_rak'] ?? '-') ?></td>
                    <td><?= esc($b['jumlah'] ?? 0) ?></td>
                    <td><?= esc($b['tersedia'] ?? 0) ?></td>

                    <!-- AKSI -->
                    <td>

                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>">Detail</a> |
                        <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>">Edit</a> |
                        <a href="<?= base_url('buku/wa/' . $b['id_buku']) ?>" target="_blank">WA</a> |
                        <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                           onclick="return confirm('Hapus buku ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="12">Belum ada data buku</td>
            </tr>
        <?php endif; ?>

    </table>

    <!-- ================= PAGINATION ================= -->
    <br>

    <?php if (!empty($pager)) : ?>
        <?= $pager->links() ?>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>