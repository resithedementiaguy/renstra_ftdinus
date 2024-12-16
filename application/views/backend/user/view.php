<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Daftar User</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Daftar User</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengelola user sistem renstra Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 200px;">Nama</th>
                                        <th class="text-start align-middle" style="width: 200px;">Username atau NPP</th>
                                        <th class="text-start align-middle" style="width: 200px;">Level User</th>
                                        <th class="text-start align-middle" style="width: 150px;">Waktu Pengisian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td class="align-middle"><?= $u->nama ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($u->username) ?></td>
                                            <td class="align-middle">
                                                <select class="form-select" name="level" id="level_<?= $u->id ?>" onchange="updateLevel(<?= $u->id ?>)" required>
                                                    <option value="" selected hidden><?= $u->level ?></option>
                                                    <option value="Dosen">Dosen</option>
                                                    <option value="Koordinator">Koordinator</option>
                                                    <option value="Admin">Admin</option>
                                                </select>
                                            </td>
                                            <td class="align-middle"><?= formatDateTime($u->ins_time) ?></td>
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

<!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Level user berhasil diperbarui!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    new DataTable('#datatable');
</script>

<script>
    function updateLevel(id) {
        const level = document.getElementById(`level_${id}`).value;

        $.ajax({
            url: '<?= base_url("user/update_level/") ?>' + id,
            method: 'POST',
            data: {
                level: level
            },
            success: function(response) {
                if (response === 'success') {
                    $('#successModal').modal('show');
                } else {
                    alert('Terjadi kesalahan saat memperbarui data!');
                }
            },
            error: function() {
                alert('Gagal menghubungi server!');
            }
        });
    }
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