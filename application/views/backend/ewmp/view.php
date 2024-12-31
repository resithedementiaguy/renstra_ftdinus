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
                            <a href="<?= base_url('ewmp/create_view') ?>" type="button" class="btn btn-primary mb-3">Tambah Pelaporan</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 200px;">Jenis Pelaporan</th>
                                        <th class="text-start align-middle" style="width: 200px;">Email</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Pengisian</th>
                                        <th class="text-start align-middle" style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($pelaporan)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data pelaporan</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($pelaporan as $p): ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <?= $p->jenis_lapor ?>
                                                    <?php if (!empty($p->kategori_haki)): ?>
                                                        <?php foreach ($p->kategori_haki as $haki): ?>
                                                            - <?= htmlspecialchars($haki['kategori']) ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle"><?= htmlspecialchars($p->email) ?></td>
                                                <td class="align-middle"><?= formatDateTime($p->ins_time) ?></td>
                                                <td class="align-middle">
                                                    <a href="<?= site_url('ewmp/detail_pelaporan/' . htmlspecialchars($p->id)) ?>" class="btn btn-sm btn-success">
                                                        <i class="bi bi-journal-text"></i> Detail
                                                    </a>
                                                    <a href="<?= site_url('ewmp/delete_pelaporan/' . htmlspecialchars($p->id)) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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
    $(document).ready(function() {
        if ($('#datatable tbody tr').length === 1 && $('#datatable tbody tr td[colspan]').length > 0) {
            // If there's only one row and it's our "no data" message, initialize DataTable with minimal options
            $('#datatable').DataTable({
                paging: false,
                searching: false,
                info: false
            });
        } else {
            // Initialize DataTable normally if we have data
            $('#datatable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                order: [
                    [2, 'desc']
                ] // Sort by Waktu Pengisian column by default
            });
        }
    });
</script>

<?php
// Format Tanggal dan Waktu
function formatDateTime($datetime)
{
    if (empty($datetime)) {
        return "-";
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