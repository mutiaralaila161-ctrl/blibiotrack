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
    background: #4f8dfd;
    color: #fff !important;
    padding: 8px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
}
a[href*="create"]:hover {
    background: #3b7de7;
}

/* FORM */
form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}

form input,
form select {
    padding: 8px 10px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
}

form button {
    background: #198754;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
}

form button:hover {
    background: #157347;
}

/* RESET */
form a[href$="users"] {
    background: #6c757d;
    color: #fff !important;
    padding: 8px 12px;
    border-radius: 10px;
    text-decoration:none;
}

/* PRINT */
form a[href*="print"] {
    background: #ffc107;
    color: #000 !important;
    padding: 8px 12px;
    border-radius: 10px;
    text-decoration:none;
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

table th {
    background: #4f8dfd;
    color: #fff;
    padding: 12px;
    font-weight: 500;
}

table td {
    padding: 12px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #f1f1f1;
}

table tr:nth-child(even) {
    background: #f8f9fa;
}

table tr:hover {
    background: #eef3ff;
}

/* FOTO */
table img {
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
}

/* BUTTON ACTION MODERN */
.btn-action {
    border: none;
    padding: 6px 8px;
    border-radius: 8px;
    font-size: 13px;
    margin: 2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
}

.btn-action i {
    font-size: 14px;
}

.btn-detail { background: #0d6efd; color: #fff; }
.btn-edit { background: #198754; color: #fff; }
.btn-wa { background: #0dcaf0; color: #fff; }
.btn-danger { background: #dc3545; color: #fff; }
.btn-warning { background: #fd7e14; color: #fff; }
.btn-success { background: #20c997; color: #fff; }

.btn-action:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

/* PAGINATION */
.pagination {
    justify-content: center;
}
</style>

<div>

    <h2>Data Users</h2>

    <!-- BUTTON TAMBAH -->
    <?php if (session()->get('role') == 'admin'): ?>
        <a href="<?= base_url('users/create') ?>">+ Tambah User</a>
    <?php endif; ?>

    <br><br>

    <!-- SEARCH -->
    <form method="get" action="<?= base_url('users') ?>">

        <input type="text"
               name="keyword"
               placeholder="Cari nama..."
               value="<?= esc($_GET['keyword'] ?? '') ?>">

        <select name="role">
            <option value="">Semua Role</option>
            <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas</option>
            <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
        </select>

        <button type="submit">Cari</button>
        <a href="<?= base_url('users') ?>">Reset</a>
        <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank">Print</a>

    </form>

    <br>

    <!-- TABLE -->
    <table>

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th>Foto</th>

            <?php if (session()->get('role') == 'admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php if (!empty($users)): ?>

            <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>

            <?php foreach ($users as $u): ?>

                <?php $id = $u['id'] ?? $u['id_user'] ?? null; ?>

                <tr>

                    <td><?= $no++ ?></td>
                    <td><?= esc($u['nama']) ?></td>
                    <td><?= esc($u['email']) ?></td>
                    <td><?= esc($u['username']) ?></td>
                    <td><?= esc($u['role']) ?></td>

                    <td>
                        <?php if ($u['role'] == 'admin'): ?>
                            Aktif (Admin)
                        <?php elseif (($u['status'] ?? 'aktif') == 'aktif'): ?>
                            Aktif
                        <?php else: ?>
                            Nonaktif
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (!empty($u['foto'])): ?>
                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="40" height="40">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <?php if (session()->get('role') == 'admin'): ?>
                    <td>

                        <!-- DETAIL -->
                        <a href="<?= base_url('users/detail/'.$id) ?>" class="btn-action btn-detail">
                            <i class="bi bi-eye"></i>
                        </a>

                        <!-- EDIT -->
                        <a href="<?= base_url('users/edit/'.$id) ?>" class="btn-action btn-edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <!-- WA -->
                        <a href="<?= base_url('users/wa/'.$id) ?>" class="btn-action btn-wa">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <?php if ($u['role'] != 'admin'): ?>

                            <?php if (($u['status'] ?? 'aktif') == 'aktif'): ?>
                                <a href="<?= base_url('users/nonaktifkan/'.$id) ?>" class="btn-action btn-warning">
                                    <i class="bi bi-pause"></i>
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('users/aktifkan/'.$id) ?>" class="btn-action btn-success">
                                    <i class="bi bi-check"></i>
                                </a>
                            <?php endif; ?>

                            <a href="<?= base_url('users/delete/'.$id) ?>"
                               class="btn-action btn-danger"
                               onclick="return confirm('Yakin hapus user ini?')">
                                <i class="bi bi-trash"></i>
                            </a>

                        <?php endif; ?>

                    </td>
                    <?php endif; ?>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="8">Belum ada data user</td>
            </tr>
        <?php endif; ?>

    </table>

    <br>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>