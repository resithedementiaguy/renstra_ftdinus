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
                <th style="width: 40px;">Biaya</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_eksternal as $neliti_eksternal) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal->nama_ketua) ?>;
                        <?php if (!empty($neliti_eksternal->anggota_penelitian_eksternal)): ?>
                            <?php foreach ($neliti_eksternal->anggota_penelitian_eksternal as $a_neliti_eksternal): ?>
                                <?= htmlspecialchars($a_neliti_eksternal->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_eksternal->skim ?></td>`
                    <td><?= $neliti_eksternal->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_eksternal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_eksternal->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
                <th style="width: 40px;">Biaya</th>
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
                    <td rowspan="<?= count($neliti_internal->anggota_penelitian_internal) + 1 ?>" class="text-end">
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
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah</td>
                <td class="text-end" style="font-weight: bold;">
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
                <th style="width: 40px;">Biaya</th>
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
                    <td rowspan="<?= count($abdi_eksternal->anggota_pengabdian_eksternal) + 1 ?>" class="text-end">
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
                <td colspan="3" style="font-weight: bold; text-align: right;">Total Hibah</td>
                <td class="text-end" style="font-weight: bold;">
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
                <th style="width: 40px;">Biaya</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($pengabdian_internal as $abdi_internal) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($abdi_internal->nama_ketua) ?>;
                        <?php if (!empty($abdi_internal->anggota_pengabdian_internal)): ?>
                            <?php foreach ($abdi_internal->anggota_pengabdian_internal as $a_abdi_internal): ?>
                                <?= htmlspecialchars($a_abdi_internal->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $abdi_internal->skim ?></td>`
                    <td><?= $abdi_internal->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($abdi_internal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $abdi_internal->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($publikasi_nasional_elektro as $pubnas_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubnas_elektro->nama_pertama) ?>;
                        <?php if (!empty($pubnas_elektro->anggota_publikasi_nasional_elektro)): ?>
                            <?php foreach ($pubnas_elektro->anggota_publikasi_nasional_elektro as $a_pubnas_elektro): ?>
                                <?= htmlspecialchars($a_pubnas_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $pubnas_elektro->judul_artikel ?></td>`
                    <td><?= $pubnas_elektro->judul_jurnal ?></td>
                    <td><?= $pubnas_elektro->doi ?></td>
                    <td><?= $pubnas_elektro->kategori ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($publikasi_internasional_elektro as $pubinter_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubinter_elektro->nama_pertama) ?>;
                        <?php if (!empty($pubinter_elektro->anggota_publikasi_internasional_elektro)): ?>
                            <?php foreach ($pubinter_elektro->anggota_publikasi_internasional_elektro as $a_pubinter_elektro): ?>
                                <?= htmlspecialchars($a_pubinter_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $pubinter_elektro->judul_artikel ?></td>`
                    <td><?= $pubinter_elektro->judul_jurnal ?></td>
                    <td><?= $pubinter_elektro->doi ?></td>
                    <td><?= $pubinter_elektro->kategori ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_internasional_elektro as $seminter_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_elektro->nama_pertama) ?>;
                        <?php if (!empty($seminter_elektro->anggota_seminar_internasional_elektro)): ?>
                            <?php foreach ($seminter_elektro->anggota_seminar_internasional_elektro as $a_seminter_elektro): ?>
                                <?= htmlspecialchars($a_seminter_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminter_elektro->judul_artikel ?></td>`
                    <td><?= $seminter_elektro->judul_seminar ?></td>
                    <td><?= $seminter_elektro->doi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 190px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Jurnal</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_nasional_elektro as $seminas_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_elektro->nama_pertama) ?>;
                        <?php if (!empty($seminas_elektro->anggota_seminar_nasional_elektro)): ?>
                            <?php foreach ($seminas_elektro->anggota_seminar_nasional_elektro as $a_seminas_elektro): ?>
                                <?= htmlspecialchars($a_seminas_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminas_elektro->judul_artikel ?></td>
                    <td><?= $seminas_elektro->judul_seminar ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($hcipta_elektro as $hcipta_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>;
                        <?php if (!empty($hcipta_e->anggota_hcipta_elektro)): ?>
                            <?php foreach ($hcipta_e->anggota_hcipta_elektro as $a_hcipta_e): ?>
                                <?= htmlspecialchars($a_hcipta_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $hcipta_e->judul ?></td>
                    <td>Hak Cipta</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($dindustri_elektro as $dindustri_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($dindustri_e->anggota_dindustri_elektro)): ?>
                            <?php foreach ($dindustri_e->anggota_dindustri_elektro as $a_dindustri_e): ?>
                                <?= htmlspecialchars($a_dindustri_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $dindustri_e->judul ?></td>
                    <td>Desain Industri</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($paten_elektro as $paten_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($paten_e->anggota_paten_elektro)): ?>
                            <?php foreach ($paten_e->anggota_paten_elektro as $a_paten_e): ?>
                                <?= htmlspecialchars($a_paten_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $paten_e->judul ?></td>
                    <td>Paten</td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_eksternal_elektro as $neliti_eksternal_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal_elektro->nama_ketua) ?>;
                        <?php if (!empty($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro)): ?>
                            <?php foreach ($neliti_eksternal_elektro->anggota_penelitian_eksternal_elektro as $a_neliti_eksternal_elektro): ?>
                                <?= htmlspecialchars($a_neliti_eksternal_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_eksternal_elektro->skim ?></td>`
                    <td><?= $neliti_eksternal_elektro->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_eksternal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_eksternal_elektro->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_internal_elektro as $neliti_internal_elektro) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal_elektro->nama_ketua) ?>;
                        <?php if (!empty($neliti_internal_elektro->anggota_penelitian_internal_elektro)): ?>
                            <?php foreach ($neliti_internal_elektro->anggota_penelitian_internal_elektro as $a_neliti_internal_elektro): ?>
                                <?= htmlspecialchars($a_neliti_internal_elektro->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_internal_elektro->skim ?></td>`
                    <td><?= $neliti_internal_elektro->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_internal_elektro->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_internal_elektro->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
            <?php foreach ($publikasi_nasional_industri as $pubnas_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubnas_industri->nama_pertama) ?>;
                        <?php if (!empty($pubnas_industri->anggota_publikasi_nasional_industri)): ?>
                            <?php foreach ($pubnas_industri->anggota_publikasi_nasional_industri as $a_pubnas_industri): ?>
                                <?= htmlspecialchars($a_pubnas_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pubnas_industri->judul_artikel) ?></td>
                    <td><?= htmlspecialchars($pubnas_industri->judul_jurnal) ?></td>
                    <td><?= htmlspecialchars($pubnas_industri->doi) ?></td>
                    <td><?= htmlspecialchars($pubnas_industri->kategori) ?></td>
                </tr>
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
            <?php foreach ($publikasi_internasional_industri as $pubinter_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubinter_industri->nama_pertama) ?>;
                        <?php if (!empty($pubinter_industri->anggota_publikasi_internasional_industri)): ?>
                            <?php foreach ($pubinter_industri->anggota_publikasi_internasional_industri as $a_pubinter_industri): ?>
                                <?= htmlspecialchars($a_pubinter_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pubinter_industri->judul_artikel) ?></td>
                    <td><?= htmlspecialchars($pubinter_industri->judul_jurnal) ?></td>
                    <td><?= htmlspecialchars($pubinter_industri->doi) ?></td>
                    <td><?= htmlspecialchars($pubinter_industri->kategori) ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_internasional_industri as $seminter_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_industri->nama_pertama) ?>;
                        <?php if (!empty($seminter_industri->anggota_seminar_internasional_industri)): ?>
                            <?php foreach ($seminter_industri->anggota_seminar_internasional_industri as $a_seminter_industri): ?>
                                <?= htmlspecialchars($a_seminter_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminter_industri->judul_artikel ?></td>`
                    <td><?= $seminter_industri->judul_seminar ?></td>
                    <td><?= $seminter_industri->doi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 190px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Jurnal</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_nasional_industri as $seminas_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_industri->nama_pertama) ?>;
                        <?php if (!empty($seminas_industri->anggota_seminar_nasional_industri)): ?>
                            <?php foreach ($seminas_industri->anggota_seminar_nasional_industri as $a_seminas_industri): ?>
                                <?= htmlspecialchars($a_seminas_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminas_industri->judul_artikel ?></td>
                    <td><?= $seminas_industri->judul_seminar ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($hcipta_industri as $hcipta_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>;
                        <?php if (!empty($hcipta_e->anggota_hcipta_industri)): ?>
                            <?php foreach ($hcipta_e->anggota_hcipta_industri as $a_hcipta_e): ?>
                                <?= htmlspecialchars($a_hcipta_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $hcipta_e->judul ?></td>
                    <td>Hak Cipta</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($dindustri_industri as $dindustri_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($dindustri_e->anggota_dindustri_industri)): ?>
                            <?php foreach ($dindustri_e->anggota_dindustri_industri as $a_dindustri_e): ?>
                                <?= htmlspecialchars($a_dindustri_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $dindustri_e->judul ?></td>
                    <td>Desain Industri</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($paten_industri as $paten_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($paten_e->anggota_paten_industri)): ?>
                            <?php foreach ($paten_e->anggota_paten_industri as $a_paten_e): ?>
                                <?= htmlspecialchars($a_paten_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $paten_e->judul ?></td>
                    <td>Paten</td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_eksternal_industri as $neliti_eksternal_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal_industri->nama_ketua) ?>;
                        <?php if (!empty($neliti_eksternal_industri->anggota_penelitian_eksternal_industri)): ?>
                            <?php foreach ($neliti_eksternal_industri->anggota_penelitian_eksternal_industri as $a_neliti_eksternal_industri): ?>
                                <?= htmlspecialchars($a_neliti_eksternal_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_eksternal_industri->skim ?></td>`
                    <td><?= $neliti_eksternal_industri->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_eksternal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_eksternal_industri->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_internal_industri as $neliti_internal_industri) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal_industri->nama_ketua) ?>;
                        <?php if (!empty($neliti_internal_industri->anggota_penelitian_internal_industri)): ?>
                            <?php foreach ($neliti_internal_industri->anggota_penelitian_internal_industri as $a_neliti_internal_industri): ?>
                                <?= htmlspecialchars($a_neliti_internal_industri->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_internal_industri->skim ?></td>`
                    <td><?= $neliti_internal_industri->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_internal_industri->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_internal_industri->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
            <?php foreach ($publikasi_nasional_biomedis as $pubnas_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubnas_biomedis->nama_pertama) ?>;
                        <?php if (!empty($pubnas_biomedis->anggota_publikasi_nasional_biomedis)): ?>
                            <?php foreach ($pubnas_biomedis->anggota_publikasi_nasional_biomedis as $a_pubnas_biomedis): ?>
                                <?= htmlspecialchars($a_pubnas_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pubnas_biomedis->judul_artikel) ?></td>
                    <td><?= htmlspecialchars($pubnas_biomedis->judul_jurnal) ?></td>
                    <td><?= htmlspecialchars($pubnas_biomedis->doi) ?></td>
                    <td><?= htmlspecialchars($pubnas_biomedis->kategori) ?></td>
                </tr>
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
            <?php foreach ($publikasi_internasional_biomedis as $pubinter_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($pubinter_biomedis->nama_pertama) ?>;
                        <?php if (!empty($pubinter_biomedis->anggota_publikasi_internasional_biomedis)): ?>
                            <?php foreach ($pubinter_biomedis->anggota_publikasi_internasional_biomedis as $a_pubinter_biomedis): ?>
                                <?= htmlspecialchars($a_pubinter_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pubinter_biomedis->judul_artikel) ?></td>
                    <td><?= htmlspecialchars($pubinter_biomedis->judul_jurnal) ?></td>
                    <td><?= htmlspecialchars($pubinter_biomedis->doi) ?></td>
                    <td><?= htmlspecialchars($pubinter_biomedis->kategori) ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_internasional_biomedis as $seminter_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminter_biomedis->nama_pertama) ?>;
                        <?php if (!empty($seminter_biomedis->anggota_seminar_internasional_biomedis)): ?>
                            <?php foreach ($seminter_biomedis->anggota_seminar_internasional_biomedis as $a_seminter_biomedis): ?>
                                <?= htmlspecialchars($a_seminter_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminter_biomedis->judul_artikel ?></td>`
                    <td><?= $seminter_biomedis->judul_seminar ?></td>
                    <td><?= $seminter_biomedis->doi ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Laporan Seminar Nasional</h3>
    <table class="table">
        <thead class="table-header">
            <tr>
                <th style="width: 55px;">Nama</th>
                <th style="width: 190px;">Judul Artikel</th>
                <th style="width: 60px;">Judul Jurnal</th>
            </tr>
        </thead>
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($seminar_nasional_biomedis as $seminas_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($seminas_biomedis->nama_pertama) ?>;
                        <?php if (!empty($seminas_biomedis->anggota_seminar_nasional_biomedis)): ?>
                            <?php foreach ($seminas_biomedis->anggota_seminar_nasional_biomedis as $a_seminas_biomedis): ?>
                                <?= htmlspecialchars($a_seminas_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $seminas_biomedis->judul_artikel ?></td>
                    <td><?= $seminas_biomedis->judul_seminar ?></td>
                </tr>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($hcipta_biomedis as $hcipta_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($hcipta_e->nama_usul) ?>;
                        <?php if (!empty($hcipta_e->anggota_hcipta_biomedis)): ?>
                            <?php foreach ($hcipta_e->anggota_hcipta_biomedis as $a_hcipta_e): ?>
                                <?= htmlspecialchars($a_hcipta_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $hcipta_e->judul ?></td>
                    <td>Hak Cipta</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($dindustri_biomedis as $dindustri_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($dindustri_e->anggota_dindustri_biomedis)): ?>
                            <?php foreach ($dindustri_e->anggota_dindustri_biomedis as $a_dindustri_e): ?>
                                <?= htmlspecialchars($a_dindustri_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $dindustri_e->judul ?></td>
                    <td>Desain biomedis</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($paten_biomedis as $paten_e) : ?>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($paten_e->anggota_paten_biomedis)): ?>
                            <?php foreach ($paten_e->anggota_paten_biomedis as $a_paten_e): ?>
                                <?= htmlspecialchars($a_paten_e->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $paten_e->judul ?></td>
                    <td>Paten</td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_eksternal_biomedis as $neliti_eksternal_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_eksternal_biomedis->nama_ketua) ?>;
                        <?php if (!empty($neliti_eksternal_biomedis->anggota_penelitian_eksternal_biomedis)): ?>
                            <?php foreach ($neliti_eksternal_biomedis->anggota_penelitian_eksternal_biomedis as $a_neliti_eksternal_biomedis): ?>
                                <?= htmlspecialchars($a_neliti_eksternal_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_eksternal_biomedis->skim ?></td>`
                    <td><?= $neliti_eksternal_biomedis->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_eksternal_biomedis->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_eksternal_biomedis->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_internal_biomedis as $neliti_internal_biomedis) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal_biomedis->nama_ketua) ?>;
                        <?php if (!empty($neliti_internal_biomedis->anggota_penelitian_internal_biomedis)): ?>
                            <?php foreach ($neliti_internal_biomedis->anggota_penelitian_internal_biomedis as $a_neliti_internal_biomedis): ?>
                                <?= htmlspecialchars($a_neliti_internal_biomedis->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_internal_biomedis->skim ?></td>`
                    <td><?= $neliti_internal_biomedis->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_internal_biomedis->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_internal_biomedis->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>