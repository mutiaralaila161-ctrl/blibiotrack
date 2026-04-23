<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<div class="card">
    <div class="card-header">
        <h4>📚 Form Peminjaman Buku</h4>
    </div>

    <div class="card-body">

        <form action="<?= base_url('peminjaman/save') ?>" method="post">

            <!-- ================= ANGGOTA & PETUGAS ================= -->
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Anggota</label>
                    <select name="id_anggota" class="form-control" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach ($anggota as $a): ?>
                            <option value="<?= $a['id_anggota'] ?>">
                                <?= $a['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Petugas</label>
                    <select name="id_petugas" class="form-control" required>
                        <option value="">-- Pilih Petugas --</option>
                        <?php foreach ($petugas as $p): ?>
                            <option value="<?= $p['id_petugas'] ?>">
                                <?= $p['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <!-- ================= TANGGAL ================= -->
            <div class="mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>

            <hr>

            <!-- ================= DAFTAR BUKU ================= -->
            <h5>📖 Pilih Buku</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($buku as $b): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="id_buku[]" value="<?= $b['id_buku'] ?>">
                        </td>

                        <td>
                            <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                                 width="50">
                        </td>

                        <td><?= $b['judul'] ?></td>

                        <td>
                            <input type="number"
                                   name="jumlah[]"
                                   value="1"
                                   min="1"
                                   class="form-control">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button class="btn btn-primary mt-2">
                💾 Simpan Peminjaman
            </button>
            <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">Kembali</a>


        </form>

    </div>
</div>

</div>

<?= $this->endSection() ?>