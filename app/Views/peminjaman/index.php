<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Peminjaman</h2>

<a href="/peminjaman/create">+ Pinjam Buku</a>

<table border="1">
    <tr>
        <th>Buku</th>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($peminjaman as $p): ?>
    <tr>
        <td><?= $p['judul'] ?? '-'; ?></td>
        <td><?= $p['anggota'] ?? '-'; ?></td>
        <td><?= $p['petugas'] ?? '-'; ?></td>
        <td><?= $p['status']; ?></td>
        <td>
            <?php if ($p['status'] == 'dipinjam'): ?>
                <a href="/peminjaman/kembali/<?= $p['id_peminjaman']; ?>">Return</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>