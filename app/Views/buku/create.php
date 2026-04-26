<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow border-0">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">➕ Tambah Buku</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- ISBN -->
                    <div class="col-md-6">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control">
                    </div>

                    <!-- JUDUL -->
                    <div class="col-md-6">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-4">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>">
                                    <?= esc($k['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENULIS -->
                    <div class="col-md-4">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select" required>
                            <option value="">-- Pilih Penulis --</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>">
                                    <?= esc($p['nama_penulis']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PENERBIT -->
                    <div class="col-md-4">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select" required>
                            <option value="">-- Pilih Penerbit --</option>
                            <?php foreach ($penerbit as $pb): ?>
                                <option value="<?= $pb['id_penerbit'] ?>">
                                    <?= esc($pb['nama_penerbit']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- RAK -->
                    <div class="col-md-6">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">-- Pilih Rak --</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>">
                                    <?= esc($r['nama_rak']) ?>
                                    <?php if (!empty($r['lokasi'])): ?>
                                        - <?= esc($r['lokasi']) ?>
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- TAHUN -->
                    <div class="col-md-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control">
                    </div>

                    <!-- JUMLAH -->
                    <div class="col-md-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control">
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- COVER -->
                    <div class="col-md-6">
                        <label class="form-label">Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>