<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
            <h5 class="mb-0 fw-semibold">
                📚 Form Peminjaman Buku
            </h5>
        </div>

        <div class="card-body p-4">

            <form action="<?= base_url('peminjaman/save') ?>" 
                  method="post" 
                  enctype="multipart/form-data">

                <!-- ANGGOTA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Anggota</label>

                    <select name="id_anggota" class="form-select form-select-lg shadow-sm rounded-3" required>
                        <option value="">-- Pilih Anggota --</option>

                        <?php if (!empty($anggota)): ?>
                            <?php foreach ($anggota as $a): ?>
                                <option value="<?= $a['id_anggota'] ?>">
                                    <?= esc($a['nama'] ?? '-') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- PETUGAS -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Petugas</label>

                    <select name="id_petugas" class="form-select form-select-lg shadow-sm rounded-3" required>
                        <option value="">-- Pilih Petugas --</option>

                        <?php if (!empty($petugas)): ?>
                            <?php foreach ($petugas as $pt): ?>
                                <option value="<?= $pt['id_petugas'] ?>">
                                    <?= esc($pt['nama'] ?? '-') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <!-- TANGGAL -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Pinjam</label>

                    <input type="date"
                           name="tanggal_pinjam"
                           class="form-control form-control-lg shadow-sm rounded-3"
                           required>

                    <small class="text-muted">
                        *Tanggal kembali otomatis +3 hari
                    </small>
                </div>

                <!-- FOTO BUKTI -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto Bukti Peminjaman</label>

                    <input type="file"
                           name="foto_bukti"
                           class="form-control form-control-lg shadow-sm rounded-3">
                </div>

                <hr>

                <!-- BUKU -->
                <h5 class="fw-bold mb-3">📖 Pilih Buku (Maksimal 2)</h5>

                <div class="row g-3">

                    <?php if (!empty($buku)): ?>
                        <?php foreach ($buku as $b): ?>

                            <div class="col-6 col-md-3">

                                <div class="card buku-card h-100 shadow-sm border-0 rounded-4"
                                     onclick="toggleBuku(this)"
                                     style="cursor:pointer; transition:0.2s;">

                                    <input type="checkbox"
                                           name="id_buku[]"
                                           value="<?= $b['id_buku'] ?>"
                                           style="display:none;">

                                    <img src="<?= base_url('uploads/buku/' . ($b['cover'] ?? 'default.png')) ?>"
                                         class="card-img-top rounded-top-4"
                                         style="height:180px; object-fit:cover;">

                                    <div class="card-body text-center">
                                        <small class="fw-semibold text-truncate d-block">
                                            <?= esc($b['judul'] ?? '-') ?>
                                        </small>
                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-primary px-4 shadow-sm">
                        💾 Simpan Peminjaman
                    </button>

                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-secondary px-4">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
function toggleBuku(card) {
    let checkbox = card.querySelector('input[type="checkbox"]');
    let checked = document.querySelectorAll('input[name="id_buku[]"]:checked');

    if (!checkbox.checked && checked.length >= 2) {
        alert('Maksimal hanya boleh memilih 2 buku!');
        return;
    }

    checkbox.checked = !checkbox.checked;

    if (checkbox.checked) {
        card.style.border = "2px solid #198754";
        card.style.background = "#e9fbe9";
    } else {
        card.style.border = "none";
        card.style.background = "white";
    }
}
</script>

<?= $this->endSection() ?>