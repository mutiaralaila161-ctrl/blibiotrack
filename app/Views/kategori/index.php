<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">🏷️ Data Kategori</h4>

        <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">
            + Tambah Kategori
        </a>

    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            <form method="get" action="<?= base_url('kategori') ?>">

                <div class="input-group">

                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari kategori..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">

                    <button class="btn btn-primary" type="submit">
                        🔍 Cari
                    </button>

                    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                        Reset
                    </a>

                </div>

            </form>

        </div>
    </div>

    <!-- FLASH -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <table class="table table-hover mb-0 align-middle">

                <thead class="table-dark">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($kategori)): ?>

                        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                        <?php foreach ($kategori as $k): ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td class="fw-semibold">
                                    <?= esc($k['nama_kategori']) ?>
                                </td>

                                <td class="text-center">

                                    <a href="<?= base_url('kategori/edit/' . $k['id_kategori']) ?>"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="<?= base_url('kategori/delete/' . $k['id_kategori']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Hapus kategori ini?')">
                                        Hapus
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                Belum ada data kategori
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>