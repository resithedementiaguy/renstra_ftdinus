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

        .align-middle {
            vertical-align: middle;
        }

        .input-target {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .print-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
            page-break-after: always;
            page-break-before: always;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Pencapaian Fakultas Teknik</h1>
    <h3>1. Hibah Penelitian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_eksternal as $neliti_eksternal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal) + 1 ?>"><?= $neliti_eksternal->skim ?></td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal) + 1 ?>"><?= $neliti_eksternal->judul ?></td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_eksternal->besar_hibah, 0, ',', '.') ?>
                    </td>
                </tr>

                <?php foreach ($neliti_eksternal->anggota_penelitian_eksternal as $a_neliti_eksternal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_eksternal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php $total_hibah += $neliti_eksternal->besar_hibah; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>2. Hibah Penelitian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_internal as $neliti_internal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal) + 1 ?>"><?= $neliti_internal->skim ?></td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal) + 1 ?>"><?= $neliti_internal->judul ?></td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_internal->besar_hibah, 0, ',', '.') ?>
                    </td>
                </tr>

                <?php foreach ($neliti_internal->anggota_penelitian_internal as $a_neliti_internal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_internal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php $total_hibah += $neliti_internal->besar_hibah; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>3. Hibah Pengabdian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($pengabdian_eksternal as $abdi_eksternal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($abdi_eksternal->nama_ketua) ?>
                    </td>

                    <td rowspan="<?= count($abdi_eksternal->anggota_pengabdian_eksternal) + 1 ?>"><?= $abdi_eksternal->skim ?></td>
                    <td rowspan="<?= count($abdi_eksternal->anggota_pengabdian_eksternal) + 1 ?>"><?= $abdi_eksternal->judul ?></td>
                    <td rowspan="<?= count($abdi_eksternal->anggota_pengabdian_eksternal) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($abdi_eksternal->besar_hibah, 0, ',', '.') ?>
                    </td>
                </tr>

                <?php foreach ($abdi_eksternal->anggota_pengabdian_eksternal as $a_abdi_eksternal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_abdi_eksternal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php $total_hibah += $abdi_eksternal->besar_hibah; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>4. Hibah Pengabdian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($pengabdian_internal as $abdi_internal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($abdi_internal->nama_ketua) ?>
                    </td>

                    <td rowspan="<?= count($abdi_internal->anggota_pengabdian_internal) + 1 ?>"><?= $abdi_internal->skim ?></td>
                    <td rowspan="<?= count($abdi_internal->anggota_pengabdian_internal) + 1 ?>"><?= $abdi_internal->judul ?></td>
                    <td rowspan="<?= count($abdi_internal->anggota_pengabdian_internal) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($abdi_internal->besar_hibah, 0, ',', '.') ?>
                    </td>
                </tr>

                <?php foreach ($abdi_internal->anggota_pengabdian_internal as $a_abdi_internal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_abdi_internal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php $total_hibah += $abdi_internal->besar_hibah; ?>

            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="print-center">
        <h1>Program Studi Teknik Elektro</h1>
    </div>

    <h3>Laporan Publikasi Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($publikasi_nasional_elektro as $pubnas_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubnas_elektro->nama_pertama) ?>
                    </td>

                    <td rowspan="<?= count($pubnas_elektro->anggota_publikasi_nasional_elektro) + 1 ?>"><?= $pubnas_elektro->judul_artikel ?></td>
                    <td rowspan="<?= count($pubnas_elektro->anggota_publikasi_nasional_elektro) + 1 ?>"><?= $pubnas_elektro->judul_jurnal ?></td>
                    <td rowspan="<?= count($pubnas_elektro->anggota_publikasi_nasional_elektro) + 1 ?>"><?= $pubnas_elektro->doi ?></td>
                    <td rowspan="<?= count($pubnas_elektro->anggota_publikasi_nasional_elektro) + 1 ?>"><?= $pubnas_elektro->kategori ?></td>
                </tr>

                <?php foreach ($pubnas_elektro->anggota_publikasi_nasional_elektro as $a_pubnas_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubnas_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Publikasi Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publikasi_internasional_elektro as $pubinter_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubinter_elektro->nama_pertama) ?>
                    </td>

                    <td rowspan="<?= count($pubinter_elektro->anggota_publikasi_internasional_elektro) + 1 ?>"><?= $pubinter_elektro->judul_artikel ?></td>
                    <td rowspan="<?= count($pubinter_elektro->anggota_publikasi_internasional_elektro) + 1 ?>"><?= $pubinter_elektro->judul_jurnal ?></td>
                    <td rowspan="<?= count($pubinter_elektro->anggota_publikasi_internasional_elektro) + 1 ?>"><?= $pubinter_elektro->doi ?></td>
                    <td rowspan="<?= count($pubinter_elektro->anggota_publikasi_internasional_elektro) + 1 ?>"><?= $pubinter_elektro->kategori ?></td>
                </tr>

                <?php foreach ($pubinter_elektro->anggota_publikasi_internasional_elektro as $a_pubinter_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubinter_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 190px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Seminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_nasional_elektro as $seminas_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_elektro->nama_pertama) ?>
                    </td>

                    <td rowspan="<?= count($seminas_elektro->anggota_seminar_nasional_elektro) + 1 ?>"><?= $seminas_elektro->judul_artikel ?></td>
                    <td rowspan="<?= count($seminas_elektro->anggota_seminar_nasional_elektro) + 1 ?>"><?= $seminas_elektro->judul_seminar ?></td>
                </tr>

                <?php foreach ($seminas_elektro->anggota_seminar_nasional_elektro as $a_seminas_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminas_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 60px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Jurnal</th>
                <th style="width: 100px;">DOI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_internasional_elektro as $seminter_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_elektro->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($seminter_elektro->anggota_seminar_internasional_elektro) + 1 ?>"><?= $seminter_elektro->judul_artikel ?></td>
                    <td rowspan="<?= count($seminter_elektro->anggota_seminar_internasional_elektro) + 1 ?>"><?= $seminter_elektro->judul_seminar ?></td>
                    <td rowspan="<?= count($seminter_elektro->anggota_seminar_internasional_elektro) + 1 ?>"><?= $seminter_elektro->doi ?></td>
                </tr>
                <?php foreach ($seminter_elektro->anggota_seminar_internasional_elektro as $a_seminter_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminter_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan HKI</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 210px;">Judul Invensi</th>
                <th style="width: 40px;">Jenis HKI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hcipta_elektro as $hcipta_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_elektro) + 1 ?>"><?= $hcipta_e->judul ?></td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_elektro) + 1 ?>">Hak Cipta</td>
                </tr>
                <?php foreach ($hcipta_e->anggota_hcipta_elektro as $a_hcipta_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_hcipta_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($dindustri_elektro as $dindustri_e): ?>
                <tr>
                    <td class="align-middle">
                        <?php foreach ($dindustri_e->anggota_dindustri_elektro as $a_dindustri_e): ?>
                            <?= htmlspecialchars($a_dindustri_e->nama) ?>;
                        <?php endforeach; ?>
                    </td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_elektro) + 1 ?>"><?= $dindustri_e->judul ?></td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_elektro) + 1 ?>">Desain Industri</td>
                </tr>
            <?php endforeach; ?>

            <?php foreach ($paten_elektro as $paten_e): ?>
                <tr>
                    <td class="align-middle">
                        <?php foreach ($paten_e->anggota_paten_elektro as $a_paten_e): ?>
                            <?= htmlspecialchars($a_paten_e->nama) ?>;
                        <?php endforeach; ?>
                    </td>
                    <td rowspan="<?= count($paten_e->anggota_paten_elektro) + 1 ?>"><?= $paten_e->judul ?></td>
                    <td rowspan="<?= count($paten_e->anggota_paten_elektro) + 1 ?>">Paten</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Hibah Penelitian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_penelitian_eksternal = 0; ?>
            <?php foreach ($penelitian_eksternal_elektro as $neliti_eksternal_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal_elektro->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro) + 1 ?>"><?= $neliti_eksternal_elektro->skim ?></td>
                    <td rowspan="<?= count($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro) + 1 ?>"><?= $neliti_eksternal_elektro->judul ?></td>
                    <td rowspan="<?= count($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_eksternal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_penelitian_eksternal += $neliti_eksternal_elektro->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro as $a_neliti_eksternal_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_eksternal_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_penelitian_eksternal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Penelitian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_penelitian_internal = 0; ?>
            <?php foreach ($penelitian_internal_elektro as $neliti_internal_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal_elektro->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_internal_elektro->anggota_penelitian_internal_elektro) + 1 ?>"><?= $neliti_internal_elektro->skim ?></td>
                    <td rowspan="<?= count($neliti_internal_elektro->anggota_penelitian_internal_elektro) + 1 ?>"><?= $neliti_internal_elektro->judul ?></td>
                    <td rowspan="<?= count($neliti_internal_elektro->anggota_penelitian_internal_elektro) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_internal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_penelitian_internal += $neliti_internal_elektro->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_internal_elektro->anggota_penelitian_internal_elektro as $a_neliti_internal_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_internal_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_penelitian_internal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_pengabdian_eksternal_elektro = 0; ?>
            <?php foreach ($pengabdian_eksternal_elektro as $pengabdian_eksternal_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_eksternal_elektro->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_eksternal_elektro->anggota_pengabdian_eksternal_elektro) + 1 ?>"><?= $pengabdian_eksternal_elektro->skim ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal_elektro->anggota_pengabdian_eksternal_elektro) + 1 ?>"><?= $pengabdian_eksternal_elektro->judul ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal_elektro->anggota_pengabdian_eksternal_elektro) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_eksternal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_pengabdian_eksternal_elektro += $pengabdian_eksternal_elektro->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_eksternal_elektro->anggota_pengabdian_eksternal_elektro as $a_pengabdian_eksternal_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_eksternal_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_pengabdian_eksternal_elektro, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_pengabdian_internal_elektro = 0; ?>
            <?php foreach ($pengabdian_internal_elektro as $pengabdian_internal_elektro): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_internal_elektro->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_internal_elektro->anggota_pengabdian_internal_elektro) + 1 ?>"><?= $pengabdian_internal_elektro->skim ?></td>
                    <td rowspan="<?= count($pengabdian_internal_elektro->anggota_pengabdian_internal_elektro) + 1 ?>"><?= $pengabdian_internal_elektro->judul ?></td>
                    <td rowspan="<?= count($pengabdian_internal_elektro->anggota_pengabdian_internal_elektro) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_internal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_pengabdian_internal_elektro += $pengabdian_internal_elektro->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_internal_elektro->anggota_pengabdian_internal_elektro as $a_pengabdian_internal_elektro): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_internal_elektro->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_pengabdian_internal_elektro, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="print-center">
        <h1>Program Studi Teknik Industri</h1>
    </div>

    <h3>Laporan Publikasi Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publikasi_nasional_industri as $pubnas_industri): ?>
                <tr>
                    <td class="align-middle"><?= htmlspecialchars($pubnas_industri->nama_pertama) ?></td>
                    <td rowspan="<?= count($pubnas_industri->anggota_publikasi_nasional_industri) + 1 ?>"><?= htmlspecialchars($pubnas_industri->judul_artikel) ?></td>
                    <td rowspan="<?= count($pubnas_industri->anggota_publikasi_nasional_industri) + 1 ?>"><?= htmlspecialchars($pubnas_industri->judul_jurnal) ?></td>
                    <td rowspan="<?= count($pubnas_industri->anggota_publikasi_nasional_industri) + 1 ?>"><?= htmlspecialchars($pubnas_industri->doi) ?></td>
                    <td rowspan="<?= count($pubnas_industri->anggota_publikasi_nasional_industri) + 1 ?>"><?= htmlspecialchars($pubnas_industri->kategori) ?></td>
                </tr>

                <?php foreach ($pubnas_industri->anggota_publikasi_nasional_industri as $a_pubnas_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubnas_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Publikasi Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publikasi_internasional_industri as $pubinter_industri): ?>
                <tr>
                    <td class="align-middle"><?= htmlspecialchars($pubinter_industri->nama_pertama) ?></td>
                    <td rowspan="<?= count($pubinter_industri->anggota_publikasi_internasional_industri) + 1 ?>"><?= htmlspecialchars($pubinter_industri->judul_artikel) ?></td>
                    <td rowspan="<?= count($pubinter_industri->anggota_publikasi_internasional_industri) + 1 ?>"><?= htmlspecialchars($pubinter_industri->judul_jurnal) ?></td>
                    <td rowspan="<?= count($pubinter_industri->anggota_publikasi_internasional_industri) + 1 ?>"><?= htmlspecialchars($pubinter_industri->doi) ?></td>
                    <td rowspan="<?= count($pubinter_industri->anggota_publikasi_internasional_industri) + 1 ?>"><?= htmlspecialchars($pubinter_industri->kategori) ?></td>
                </tr>

                <?php foreach ($pubinter_industri->anggota_publikasi_internasional_industri as $a_pubinter_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubinter_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 190px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Seminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_nasional_industri as $seminas_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_industri->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($seminas_industri->anggota_seminar_nasional_industri) + 1 ?>">
                        <?= htmlspecialchars($seminas_industri->judul_artikel) ?>
                    </td>
                    <td rowspan="<?= count($seminas_industri->anggota_seminar_nasional_industri) + 1 ?>">
                        <?= htmlspecialchars($seminas_industri->judul_seminar) ?>
                    </td>
                </tr>
                <?php foreach ($seminas_industri->anggota_seminar_nasional_industri as $a_seminas_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminas_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 60px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Seminar</th>
                <th style="width: 100px;">DOI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_internasional_industri as $seminter_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_industri->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($seminter_industri->anggota_seminar_internasional_industri) + 1 ?>">
                        <?= htmlspecialchars($seminter_industri->judul_artikel) ?>
                    </td>
                    <td rowspan="<?= count($seminter_industri->anggota_seminar_internasional_industri) + 1 ?>">
                        <?= htmlspecialchars($seminter_industri->judul_seminar) ?>
                    </td>
                    <td rowspan="<?= count($seminter_industri->anggota_seminar_internasional_industri) + 1 ?>">
                        <?= htmlspecialchars($seminter_industri->doi) ?>
                    </td>
                </tr>
                <?php foreach ($seminter_industri->anggota_seminar_internasional_industri as $a_seminter_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminter_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan HKI</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 210px;">Judul Invensi</th>
                <th style="width: 40px;">Jenis HKI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hcipta_industri as $hcipta_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_industri) + 1 ?>"><?= htmlspecialchars($hcipta_e->judul) ?></td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_industri) + 1 ?>">Hak Cipta</td>
                </tr>
                <?php foreach ($hcipta_e->anggota_hcipta_industri as $a_hcipta_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_hcipta_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($dindustri_industri as $dindustri_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($dindustri_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_industri) + 1 ?>"><?= htmlspecialchars($dindustri_e->judul) ?></td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_industri) + 1 ?>">Desain Industri</td>
                </tr>
                <?php foreach ($dindustri_e->anggota_dindustri_industri as $a_dindustri_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_dindustri_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($paten_industri as $paten_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($paten_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($paten_e->anggota_paten_industri) + 1 ?>"><?= htmlspecialchars($paten_e->judul) ?></td>
                    <td rowspan="<?= count($paten_e->anggota_paten_industri) + 1 ?>">Paten</td>
                </tr>
                <?php foreach ($paten_e->anggota_paten_industri as $a_paten_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_paten_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Hibah Penelitian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_penelitian_eksternal = 0; ?>
            <?php foreach ($penelitian_eksternal_industri as $neliti_eksternal_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal_industri->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_eksternal_industri->anggota_penelitian_eksternal_industri) + 1 ?>"><?= htmlspecialchars($neliti_eksternal_industri->skim) ?></td>
                    <td rowspan="<?= count($neliti_eksternal_industri->anggota_penelitian_eksternal_industri) + 1 ?>"><?= htmlspecialchars($neliti_eksternal_industri->judul) ?></td>
                    <td rowspan="<?= count($neliti_eksternal_industri->anggota_penelitian_eksternal_industri) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_eksternal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_penelitian_eksternal += $neliti_eksternal_industri->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_eksternal_industri->anggota_penelitian_eksternal_industri as $a_neliti_eksternal_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_eksternal_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_penelitian_eksternal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Penelitian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_penelitian_internal = 0; ?>
            <?php foreach ($penelitian_internal_industri as $neliti_internal_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal_industri->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_internal_industri->anggota_penelitian_internal_industri) + 1 ?>"><?= htmlspecialchars($neliti_internal_industri->skim) ?></td>
                    <td rowspan="<?= count($neliti_internal_industri->anggota_penelitian_internal_industri) + 1 ?>"><?= htmlspecialchars($neliti_internal_industri->judul) ?></td>
                    <td rowspan="<?= count($neliti_internal_industri->anggota_penelitian_internal_industri) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_internal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_penelitian_internal += $neliti_internal_industri->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_internal_industri->anggota_penelitian_internal_industri as $a_neliti_internal_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_internal_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_penelitian_internal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_pengabdian_eksternal = 0; ?>
            <?php foreach ($pengabdian_eksternal_industri as $pengabdian_eksternal_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_eksternal_industri->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_eksternal_industri->anggota_pengabdian_eksternal_industri) + 1 ?>"><?= htmlspecialchars($pengabdian_eksternal_industri->skim) ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal_industri->anggota_pengabdian_eksternal_industri) + 1 ?>"><?= htmlspecialchars($pengabdian_eksternal_industri->judul) ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal_industri->anggota_pengabdian_eksternal_industri) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_eksternal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_pengabdian_eksternal += $pengabdian_eksternal_industri->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_eksternal_industri->anggota_pengabdian_eksternal_industri as $a_pengabdian_eksternal_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_eksternal_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_pengabdian_eksternal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_pengabdian_internal = 0; ?>
            <?php foreach ($pengabdian_internal_industri as $pengabdian_internal_industri): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_internal_industri->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_internal_industri->anggota_pengabdian_internal_industri) + 1 ?>"><?= htmlspecialchars($pengabdian_internal_industri->skim) ?></td>
                    <td rowspan="<?= count($pengabdian_internal_industri->anggota_pengabdian_internal_industri) + 1 ?>"><?= htmlspecialchars($pengabdian_internal_industri->judul) ?></td>
                    <td rowspan="<?= count($pengabdian_internal_industri->anggota_pengabdian_internal_industri) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_internal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_pengabdian_internal += $pengabdian_internal_industri->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_internal_industri->anggota_pengabdian_internal_industri as $a_pengabdian_internal_industri): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_internal_industri->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_pengabdian_internal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="print-center">
        <h1>Program Studi Teknik Biomedis</h1>
    </div>

    <h3>Laporan Publikasi Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publikasi_nasional_biomedis as $pubnas_biomedis): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubnas_biomedis->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($pubnas_biomedis->anggota_publikasi_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubnas_biomedis->judul_artikel) ?></td>
                    <td rowspan="<?= count($pubnas_biomedis->anggota_publikasi_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubnas_biomedis->judul_jurnal) ?></td>
                    <td rowspan="<?= count($pubnas_biomedis->anggota_publikasi_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubnas_biomedis->doi) ?></td>
                    <td rowspan="<?= count($pubnas_biomedis->anggota_publikasi_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubnas_biomedis->kategori) ?></td>
                </tr>
                <?php foreach ($pubnas_biomedis->anggota_publikasi_nasional_biomedis as $a_pubnas_biomedis): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubnas_biomedis->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Publikasi Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Jurnal</th>
                <th style="width: 50px;">DOI</th>
                <th style="width: 55px;">Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($publikasi_internasional_biomedis as $pubinter_biomedis): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubinter_biomedis->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($pubinter_biomedis->anggota_publikasi_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubinter_biomedis->judul_artikel) ?></td>
                    <td rowspan="<?= count($pubinter_biomedis->anggota_publikasi_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubinter_biomedis->judul_jurnal) ?></td>
                    <td rowspan="<?= count($pubinter_biomedis->anggota_publikasi_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubinter_biomedis->doi) ?></td>
                    <td rowspan="<?= count($pubinter_biomedis->anggota_publikasi_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($pubinter_biomedis->kategori) ?></td>
                </tr>
                <?php foreach ($pubinter_biomedis->anggota_publikasi_internasional_biomedis as $a_pubinter_biomedis): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pubinter_biomedis->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Seminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_nasional_biomedis as $seminas_biomedis): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_biomedis->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($seminas_biomedis->anggota_seminar_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($seminas_biomedis->judul_artikel) ?></td>
                    <td rowspan="<?= count($seminas_biomedis->anggota_seminar_nasional_biomedis) + 1 ?>"><?= htmlspecialchars($seminas_biomedis->judul_seminar) ?></td>
                </tr>
                <?php foreach ($seminas_biomedis->anggota_seminar_nasional_biomedis as $a_seminas_biomedis): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminas_biomedis->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Internasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 120px;">Judul Artikel</th>
                <th style="width: 50px;">Judul Seminar</th>
                <th style="width: 50px;">DOI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seminar_internasional_biomedis as $seminter_biomedis): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_biomedis->nama_pertama) ?>
                    </td>
                    <td rowspan="<?= count($seminter_biomedis->anggota_seminar_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($seminter_biomedis->judul_artikel) ?></td>
                    <td rowspan="<?= count($seminter_biomedis->anggota_seminar_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($seminter_biomedis->judul_seminar) ?></td>
                    <td rowspan="<?= count($seminter_biomedis->anggota_seminar_internasional_biomedis) + 1 ?>"><?= htmlspecialchars($seminter_biomedis->doi) ?></td>
                </tr>
                <?php foreach ($seminter_biomedis->anggota_seminar_internasional_biomedis as $a_seminter_biomedis): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_seminter_biomedis->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan HKI</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 210px;">Judul Invensi</th>
                <th style="width: 40px;">Jenis HKI</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hcipta_biomedis as $hcipta_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_biomedis) + 1 ?>"><?= htmlspecialchars($hcipta_e->judul) ?></td>
                    <td rowspan="<?= count($hcipta_e->anggota_hcipta_biomedis) + 1 ?>">Hak Cipta</td>
                </tr>
                <?php foreach ($hcipta_e->anggota_hcipta_biomedis as $a_hcipta_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_hcipta_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($dindustri_biomedis as $dindustri_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($dindustri_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_biomedis) + 1 ?>"><?= htmlspecialchars($dindustri_e->judul) ?></td>
                    <td rowspan="<?= count($dindustri_e->anggota_dindustri_biomedis) + 1 ?>">Desain Industri</td>
                </tr>
                <?php foreach ($dindustri_e->anggota_dindustri_biomedis as $a_dindustri_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_dindustri_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php foreach ($paten_biomedis as $paten_e): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($paten_e->nama_usul) ?>
                    </td>
                    <td rowspan="<?= count($paten_e->anggota_paten_biomedis) + 1 ?>"><?= htmlspecialchars($paten_e->judul) ?></td>
                    <td rowspan="<?= count($paten_e->anggota_paten_biomedis) + 1 ?>">Paten</td>
                </tr>
                <?php foreach ($paten_e->anggota_paten_biomedis as $a_paten_e): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_paten_e->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Hibah Penelitian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_eksternal = 0; ?>
            <?php foreach ($penelitian_eksternal_biomedis as $neliti_eksternal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal_biomedis) + 1 ?>"><?= htmlspecialchars($neliti_eksternal->skim) ?></td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal_biomedis) + 1 ?>"><?= htmlspecialchars($neliti_eksternal->judul) ?></td>
                    <td rowspan="<?= count($neliti_eksternal->anggota_penelitian_eksternal_biomedis) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_eksternal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_eksternal += $neliti_eksternal->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_eksternal->anggota_penelitian_eksternal_biomedis as $a_neliti_eksternal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_eksternal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_eksternal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Penelitian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_internal = 0; ?>
            <?php foreach ($penelitian_internal_biomedis as $neliti_internal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal_biomedis) + 1 ?>"><?= htmlspecialchars($neliti_internal->skim) ?></td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal_biomedis) + 1 ?>"><?= htmlspecialchars($neliti_internal->judul) ?></td>
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal_biomedis) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($neliti_internal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_internal += $neliti_internal->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($neliti_internal->anggota_penelitian_internal_biomedis as $a_neliti_internal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_neliti_internal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Penelitian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_internal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Eksternal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_eksternal = 0; ?>
            <?php foreach ($pengabdian_eksternal_biomedis as $pengabdian_eksternal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_eksternal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_eksternal->anggota_pengabdian_eksternal_biomedis) + 1 ?>"><?= htmlspecialchars($pengabdian_eksternal->skim) ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal->anggota_pengabdian_eksternal_biomedis) + 1 ?>"><?= htmlspecialchars($pengabdian_eksternal->judul) ?></td>
                    <td rowspan="<?= count($pengabdian_eksternal->anggota_pengabdian_eksternal_biomedis) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_eksternal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_eksternal += $pengabdian_eksternal->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_eksternal->anggota_pengabdian_eksternal_biomedis as $a_pengabdian_eksternal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_eksternal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Eksternal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_eksternal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Hibah Pengabdian Internal</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 60px;">Nama</th>
                <th style="width: 40px;">Skim</th>
                <th style="width: 150px;">Judul</th>
                <th style="width: 50px;">Biaya</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_hibah_internal = 0; ?>
            <?php foreach ($pengabdian_internal_biomedis as $pengabdian_internal): ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pengabdian_internal->nama_ketua) ?>
                    </td>
                    <td rowspan="<?= count($pengabdian_internal->anggota_pengabdian_internal_biomedis) + 1 ?>"><?= htmlspecialchars($pengabdian_internal->skim) ?></td>
                    <td rowspan="<?= count($pengabdian_internal->anggota_pengabdian_internal_biomedis) + 1 ?>"><?= htmlspecialchars($pengabdian_internal->judul) ?></td>
                    <td rowspan="<?= count($pengabdian_internal->anggota_pengabdian_internal_biomedis) + 1 ?>" style="text-align: right;">
                        <?= 'Rp' . number_format($pengabdian_internal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah_internal += $pengabdian_internal->besar_hibah; ?>
                    </td>
                </tr>
                <?php foreach ($pengabdian_internal->anggota_pengabdian_internal_biomedis as $a_pengabdian_internal): ?>
                    <tr>
                        <td><?= htmlspecialchars($a_pengabdian_internal->nama) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah Pengabdian Internal</td>
                <td style="font-weight: bold; text-align: right;">
                    <?= 'Rp' . number_format($total_hibah_internal, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>