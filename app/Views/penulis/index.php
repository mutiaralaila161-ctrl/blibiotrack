<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- CARD WRAPPER -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-pen-fill me-2"></i> Data Penulis
            </h5>

            <a href="<?= base_url('penulis/create') ?>" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </a>
        </div>

        <div class="card-body p-4">

            <!-- SEARCH -->
            <form method="get" action="<?= base_url('penulis') ?>" class="row g-2 mb-3">

                <div class="col-md-8">
                    <input type="text"
                           name="keyword"
                           class="form-control shadow-sm rounded-3"
                           placeholder="Cari penulis..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="<?= base_url('penulis') ?>" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>

            <!-- FLASH MESSAGE -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success shadow-sm">
                    <i class="bi bi-check-circle me-1"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Penulis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($penulis)): ?>

                            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                            <?php foreach ($penulis as $p): ?>
                            <tr>

                                <td><?= $no++ ?></td>

                                <td class="fw-semibold">
                                    <?= esc($p['nama_penulis']) ?>
                                </td>

                                <td>

                                    <a href="<?= base_url('penulis/edit/' . $p['id_penulis']) ?>"
                                       class="btn btn-warning btn-sm text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="<?= base_url('penulis/delete/' . $p['id_penulis']) ?>"
                                       onclick="return confirm('Hapus data penulis ini?')"
                                       class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </td>

                            </tr>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="3" class="text-muted py-4">
                                    Belum ada data penulis
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