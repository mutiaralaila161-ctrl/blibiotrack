<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                📚 Form Peminjaman Buku
            </h5>
        </div>

        <div class="card-body">

            <!-- FORM -->
            <form action="<?= base_url('peminjaman/save') ?>"
                  method="post"
                  enctype="multipart/form-data">

                <div class="row g-3">

                    <!-- ANGGOTA -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Anggota</label>
                        <select name="id_anggota" class="form-select" required>
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
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Petugas</label>
                        <select name="id_petugas" class="form-select" required>
                            <option value="">-- Pilih Petugas --</option>
                            <?php if (!empty($petugas)): ?>
                                <?php foreach ($petugas as $p): ?>
                                    <option value="<?= $p['id_petugas'] ?>">
                                        <?= esc($p['nama'] ?? '-') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" required>
                        <small class="text-muted">
                            *Tanggal kembali otomatis +3 hari
                        </small>
                    </div>

                    <!-- FOTO BUKTI -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Foto Bukti Peminjaman</label>
                        <input type="file" name="foto_bukti" class="form-control">
                    </div>

                </div>

                <hr class="my-4">

                <!-- BUKU -->
                <h5 class="fw-bold mb-3">📖 Pilih Buku (Maksimal 2)</h5>

                <div class="row g-3">

                    <?php foreach ($buku as $b): ?>

                        <div class="col-6 col-md-3">

                            <div class="card buku-card border shadow-sm h-100"
                                 onclick="toggleBuku(this)"
                                 style="cursor:pointer; transition:0.2s;">

                                <input type="checkbox"
                                       name="id_buku[]"
                                       value="<?= $b['id_buku'] ?>"
                                       class="d-none">

                                <img src="<?= base_url('uploads/buku/' . ($b['cover'] ?? 'default.png')) ?>"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover;">

                                <div class="card-body text-center">

                                    <div class="fw-semibold text-truncate">
                                        <?= esc($b['judul']) ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex gap-2">

                    <button class="btn btn-primary px-4">
                        💾 Simpan Peminjaman
                    </button>

                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary px-4">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- SCRIPT SELECT BOOK -->
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
        card.classList.add("border-success");
        card.classList.add("bg-light");
    } else {
        card.classList.remove("border-success");
        card.classList.remove("bg-light");
    }
}
</script>

<?= $this->endSection() ?>