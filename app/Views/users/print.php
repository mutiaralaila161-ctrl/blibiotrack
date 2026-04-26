<!DOCTYPE html>
<html>

<head>
    <title>Print Data Users</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2, h3 {
            text-align: center;
            margin: 0;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background-color: #f2f2f2;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        table th {
            text-align: center;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }

        .admin {
            background: #000;
            color: #fff;
        }

        .petugas {
            background: #0d6efd;
            color: #fff;
        }

        .anggota {
            background: #198754;
            color: #fff;
        }

        /* PRINT SETTING */
        @media print {
            body {
                margin: 0;
            }

            button {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <h2>DATA USERS</h2>
    <div class="subtitle">
        Sistem Perpustakaan - Laporan Data User
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th width="15%">Role</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td class="center"><?= $no++ ?></td>
                        <td><?= esc($u['nama']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc($u['username']) ?></td>
                        <td class="center">
                            <?php if ($u['role'] == 'admin'): ?>
                                <span class="badge admin">Admin</span>
                            <?php elseif ($u['role'] == 'petugas'): ?>
                                <span class="badge petugas">Petugas</span>
                            <?php else: ?>
                                <span class="badge anggota">Anggota</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br><br>

    <div style="text-align:right; font-size:12px;">
        Dicetak pada: <?= date('d-m-Y H:i') ?>
    </div>

</body>

</html>