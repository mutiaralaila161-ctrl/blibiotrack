<!DOCTYPE html>
<html>

<head>
    <title>Print Data Buku</title>
</head>

<body onload="window.print()">

    <h3>Data Buku</h3>

    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
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
                <?php $no = 1;
                foreach ($buku as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b['judul'] ?></td>
                        <td><?= $b['isbn'] ?></td>
                        <td><?= $b['tahun_terbit'] ?></td>
                        <td><?= $b['jumlah'] ?></td>
                        <td><?= $b['tersedia'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>