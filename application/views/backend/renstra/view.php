<style>
    table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    table thead th {
        background-color: #072a75;
        color: #fff;
        border: 1px solid black;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Renstra</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Daftar Rencana Strategis</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengisi Rencana Strategis Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('renstra/create_view1') ?>" type="button" class="btn btn-primary mb-4">Tambah Indikator</a>
                            </div>
                            <a href="<?= base_url('cetak/generate_pdf_renstra') ?>" type="button" target="_blank" class="btn btn-danger mb-4"><i class="bi bi-file-pdf"></i> Cetak PDF</a>
                        </div>
                        <div class="table-responsive" style="overflow-x: auto; max-height: 800px;"> <!-- Membatasi tinggi tabel dengan scroll -->
                            <table class="table table-bordered" style="border: 1px solid;">
                                <thead style="border: 1px solid black; background-color: #072a75 !important; color: #fff !important;">
                                    <tr>
                                        <th class="text-center align-middle" rowspan="2" style="border: 1px solid black; width: 50px; background-color: #092b6b !important; color: #fff !important;">No.</th>
                                        <th class="text-center align-middle" rowspan="2" colspan="2" style="border: 1px solid black; width: 170px; background-color: #092b6b !important; color: #fff !important;">Butir</th>
                                        <th class="text-start align-middle" rowspan="2" style="border: 1px solid black; width: 250px; background-color: #092b6b !important; color: #fff !important;">Indikator Kinerja Utama</th>
                                        <th class="text-center align-middle" colspan="<?php echo count($years) * 2; ?>" style="border: 1px solid black; width: 500px; background-color: #092b6b !important; color: #fff !important;">Tahun</th>
                                    </tr>
                                    <tr>
                                        <?php foreach ($years as $year): ?>
                                            <th style="border: 1px solid black; min-width: 100px; width: auto; background-color: #092b6b !important; color: #fff !important;" class="text-center align-middle"><?php echo $year; ?></th>
                                            <th style="border: 1px solid black; min-width: 100px; width: auto; background-color: #092b6b !important; color: #fff !important;" class="text-center align-middle">Capaian <?php echo $year; ?></th>
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
                                                $capaian_level3 = $this->Mod_iku->get_capaian_level3($level3_item->id); // Ambil capaian jika ada
                                            ?>
                                                <tr style="border: 1px solid;">
                                                    <td style="border: 1px solid;"></td>
                                                    <td style="border: 1px solid;"></td>
                                                    <td style="border: 1px solid;"><?php echo $level3_item->no_iku; ?></td>

                                                    <?php if ($level3_item->ket_target === 'Iya'): ?>
                                                        <td style="border: 1px solid;"><?php echo $level3_item->isi_iku; ?></td>
                                                        <?php foreach ($years as $year):
                                                            $value = isset($target_level3[$year]) ? $target_level3[$year] : '';
                                                            $capaian_value = isset($capaian_level3[$year]) ? $capaian_level3[$year] : ''; // Ambil capaian
                                                        ?>
                                                            <td style="border: 1px solid;">
                                                                <input type="text"
                                                                    name="target[<?php echo $level3_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control target-input"
                                                                    data-id="<?php echo $level3_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level3"
                                                                    value="<?php echo $value; ?>"
                                                                    placeholder="Isi target">
                                                            </td>
                                                            <td style="border: 1px solid;">
                                                                <input type="text"
                                                                    name="capaian[<?php echo $level3_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control capaian-input"
                                                                    data-id="<?php echo $level3_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level3"
                                                                    value="<?php echo $capaian_value; ?>"
                                                                    placeholder="Isi capaian">
                                                            </td>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <td style="border: 1px solid;" colspan="<?php echo count($years) * 2 + 1; ?>"><?php echo $level3_item->isi_iku; ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php
                                                $level4 = $this->Mod_iku->get_level4($level3_item->id);
                                                foreach ($level4 as $level4_item):
                                                    $target_level4 = $this->Mod_iku->get_target_level4($level4_item->id);
                                                    $capaian_level4 = $this->Mod_iku->get_capaian_level4($level4_item->id); // Ambil capaian jika ada
                                                ?>
                                                    <tr style="border: 1px solid;">
                                                        <td style="border: 1px solid;"></td>
                                                        <td style="border: 1px solid;"></td>
                                                        <td style="border: 1px solid;" class="text-end"><?php echo $level4_item->no_iku; ?></td>
                                                        <td style="border: 1px solid;" class="text-end"><?php echo $level4_item->isi_iku; ?></td>
                                                        <?php foreach ($years as $year):
                                                            $value = isset($target_level4[$year]) ? $target_level4[$year] : '';
                                                            $capaian_value = isset($capaian_level4[$year]) ? $capaian_level4[$year] : ''; // Ambil capaian
                                                        ?>
                                                            <td style="border: 1px solid;">
                                                                <input type="text"
                                                                    name="target[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control target-input"
                                                                    data-id="<?php echo $level4_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level4"
                                                                    value="<?php echo $value; ?>"
                                                                    placeholder="Isi target">
                                                            </td>
                                                            <td style="border: 1px solid;">
                                                                <input type="text"
                                                                    name="capaian[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control capaian-input"
                                                                    data-id="<?php echo $level4_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level4"
                                                                    value="<?php echo $capaian_value; ?>"
                                                                    placeholder="Isi capaian">
                                                            </td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                    <?php endforeach;
                                            endforeach;
                                        endforeach;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal Bootstrap -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Informasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="responseMessage">
                <!-- Pesan respons akan muncul di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // For target input change
        $('input.target-input').on('change', function() {
            var targetId = $(this).data('id');
            var year = $(this).data('year');
            var value = $(this).val();
            var levelType = $(this).data('level-type');

            $.ajax({
                url: "<?php echo base_url('renstra/update_target'); ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    target_id: targetId,
                    year: year,
                    value: value,
                    level_type: levelType
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        $('#responseMessage').text("Target berhasil diperbarui untuk tahun " + year);
                    } else {
                        $('#responseMessage').text("Gagal memperbarui target. Pesan kesalahan: " + (response.message || "Tidak ada detail"));
                    }
                    $('#responseModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);

                    var errorMessage = "Terjadi kesalahan di server. Cek console untuk detail.";
                    if (xhr.responseText) {
                        errorMessage += "\nDetail kesalahan: " + xhr.responseText;
                    }

                    $('#responseMessage').text(errorMessage);
                    $('#responseModal').modal('show');
                }
            });
        });

        // For capaian input change
        $('input.capaian-input').on('change', function() {
            var capaianId = $(this).data('id');
            var year = $(this).data('year');
            var value = $(this).val();
            var levelType = $(this).data('level-type');

            $.ajax({
                url: "<?php echo base_url('renstra/update_capaian'); ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    capaian_id: capaianId,
                    year: year,
                    value: value,
                    level_type: levelType
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        $('#responseMessage').text("Capaian berhasil diperbarui untuk tahun " + year);
                    } else {
                        $('#responseMessage').text("Gagal memperbarui capaian. Pesan kesalahan: " + (response.message || "Tidak ada detail"));
                    }
                    $('#responseModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);

                    var errorMessage = "Terjadi kesalahan di server. Cek console untuk detail.";
                    if (xhr.responseText) {
                        errorMessage += "\nDetail kesalahan: " + xhr.responseText;
                    }

                    $('#responseMessage').text(errorMessage);
                    $('#responseModal').modal('show');
                }
            });
        });
    });
</script>