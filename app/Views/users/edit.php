<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
// FIX ERROR ID (PALING AMAN)
$id = $user['id'] ?? $user['id_user'] ?? null;
?>

<style>
/* CARD STYLE */
.card {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* HEADER */
.card-header {
    background: linear-gradient(135deg, #4f8dfd, #6ea8fe);
    border: none;
    padding: 18px 22px;
    color: white;
}

/* FORM LABEL */
.form-label {
    font-weight: 600;
    color: #495057;
}

/* INPUT */
.form-control,
.form-select {
    border-radius: 12px;
    padding: 10px 12px;
    border: 1px solid #e5e5e5;
    transition: 0.2s;
}

.form-control:focus,
.form-select:focus {
    border-color: #4f8dfd;
    box-shadow: 0 0 0 4px rgba(79,141,253,0.15);
}

/* BUTTON */
.btn {
    border-radius: 12px;
    padding: 10px 18px;
}

.btn-success {
    background: #20c997;
    border: none;
}

.btn-success:hover {
    background: #1aa179;
}

/* IMAGE */
img {
    border-radius: 50%;
    border: 3px solid #e9ecef;
    object-fit: cover;
}
</style>

<div class="container py-4" style="max-width: 900px;">

    <div class="card">

        <!-- HEADER -->
        <div class="card-header">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-pencil-square"></i> Edit User
            </h5>
        </div>

        <div class="card-body p-4">

            <form action="<?= base_url('users/update/' . $id) ?>"
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
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Kosongkan jika tidak diubah">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password</small>
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
                        <label class="form-label">Foto Profil</label>
                        <input type="file" name="foto" class="form-control">

                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Foto saat ini:</small>

                            <?php if (!empty($user['foto'])): ?>
                                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                     width="80"
                                     height="80">
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