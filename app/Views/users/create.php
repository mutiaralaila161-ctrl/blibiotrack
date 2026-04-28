<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #c3d1f0, #e6ecff);
            font-family: "Segoe UI", sans-serif;
        }

        /* CARD */
        .card {
            border-radius: 18px;
            border: none;
            overflow: hidden;
        }

        /* HEADER */
        .card-header {
            background: linear-gradient(135deg, #0d6efd, #4f8dfd);
            color: #fff;
            padding: 18px 20px;
            border: none;
        }

        /* BODY */
        .card-body {
            padding: 25px;
        }

        /* INPUT */
        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.1rem rgba(13,110,253,0.25);
        }

        /* LABEL */
        .form-label {
            font-weight: 500;
        }

        /* BUTTON */
        .btn {
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        /* ALERT */
        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">
                <i class="bi bi-person-plus me-1"></i>
                Form Tambah User
            </h4>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak upload foto</small>
                </div>

                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>

                    <a href="<?= base_url('login') ?>" class="btn btn-secondary">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Sudah Punya Akun
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>