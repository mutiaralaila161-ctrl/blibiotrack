<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-success text-white py-3 rounded-top-4">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-building-add me-2"></i> Tambah Penerbit
            </h5>
        </div>

        <div class="card-body p-4">

            <form action="<?= base_url('penerbit/store') ?>" method="post">

                <!-- NAMA PENERBIT -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-building me-1"></i> Nama Penerbit
                    </label>

                    <input type="text"
                           name="nama_penerbit"
                           class="form-control form-control-lg shadow-sm rounded-3"
                           placeholder="Masukkan nama penerbit"
                           required>
                </div>

                <!-- ALAMAT -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-geo-alt me-1"></i> Alamat
                    </label>

                    <input type="text"
                           name="alamat"
                           class="form-control form-control-lg shadow-sm rounded-3"
                           placeholder="Masukkan alamat penerbit"
                           required>
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">

                    <button class="btn btn-success px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>

                    <a href="<?= base_url('penerbit') ?>" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>