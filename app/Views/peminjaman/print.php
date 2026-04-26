<!DOCTYPE html>
<html>

<head>
    <title>Print Data Peminjaman Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .status-kembali {
            color: green;
            font-weight: bold;
        }

        .status-terlambat {
            color: red;
            font-weight: bold;
        }

        .status-pinjam {
            color: orange;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>

</head>

<body onload="window.print()">

    <h2>DATA PEMINJAMAN BUKU</h2>
    <div class="subtitle">
        Sistem Perpustakaan - Laporan Data Peminjaman
    </div>

    <table>

        <thead>
        <tr>
            <th>No</th>
            <th>Anggota</th>
            <th>Petugas</th>
            <th>Buku</th>
            <th>Tgl Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Denda</th>
        </tr>
        </thead>

        <tbody>

        <?php if (!empty($peminjaman)): ?>

            <?php $no = 1; foreach ($peminjaman as $p): ?>

                <tr>

                    <td class="center"><?= $no++ ?></td>

                    <td><?= esc($p['nama_anggota'] ?? '-') ?></td>

                    <td><?= esc($p['nama_petugas'] ?? '-') ?></td>

                    <td>
                        <?php if (!empty($p['detail'])): ?>
                            <?php foreach ($p['detail'] as $d): ?>
                                - <?= esc($d['judul'] ?? '-') ?><br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td class="center"><?= esc($p['tanggal_pinjam'] ?? '-') ?></td>

                    <td class="center"><?= esc($p['tanggal_kembali'] ?? '-') ?></td>

                    <td class="center"><?= esc($p['tanggal_dikembalikan'] ?? '-') ?></td>

                    <!-- STATUS -->
                    <td class="center">
                        <?php
                        if (($p['status_label'] ?? '') == 'Kembali') {
                            echo '<span class="status-kembali">Kembali</span>';
                        } elseif (($p['status_label'] ?? '') == 'Terlambat') {
                            echo '<span class="status-terlambat">Terlambat</span>';
                        } else {
                            echo '<span class="status-pinjam">Dipinjam</span>';
                        }
                        ?>
                    </td>

                    <!-- DENDA -->
                    <td class="right">
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
                <td colspan="9" class="center">Tidak ada data peminjaman</td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>

    <br><br>

    <div class="right">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

</body>

</html>