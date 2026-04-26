<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow" style="width: 380px;">

        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">Register</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="anggota">Anggota</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <!-- FOTO PROFIL -->
    <div class="mb-3">
        <label>Foto Profil</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>

    <button class="btn btn-success w-100">
        Daftar
    </button>

</form>
        </div>
    </div>

</div>

</body>
</html>