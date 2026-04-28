<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-cash-coin"></i> Form Transaksi Denda
                    </h5>
                </div>

                <div class="card-body p-4">

                    <?php if (!isset($peminjaman)): ?>
                        <div class="alert alert-danger">
                            Data peminjaman tidak ditemukan
                        </div>
                    <?php else: ?>

                    <!-- INFO -->
                    <form action="<?= base_url('transaksi/save') ?>" method="post">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman'] ?>">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">ID Peminjaman</label>
                            <input type="text" class="form-control"
                                   value="<?= $peminjaman['id_peminjaman'] ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Anggota</label>
                            <input type="text" class="form-control"
                                   value="<?= esc($peminjaman['nama_anggota'] ?? '-') ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Denda (Rp)</label>
                            <input type="number" name="jumlah"
                                   class="form-control"
                                   placeholder="Masukkan jumlah denda"
                                   required>
                        </div>

                        <div class="d-flex gap-2 mt-4">

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>

                            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                        </div>

                    </form>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>