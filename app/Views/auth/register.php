<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="card shadow p-4" style="max-width:500px; margin:auto;">

        <h4 class="text-center mb-4">Register Anggota</h4>

        <form method="post" action="<?= base_url('register') ?>">

    <?= csrf_field() ?>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Register</button>

</form>

    </div>

</div>

<?= $this->endSection() ?>