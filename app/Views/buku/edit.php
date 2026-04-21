<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Buku</h3>

<form method="post" action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" enctype="multipart/form-data">

    Judul:<br>
    <input type="text" name="judul" value="<?= esc($buku['judul']) ?>"><br><br>

    ISBN:<br>
    <input type="text" name="isbn" value="<?= esc($buku['isbn']) ?>"><br><br>

    Kategori:<br>
    <select name="id_kategori" required>
        <option value="">Pilih Kategori</option>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori'] ?>"
                <?= ($buku['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                <?= esc($k['nama_kategori']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Penulis:<br>
    <select name="id_penulis" required>
        <option value="">Pilih Penulis</option>
        <?php foreach ($penulis as $p): ?>
            <option value="<?= $p['id_penulis'] ?>"
                <?= ($buku['id_penulis'] == $p['id_penulis']) ? 'selected' : '' ?>>
                <?= esc($p['nama_penulis']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Penerbit:<br>
    <select name="id_penerbit" required>
        <option value="">Pilih Penerbit</option>
        <?php foreach ($penerbit as $p): ?>
            <option value="<?= $p['id_penerbit'] ?>"
                <?= ($buku['id_penerbit'] == $p['id_penerbit']) ? 'selected' : '' ?>>
                <?= esc($p['nama_penerbit']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Rak:<br>
    <select name="id_rak">
        <option value="">Pilih Rak</option>
        <?php foreach ($rak as $r): ?>
            <option value="<?= $r['id_rak'] ?>"
                <?= ($buku['id_rak'] ?? null) == $r['id_rak'] ? 'selected' : '' ?>>
                <?= esc($r['nama_rak']) ?> - <?= esc($r['lokasi']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Tahun:<br>
    <input type="number" name="tahun_terbit" value="<?= esc($buku['tahun_terbit']) ?>"><br><br>

    Jumlah:<br>
    <input type="number" name="jumlah" value="<?= esc($buku['jumlah']) ?>"><br><br>

    Tersedia:<br>
    <input type="number" name="tersedia" value="<?= esc($buku['tersedia']) ?>"><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi"><?= esc($buku['deskripsi']) ?></textarea><br><br>

    Cover:<br>
    <input type="file" name="cover"><br><br>

    <b>Cover Saat Ini:</b><br>

    <?php if (!empty($buku['cover'])): ?>
        <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="120">
    <?php else: ?>
        <i>Tidak ada cover</i>
    <?php endif; ?>

    <br><br>

    <button type="submit">Update</button>
    <a href="<?= base_url('buku') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>