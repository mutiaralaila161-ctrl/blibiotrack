<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-box-seam"></i> Tambah Rak
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="<?= base_url('rak/store') ?>" method="post">

                        <!-- NAMA RAK -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Rak</label>
                            <input type="text"
                                   name="nama_rak"
                                   class="form-control"
                                   placeholder="Contoh: Rak Novel, Rak Fiksi"
                                   required>
                        </div>

                        <!-- LOKASI -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lokasi</label>
                            <input type="text"
                                   name="lokasi"
                                   class="form-control"
                                   placeholder="Contoh: Lantai 1 - A1">
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save"></i> Simpan
                            </button>

                            <a href="<?= base_url('rak') ?>" class="btn btn-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>