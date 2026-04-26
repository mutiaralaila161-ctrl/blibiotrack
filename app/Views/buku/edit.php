<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">✏️ Edit Buku</h4>
        <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="post"
                  action="<?= base_url('buku/update/' . $buku['id_buku']) ?>"
                  enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- JUDUL -->
                    <div class="col-md-6">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control"
                               value="<?= esc($buku['judul']) ?>" required>
                    </div>

                    <!-- ISBN -->
                    <div class="col-md-6">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control"
                               value="<?= esc($buku['isbn']) ?>">
                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>"
                                    <?= ($buku['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENULIS -->
                    <div class="col-md-4">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select" required>
                            <option value="">Pilih Penulis</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>"
                                    <?= ($buku['id_penulis'] == $p['id_penulis']) ? 'selected' : '' ?>>
                                    <?= esc($p['nama_penulis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENERBIT -->
                    <div class="col-md-4">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select" required>
                            <option value="">Pilih Penerbit</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>"
                                    <?= ($buku['id_penerbit'] == $p['id_penerbit']) ? 'selected' : '' ?>>
                                    <?= esc($p['nama_penerbit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- RAK -->
                    <div class="col-md-6">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">Pilih Rak</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>"
                                    <?= ($buku['id_rak'] ?? null) == $r['id_rak'] ? 'selected' : '' ?>>
                                    <?= esc($r['nama_rak']) ?> - <?= esc($r['lokasi']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- TAHUN -->
                    <div class="col-md-2">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun_terbit" class="form-control"
                               value="<?= esc($buku['tahun_terbit']) ?>">
                    </div>

                    <!-- JUMLAH -->
                    <div class="col-md-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control"
                               value="<?= esc($buku['jumlah']) ?>">
                    </div>

                    <!-- TERSEDIA -->
                    <div class="col-md-2">
                        <label class="form-label">Tersedia</label>
                        <input type="number" name="tersedia" class="form-control"
                               value="<?= esc($buku['tersedia']) ?>">
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= esc($buku['deskripsi']) ?></textarea>
                    </div>

                    <!-- COVER -->
                    <div class="col-md-6">
                        <label class="form-label">Cover Baru</label>
                        <input type="file" name="cover" class="form-control">

                        <div class="mt-3">
                            <small class="text-muted">Cover saat ini</small><br>

                            <?php if (!empty($buku['cover'])): ?>
                                <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                                     class="img-thumbnail mt-2"
                                     width="120">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada cover</span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Update
                    </button>

                    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>