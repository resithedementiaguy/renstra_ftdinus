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
                        <h5><strong>Tabel Rencana Strategi</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengisi Rencana Strategis Fakultas Teknik UDINUS Semarang
                        </div>
                        <a href="<?= base_url('renstra/create_view1') ?>" type="button" class="btn btn-primary mb-4">Tambah Indikator</a>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr class="text-center align-middle">
                                        <th scope="col" rowspan="2" style="width: 50px;">No</th>
                                        <th scope="col" rowspan="2" colspan="2" style="width: 170px;">Butir</th>
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
                                        $level2 = $this->Iku_model->get_level2($level1_item->id);
                                        foreach ($level2 as $level2_item):
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $level2_item->no_iku; ?></td>
                                                <td colspan="8"><?php echo $level2_item->isi_iku; ?></td>
                                            </tr>
                                            <?php
                                            $level3 = $this->Iku_model->get_level3($level2_item->id);
                                            foreach ($level3 as $level3_item):
                                                // Ambil target level 3 berdasarkan ID
                                                $target_level3 = $this->Iku_model->get_target_level3($level3_item->id);
                                            ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $level3_item->no_iku; ?></td>

                                                    <?php if ($level3_item->ket_target === 'Iya'): ?>
                                                        <td><?php echo $level3_item->isi_iku; ?></td>
                                                        <?php for ($year = 2021; $year <= 2026; $year++):
                                                            $value = isset($target_level3[$year]) ? $target_level3[$year] : ''; ?>
                                                            <td>
                                                                <input type="text"
                                                                    name="target[<?php echo $level3_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control target-input"
                                                                    data-id="<?php echo $level3_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level3"
                                                                    value="<?php echo $value; ?>"
                                                                    placeholder="Isi target">
                                                            </td>
                                                        <?php endfor; ?>
                                                    <?php else: ?>
                                                        <td colspan="7"><?php echo $level3_item->isi_iku; ?></td>
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
                                                        <?php for ($year = 2021; $year <= 2026; $year++):
                                                            $value = isset($target_level4[$year]) ? $target_level4[$year] : ''; ?>
                                                            <td>
                                                                <input type="text"
                                                                    name="target[<?php echo $level4_item->id; ?>][<?php echo $year; ?>]"
                                                                    class="form-control target-input"
                                                                    data-id="<?php echo $level4_item->id; ?>"
                                                                    data-year="<?php echo $year; ?>"
                                                                    data-level-type="level4"
                                                                    value="<?php echo $value; ?>"
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
        $('input.target-input').on('change', function() {
            var targetId = $(this).data('id');
            var year = $(this).data('year');
            var value = $(this).val();
            var levelType = $(this).data('level-type');

            $.ajax({
                url: "<?php echo base_url('iku/update_target'); ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    target_id: targetId,
                    year: year,
                    value: value,
                    level_type: levelType
                },
                success: function(response) {
                    console.log(response); // Cek isi response di console
                    if (response.success) {
                        $('#responseMessage').text("Target berhasil diperbarui");
                    } else {
                        $('#responseMessage').text("Gagal memperbarui target");
                    }
                    $('#responseModal').modal('show'); // Tampilkan modal
                },
                error: function(xhr, status, error) {
                    console.error("Status: " + status);
                    console.error("Error: " + error);
                    console.error("Response: " + xhr.responseText);
                    $('#responseMessage').text("Terjadi kesalahan di server. Cek console untuk detail.");
                    $('#responseModal').modal('show'); // Tampilkan modal
                }
            });
        });
    });
</script>