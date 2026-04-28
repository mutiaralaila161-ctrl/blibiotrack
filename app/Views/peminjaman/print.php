<!DOCTYPE html>
<html>

<head>
    <title>Print Data Peminjaman Buku</title>

    <!-- Bootstrap 5 (optional untuk print lebih rapi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-size: 12px;
        }

        h3 {
            margin-bottom: 20px;
            font-weight: 700;
        }

        table {
            font-size: 11px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }

        .table thead {
            background-color: #0d6efd !important;
            color: white;
        }
    </style>
</head>

<body onload="window.print()">

<div class="container mt-3">

    <!-- HEADER -->
    <h4 class="fw-bold mb-3">
        📚 Data Peminjaman Buku
    </h4>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table table-bordered table-sm align-middle">

            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Anggota</th>
                    <th>Petugas</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>

            <tbody>

            <?php if (!empty($peminjaman)): ?>

                <?php $no = 1; foreach ($peminjaman as $p): ?>

                <tr>

                    <td class="text-center"><?= $no++ ?></td>

                    <td><?= esc($p['nama_anggota'] ?? '-') ?></td>

                    <td><?= esc($p['nama_petugas'] ?? '-') ?></td>

                    <td>
                        <?php if (!empty($p['detail'])): ?>
                            <?php foreach ($p['detail'] as $d): ?>
                                • <?= esc($d['judul'] ?? '-') ?><br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td><?= esc($p['tanggal_pinjam'] ?? '-') ?></td>

                    <td class="text-nowrap">
                        <?= esc($p['tanggal_kembali'] ?? '-') ?>
                    </td>

                    <td><?= esc($p['tanggal_dikembalikan'] ?? '-') ?></td>

                    <!-- STATUS -->
                    <td class="text-center fw-semibold">
                        <?php
                        if (($p['status_label'] ?? '') == 'Kembali') {
                            echo '<span style="color:green;">Kembali</span>';
                        } elseif (($p['status_label'] ?? '') == 'Terlambat') {
                            echo '<span style="color:red;">Terlambat</span>';
                        } else {
                            echo '<span style="color:orange;">Dipinjam</span>';
                        }
                        ?>
                    </td>

                    <!-- DENDA -->
                    <td class="text-end">
                        <?php if (!empty($p['denda']) && $p['denda'] > 0): ?>
                            Rp <?= number_format($p['denda'],0,',','.') ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data peminjaman
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>