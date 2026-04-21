<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="max-width:800px; margin:auto;">

    <h3>Detail Buku</h3>

    <a href="<?= base_url('buku') ?>">← Kembali</a>

    <br><br>

    <?php if (!empty($buku)): ?>

        <div style="display:flex; gap:20px;">

            <!-- ================= COVER ================= -->
            <div>
                <?php if (!empty($buku['cover'])): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                         width="180"
                         style="border-radius:10px;">
                <?php else: ?>
                    <div style="width:180px;height:240px;background:#ddd;
                                display:flex;align-items:center;justify-content:center;">
                        No Cover
                    </div>
                <?php endif; ?>
            </div>

            <!-- ================= INFO ================= -->
            <div>

                <table border="0" cellpadding="6">

                    <tr>
                        <td><b>ISBN</b></td>
                        <td>: <?= esc($buku['isbn'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Judul</b></td>
                        <td>: <?= esc($buku['judul'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Kategori</b></td>
                        <td>: <?= esc($buku['nama_kategori'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Penulis</b></td>
                        <td>: <?= esc($buku['nama_penulis'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Penerbit</b></td>
                        <td>: <?= esc($buku['nama_penerbit'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Rak</b></td>
                        <td>: <?= esc($buku['nama_rak'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Tahun Terbit</b></td>
                        <td>: <?= esc($buku['tahun_terbit'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <td><b>Jumlah</b></td>
                        <td>: <?= esc($buku['jumlah'] ?? '-') ?></td>
                    </tr>

                    <!-- ================= STOK ================= -->
                    <tr>
                        <td><b>Tersedia</b></td>
                        <td>
                            :
                            <?php if (($buku['tersedia'] ?? 0) > 0): ?>
                                <span style="color:green;">
                                    Tersedia (<?= esc($buku['tersedia']) ?>)
                                </span>
                            <?php else: ?>
                                <span style="color:red;">Habis</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Status</b></td>
                        <td>
                            :
                            <?php if (($buku['tersedia'] ?? 0) > 0): ?>
                                <span style="color:green;font-weight:bold;">Bisa Dipinjam</span>
                            <?php else: ?>
                                <span style="color:red;font-weight:bold;">Tidak Tersedia</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>

            </div>
        </div>

        <br>

        <!-- ================= DESKRIPSI ================= -->
        <div>
            <h4>Deskripsi</h4>
            <p>
                <?= esc($buku['deskripsi'] ?? 'Tidak ada deskripsi') ?>
            </p>
        </div>

        <br>

        <!-- ================= ACTION ================= -->
        <a href="<?= base_url('buku/edit/' . $buku['id_buku']) ?>">Edit</a>
        <a href="<?= base_url('buku/wa/' . $buku['id_buku']) ?>" target="_blank">Kirim WA</a>

    <?php else: ?>
        <p>Data tidak ditemukan</p>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>