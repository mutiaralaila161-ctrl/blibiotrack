<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-building-add"></i> Tambah Penerbit
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="<?= base_url('penerbit/store') ?>" method="post">

                        <!-- NAMA PENERBIT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Penerbit</label>
                            <input type="text"
                                   name="nama_penerbit"
                                   class="form-control"
                                   placeholder="Masukkan nama penerbit"
                                   required>
                        </div>

                        <!-- ALAMAT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input type="text"
                                   name="alamat"
                                   class="form-control"
                                   placeholder="Masukkan alamat penerbit"
                                   required>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save"></i> Simpan
                            </button>

                            <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary px-4">
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