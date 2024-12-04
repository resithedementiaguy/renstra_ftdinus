<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        /* Memusatkan secara horizontal */
        align-items: center;
        /* Memusatkan secara vertikal */
        height: 100%;
        /* Pastikan tinggi kolom tercakup */
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
                        <div class="row mb-4">
                            <div class="col-6" style="height: 300px;">
                                <div id="chartQ"></div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Q1</td>
                                            <td><?= $q1_data ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q2</td>
                                            <td><?= $q2_data ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q3</td>
                                            <td><?= $q3_data ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q4</td>
                                            <td><?= $q4_data ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><?= $total = $q1_data + $q2_data + $q3_data + $q4_data ?></td>
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
                                        <th class="text-start align-middle" style="width: 250px;">Waktu Pengisian</th>
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
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('ewmp/hasil') ?>" type="button" class="btn btn-secondary my-2">Kembali</a>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Data dari PHP
        var q1Data = <?= json_encode($q1_data) ?>;
        var q2Data = <?= json_encode($q2_data) ?>;
        var q3Data = <?= json_encode($q3_data) ?>;
        var q4Data = <?= json_encode($q4_data) ?>;
        var totalData = <?= json_encode($total_data) ?>;

        // Hitung persentase
        var percentages = [
            (q1Data / totalData) * 100,
            (q2Data / totalData) * 100,
            (q3Data / totalData) * 100,
            (q4Data / totalData) * 100,
        ];

        // Data untuk ApexCharts
        new ApexCharts(document.querySelector("#chartQ"), {
            series: percentages,
            chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                    show: true,
                },
            },
            labels: ["Q1", "Q2", "Q3", "Q4"],
            colors: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"],
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toFixed(2) + '%'; // Menampilkan 2 angka desimal
                    },
                },
            },
            legend: {
                position: 'top', // Menampilkan legend di atas
            },
        }).render();
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