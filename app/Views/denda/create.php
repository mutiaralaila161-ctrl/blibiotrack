<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="card shadow">
<div class="card-body">

<h4>💰 Input Denda</h4>

<form action="<?= base_url('denda/save') ?>" method="post">

<input type="hidden" name="id_pengembalian" value="<?= $id_pengembalian ?>">

<div class="mb-3">
    <label>Jumlah Denda</label>
    <input type="number" name="jumlah_denda" class="form-control" required>
</div>

<button class="btn btn-success">Simpan</button>
<a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

</div>

<?= $this->endSection() ?>