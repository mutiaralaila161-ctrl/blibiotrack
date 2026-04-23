<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="card">
    <div class="card-header">
        <h4>Tambah Penerbit</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('penerbit/store') ?>" method="post">

            <div class="mb-3">
                <label>Nama Penerbit</label>
                <input type="text" name="nama_penerbit" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">Kembali</a>


        </form>

    </div>
</div>

</div>

<?= $this->endSection() ?>