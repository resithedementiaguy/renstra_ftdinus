<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Artikel Ilmiah</title>
</head>

<body>
    <h1>Data Artikel Ilmiah - Tahun <?= $tahun ?></h1>

    <form method="get" action="">
        <label for="tahun">Pilih Tahun:</label>
        <select name="tahun" id="tahun" onchange="this.form.submit()">
            <?php foreach ($tahunList as $row): ?>
                <option value="<?= $row['tahun'] ?>" <?= ($row['tahun'] == $tahun) ? 'selected' : '' ?>>
                    <?= $row['tahun'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Rasio Artikel/Dosen</th>
                2021-2026
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jurnal Internasional Bereputasi</td>
                <td><?= ($jumlah_dosen > 0) ? number_format($total_jurnal_bereputasi / $jumlah_dosen, 2) : 0 ?></td>
            </tr>
            <tr>
                <td>Jurnal Internasional</td>
                <td><?= ($jumlah_dosen > 0) ? number_format($total_jurnal_internasional / $jumlah_dosen, 2) : 0 ?></td>
            </tr>
            <tr>
                <td>Jurnal Nasional Terakreditasi</td>
                <td><?= ($jumlah_dosen > 0) ? number_format($total_jurnal_nasional / $jumlah_dosen, 2) : 0 ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>