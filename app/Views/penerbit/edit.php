<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Penerbit
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form method="post"
                          action="<?= base_url('penerbit/update/' . $penerbit['id_penerbit']) ?>">

                        <div class="row g-3">

                            <!-- NAMA PENERBIT -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Penerbit</label>
                                <input type="text"
                                       name="nama_penerbit"
                                       class="form-control"
                                       value="<?= esc($penerbit['nama_penerbit']) ?>"
                                       placeholder="Masukkan nama penerbit"
                                       required>
                            </div>

                            <!-- ALAMAT -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="alamat"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Masukkan alamat penerbit"><?= esc($penerbit['alamat']) ?></textarea>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Update
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