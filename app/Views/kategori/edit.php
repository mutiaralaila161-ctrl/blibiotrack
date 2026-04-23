<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header">
            <h4 class="mb-0">✏️ Edit Kategori</h4>
        </div>

        <div class="card-body">

            <form method="post"
                  action="<?= base_url('kategori/update/' . $kategori['id_kategori']) ?>">

                <div class="row g-3">

                    <!-- NAMA KATEGORI -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text"
                               name="nama_kategori"
                               class="form-control"
                               value="<?= esc($kategori['nama_kategori']) ?>"
                               required>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>