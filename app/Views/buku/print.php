<!DOCTYPE html>
<html>

<head>
    <title>Print Data Buku</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
        body {
            background: #fff;
        }

        .print-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="container mt-4">

    <!-- HEADER -->
    <div class="print-title">
        <h3 class="fw-bold">📚 DATA BUKU</h3>
        <p class="text-muted">Laporan Perpustakaan</p>
        <hr>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle mb-0">

                <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Tahun</th>
                    <th>Jumlah</th>
                    <th>Tersedia</th>
                </tr>
                </thead>

                <tbody>
                <?php if (!empty($buku)): ?>
                    <?php $no = 1; foreach ($buku as $b): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($b['judul']) ?></td>
                            <td><?= esc($b['isbn']) ?></td>
                            <td><?= esc($b['tahun_terbit']) ?></td>
                            <td><?= esc($b['jumlah']) ?></td>
                            <td>
                                <span class="badge bg-success">
                                    <?= esc($b['tersedia']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Tidak ada data
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>

            </table>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-end mt-3 text-muted small">
        Dicetak otomatis oleh sistem
    </div>

</div>

</body>
</html>