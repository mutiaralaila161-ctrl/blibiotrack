<a href="<?= base_url('/') ?>">
    <b>PERPUS</b>App
</a><br>

<a href="<?= base_url('/') ?>">
    Dashboard
</a><br>

<?php if (session()->get('role')) : ?>

    <!-- 🔥 MENU ADMIN & PETUGAS -->
    <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

        <a href="<?= base_url('/users') ?>">Users</a><br>
        <a href="<?= base_url('/buku') ?>">Buku</a><br>
        <a href="<?= base_url('/pengembalian') ?>">Pengembalian</a><br>
        <a href="<?= base_url('denda') ?>">Denda</a><br>
        <a href="<?= base_url('/rak') ?>">Rak</a><br>
        <a href="<?= base_url('/kategori') ?>">Kategori</a><br>
        <a href="<?= base_url('/penulis') ?>">Penulis</a><br>
        <a href="<?= base_url('/penerbit') ?>">Penerbit</a><br>

    <!-- 🔥 MENU SEMUA ROLE -->
    <?php if (in_array(session()->get('role'), ['admin','petugas','anggota'])) : ?>
        <a href="<?= base_url('peminjaman') ?>">Peminjaman</a><br>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin') : ?>
<a href="<?= base_url('/backup') ?>" class="btn btn-success">Backup Database</a>
<?php endif; ?>
<a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm">
<i class="bi bi-database"></i> Restore DB
</a>
    <?php endif; ?>
    
    <!-- 🔥 SETTING -->
    <?php $idu = session()->get('id'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>">Setting</a><br>

<?php endif; ?>

<hr>

<?php if (session()->get('nama')) : ?>
    Masuk sebagai:
    <b><?= session()->get('nama'); ?> (<?= session()->get('role'); ?>)</b>
    <br>

    <?php if (session()->get('foto')) : ?>
        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80"><br>
    <?php else : ?>
        <img src="<?= base_url('assets/img/default.png') ?>" height="80"><br>
    <?php endif; ?>

    <!-- 🔥 LOGOUT DI BAWAH FOTO -->
    <a href="<?= base_url('/logout') ?>">Log Out</a>

<?php endif; ?>