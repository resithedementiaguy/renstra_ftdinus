<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Pelaporan EWMP</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Daftar Pelaporan EWMP</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek atau menambah Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('ewmp/create_view') ?>" type="button" class="btn btn-primary mb-4">Tambah Pelaporan</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table">
                                    <tr>
                                        <th class="text-start align-middle" style="width: 200px;">Jenis Pelaporan</th>
                                        <th class="text-start align-middle" style="width: 200px;">Email</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Pengisian</th>
                                        <th class="text-start align-middle" style="width: 200px;"></th>
                                    </tr>
                                </thead>
                                <?php foreach ($pelaporan as $p): ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?= $p->jenis_lapor ?>
                                            </td>
                                            <td>
                                                <?= $p->email ?>
                                            </td>
                                            <td>
                                                <?= $p->ins_time ?>
                                            </td>
                                            <td>
                                                <button type="button" class="badge bg-warning border-0 edit-suntik-btn" data-bs-toggle="modal" data-bs-target="#SuntikModal" data-id="<?= $p->id ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <a class="badge bg-danger border-0 delete-suntik-btn" href="<?= site_url('ewmp/delete_pelaporan/' . $p->id) ?>">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
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
                        $('#responseMessage').text("Target berhasil diperbarui untuk tahun " + year);
                    } else {
                        $('#responseMessage').text("Gagal memperbarui target. Pesan kesalahan: " + (response.message || "Tidak ada detail"));
                    }
                    $('#responseModal').modal('show'); // Tampilkan modal
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
                    $('#responseModal').modal('show'); // Tampilkan modal
                }
            });
        });
    });
</script>