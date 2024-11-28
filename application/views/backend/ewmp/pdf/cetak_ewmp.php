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
    <h1 style="text-align: center;">Pencapaian Fakultas Teknik</h1>
    <h3>1. Publikasi Artikel Ilmiah</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 50px;" colspan="2">Internasional</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Q1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Q2</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Q3</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Q4</td>
                <td>1</td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight: bold;">Nasional</td>
            </tr>
            <tr>
                <td>S</td>
                <td>1</td>
            </tr>
            <tr>
                <td>S2</td>
                <td>1</td>
            </tr>
            <tr>
                <td>S3</td>
                <td>1</td>
            </tr>
            <tr>
                <td>S4</td>
                <td>1</td>
            </tr>
            <tr>
                <td>S5</td>
                <td>1</td>
            </tr>
            <tr>
                <td>S6</td>
                <td>1</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Tidak Terakreditasi</td>
                <td>1</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td>11</td>
            </tr>
        </tbody>
    </table>
    <h3>2. Seminar</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 50px;">Internasional</th>
                <th style="font-weight: 100; width: 50px;">2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight: bold;">Nasional</td>
                <td>2</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td>11</td>
            </tr>
        </tbody>
    </table>
    <h3>3. Hibah Penelitian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 50px;">Nama</th>
                <th style="width: 50px;">Skema</th>
                <th style="width: 50px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nur Islahudin</td>
                <td rowspan="4">MF Kedaireka</td>
                <td rowspan="4">Pengembangan Teknologi Fast filling Pengisian Bahan Bakar Kendaraan Berat Melalui Kolaborasi Dudi Guna Penguatan Ekosistem MBKM di Bidang Desain Engineering</td>
                <td rowspan="4" style="text-align: right;">Rp787.561.000,00</td>
            </tr>
            <tr>
                <td>Dony Satriyo Nugroho</td>
            </tr>
            <tr>
                <td>Amalia</td>
            </tr>
            <tr>
                <td>Jazuli</td>
            </tr>
        </tbody>
    </table>
</body>

</html>