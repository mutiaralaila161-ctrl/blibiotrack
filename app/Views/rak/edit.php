<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Rak
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="<?= base_url('rak/update/' . $rak['id_rak']) ?>" method="post">

                        <div class="row g-3">

                            <!-- NAMA RAK -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Rak</label>
                                <input type="text"
                                       name="nama_rak"
                                       class="form-control"
                                       value="<?= esc($rak['nama_rak']) ?>"
                                       required>
                            </div>

                            <!-- LOKASI -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Lokasi</label>
                                <input type="text"
                                       name="lokasi"
                                       class="form-control"
                                       value="<?= esc($rak['lokasi']) ?>">
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4 d-flex gap-2">

                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Update
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