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
                            <div class="col-6" style="">
                                <div id="chartQ" style=""></div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Q1</td>
                                            <td>22</td>
                                        </tr>
                                        <tr>
                                            <td>Q2</td>
                                            <td>11</td>
                                        </tr>
                                        <tr>
                                            <td>Q3</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Q4</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>33</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-start align-middle" style="width: 350px;">Kategori Publikasi</th>
                                        <th class="text-start align-middle" style="width: 350px;">Nama</th>
                                        <th class="text-start align-middle" style="width: 350px;">Judul Artikel</th>
                                        <th class="text-start align-middle" style="width: 350px;">Judul Jurnal</th>
                                        <th class="text-start align-middle" style="width: 100px;">Waktu Pengisian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pub_internasional as $pi): ?>
                                        <tr>
                                            <td class="align-middle"><?= htmlspecialchars($pi->kategori) ?></td>
                                            <td class="align-middle">
                                                <!-- Tampilkan nama pertama -->
                                                <?= htmlspecialchars($pi->nama_pertama) ?>;
                                                <!-- Iterasi anggota ilmiah -->
                                                <?php if (!empty($pi->anggota_ilmiah)): ?>
                                                    <?php foreach ($pi->anggota_ilmiah as $ai): ?>
                                                        <?= htmlspecialchars($ai->nama) ?>;
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle"><?= $pi->judul_artikel ?></td>
                                            <td class="align-middle"><?= $pi->judul_jurnal ?></td>
                                            <td class="align-middle"><?= formatDateTime($pi->ins_time) ?></td>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data dari PHP untuk chart
        var chartData = <?= json_encode($chart_data) ?>;

        // Pisahkan labels dan values
        var labels = Object.keys(chartData);
        var values = Object.values(chartData);

        // Warna untuk masing-masing kategori
        var colors = [
            '#1E90FF', // Internasional Q1 - Biru
            '#32CD32', // Internasional Q2 - Hijau
            '#FFD700', // Internasional Q3 - Kuning
            '#FF4500', // Internasional Q4 - Oranye
            '#8A2BE2'  // Internasional Non Scopus - Ungu
        ];

        // Konfigurasi ApexCharts
        var options = {
            series: values, // Data untuk grafik
            chart: {
                type: 'pie',
                height: '350px',
            },
            labels: labels, // Label kategori
            colors: colors, // Warna untuk setiap kategori
            legend: {
                position: 'bottom',
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    const name = opts.w.globals.labels[opts.seriesIndex];
                    return name + ': ' + val.toFixed(1) + '%';
                },
            },
        };

        // Render chart
        var chart = new ApexCharts(document.querySelector("#chartQ"), options);
        chart.render();
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