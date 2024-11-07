<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Renstra</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5>Tabel Rencana Strategi</h5>
                    </div>
                    <div class="card-body">
                        <!-- Default Table -->
                        <a href="<?= base_url('renstra/create_view1') ?>" type="button" class="btn btn-primary mb-4">Tambah Indikator</a>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr class="text-center align-middle">
                                        <th scope="col" rowspan="2" style="width: 50px;">No</th>
                                        <th scope="col" rowspan="2" colspan="2">Butir</th>
                                        <th scope="col" rowspan="2" style="width: 200px;">Indikator Kinerja Utama</th>
                                        <th scope="col" colspan="6" style="width: 300px;">Tahun</th>
                                    </tr>
                                    <tr class="text-center align-middle">
                                        <th scope="col">2021</th>
                                        <th scope="col">2022</th>
                                        <th scope="col">2023</th>
                                        <th scope="col">2024</th>
                                        <th scope="col">2025</th>
                                        <th scope="col">2026</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($level1 as $key => $level1_item): ?>
                                        <tr>
                                            <td><?php echo $level1_item->no_iku; ?></td>
                                            <td colspan="9"><?php echo $level1_item->isi_iku; ?></td>
                                        </tr>
                                        <?php
                                        // Get level 2 data for this level 1
                                        $level2 = $this->Iku_model->get_level2($level1_item->id);
                                        foreach ($level2 as $level2_item):
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $level2_item->no_iku; ?></td>
                                                <td colspan="8"><?php echo $level2_item->isi_iku; ?></td>
                                            </tr>
                                            <?php
                                            // Get level 3 data for this level 2
                                            $level3 = $this->Iku_model->get_level3($level2_item->id);
                                            foreach ($level3 as $level3_item):
                                            ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $level3_item->no_iku; ?></td>

                                                    <!-- Check the value of ket_target for colspan and add input boxes if needed -->
                                                    <?php if ($level3_item->ket_target === 'Iya'): ?>
                                                        <td><?php echo $level3_item->isi_iku; ?></td>
                                                        <?php
                                                        // Generate input boxes for each year if ket_target is "Iya"
                                                        for ($year = 2021; $year <= 2026; $year++): ?>
                                                            <td>
                                                                <input type="text" name="target[<?php echo $level3_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control"
                                                                    placeholder="Isi target">
                                                            </td>
                                                        <?php endfor; ?>
                                                    <?php else: ?>
                                                        <td colspan="7"><?php echo $level3_item->isi_iku; ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php
                                                // Get level 4 data for this level 3
                                                $level4 = $this->Iku_model->get_level4($level3_item->id);
                                                foreach ($level4 as $level4_item):
                                                ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-end"><?php echo $level4_item->no_iku; ?></td>
                                                        <td class="text-end"><?php echo $level4_item->isi_iku; ?></td>

                                                        <!-- Generate input boxes for each year if level 4 is populated -->
                                                        <?php for ($year = 2021; $year <= 2026; $year++): ?>
                                                            <td>
                                                                <input type="text" name="target[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control"
                                                                    placeholder="Isi target">
                                                            </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                    <?php endforeach;
                                            endforeach;
                                        endforeach;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Default Table Example -->
                    </div>
                </div>