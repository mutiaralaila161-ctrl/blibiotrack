<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📚 Data Buku</h4>

        <a href="<?= base_url('buku/create') ?>" class="btn btn-primary btn-sm">
            + Tambah Buku
        </a>
    </div>

    <!-- SEARCH -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <form class="row g-2" method="get">

                <div class="col-md-8">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari judul buku..."
                           value="<?= esc($keyword ?? '') ?>">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary w-100">Cari</button>
                    <a href="<?= base_url('buku') ?>" class="btn btn-secondary w-100">Reset</a>
                </div>

            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($buku)): ?>
                    <?php $no = 1; foreach ($buku as $b): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <img src="<?= base_url('uploads/buku/' . ($b['cover'] ?? 'default.png')) ?>"
                                     width="50" class="rounded">
                            </td>

                            <td class="fw-semibold">
                                <?= esc($b['judul'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($b['nama_kategori'] ?? '-') ?>
                            </td>

                            <td>
                                <?= esc($b['nama_penulis'] ?? '-') ?>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    <?= esc($b['tersedia'] ?? 0) ?>
                                </span>
                            </td>

                            <td class="d-flex gap-1">

                                <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>"
                                   class="btn btn-sm btn-info">
                                    Detail
                                </a>

                                <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="<?= base_url('buku/delete/'.$b['id_buku']) ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus data?')">
                                    Hapus
                                </a>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Tidak ada data
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