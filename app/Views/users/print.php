<!DOCTYPE html>
<html>

<head>
    <title>Print Data Users</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            color: #333;
            padding: 20px;
        }

        /* HEADER */
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub-title {
            text-align: center;
            font-size: 13px;
            margin-bottom: 20px;
            color: #666;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background: #0d6efd;
            color: white;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: right;
        }

        /* PRINT SETTING */
        @media print {
            body {
                margin: 0;
            }

            h3 {
                margin-top: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <h3>Data Users</h3>
    <div class="sub-title">Laporan Data Pengguna Sistem</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($u['nama']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc($u['username']) ?></td>
                        <td><?= ucfirst($u['role']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

</body>

</html>