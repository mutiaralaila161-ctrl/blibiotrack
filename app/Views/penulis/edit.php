<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Penulis
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form method="post"
                          action="<?= base_url('penulis/update/' . $penulis['id_penulis']) ?>">

                        <!-- NAMA PENULIS -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Penulis</label>
                            <input type="text"
                                   name="nama_penulis"
                                   class="form-control"
                                   value="<?= esc($penulis['nama_penulis']) ?>"
                                   placeholder="Masukkan nama penulis"
                                   required>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Update
                            </button>

                            <a href="<?= base_url('penulis') ?>" class="btn btn-secondary px-4">
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