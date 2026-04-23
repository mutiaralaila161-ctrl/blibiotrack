<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

<h2>💰 Data Denda</h2>

<table border="1" cellpadding="5">

<tr>
    <th>No</th>
    <th>ID Peminjaman</th>
    <th>Jumlah</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no = 1; foreach ($denda as $d): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['id_peminjaman'] ?></td>
    <td>Rp <?= number_format($d['jumlah_denda'],0,',','.') ?></td>
    <td><?= $d['status'] ?></td>
    <td>
        <a href="<?= base_url('denda/detail/'.$d['id_pengembalian']) ?>">
            Detail
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</div>

<?= $this->endSection() ?>