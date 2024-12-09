<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tahun</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Tahun Akademik</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek atau menambah Tahun Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('tahun/create_view') ?>" type="button" class="btn btn-primary mb-4">Tambah Tahun</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 50px;">No.</th>
                                        <th class="text-start align-middle" style="width: 50px;">Tahun</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Input</th>
                                        <th class="text-start align-middle" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($tahun as $thn): ?>
                                        <tr>
                                            <td class="align-middle text-start"><?= $no++ ?></td>
                                            <td class="align-middle text-start"><?= htmlspecialchars($thn->tahun) ?></td>
                                            <td class="align-middle"><?= formatDateTime($thn->ins_time) ?></td>
                                            <td class="align-middle">
                                                <a href="<?= site_url('tahun/detail/' . htmlspecialchars($thn->id)) ?>" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-journal-text"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="<?= site_url('tahun/delete/' . $thn->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    new DataTable('#datatable');
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