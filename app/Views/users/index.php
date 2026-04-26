<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill"></i> Data Users
        </h3>

        <?php if (session()->get('role') == 'admin'): ?>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                <i class="bi bi-person-plus-fill"></i> Tambah User
            </a>
        <?php endif; ?>
    </div>

    <!-- CARD SEARCH -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <form method="get" action="<?= base_url('users') ?>" class="row g-2 align-items-center">

                <div class="col-md-4">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari nama..."
                           value="<?= esc($_GET['keyword'] ?? '') ?>">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                        <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        Reset
                    </a>

                    <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank"
                       class="btn btn-outline-dark">
                        <i class="bi bi-printer"></i> Print
                    </a>
                </div>

            </form>

        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>

                    <?php if (session()->get('role') == 'admin'): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($users)): ?>

                    <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

                    <?php foreach ($users as $u): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <!-- FOTO -->
                            <td>
                                <?php if (!empty($u['foto'])): ?>
                                    <img src="<?= base_url('uploads/users/' . $u['foto']) ?>"
                                         class="rounded-circle border"
                                         width="45" height="45">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <td class="fw-semibold"><?= esc($u['nama']) ?></td>
                            <td><?= esc($u['email']) ?></td>
                            <td><?= esc($u['username']) ?></td>

                            <!-- ROLE -->
                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= esc($u['role']) ?>
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php if ($u['role'] == 'admin'): ?>
                                    <span class="badge bg-dark">Admin Aktif</span>
                                <?php elseif (($u['status'] ?? 'aktif') == 'aktif'): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Nonaktif</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <?php if (session()->get('role') == 'admin'): ?>
                                <td class="text-nowrap">

                                    <a href="<?= base_url('users/detail/'.$u['id']) ?>"
                                       class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="<?= base_url('users/edit/'.$u['id']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('users/wa/'.$u['id']) ?>"
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>

                                    <?php if ($u['role'] != 'admin'): ?>

                                        <?php if (($u['status'] ?? 'aktif') == 'aktif'): ?>
                                            <a href="<?= base_url('users/nonaktifkan/'.$u['id']) ?>"
                                               class="btn btn-sm btn-secondary">
                                                Nonaktif
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('users/aktifkan/'.$u['id']) ?>"
                                               class="btn btn-sm btn-primary">
                                                Aktifkan
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= base_url('users/delete/'.$u['id']) ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin hapus user ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    <?php endif; ?>

                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Belum ada data user
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