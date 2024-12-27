<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .bold-line {
            margin-bottom: 2px;
            border-bottom: 4px solid black;
        }

        .light-line {
            margin-bottom: 8px;
            border-bottom: 1px solid black;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td,
        .table th {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .no-border td {
            border: none;
            padding: 5px;
        }

        .table-header {
            text-align: center;
        }

        .table-header th {
            border: 1px solid #000;
        }

        .table-header-row {
            text-align: center;
            border: 1px solid #000;
        }

        .sign-area {
            text-align: right;
        }

        .line {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 250px;
        }

        .line2 {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 187px;
        }

        .box {
            display: inline-block;
            width: 7px;
            height: 7px;
            border: 1px solid black;
            margin-right: 5px;
            vertical-align: middle;
        }

        .circle {
            display: inline-block;
            width: 7px;
            height: 7px;
            border: 1px solid black;
            margin-right: 5px;
            vertical-align: middle;
            border-radius: 50px;
        }

        .bold-text-underline {
            font-weight: bold;
            text-decoration: underline;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .align-middle {
            vertical-align: middle;
        }

        .input-target {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Rekapitulasi Fakultas Teknik Tahun <?= $tahun ?></h1>
    <h3>1. Rekapitulasi Penelitian <?= $tahun?></h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 10px;">No</th>
                <th style="width: 100px;">Judul Penelitian</th>
                <th style="width: 50px;">Skim Penelitian</th>
                <th style="width: 50px;">Kesesuaian</th>
                <th style="width: 60px;">Prodi</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php foreach ($penelitian_elektro as $elektro) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $elektro->judul ?></td>
                    <td><?= $elektro->skim ?></td>
                    <td><?= $elektro->kesesuaian ?></td>
                    <td>S1 - <?= $elektro->prodi ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($penelitian_industri as $industri) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $industri->judul ?></td>
                    <td><?= $industri->skim ?></td>
                    <td><?= $industri->kesesuaian ?></td>
                    <td>S1 - <?= $industri->prodi ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($penelitian_biomedis as $biomedis) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $biomedis->judul ?></td>
                    <td><?= $biomedis->skim ?></td>
                    <td><?= $biomedis->kesesuaian ?></td>
                    <td>S1 - <?= $biomedis->prodi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>2. Rekapitulasi Pengabdian <?= $tahun?></h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 10px;">No</th>
                <th style="width: 100px;">Judul Pengabdian</th>
                <th style="width: 50px;">Skim Pengabdian</th>
                <th style="width: 50px;">Kesesuaian</th>
                <th style="width: 60px;">Prodi</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php foreach ($pengabdian_elektro as $elektro) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $elektro->judul ?></td>
                    <td><?= $elektro->skim ?></td>
                    <td><?= $elektro->kesesuaian ?></td>
                    <td>S1 - <?= $elektro->prodi ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($pengabdian_industri as $industri) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $industri->judul ?></td>
                    <td><?= $industri->skim ?></td>
                    <td><?= $industri->kesesuaian ?></td>
                    <td>S1 - <?= $industri->prodi ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($pengabdian_biomedis as $biomedis) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $biomedis->judul ?></td>
                    <td><?= $biomedis->skim ?></td>
                    <td><?= $biomedis->kesesuaian ?></td>
                    <td>S1 - <?= $biomedis->prodi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>