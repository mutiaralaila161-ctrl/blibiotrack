<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <!-- HEADER -->
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-badge"></i> Detail User
                    </h5>
                </div>

                <div class="card-body text-center">

                    <!-- FOTO -->
                    <div class="mb-3">
                        <?php if (!empty($user['foto'])): ?>
                            <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                 class="rounded-circle border shadow"
                                 width="120"
                                 height="120"
                                 style="object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                 style="width:120px;height:120px;">
                                <i class="bi bi-person fs-1"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <h5 class="fw-bold mb-1"><?= esc($user['nama']) ?></h5>
                    <p class="text-muted mb-3"><?= esc($user['email']) ?></p>

                    <!-- ROLE BADGE -->
                    <span class="badge bg-primary mb-3">
                        <?= ucfirst($user['role']) ?>
                    </span>

                    <!-- DETAIL INFO -->
                    <div class="list-group text-start mt-3">

                        <div class="list-group-item d-flex justify-content-between">
                            <span>Username</span>
                            <strong><?= esc($user['username']) ?></strong>
                        </div>

                        <div class="list-group-item d-flex justify-content-between">
                            <span>Password</span>
                            <span class="text-muted">••••••••</span>
                        </div>

                        <div class="list-group-item d-flex justify-content-between">
                            <span>Role</span>
                            <span><?= ucfirst($user['role']) ?></span>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="mt-4 d-flex justify-content-between">

                        <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <?php if (session()->get('role') == 'admin') : ?>
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>