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

        .header {
            text-align: center;
        }

        .header::after {
            content: "";
            display: table;
            clear: both;
        }

        .header img,
        .header .text-container {
            display: inline-block;
            vertical-align: middle;
        }

        .header img {
            max-height: 80px;
            margin-right: 20px;
        }

        .sub-header {
            text-align: center;
            font-weight: bold;
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
            background-color: #072a75;
            color: white;
            text-align: center;
        }

        .table-header th {
            border: 3px solid #072a75;
        }

        .table-header-row {
            text-align: center;
            border: 3px solid #072a75;
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
    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td style="width: 20%;">
                    <?php
                    $path = base_url('assets/img/udinus.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    if (!isset($base64)) {
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                    ?>
                    <img src="<?= $base64 ?>" alt="Logo" />
                </td>
                <td style="text-align: center;">
                    <h3 style="font-size: 20px;"><strong>RENCANA STRATEGIS FAKULTAS TEKNIK</strong><br>
                        <strong>UNIVERSITAS DIAN NUSWANTORO SEMARANG</strong>
                    </h3>
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead style="border: 1px solid #000000 !important;">
            <tr class="table-header" style="border: 1px solid #000000 !important;">
                <th class="table-header-row" rowspan="2" style="border: 1px solid #000000; width: 10px;">No.</th>
                <th class="table-header-row" rowspan="2" colspan="2" style="border: 1px solid #000000; width: 170px;">Butir</th>
                <th class="table-header-row" rowspan="2" style="border: 1px solid #000000; width: 250px;">Indikator Kinerja Utama</th>
                <th class="table-header-row" colspan="2" style="border: 1px solid #000000; width: 250px; text-align: center;">Tahun <?= $selected_year ?></th>
            </tr>
            <tr class="table-header" style="border: 1px solid #000000 !important;">
                <th class="table-header-row" style="border: 1px solid #000000; text-align: center;">Target</th>
                <th class="table-header-row" style="border: 1px solid #000000; text-align: center;">Capaian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($level1 as $key => $level1_item): ?>
                <tr style="border: 1px solid;">
                    <td style="border: 1px solid;"><?php echo $level1_item->no_iku; ?></td>
                    <td style="border: 1px solid;" colspan="5"><?php echo $level1_item->isi_iku; ?></td>
                </tr>
                <?php
                $level2 = $this->Mod_iku->get_level2($level1_item->id);
                foreach ($level2 as $level2_item):
                ?>
                    <tr style="border: 1px solid;">
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"><?php echo $level2_item->no_iku; ?></td>
                        <td style="border: 1px solid;" colspan="4"><?php echo $level2_item->isi_iku; ?></td>
                    </tr>
                    <?php
                    $level3 = $this->Mod_iku->get_level3($level2_item->id);
                    foreach ($level3 as $level3_item):
                        $target_level3 = $this->Mod_iku->get_target_level3($level3_item->id, $selected_year);
                        $capaian_level3 = $this->Mod_iku->get_capaian_level3($level3_item->id, $selected_year);
                    ?>
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid;"></td>
                            <td style="border: 1px solid;"></td>
                            <td style="border: 1px solid;"><?php echo $level3_item->no_iku; ?></td>
                            <td style="border: 1px solid;"><?php echo $level3_item->isi_iku; ?></td>
                            <?php
                            $target_value = $target_level3 ?? '-';
                            $capaian_value = ($capaian_level3 !== '-' && $capaian_level3 !== null) ? $capaian_level3 : null;

                            // Initialize capaian_otomatis variable
                            $capaian_otomatis = null;

                            // Determine the value of capaian_otomatis based on no_iku
                            switch ($level3_item->no_iku) {
                                case '2.1.6.':
                                    $capaian_otomatis = $rata_rata_penelitian_mahasiswa_per_tahun ?? 0;
                                    break;
                                case '4.2.1.':
                                    $capaian_otomatis = $total_haki_per_tahun['paten'] ?? 0;
                                    break;
                                case '4.2.2.':
                                    $capaian_otomatis = $total_haki_per_tahun['hak_cipta'] ?? 0;
                                    break;
                                case '4.2.3.':
                                    $capaian_otomatis = $total_haki_per_tahun['merk'] ?? 0;
                                    break;
                                case '4.2.4.':
                                    $capaian_otomatis = $total_haki_per_tahun['buku'] ?? 0;
                                    break;
                                case '4.2.5.':
                                    $capaian_otomatis = $total_haki_per_tahun['lisensi'] ?? 0;
                                    break;
                                case '4.2.6.':
                                    $capaian_otomatis = $total_haki_per_tahun['desain_industri'] ?? 0;
                                    break;
                            }
                            ?>
                            <td style="border: 1px solid; text-align: center;"><?php echo $target_value; ?></td>
                            <td style="border: 1px solid; text-align: center;">
                                <?php
                                if ($capaian_value !== null) {
                                    echo $capaian_value;
                                } elseif ($capaian_otomatis !== null && $capaian_otomatis > 0) {
                                    if ($level3_item->no_iku === '2.1.6.') {
                                        $value = floatval($capaian_otomatis);
                                        echo number_format($value, 2, ',', '');
                                    } else {
                                        $value = floatval($capaian_otomatis);
                                        if (floor($value) == $value) {
                                            echo number_format($value, 0, ',', '.');
                                        } else {
                                            echo number_format($value, 2, ',', '.');
                                        }
                                    }
                                } else {
                                    echo $capaian_value ?? '-';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $level4 = $this->Mod_iku->get_level4($level3_item->id);
                        foreach ($level4 as $level4_item):
                            $target_level4 = $this->Mod_iku->get_target_level4($level4_item->id, $selected_year);
                            $capaian_level4 = $this->Mod_iku->get_capaian_level4($level4_item->id, $selected_year);
                        ?>
                            <tr style="border: 1px solid;">
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid; text-align: right;"><?php echo $level4_item->no_iku; ?></td>
                                <td style="border: 1px solid; text-align: right;"><?php echo $level4_item->isi_iku; ?></td>
                                <?php
                                // Perbaikan cara akses target dan capaian
                                $target_value = $target_level4 ?? '-';
                                $capaian_value = ($capaian_level4 !== '-' && $capaian_level4 !== null) ? $capaian_level4 : null;

                                // Initialize capaian_otomatis variable
                                $capaian_otomatis = null;

                                // Check if the no_iku requires automatic calculation
                                if (in_array($level4_item->no_iku, [
                                    '2.1.3.a.',
                                    '2.1.3.b.',
                                    '2.1.3.c.',
                                    '2.1.5.a.',
                                    '2.1.5.b.',
                                    '2.1.5.c.',
                                    '2.1.7.a.',
                                    '2.1.7.b.',
                                    '2.2.1.a.',
                                    '2.2.1.b.',
                                    '2.2.1.c.',
                                    '3.1.2.a.',
                                    '3.1.2.b.',
                                    '3.1.2.c.',
                                    '3.1.3.a.',
                                    '3.1.3.b.',
                                    '3.1.4.a.',
                                    '3.1.4.b.',
                                    '3.2.1.a.',
                                    '3.2.1.b.',
                                    '3.2.1.c.'
                                ])) {
                                    // Calculate capaian_otomatis based on no_iku
                                    switch ($level4_item->no_iku) {
                                        case '2.1.3.a.':
                                            $capaian_otomatis = $rata_rata_jurnal_per_tahun['bereputasi'] ?? 0;
                                            break;
                                        case '2.1.3.b.':
                                            $capaian_otomatis = $rata_rata_jurnal_per_tahun['internasional'] ?? 0;
                                            break;
                                        case '2.1.3.c.':
                                            $capaian_otomatis = $rata_rata_jurnal_per_tahun['nasional'] ?? 0;
                                            break;
                                        case '3.1.3.a.':
                                            $capaian_otomatis = $rata_rata_jurnal_pengabdian_per_tahun['internasional'] ?? 0;
                                            break;
                                        case '3.1.3.b.':
                                            $capaian_otomatis = $rata_rata_jurnal_pengabdian_per_tahun['nasional'] ?? 0;
                                            break;
                                        case '2.1.5.a.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['luar_negeri'] ?? 0;
                                            break;
                                        case '2.1.5.b.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['dalam_negeri'] ?? 0;
                                            break;
                                        case '2.1.5.c.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['internal'] ?? 0;
                                            break;
                                        case '3.1.4.a.':
                                            $capaian_otomatis = $rata_rata_prosiding_pengabdian_per_tahun['prosiding_pengabdian_internasional'] ?? 0;
                                            break;
                                        case '3.1.4.b.':
                                            $capaian_otomatis = $rata_rata_prosiding_pengabdian_per_tahun['prosiding_pengabdian_nasional'] ?? 0;
                                            break;
                                        case '2.1.7.a.':
                                            $capaian_otomatis = $rata_rata_seminar_per_tahun['internasional'] ?? 0;
                                            break;
                                        case '2.1.7.b.':
                                            $capaian_otomatis = $rata_rata_seminar_per_tahun['nasional'] ?? 0;
                                            break;
                                        case '2.2.1.a.':
                                            $capaian_otomatis = $total_dana_penelitian_per_tahun['internasional'] ?? 0;
                                            break;
                                        case '2.2.1.b.':
                                            $capaian_otomatis = $total_dana_penelitian_per_tahun['nasional'] ?? 0;
                                            break;
                                        case '2.2.1.c.':
                                            $capaian_otomatis = $total_dana_penelitian_per_tahun['internal'] ?? 0;
                                            break;
                                        case '3.1.2.a.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['luar_negeri'] ?? 0;
                                            break;
                                        case '3.1.2.b.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['dalam_negeri'] ?? 0;
                                            break;
                                        case '3.1.2.c.':
                                            $capaian_otomatis = $rata_rata_penelitian_per_tahun['internal'] ?? 0;
                                            break;
                                        case '3.2.1.a.':
                                            $capaian_otomatis = $total_dana_pengabdian_per_tahun['internasional'] ?? 0;
                                            break;
                                        case '3.2.1.b.':
                                            $capaian_otomatis = $total_dana_pengabdian_per_tahun['nasional'] ?? 0;
                                            break;
                                        case '3.2.1.c.':
                                            $capaian_otomatis = $total_dana_pengabdian_per_tahun['internal'] ?? 0;
                                            break;
                                    }
                                }
                                ?>
                                <td style="border: 1px solid; text-align: center;"><?php echo $target_value; ?></td>
                                <td style="border: 1px solid; text-align: center;">
                                    <?php
                                    if ($capaian_value !== null) {
                                        echo $capaian_value;
                                    } elseif ($capaian_otomatis !== null && $capaian_otomatis > 0) {
                                        $value = floatval($capaian_otomatis);

                                        // Cek apakah perlu format angka bulat
                                        if (in_array($level4_item->no_iku, ['3.2.1.a.', '3.1.3.a.', '3.1.3.b.', '3.1.4.a.', '3.1.4.b.'])) {
                                            echo number_format($value, 0, ',', '.');
                                        } else {
                                            // Cek apakah angka bulat untuk format yang lain
                                            if (floor($value) == $value) {
                                                echo number_format($value, 0, ',', '.');
                                            } else {
                                                echo number_format($value, 2, ',', '.');
                                            }
                                        }
                                    } else {
                                        echo $capaian_value ?? '-';
                                    }
                                    ?>
                                </td>
                            </tr>
            <?php endforeach;
                    endforeach;
                endforeach;
            endforeach; ?>
        </tbody>
    </table>
</body>

</html>