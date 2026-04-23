<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="card">
    <div class="card-header">
        <h4>Tambah Kategori</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('kategori/store') ?>" method="post">

            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>


        </form>

    </div>
</div>

</div>

<?= $this->endSection() ?>