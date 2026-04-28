<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* WRAPPER */
.content > div {
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

/* TITLE */
h2 {
    font-weight: 600;
    margin-bottom: 15px;
}

/* BUTTON TAMBAH */
a[href*="create"] {
    background: #0d6efd;
    color: #fff !important;
    padding: 8px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}
a[href*="create"]:hover {
    background: #0b5ed7;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    margin-top: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* HEADER */
table tr:first-child {
    background: #0d6efd;
    color: #fff;
}

/* CELL */
table th,
table td {
    padding: 10px;
    text-align: center;
    font-size: 14px;
}

/* STRIPED */
table tr:nth-child(even) {
    background: #f8f9fa;
}

/* HOVER */
table tr:hover {
    background: #eef3ff;
}

/* AKSI */
td a {
    text-decoration: none;
    font-size: 13px;
}

/* WARNA AKSI */
td a[href*="edit"] {
    color: #198754;
}
td a[href*="delete"] {
    color: #dc3545;
}

/* EMPTY STATE */
td[colspan] {
    color: #888;
}
</style>

<div>

    <h2>
        <i class="bi bi-box-seam me-1"></i>
        Data Rak
    </h2>

    <!-- BUTTON TAMBAH -->
    <a href="<?= base_url('rak/create') ?>">
        <i class="bi bi-plus-circle me-1"></i> Tambah Rak
    </a>

    <br><br>

    <!-- TABLE -->
    <table border="1" cellpadding="5" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama Rak</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>

        <?php if (!empty($rak)): ?>

            <?php $no = 1; foreach ($rak as $r): ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><?= esc($r['nama_rak']) ?></td>
                <td><?= esc($r['lokasi']) ?></td>

                <td>

                    <a href="<?= base_url('rak/edit/'.$r['id_rak']) ?>">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    |

                    <a href="<?= base_url('rak/delete/'.$r['id_rak']) ?>"
                       onclick="return confirm('Hapus data rak ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </a>

                </td>

            </tr>
            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="4">Belum ada data rak</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>