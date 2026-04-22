<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penerbit</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari penerbit..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= base_url('penerbit') ?>">Reset</a>
</form>

<br>

<a href="<?= base_url('penerbit/create') ?>">+ Tambah Penerbit</a>

<br><br>

<?php if (session()->getFlashdata('success')): ?>
    <div><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Penerbit</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($penerbit)): ?>
        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
        <?php foreach ($penerbit as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($p['nama_penerbit']) ?></td>
                <td><?= esc($p['alamat']) ?></td>
                <td>
                    <a href="<?= base_url('penerbit/edit/' . $p['id_penerbit']) ?>">Edit</a>
                    <a href="<?= base_url('penerbit/delete/' . $p['id_penerbit']) ?>"
                       onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Belum ada data</td>
        </tr>
    <?php endif; ?>

</table>

<br>

<?= $pager->links() ?>

<?= $this->endSection() ?>