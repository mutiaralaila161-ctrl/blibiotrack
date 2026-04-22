<form action="/peminjaman/store" method="post">
<?= csrf_field(); ?>

<h3>Buku (bisa lebih dari 1)</h3>

<?php foreach ($buku as $b): ?>
    <label>
        <input type="checkbox" name="id_buku[]" value="<?= $b['id_buku']; ?>">
        <?= $b['judul']; ?> (<?= $b['tersedia']; ?>)
    </label><br>
<?php endforeach; ?>

<h3>Anggota</h3>
<select name="id_anggota" required>
    <option value="">-- pilih --</option>
    <?php foreach ($anggota as $a): ?>
        <option value="<?= $a['id_anggota']; ?>">
            <?= $a['nama']; ?>
        </option>
    <?php endforeach; ?>
</select>

<h3>Petugas</h3>
<select name="id_petugas" required>
    <option value="">-- pilih --</option>
    <?php foreach ($petugas as $p): ?>
        <option value="<?= $p['id_petugas']; ?>">
            <?= $p['nama']; ?>
        </option>
    <?php endforeach; ?>
</select>

<br><br>
<button type="submit">Pinjam</button>
    <a href="<?= base_url('buku') ?>">Kembali</a>


</form>