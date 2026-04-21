<form action="/peminjaman/store" method="post">

<?= csrf_field(); ?>

<h3>Pilih Buku</h3>
<select name="id_buku" required>
    <option value="">-- Pilih Buku --</option>
    <?php foreach ($buku as $b): ?>
        <option value="<?= $b['id_buku']; ?>">
            <?= $b['judul']; ?> (stok: <?= $b['tersedia']; ?>)
        </option>
    <?php endforeach; ?>
</select>
<br><br>

<h3>Pilih Anggota</h3>
<select name="id_anggota" required>
    <option value="">-- Pilih Anggota --</option>
    <?php foreach ($anggota as $a): ?>
        <option value="<?= $a['id_anggota']; ?>">
            <?= $a['nama']; ?>
        </option>
    <?php endforeach; ?>
</select>
<br><br>

<h3>Pilih Petugas</h3>
<select name="id_petugas" required>
    <option value="">-- Pilih Petugas --</option>
    <?php foreach ($petugas as $p): ?>
        <option value="<?= $p['id_petugas']; ?>">
            <?= $p['nama']; ?>
        </option>
    <?php endforeach; ?>
</select>
<br><br>

<button type="submit">Pinjam</button>

</form>