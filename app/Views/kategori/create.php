<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Tambah Kategori</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('kategori/store') ?>" method="post">

                <div class="row g-3">

                    <!-- NAMA KATEGORI -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama_kategori"
                               class="form-control"
                               placeholder="Contoh: Novel, Komik, Pelajaran"
                               required>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-primary px-4">
                        💾 Simpan
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