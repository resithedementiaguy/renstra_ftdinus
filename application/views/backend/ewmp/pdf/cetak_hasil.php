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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($penelitian_internal as $neliti_internal) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($neliti_internal->nama_ketua) ?>;
                        <?php if (!empty($neliti_internal->anggota_penelitian_internal)): ?>
                            <?php foreach ($neliti_internal->anggota_penelitian_internal as $a_neliti_internal): ?>
                                <?= htmlspecialchars($a_neliti_internal->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $neliti_internal->skim ?></td>`
                    <td><?= $neliti_internal->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($neliti_internal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $neliti_internal->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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
        <?php $no = 1; ?>
        <tbody>
            <?php $total_hibah = 0; ?>
            <?php foreach ($pengabdian_eksternal as $abdi_eksternal) : ?>
                <tr>
                    <td class="align-middle">
                        <?= htmlspecialchars($abdi_eksternal->nama_ketua) ?>;
                        <?php if (!empty($abdi_eksternal->anggota_pengabdian_eksternal)): ?>
                            <?php foreach ($abdi_eksternal->anggota_pengabdian_eksternal as $a_abdi_eksternal): ?>
                                <?= htmlspecialchars($a_abdi_eksternal->nama) ?>;
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $abdi_eksternal->skim ?></td>`
                    <td><?= $abdi_eksternal->judul ?></td>
                    <td>
                        <?= 'Rp' . number_format($abdi_eksternal->besar_hibah, 0, ',', '.') ?>
                        <?php $total_hibah += $abdi_eksternal->besar_hibah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total Hibah</td>
                <td class="align-end"><?= 'Rp' . number_format($total_hibah, 0, ',', '.') ?></td>
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

    <h1 style="text-align: center;">Program Studi Teknik Elektro</h1>
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

    <h1 style="text-align: center;">Program Studi Teknik Elektro</h1>
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
</body>

</html>