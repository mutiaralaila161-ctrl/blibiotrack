<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?= $title ?? 'Detail Buku' ?></h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>Judul Buku</th>
                    <td><?= $buku['judul'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>ISBN</th>
                    <td><?= $buku['isbn'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td><?= $buku['nama_kategori'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Penulis</th>
                    <td><?= $buku['nama_penulis'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Penerbit</th>
                    <td><?= $buku['nama_penerbit'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Tahun Terbit</th>
                    <td><?= $buku['tahun_terbit'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Jumlah</th>
                    <td><?= $buku['jumlah'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Tersedia</th>
                    <td><?= $buku['tersedia'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Rak</th>
                    <td><?= $buku['nama_rak'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td><?= $buku['deskripsi'] ?? '-' ?></td>
                </tr>

                <tr>
                    <th>Cover</th>
                    <td>
                        <?php if (!empty($buku['cover'])) : ?>
                            <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" 
                                 width="120" 
                                 class="img-thumbnail">
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>

            </table>

            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>