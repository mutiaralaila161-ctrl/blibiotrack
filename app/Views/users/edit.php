<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-pencil-square"></i> Edit User
            </h5>
        </div>

        <div class="card-body p-4">

            <form action="<?= base_url('users/update/' . $user['id']) ?>"
                  method="post"
                  enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- NAMA -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="<?= esc($user['nama']) ?>"
                               required>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="<?= esc($user['email']) ?>"
                               required>
                    </div>

                    <!-- USERNAME -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="<?= esc($user['username']) ?>"
                               required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Kosongkan jika tidak diubah">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
                    </div>

                    <!-- ROLE -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                            <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                        </select>
                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control">

                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Foto saat ini:</small>

                            <?php if (!empty($user['foto'])): ?>
                                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                     class="rounded-circle border shadow-sm"
                                     width="80"
                                     height="80"
                                     style="object-fit: cover;">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada foto</span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Update
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>