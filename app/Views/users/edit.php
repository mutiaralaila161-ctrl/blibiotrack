<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header">
            <h4 class="mb-0">✏️ Edit User</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('users/update/' . $user['id']) ?>"
                  method="post"
                  enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- NAMA -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="<?= esc($user['nama']) ?>"
                               required>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?= esc($user['email']) ?>"
                               required>
                    </div>

                    <!-- USERNAME -->
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="<?= esc($user['username']) ?>"
                               required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6">
                        <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <!-- ROLE -->
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                            <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">

                        <small class="text-muted d-block mt-2">Foto saat ini:</small>

                        <?php if (!empty($user['foto'])): ?>
                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                 width="80"
                                 class="rounded mt-1">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada foto</span>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>