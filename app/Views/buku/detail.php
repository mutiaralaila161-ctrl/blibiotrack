<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📘 <?= esc($buku['judul'] ?? 'Detail Buku') ?></h5>
            <a href="<?= base_url('buku') ?>" class="btn btn-light btn-sm">
                ← Kembali
            </a>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- COVER -->
                <div class="col-md-4 text-center mb-3">
                    <img src="<?= base_url('uploads/buku/' . ($buku['cover'] ?? 'default.png')) ?>"
                         class="img-fluid rounded shadow-sm"
                         style="max-height:300px; object-fit:cover;">
                </div>

                <!-- DETAIL -->
                <div class="col-md-8">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted">ISBN</small>
                                <div class="fw-semibold"><?= esc($buku['isbn'] ?? '-') ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted">Kategori</small>
                                <div class="fw-semibold"><?= esc($buku['nama_kategori'] ?? '-') ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted">Penulis</small>
                                <div class="fw-semibold"><?= esc($buku['nama_penulis'] ?? '-') ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light h-100">
                                <small class="text-muted">Penerbit</small>
                                <div class="fw-semibold"><?= esc($buku['nama_penerbit'] ?? '-') ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <small class="text-muted">Tahun</small>
                                <div class="fw-bold"><?= esc($buku['tahun_terbit'] ?? '-') ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-success text-white text-center">
                                <small>Stok</small>
                                <div class="fw-bold fs-5"><?= esc($buku['jumlah'] ?? 0) ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-info text-white text-center">
                                <small>Tersedia</small>
                                <div class="fw-bold fs-5"><?= esc($buku['tersedia'] ?? 0) ?></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="p-3 border rounded bg-light">
                                <small class="text-muted">Rak</small>
                                <div class="fw-semibold"><?= esc($buku['nama_rak'] ?? '-') ?></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="mt-4">
                <div class="p-3 border rounded bg-light">
                    <small class="text-muted">Deskripsi</small>
                    <p class="mb-0 mt-2"><?= esc($buku['deskripsi'] ?? '-') ?></p>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>