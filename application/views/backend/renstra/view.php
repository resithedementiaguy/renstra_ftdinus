<style>
    table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #1153a1 !important;
    }

    table thead tr {
        background-color: #1153a1 !important;
    }

    table thead th {
        background-color: #1153a1 !important;
        color: #fff !important;
        border: 1px solid black !important;
        padding: 8px;
        position: sticky;
        top: 0;
        z-index: 11;
    }

    /* Ensure first row of headers maintains border and color */
    table thead tr:first-child th {
        background-color: #1153a1 !important;
        border: 1px solid black !important;
        color: #fff !important;
    }

    /* Ensure second row of headers maintains border and color */
    table thead tr:nth-child(2) th {
        background-color: #1153a1 !important;
        border: 1px solid black !important;
        color: #fff !important;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Renstra</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Rencana Strategis Fakultas Teknik Universitas Dian Nuswantoro Semarang</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengisi Target Indikator Kinerja Utama Fakultas Teknik
                        </div>
                        <!-- Tambahkan wrapper untuk menata layout -->
                        <div class="d-flex flex-column align-items-end">
                            <!-- Select Option -->
                            <div style="width: 200px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Cetak Renstra</label>
                                <select class="form-select" name="tahun" id="tahun" required>
                                    <option value="" selected hidden>Pilih Tahun</option>
                                    <?php foreach ($tahun as $thn): ?>
                                        <option value="<?= $thn->tahun ?>"><?= $thn->tahun ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tombol Tambah dan Cetak -->
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <a href="<?= base_url('renstra/create_view1') ?>" type="button" class="btn btn-primary mb-4">Tambah Indikator</a>
                                </div>
                                <div>
                                    <a href="<?= base_url('cetak/generate_pdf_renstra_tahunan') ?>"
                                        id="cetak-renstra-tahunan"
                                        type="button"
                                        target="_blank"
                                        class="btn btn-danger mb-4">
                                        <i class="bi bi-file-pdf"></i> Cetak PDF Renstra Sesuai Tahun
                                    </a>
                                    <a href="<?= base_url('cetak/generate_pdf_renstra') ?>" type="button" target="_blank" class="btn btn-danger mb-4"><i class="bi bi-file-pdf"></i> Cetak PDF Renstra 6 Tahun</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow-x: auto; max-height: 800px;">
                            <table class="table table-bordered" style="border: 1px solid black;">
                                <thead style="border: 1px solid black; background-color: #1153a1 !important; color: #fff !important;">
                                    <tr style="border: 1px solid black !important;">
                                        <th class="text-center align-middle" rowspan="2" style="border: 1px solid black; width: 50px; background-color: #1153a1 !important; color: #fff !important;">No.</th>
                                        <th class="text-center align-middle" rowspan="2" colspan="2" style="border: 1px solid black; width: 170px; background-color: #1153a1 !important; color: #fff !important;">Butir</th>
                                        <th class="text-start align-middle" rowspan="2" style="border: 1px solid black; width: 250px; background-color: #1153a1 !important; color: #fff !important;">Indikator Kinerja Utama</th>
                                        <th class="text-center align-middle" colspan="<?php echo count($years) * 2; ?>" style="border: 1px solid black; width: 500px; background-color: #1153a1 !important; color: #fff !important;">Tahun</th>
                                    </tr>
                                    <tr style="border: 1px solid black !important;">
                                        <?php foreach ($years as $year): ?>
                                            <th style="border: 1px solid black; min-width: 100px; width: auto; background-color: #1153a1 !important; color: #fff !important;" class="text-center align-middle">Target <?php echo $year; ?></th>
                                            <th style="border: 1px solid black; min-width: 100px; width: auto; background-color: #1153a1 !important; color: #fff !important;" class="text-center align-middle">Capaian <?php echo $year; ?></th>
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

                                                    <?php if ($level3_item->ket_target === 'Iya'): ?>
                                                        <td style="border: 1px solid;"><?php echo $level3_item->isi_iku; ?></td>
                                                        <?php foreach ($years as $year): ?>
                                                            <?php
                                                            // Inisialisasi capaian_otomatis
                                                            $capaian_otomatis = null;

                                                            // Tampilkan nilai capaian hanya untuk IKU yang sesuai kriteria
                                                            if ($level3_item->no_iku === '2.1.6.') {
                                                                $capaian_otomatis = $rata_rata_penelitian_mahasiswa_per_tahun[$year] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.1.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['paten'] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.2.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['hak_cipta'] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.3.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['merk'] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.4.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['buku'] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.5.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['lisensi'] ?? 0;
                                                            } elseif ($level3_item->no_iku === '4.2.6.') {
                                                                $capaian_otomatis = $total_haki_per_tahun[$year]['desain_industri'] ?? 0;
                                                            }

                                                            // Ambil nilai target dan capaian
                                                            $value = $target_level3[$year] ?? '';
                                                            $capaian_value = $capaian_level3[$year] ?? '';
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
                                                                <?php
                                                                if ($capaian_otomatis !== null && $capaian_otomatis > 0) {
                                                                    echo "<p>";
                                                                    if ($level3_item->no_iku === '2.1.6.') {
                                                                        $value = floatval($capaian_otomatis);
                                                                        echo number_format($value, 2, ',', '');
                                                                    } else {
                                                                        $value = floatval($capaian_otomatis);
                                                                        // Check if the number is a whole number
                                                                        if (floor($value) == $value) {
                                                                            echo number_format($value, 0, ',', '.');
                                                                        } else {
                                                                            echo number_format($value, 2, ',', '.');
                                                                        }
                                                                    }
                                                                    echo "</p>";
                                                                }
                                                                ?>
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
                                                    $capaian_level4 = $this->Mod_iku->get_capaian_level4($level4_item->id);
                                                ?>
                                                    <tr style="border: 1px solid;">
                                                        <td style="border: 1px solid;"></td>
                                                        <td style="border: 1px solid;"></td>
                                                        <td style="border: 1px solid;" class="text-end"><?php echo $level4_item->no_iku; ?></td>
                                                        <td style="border: 1px solid;" class="text-end">
                                                            <?php echo $level4_item->isi_iku; ?>
                                                        </td>
                                                        <?php foreach ($years as $year): ?>
                                                            <td style="border: 1px solid;">
                                                                <input type="text"
                                                                    name="target[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control target-input"
                                                                    data-id="<?php echo $level4_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level4"
                                                                    value="<?php echo isset($target_level4[$year]) ? $target_level4[$year] : ''; ?>"
                                                                    placeholder="Isi target">
                                                            </td>
                                                            <td style="border: 1px solid;">
                                                                <?php
                                                                // Reset $capaian_otomatis untuk setiap tahun
                                                                $capaian_otomatis = '';

                                                                // Hitung nilai otomatis hanya jika no_iku sesuai
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
                                                                    // Penyesuaian capaian otomatis berdasarkan nomor IKU
                                                                    if ($level4_item->no_iku === '2.1.3.a.') {
                                                                        $capaian_otomatis = $rata_rata_jurnal_per_tahun[$year]['bereputasi'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.3.b.') {
                                                                        $capaian_otomatis = $rata_rata_jurnal_per_tahun[$year]['internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.3.c.') {
                                                                        $capaian_otomatis = $rata_rata_jurnal_per_tahun[$year]['nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.3.a.') {
                                                                        $capaian_otomatis = $rata_rata_jurnal_pengabdian_per_tahun[$year]['internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.3.b.') {
                                                                        $capaian_otomatis = $rata_rata_jurnal_pengabdian_per_tahun[$year]['nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.5.a.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['luar_negeri'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.5.b.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['dalam_negeri'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.5.c.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['internal'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.4.a.') {
                                                                        $capaian_otomatis = $rata_rata_prosiding_pengabdian_per_tahun[$year]['prosiding_pengabdian_internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.4.b.') {
                                                                        $capaian_otomatis = $rata_rata_prosiding_pengabdian_per_tahun[$year]['prosiding_pengabdian_nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.7.a.') {
                                                                        $capaian_otomatis = $rata_rata_seminar_per_tahun[$year]['internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.1.7.b.') {
                                                                        $capaian_otomatis = $rata_rata_seminar_per_tahun[$year]['nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.2.1.a.') {
                                                                        $capaian_otomatis = $total_dana_penelitian_per_tahun[$year]['internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.2.1.b.') {
                                                                        $capaian_otomatis = $total_dana_penelitian_per_tahun[$year]['nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '2.2.1.c.') {
                                                                        $capaian_otomatis = $total_dana_penelitian_per_tahun[$year]['internal'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.2.a.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['luar_negeri'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.2.b.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['dalam_negeri'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.1.2.c.') {
                                                                        $capaian_otomatis = $rata_rata_penelitian_per_tahun[$year]['internal'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.2.1.a.') {
                                                                        $capaian_otomatis = $total_dana_pengabdian_per_tahun[$year]['internasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.2.1.b.') {
                                                                        $capaian_otomatis = $total_dana_pengabdian_per_tahun[$year]['nasional'] ?? 0;
                                                                    } elseif ($level4_item->no_iku === '3.2.1.c.') {
                                                                        $capaian_otomatis = $total_dana_pengabdian_per_tahun[$year]['internal'] ?? 0;
                                                                    } else {
                                                                        $capaian_otomatis = 0;
                                                                    }
                                                                }
                                                                ?>

                                                                <input type="text"
                                                                    name="capaian[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control capaian-input"
                                                                    data-id="<?php echo $level4_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level4"
                                                                    value="<?php echo isset($capaian_level4[$year]) ? $capaian_level4[$year] : ''; ?>"
                                                                    placeholder="Isi capaian">

                                                                <?php
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
                                                                    if ((isset($capaian_level4[$year]) && !empty($capaian_level4[$year])) || !empty($capaian_otomatis)) {
                                                                        echo "<p>";
                                                                        if (isset($capaian_level4[$year]) && !empty($capaian_level4[$year])) {
                                                                            $value = str_replace(',', '.', $capaian_level4[$year]);
                                                                            $value = floatval($value);
                                                                            // Check if the no_iku matches any of the specified values
                                                                            if ($level4_item->no_iku === '3.2.1.a.' || $level4_item->no_iku === '3.1.3.a.' || $level4_item->no_iku === '3.1.3.b.' || $level4_item->no_iku === '3.1.4.a.' || $level4_item->no_iku === '3.1.4.b.') {
                                                                                echo number_format($value, 0, ',', '.');
                                                                            } else {
                                                                                echo number_format($value, 2, ',', '.');
                                                                            }
                                                                        } elseif (!empty($capaian_otomatis)) {
                                                                            $value = str_replace(',', '.', $capaian_otomatis);
                                                                            $value = floatval($value);
                                                                            // Check if the no_iku matches any of the specified values
                                                                            if ($level4_item->no_iku === '3.2.1.a.' || $level4_item->no_iku === '3.1.3.a.' || $level4_item->no_iku === '3.1.3.b.' || $level4_item->no_iku === '3.1.4.a.' || $level4_item->no_iku === '3.1.4.b.') {
                                                                                echo number_format($value, 0, ',', '.');
                                                                            } else {
                                                                                echo number_format($value, 2, ',', '.');
                                                                            }
                                                                        }
                                                                        echo "</p>";
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
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

    // Add event listener for PDF print button
    $('#cetak-renstra-tahunan').on('click', function(e) {
        var selectedYear = $('#tahun').val();

        if (!selectedYear) {
            e.preventDefault(); // Prevent default link behavior

            // Populate modal with warning message
            $('#responseModalLabel').text('Peringatan');
            $('#responseMessage').html('Silahkan pilih tahun terlebih dahulu sebelum mencetak Renstra tahunan.');
            $('#responseModal').modal('show');
        }
    });

    // Existing year change event listener...
    document.getElementById('tahun').addEventListener('change', function() {
        var selectedYear = this.value;
        var pdfYearlyLink = '<?= base_url('cetak/generate_pdf_renstra_tahunan/') ?>' + selectedYear;
        document.getElementById('cetak-renstra-tahunan').href = pdfYearlyLink;
    });
</script>
