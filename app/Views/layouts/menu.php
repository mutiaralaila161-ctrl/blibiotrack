<?php
$current = uri_string();

function activeMenu($url, $current)
{
    return ($current == $url) ? 'active' : '';
}

$role = session()->get('role');
?>

<style>
/* === SIDEBAR CONTAINER === */
.sidebar-custom {
    width: 260px;
    background: linear-gradient(180deg, #4f8dfd, #3b7de7);
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    padding: 18px 14px;
    box-shadow: 4px 0 20px rgba(0,0,0,0.08);
}

/* === BRAND === */
.sidebar-custom a.brand {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #ffffff;
    letter-spacing: 0.5px;
}

/* === SECTION TITLE === */
.menu-section {
    font-size: 11px;
    letter-spacing: 1.5px;
    margin-top: 18px;
    margin-bottom: 5px;
    padding-left: 10px;
    color: rgba(255,255,255,0.75);
}

/* === MENU LINK === */
.menu-link {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 12px;
    margin: 4px 0;
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 14px;
    transition: all 0.25s ease;
}

/* ICON */
.menu-link i {
    font-size: 16px;
}

/* HOVER (SOFT EFFECT) */
.menu-link:hover {
    background: rgba(255,255,255,0.12);
    color: #ffffff;
    transform: translateX(4px);
}

/* ACTIVE MENU (SOFT WHITE CARD STYLE) */
.menu-link.active {
    background: #ffffff;
    color: #3b7de7 !important;
    font-weight: 600;
    box-shadow: 0 6px 15px rgba(0,0,0,0.12);
}

/* === USER BOX === */
.user-box {
    margin-top: auto;
    text-align: center;
    background: rgba(255,255,255,0.15);
    padding: 15px;
    border-radius: 16px;
    backdrop-filter: blur(10px);
}

/* PROFILE IMAGE */
.profile-img {
    width: 60px !important;
    height: 60px !important;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255,255,255,0.7);
}

/* USER NAME */
.user-box .fw-semibold {
    font-size: 14px;
    margin-top: 6px;
    color: #fff;
}

/* ROLE */
.user-box small {
    opacity: 0.85;
}

/* BUTTON */
.user-box .btn {
    border-radius: 10px;
}

/* SCROLLBAR SOFT */
.sidebar-custom::-webkit-scrollbar {
    width: 6px;
}

.sidebar-custom::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.25);
    border-radius: 10px;
}
</style>

<!-- SIDEBAR -->
<div class="sidebar-custom text-white">

    <!-- BRAND -->
    <a href="<?= base_url('/') ?>" class="brand text-decoration-none text-white">
        <i class="bi bi-journal-bookmark-fill me-1"></i>
        BLIBIO<span class="fw-bold">TRACK</span>
    </a>

    <div class="menu-section">MENU</div>

    <!-- DASHBOARD -->
    <a href="<?= base_url('/') ?>" class="menu-link <?= activeMenu('', $current) ?>">
        <i class="bi bi-house-door me-2"></i> Dashboard
    </a>

<?php if ($role) : ?>

    <!-- MASTER DATA -->
    <?php if (in_array($role, ['admin', 'petugas'])) : ?>

        <div class="menu-section">MASTER DATA</div>

        <a href="<?= base_url('users') ?>" class="menu-link <?= activeMenu('users', $current) ?>">
            <i class="bi bi-people me-2"></i> Users
        </a>

        <a href="<?= base_url('buku') ?>" class="menu-link <?= activeMenu('buku', $current) ?>">
            <i class="bi bi-book me-2"></i> Buku
        </a>

        <a href="<?= base_url('rak') ?>" class="menu-link <?= activeMenu('rak', $current) ?>">
            <i class="bi bi-box me-2"></i> Rak
        </a>

        <a href="<?= base_url('kategori') ?>" class="menu-link <?= activeMenu('kategori', $current) ?>">
            <i class="bi bi-tags me-2"></i> Kategori
        </a>

        <a href="<?= base_url('penulis') ?>" class="menu-link <?= activeMenu('penulis', $current) ?>">
            <i class="bi bi-pencil me-2"></i> Penulis
        </a>

        <a href="<?= base_url('penerbit') ?>" class="menu-link <?= activeMenu('penerbit', $current) ?>">
            <i class="bi bi-building me-2"></i> Penerbit
        </a>

        <div class="menu-section">TRANSAKSI</div>

        <a href="<?= base_url('pengembalian') ?>" class="menu-link <?= activeMenu('pengembalian', $current) ?>">
            <i class="bi bi-arrow-return-left me-2"></i> Pengembalian
        </a>

        <a href="<?= base_url('transaksi') ?>" class="menu-link <?= activeMenu('transaksi', $current) ?>">
            <i class="bi bi-cash-coin me-2"></i> Denda
        </a>

    <?php endif; ?>

    <!-- SEMUA ROLE -->
    <?php if (in_array($role, ['admin','petugas','anggota'])) : ?>

        <div class="menu-section">TRANSAKSI UMUM</div>

        <a href="<?= base_url('peminjaman') ?>" class="menu-link <?= activeMenu('peminjaman', $current) ?>">
            <i class="bi bi-journal-bookmark me-2"></i> Peminjaman
        </a>

    <?php endif; ?>

    <!-- ADMIN ONLY -->
    <?php if ($role == 'admin') : ?>

        <div class="menu-section">SYSTEM</div>

        <a href="<?= base_url('backup') ?>" class="menu-link text-light">
            <i class="bi bi-cloud-download me-2"></i> Backup DB
        </a>

    <?php endif; ?>

    <!-- SETTING -->
    <?php if (session()->get('id')) : ?>
        <a href="<?= base_url('users/edit/' . session()->get('id')) ?>" class="menu-link mt-3 text-warning">
            <i class="bi bi-gear me-2"></i> Setting
        </a>
    <?php endif; ?>

<?php endif; ?>

    <hr class="border-light">

    <!-- USER -->
<?php if (session()->get('nama')) : ?>

    <div class="user-box">

       <?php $foto = session()->get('foto'); ?>

<?php if (!empty($foto) && file_exists(FCPATH . 'uploads/users/' . $foto)) : ?>
    <img src="<?= base_url('uploads/users/' . $foto) ?>" class="profile-img mb-2">
<?php else : ?>
    <img src="<?= base_url('assets/img/default.png') ?>" class="profile-img mb-2">
<?php endif; ?>

        <div class="fw-semibold text-white">
            <?= session()->get('nama') ?>
        </div>

        <small class="text-light">
            <?= session()->get('role') ?>
        </small>

        <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm w-100 mt-2">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>

    </div>

<?php endif; ?>

</div>