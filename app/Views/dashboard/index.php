<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.dashboard-header {
    background: linear-gradient(135deg, #0d6efd, #6ea8fe);
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.stat-card {
    border: none;
    border-radius: 15px;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.icon-box {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin: 0 auto 10px;
}

.bg-book { background: #0d6efd; }
.bg-loan { background: #ffc107; }
.bg-user { background: #198754; }

.quick-btn {
    border-radius: 12px;
    padding: 10px 15px;
    font-weight: 500;
}
</style>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="dashboard-header">

        <h3 class="fw-bold mb-1">📊 Dashboard BLIBIOTRACK</h3>

        <p class="mb-0">
            Selamat datang, <b><?= $nama ?></b> 👋
            (<?= ucfirst($role) ?>)
        </p>

    </div>

    <!-- QUICK MENU -->
    <div class="mb-4">

        <?php if ($role == 'admin'): ?>

            <a href="<?= base_url('users') ?>" class="btn btn-primary quick-btn me-2">
                👥 Kelola User
            </a>

            <a href="<?= base_url('buku') ?>" class="btn btn-success quick-btn">
                📚 Kelola Buku
            </a>

        <?php elseif ($role == 'petugas'): ?>

            <a href="<?= base_url('peminjaman') ?>" class="btn btn-primary quick-btn me-2">
                📖 Peminjaman
            </a>

            <a href="<?= base_url('pengembalian') ?>" class="btn btn-warning quick-btn">
                🔄 Pengembalian
            </a>

        <?php elseif ($role == 'anggota'): ?>

            <a href="<?= base_url('peminjaman') ?>" class="btn btn-info quick-btn">
                📚 Pinjam Buku
            </a>

        <?php endif; ?>

    </div>

    <!-- STAT CARDS -->
    <div class="row g-4">

        <!-- BUKU -->
        <div class="col-md-4">
            <div class="card stat-card text-center p-3">

                <div class="icon-box bg-book">
                    📚
                </div>

                <h6 class="text-muted">Total Buku</h6>
                <h3 class="fw-bold"><?= $totalBuku ?></h3>

            </div>
        </div>

        <!-- PEMINJAMAN -->
        <div class="col-md-4">
            <div class="card stat-card text-center p-3">

                <div class="icon-box bg-loan">
                    📖
                </div>

                <h6 class="text-muted">Peminjaman</h6>
                <h3 class="fw-bold"><?= $totalPeminjaman ?></h3>

            </div>
        </div>

        <!-- USER -->
        <div class="col-md-4">
            <div class="card stat-card text-center p-3">

                <div class="icon-box bg-user">
                    👤
                </div>

                <h6 class="text-muted">User</h6>
                <h3 class="fw-bold"><?= $totalUser ?></h3>

            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>