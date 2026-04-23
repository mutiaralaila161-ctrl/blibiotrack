<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header">
            <h4 class="mb-0">✏️ Edit Rak</h4>
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
                        Update
                    </button>

                    <a href="<?= base_url('rak') ?>" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>