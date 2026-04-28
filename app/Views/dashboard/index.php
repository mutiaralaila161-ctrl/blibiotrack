<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.dashboard-header {
    background: linear-gradient(135deg, #0d6efd, #4f8dfd);
    color: white;
    padding: 25px;
    border-radius: 16px;
    margin-bottom: 25px;
    box-shadow: 0 10px 30px rgba(13,110,253,0.2);
}

.card-custom {
    border-radius: 16px;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.stat-card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
}

.icon-box {
    width: 55px;
    height: 55px;
    border-radius: 14px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    color:white;
}

.bg-book { background: #6ea8fe; }
.bg-loan { background: #ff9ff3; }
.bg-user { background: #63e6be; }
</style>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="dashboard-header">
        <h3><i class="bi bi-speedometer2"></i> Dashboard</h3>
        <p>Selamat datang, <b><?= $nama ?></b> (<?= $role ?>)</p>
    </div>

    <!-- STAT -->
    <div class="row">

        <div class="col-md-4">
            <div class="card stat-card text-center p-3">
                <div class="icon-box bg-book"><i class="bi bi-book"></i></div>
                <h6>Total Buku</h6>
                <h3><?= $totalBuku ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card text-center p-3">
                <div class="icon-box bg-loan"><i class="bi bi-journal"></i></div>
                <h6>Peminjaman</h6>
                <h3><?= $totalPeminjaman ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card text-center p-3">
                <div class="icon-box bg-user"><i class="bi bi-people"></i></div>
                <h6>User</h6>
                <h3><?= $totalUser ?></h3>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-4">

        <div class="col-md-8">
            <div class="card card-custom p-3">
                <h5>Grafik Peminjaman</h5>
                <canvas id="chartPeminjaman"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-3">
                <h5>Info Sistem</h5>
                <p>Total Buku: <?= $totalBuku ?></p>
                <p>Total User: <?= $totalUser ?></p>
                <p>Total Peminjaman: <?= $totalPeminjaman ?></p>
            </div>
        </div>

    </div>

</div>
<!-- ROW TAMBAHAN -->
<div class="row mt-4">

    <!-- AKTIVITAS TERBARU -->
    <div class="col-md-6">
        <div class="card card-custom p-3">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-clock-history"></i> Aktivitas Terbaru
            </h6>

            <div class="mb-2">📖 Peminjaman baru dilakukan</div>
            <div class="mb-2">📚 Buku ditambahkan</div>
            <div class="mb-2">👤 User baru terdaftar</div>
            <div class="mb-2">🔄 Pengembalian selesai</div>
        </div>
    </div>

    <!-- PROGRESS -->
    <div class="col-md-6">
        <div class="card card-custom p-3">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-bar-chart"></i> Statistik Sistem
            </h6>

            <p class="mb-1">Peminjaman</p>
            <div class="progress mb-3">
                <div class="progress-bar bg-primary" style="width: 70%"></div>
            </div>

            <p class="mb-1">Pengembalian</p>
            <div class="progress mb-3">
                <div class="progress-bar bg-success" style="width: 50%"></div>
            </div>

            <p class="mb-1">User Aktif</p>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width: 80%"></div>
            </div>
        </div>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartPeminjaman');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= $chartBulan ?>,
        datasets: [{
            label: 'Peminjaman',
            data: <?= $chartTotal ?>,
            borderWidth: 2,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true
    }
});
</script>

<?= $this->endSection() ?>