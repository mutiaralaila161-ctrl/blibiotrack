<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white rounded-top-4 py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-box-seam me-2"></i> Tambah Rak
            </h5>
        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            <form action="<?= base_url('rak/store') ?>" method="post">

                <!-- NAMA RAK -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-tag me-1"></i> Nama Rak
                    </label>
                    <input type="text" name="nama_rak" class="form-control form-control-lg shadow-sm rounded-3" placeholder="Masukkan nama rak" required>
                </div>

                <!-- LOKASI -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-geo-alt me-1"></i> Lokasi
                    </label>
                    <input type="text" name="lokasi" class="form-control form-control-lg shadow-sm rounded-3" placeholder="Contoh: Lantai 1 - A1">
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">
                    <button class="btn btn-primary px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>

                    <a href="<?= base_url('rak') ?>" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>