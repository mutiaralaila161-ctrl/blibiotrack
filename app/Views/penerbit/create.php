<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Penerbit</h3>

<form method="post" action="<?= base_url('penerbit/store') ?>">

    Nama Penerbit:<br>
    <input type="text" name="nama_penerbit"><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('penerbit') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>