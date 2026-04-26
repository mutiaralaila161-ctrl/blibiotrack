<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold mb-0">
            <i class="bi bi-pen"></i> Data Penulis
        </h4>

        <a href="<?= base_url('penulis/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Penulis
        </a>

    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">

        <div class="card-body">

            <form method="get" action="<?= base_url('penulis') ?>" class="row g-2">

                <div class="col-md-10">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari penulis..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>

                <div class="col-12 mt-2">
                    <a href="<?= base_url('penulis') ?>" class="btn btn-outline-secondary btn-sm">
                        Reset
                    </a>
                </div>

            </form>

        </div>

    </div>

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
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

                            <td class="text-nowrap">

                                <a href="<?= base_url('penulis/edit/' . $p['id_penulis']) ?>"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="<?= base_url('penulis/delete/' . $p['id_penulis']) ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus data penulis ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            Belum ada data penulis
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