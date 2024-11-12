<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            padding: 10px;
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
            max-height: 100px;
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
                    <strong>UNIVERSITAS DIAN NUSWANTORO</strong></h3>
                    <p>Jl. Nakula I No. 5-11 Semarang 50131, Telp: (024) 3555628</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead class="table-header">
            <tr class="table-header-row">
                <th class="text-center align-middle" rowspan="2" style="width: 50px;">No.</th>
                <th class="text-center align-middle" rowspan="2" colspan="2" style="width: 170px;">Butir</th>
                <th class="text-start align-middle" rowspan="2" style="width: 250px;">Indikator Kinerja Utama</th>
                <th class="text-center align-middle" colspan="<?php echo count($years); ?>" style="width: 300px;">Tahun</th>
            </tr>
            <tr class="text-center align-middle">
                <?php foreach ($years as $year): ?>
                    <th><?php echo $year; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($level1 as $key => $level1_item): ?>
                <tr>
                    <td><?php echo $level1_item->no_iku; ?></td>
                    <td colspan="<?php echo count($years) + 3; ?>"><?php echo $level1_item->isi_iku; ?></td>
                </tr>
                <?php
                $level2 = $this->Iku_model->get_level2($level1_item->id);
                foreach ($level2 as $level2_item):
                ?>
                    <tr>
                        <td></td>
                        <td><?php echo $level2_item->no_iku; ?></td>
                        <td colspan="<?php echo count($years) + 2; ?>"><?php echo $level2_item->isi_iku; ?></td>
                    </tr>
                    <?php
                    $level3 = $this->Iku_model->get_level3($level2_item->id);
                    foreach ($level3 as $level3_item):
                        $target_level3 = $this->Iku_model->get_target_level3($level3_item->id);
                    ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?php echo $level3_item->no_iku; ?></td>

                            <?php if ($level3_item->ket_target === 'Iya'): ?>
                                <td><?php echo $level3_item->isi_iku; ?></td>
                                <?php foreach ($years as $year):
                                    $value = isset($target_level3[$year]) ? $target_level3[$year] : ''; ?>
                                    <td>
                                        <input type="text"
                                            name="target[<?php echo $level3_item->id; ?>][<?php echo $year; ?>]"
                                            class="input-target"
                                            data-id="<?php echo $level3_item->id; ?>"
                                            data-year="<?php echo $year; ?>"
                                            data-level-type="level3"
                                            value="<?php echo $value; ?>"
                                            placeholder="Isi target">
                                    </td>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <td colspan="<?php echo count($years) + 1; ?>"><?php echo $level3_item->isi_iku; ?></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $level4 = $this->Iku_model->get_level4($level3_item->id);
                        foreach ($level4 as $level4_item):
                            $target_level4 = $this->Iku_model->get_target_level4($level4_item->id);
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-end"><?php echo $level4_item->no_iku; ?></td>
                                <td class="text-end"><?php echo $level4_item->isi_iku; ?></td>
                                <?php foreach ($years as $year):
                                    $value = isset($target_level4[$year]) ? $target_level4[$year] : ''; ?>
                                    <td>
                                        <input type="text"
                                            name="target[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                            class="input-target"
                                            data-id="<?php echo $level4_item->id; ?>"
                                            data-year="<?php echo $year; ?>"
                                            data-level-type="level4"
                                            value="<?php echo $value; ?>"
                                            placeholder="Isi target">
                                    </td>
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
