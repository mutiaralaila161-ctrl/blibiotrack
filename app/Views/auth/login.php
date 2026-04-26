<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BLIBIOTRACK</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 900px;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        /* LEFT SIDE */
        .login-left {
            flex: 1;
            background: url('<?= base_url('assets/img/library-bg.jpg') ?>') center/cover no-repeat;
            position: relative;
            color: white;
        }

        .login-left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(13,110,253,0.75);
        }

        .login-left-content {
            position: relative;
            z-index: 2;
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h2 {
            font-weight: bold;
        }

        /* RIGHT SIDE */
        .login-right {
            flex: 1;
            background: white;
            padding: 50px 40px;
        }

        .title {
            font-weight: bold;
            color: #0d6efd;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-login {
            border-radius: 10px;
            padding: 10px;
        }

        @media(max-width: 768px) {
            .login-card {
                flex-direction: column;
                width: 100%;
            }

            .login-left {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- LEFT -->
        <div class="login-left">
            <div class="login-left-content">
                <h2>BLIBIOTRACK</h2>
                <p>Sistem Perpustakaan Digital Modern</p>
                <hr>
                <p>📚 Kelola buku dengan mudah<br>
                   👥 Manajemen anggota & petugas<br>
                   ⚡ Sistem cepat & responsif</p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <div class="text-center mb-4">

                <h3 class="title">BLIBIOTRACK</h3>
                <small class="text-muted">Silakan login untuk melanjutkan</small>

            </div>

            <!-- ALERT -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form action="<?= base_url('/proses-login') ?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button class="btn btn-primary w-100 btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>

            </form>

            <div class="text-center mt-3">
                <a href="<?= base_url('users/create') ?>" class="btn btn-outline-success btn-sm w-100">
                    <i class="bi bi-person-plus"></i> Daftar Akun Baru
                     <a href="<?= base_url('restore') ?>" class="menu-link text-light">
            <i class="bi bi-database me-2"></i> Restore DB
        </a>
                </a>
            </div>


        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>