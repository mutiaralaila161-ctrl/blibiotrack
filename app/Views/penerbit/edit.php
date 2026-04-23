<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header">
            <h4 class="mb-0">✏️ Edit Penerbit</h4>
        </div>

        <div class="card-body">

            <form method="post"
                  action="<?= base_url('penerbit/update/' . $penerbit['id_penerbit']) ?>">

                <div class="row g-3">

                    <!-- NAMA PENERBIT -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Penerbit</label>
                        <input type="text"
                               name="nama_penerbit"
                               class="form-control"
                               value="<?= esc($penerbit['nama_penerbit']) ?>"
                               required>
                    </div>

                    <!-- ALAMAT -->
                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"><?= esc($penerbit['alamat']) ?></textarea>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                    <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>