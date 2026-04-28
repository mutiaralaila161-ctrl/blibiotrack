<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* WRAPPER CARD */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* HEADER */
.card-header {
    background: linear-gradient(135deg, #0d6efd, #4f8dfd);
    color: white;
    padding: 18px 20px;
    font-weight: 600;
}

/* BODY */
.card-body {
    padding: 25px;
}

/* INPUT */
.form-control {
    border-radius: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    transition: 0.2s;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.15rem rgba(13,110,253,0.15);
}

/* LABEL */
.form-label {
    font-weight: 500;
    margin-bottom: 5px;
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

/* SPACING */
.mt-4 {
    margin-top: 20px !important;
}
</style>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-1"></i>
                Edit Rak
            </h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('rak/update/' . $rak['id_rak']) ?>" method="post">

                <div class="row g-3">

                    <!-- NAMA RAK -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Rak</label>
                        <input type="text"
                               name="nama_rak"
                               class="form-control"
                               value="<?= esc($rak['nama_rak']) ?>"
                               required>
                    </div>

                    <!-- LOKASI -->
                    <div class="col-md-6">
                        <label class="form-label">Lokasi</label>
                        <input type="text"
                               name="lokasi"
                               class="form-control"
                               value="<?= esc($rak['lokasi']) ?>">
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update
                    </button>

                    <a href="<?= base_url('rak') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>