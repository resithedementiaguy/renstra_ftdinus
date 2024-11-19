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
                            <table class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 200px;">Jenis Pelaporan</th>
                                        <th class="text-start align-middle" style="width: 200px;">Email</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Pengisian</th>
                                        <th class="text-start align-middle" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pelaporan as $p): ?>
                                        <tr>
                                            <td class="align-middle"><?= $p->jenis_lapor ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($p->email) ?></td>
                                            <td class="align-middle"><?= formatDateTime($p->ins_time) ?></td>
                                            <td class="align-middle">
                                                <a href="<?= site_url('ewmp/detail_pelaporan/' . htmlspecialchars($p->id)) ?>" class="btn btn-sm btn-success">
                                                    <i class="bi bi-journal-text"></i> Detail
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning edit-suntik-btn"
                                                    data-bs-toggle="modal" data-bs-target="#SuntikModal"
                                                    data-id="<?= htmlspecialchars($p->id) ?>">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                                <a class="btn btn-sm btn-danger delete-suntik-btn"
                                                    href="<?= site_url('ewmp/delete_pelaporan/' . $p->id) ?>"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelaporan ini?');">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
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

<?php
// Format Tanggal dan Waktu
function formatDateTime($datetime)
{
    if (empty($datetime)) {
        return "-"; // Atau teks lain sesuai kebutuhan
    }

    $date = new DateTime($datetime);
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];
    $day = $date->format('d');
    $month = $months[(int)$date->format('m')];
    $year = $date->format('Y');
    $time = $date->format('H:i:s');

    return "{$day} {$month} {$year}, {$time} WIB";
}
?>