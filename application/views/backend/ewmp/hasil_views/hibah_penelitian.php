<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }

    .chart-container {
        display: flex;
        justify-content: center; /* Memusatkan secara horizontal */
        align-items: center;    /* Memusatkan secara vertikal */
        height: 100%;           /* Pastikan tinggi kolom tercakup */
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Hasil Pelaporan EWMP</li>
                <li class="breadcrumb-item active">Publikasi Internasional EWMP</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Daftar Publikasi Internasional EWMP</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Publikasi Internasional Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Total Hibah Mandiri</td>
                                            <td><?= 'Rp' . number_format($mandiri_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Internal</td>
                                            <td><?= 'Rp' . number_format($internal_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Nasional</td>
                                            <td><?= 'Rp' . number_format($nasional_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Internasional</td>
                                            <td><?= 'Rp' . number_format($internasional_data, 0, ',', '.') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 350px;">Kategori Penelitian</th>
                                        <th class="text-start align-middle" style="width: 350px;">Nama</th>
                                        <th class="text-start align-middle" style="width: 350px;">Skim Penelitian</th>
                                        <th class="text-start align-middle" style="width: 350px;">Judul</th>
                                        <th class="text-start align-middle" style="width: 350px;">Biaya</th>
                                        <th class="text-start align-middle" style="width: 200px;">Waktu Pengisian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penelitian as $p): ?>
                                        <tr>
                                            <td class="align-middle"><?= htmlspecialchars($p->kategori) ?></td>
                                            <td class="align-middle">
                                                <!-- Tamplkan nama ketua -->
                                                <?= htmlspecialchars($p->nama_ketua) ?><br>
                                                <!-- Iterasi anggota penelitian -->
                                                <?php if (!empty($p->anggota_penelitian)): ?>
                                                    <?php foreach ($p->anggota_penelitian as $ai): ?>
                                                        <?= htmlspecialchars($ai->nama) ?><br>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle"><?= $p->skim ?></td>
                                            <td class="align-middle"><?= $p->judul ?></td>
                                            <td class="align-middle"><?= 'Rp' . number_format($p->besar_hibah, 0, ',', '.') ?></td>
                                            <td class="align-middle"><?= formatDateTime($p->ins_time) ?></td>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data dari PHP
        var q1Data = <?= json_encode($q1_data) ?>;
        var q2Data = <?= json_encode($q2_data) ?>;
        var q3Data = <?= json_encode($q3_data) ?>;
        var q4Data = <?= json_encode($q4_data) ?>;

        // Ambil elemen canvas
        var ctx = document.getElementById("chartQ").getContext("2d");

        // Data untuk Chart.js
        var data = {
            labels: ["Q1", "Q2", "Q3", "Q4"],
            datasets: [{
                data: [q1Data, q2Data, q3Data, q4Data],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
                hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"]
            }]
        };

        // Membuat grafik pie
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                var label = data.labels[tooltipItem.dataIndex];
                                var value = data.datasets[0].data[tooltipItem.dataIndex];
                                return label + ': ' + value;
                            }
                        }
                    }
                }
            }
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