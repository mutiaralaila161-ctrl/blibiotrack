<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>

    <h2>Data Users</h2>

    <!-- BUTTON TAMBAH (HANYA ADMIN) -->
    <?php if (session()->get('role') == 'admin'): ?>
        <a href="<?= base_url('users/create') ?>">
            + Tambah User
        </a>
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

    </form>

    <br>

    <!-- TABLE -->
    <table border="1" cellpadding="5" cellspacing="0">

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
            <tr>

                <td><?= $no++ ?></td>
                <td><?= esc($u['nama']) ?></td>
                <td><?= esc($u['email']) ?></td>
                <td><?= esc($u['username']) ?></td>

                <!-- ROLE -->
                <td>
                    <?= $u['role'] ?>
                </td>

                <!-- STATUS -->
                <td>
                    <?php if ($u['role'] == 'admin'): ?>
                        Aktif (Admin)
                    <?php elseif (($u['status'] ?? 'aktif') == 'aktif'): ?>
                        Aktif
                    <?php else: ?>
                        Nonaktif
                    <?php endif; ?>
                </td>

                <!-- FOTO -->
                <td>
                    <?php if (!empty($u['foto'])): ?>
                        <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="40" height="40">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>

                <!-- AKSI -->
                <?php if (session()->get('role') == 'admin'): ?>
                <td>

                    <a href="<?= base_url('users/detail/'.$u['id']) ?>">Detail</a> |
                    <a href="<?= base_url('users/edit/'.$u['id']) ?>">Edit</a> |
                    <a href="<?= base_url('users/wa/'.$u['id']) ?>">WA</a>

                    <?php if ($u['role'] != 'admin'): ?>

                        <?php if (($u['status'] ?? 'aktif') == 'aktif'): ?>
                            | <a href="<?= base_url('users/nonaktifkan/'.$u['id']) ?>">Nonaktifkan</a>
                        <?php else: ?>
                            | <a href="<?= base_url('users/aktifkan/'.$u['id']) ?>">Aktifkan</a>
                        <?php endif; ?>

                        | <a href="<?= base_url('users/delete/'.$u['id']) ?>">Hapus</a>

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

    <!-- PAGINATION -->
    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>