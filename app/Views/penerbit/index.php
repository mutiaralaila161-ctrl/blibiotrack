<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-building me-2"></i> Data Penerbit
            </h5>

            <a href="<?= base_url('penerbit/create') ?>" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </a>
        </div>

        <div class="card-body p-4">

            <!-- SEARCH -->
            <form method="get" action="<?= base_url('penerbit') ?>" class="row g-2 mb-3">

                <div class="col-md-8">
                    <input type="text"
                           name="keyword"
                           class="form-control shadow-sm rounded-3"
                           placeholder="Cari penerbit..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="<?= base_url('penerbit') ?>" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>

            <!-- FLASH -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success shadow-sm">
                    <i class="bi bi-check-circle me-1"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($penerbit)): ?>

                            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                            <?php foreach ($penerbit as $p): ?>
                            <tr>

                                <td><?= $no++ ?></td>

                                <td class="fw-semibold">
                                    <?= esc($p['nama_penerbit']) ?>
                                </td>

                                <td>
                                    <i class="bi bi-geo-alt me-1 text-secondary"></i>
                                    <?= esc($p['alamat']) ?>
                                </td>

                                <td>

                                    <a href="<?= base_url('penerbit/edit/' . $p['id_penerbit']) ?>"
                                       class="btn btn-warning btn-sm text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="<?= base_url('penerbit/delete/' . $p['id_penerbit']) ?>"
                                       onclick="return confirm('Hapus data penerbit ini?')"
                                       class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </td>

                            </tr>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-muted py-4">
                                    Belum ada data penerbit
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                <?= $pager->links() ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>