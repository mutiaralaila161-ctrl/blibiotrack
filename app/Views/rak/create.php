<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="card shadow">
    <div class="card-header">
        <h4>📦 Tambah Rak</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('rak/store') ?>" method="post">

            <!-- NAMA RAK -->
            <div class="mb-3">
                <label>Nama Rak</label>
                <input type="text" name="nama_rak" class="form-control" required>
            </div>

            <!-- LOKASI -->
            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lantai 1 - A1">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('rak') ?>" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

</div>

<?= $this->endSection() ?>