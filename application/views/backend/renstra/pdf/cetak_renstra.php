<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
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
                    <h3 style="font-size: 20px;"><strong>FAKULTAS TEKNIK</strong><br>
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
                <th class="table-header-row" colspan="<?php echo count($years) * 2; ?>" style="border: 1px solid #000000; text-align: center;">Tahun</th>
            </tr>
            <tr class="table-header" style="border: 1px solid #000000 !important;">
                <?php foreach ($years as $year): ?>
                    <th class="table-header-row" style="border: 1px solid #000000; text-align: center;"><?php echo $year; ?></th>
                    <th class="table-header-row" style="border: 1px solid #000000; text-align: center;">Capaian <?php echo $year; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($level1 as $key => $level1_item): ?>
                <tr style="border: 1px solid;">
                    <td style="border: 1px solid;"><?php echo $level1_item->no_iku; ?></td>
                    <td style="border: 1px solid;" colspan="<?php echo count($years) * 2 + 3; ?>"><?php echo $level1_item->isi_iku; ?></td>
                </tr>
                <?php
                $level2 = $this->Mod_iku->get_level2($level1_item->id);
                foreach ($level2 as $level2_item):
                ?>
                    <tr style="border: 1px solid;">
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"><?php echo $level2_item->no_iku; ?></td>
                        <td style="border: 1px solid;" colspan="<?php echo count($years) * 2 + 2; ?>"><?php echo $level2_item->isi_iku; ?></td>
                    </tr>
                    <?php
                    $level3 = $this->Mod_iku->get_level3($level2_item->id);
                    foreach ($level3 as $level3_item):
                        $target_level3 = $this->Mod_iku->get_target_level3($level3_item->id);
                        $capaian_level3 = $this->Mod_iku->get_capaian_level3($level3_item->id);
                    ?>
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid;"></td>
                            <td style="border: 1px solid;"></td>
                            <td style="border: 1px solid;"><?php echo $level3_item->no_iku; ?></td>
                            <td style="border: 1px solid;"><?php echo $level3_item->isi_iku; ?></td>
                            <?php foreach ($years as $year):
                                $target_value = isset($target_level3[$year]) ? $target_level3[$year] : '-';
                                $capaian_value = isset($capaian_level3[$year]) ? $capaian_level3[$year] : '-';
                            ?>
                                <td style="border: 1px solid; text-align: center;"><?php echo $target_value; ?></td>
                                <td style="border: 1px solid; text-align: center;"><?php echo $capaian_value; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php
                        $level4 = $this->Mod_iku->get_level4($level3_item->id);
                        foreach ($level4 as $level4_item):
                            $target_level4 = $this->Mod_iku->get_target_level4($level4_item->id);
                            $capaian_level4 = $this->Mod_iku->get_capaian_level4($level4_item->id);
                        ?>
                            <tr style="border: 1px solid;">
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid;"></td>
                                <td style="border: 1px solid; text-align: right;"><?php echo $level4_item->no_iku; ?></td>
                                <td style="border: 1px solid; text-align: right;"><?php echo $level4_item->isi_iku; ?></td>
                                <?php foreach ($years as $year):
                                    $target_value = isset($target_level4[$year]) ? $target_level4[$year] : '-';
                                    $capaian_value = isset($capaian_level4[$year]) ? $capaian_level4[$year] : '-';
                                ?>
                                    <td style="border: 1px solid; text-align: center;"><?php echo $target_value; ?></td>
                                    <td style="border: 1px solid; text-align: center;"><?php echo $capaian_value; ?></td>
                                <?php endforeach; ?>
                            </tr>
            <?php endforeach;
                    endforeach;
                endforeach;
            endforeach; ?>
        </tbody>
    </table>
</body>

</html>