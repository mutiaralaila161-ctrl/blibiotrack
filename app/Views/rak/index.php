<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-box-seam"></i> Data Rak
        </h4>

        <a href="<?= base_url('rak/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Rak
        </a>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Rak</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($rak)): ?>

                    <?php $no = 1; foreach ($rak as $r): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <td class="fw-semibold">
                                <?= esc($r['nama_rak']) ?>
                            </td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= esc($r['lokasi']) ?>
                                </span>
                            </td>

                            <td class="text-nowrap">

                                <a href="<?= base_url('rak/edit/'.$r['id_rak']) ?>"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a href="<?= base_url('rak/delete/'.$r['id_rak']) ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus data rak ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada data rak
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>