<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">✏️ Edit Kategori</h5>
        </div>

        <div class="card-body">

            <form method="post"
                  action="<?= base_url('kategori/update/' . $kategori['id_kategori']) ?>">

                <div class="row g-3">

                    <!-- NAMA KATEGORI -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama_kategori"
                               class="form-control"
                               value="<?= esc($kategori['nama_kategori']) ?>"
                               placeholder="Masukkan nama kategori"
                               required>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary px-4">
                        💾 Update
                    </button>

                    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary px-4">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>