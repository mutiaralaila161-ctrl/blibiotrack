<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
// FIX ID AMAN (ANTI ERROR)
$id = $user['id'] ?? $user['id_user'] ?? null;
?>

<style>
/* CARD WRAPPER */
.detail-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* TITLE */
h3 {
    font-weight: 600;
    margin-bottom: 20px;
    color: #343a40;
}

/* TABLE MODERN */
.detail-table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
}

/* ROW */
.detail-table tr {
    border-bottom: 1px solid #f1f1f1;
    transition: 0.2s;
}

.detail-table tr:hover {
    background: #f8faff;
}

/* LABEL */
.detail-table td:first-child {
    width: 200px;
    font-weight: 600;
    background: #f8f9fa;
    color: #495057;
}

/* CELL */
.detail-table td {
    padding: 12px 14px;
    font-size: 14px;
}

/* FOTO */
.detail-table img {
    border-radius: 14px;
    border: 2px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* BUTTON */
.btn-soft {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 9px 14px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s;
}

/* BACK */
.btn-back {
    background: #6c757d;
    color: #fff !important;
}
.btn-back:hover {
    background: #5c636a;
}

/* EDIT */
.btn-edit {
    background: #4f8dfd;
    color: #fff !important;
}
.btn-edit:hover {
    background: #3b7de7;
}

/* BUTTON GROUP */
.button-group {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}
</style>

<div class="container py-4" style="max-width: 900px;">

    <div class="detail-card">

        <h3>
            <i class="bi bi-person-lines-fill me-1"></i>
            Detail User
        </h3>

        <table class="detail-table">

            <tr>
                <td>Nama</td>
                <td><?= esc($user['nama']) ?></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><?= esc($user['email']) ?></td>
            </tr>

            <tr>
                <td>Username</td>
                <td><?= esc($user['username']) ?></td>
            </tr>

            <tr>
                <td>Password</td>
                <td>***</td>
            </tr>

            <tr>
                <td>Role</td>
                <td><?= ucfirst($user['role']) ?></td>
            </tr>

            <tr>
                <td>Foto</td>
                <td>
                    <?php if (!empty($user['foto'])): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                             width="90"
                             height="90"
                             style="object-fit: cover;">
                    <?php else: ?>
                        <span class="text-muted">Tidak ada foto</span>
                    <?php endif; ?>
                </td>
            </tr>

        </table>

        <!-- BUTTON -->
        <div class="button-group">

            <a href="<?= base_url('users') ?>" class="btn-soft btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('users/edit/' . $id) ?>" class="btn-soft btn-edit">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>