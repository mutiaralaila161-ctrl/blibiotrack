<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">👥 Data Users</h4>

        <?php if (session()->get('role') == 'admin'): ?>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-sm">
                + Tambah User
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form class="row g-2" method="get" action="<?= base_url('users') ?>">

                <div class="col-md-5">
                    <input type="text" name="keyword" class="form-control"
                           placeholder="Cari nama..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary w-100">Cari</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-secondary w-100">Reset</a>
                    <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>"
                       target="_blank" class="btn btn-dark w-100">
                        Print
                    </a>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <?php if (session()->get('role') == 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($u['nama']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc($u['username']) ?></td>
                        <td><span class="badge bg-info"><?= $u['role'] ?></span></td>
                        <td>
                            <span class="badge bg-success">
                                <?= ($u['status'] ?? 'aktif') ?>
                            </span>
                        </td>
                        <td>
                            <?php if (!empty($u['foto'])): ?>
                                <img src="<?= base_url('uploads/users/' . $u['foto']) ?>"
                                     class="rounded-circle" width="40" height="40">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>

                        <?php if (session()->get('role') == 'admin'): ?>
                        <td class="d-flex gap-1 flex-wrap">

                            <a class="btn btn-sm btn-info"
                               href="<?= base_url('users/detail/'.$u['id']) ?>">Detail</a>

                            <a class="btn btn-sm btn-warning"
                               href="<?= base_url('users/edit/'.$u['id']) ?>">Edit</a>

                            <a class="btn btn-sm btn-success"
                               href="<?= base_url('users/wa/'.$u['id']) ?>">WA</a>

                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

    <div class="mt-3">
        <?= $pager->links() ?>
    </div>

</div>

<?= $this->endSection() ?>