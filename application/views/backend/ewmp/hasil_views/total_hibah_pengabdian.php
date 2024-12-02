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
                <li class="breadcrumb-item active">Total Hibah Pengabdian</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Daftar Total Hibah Pengabdian</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Total Hibah Pengabdian Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-header">
                                    <tr>
                                        <th style="width: 50px;">Nama</th>
                                        <th style="width: 200px;">Judul</th>
                                        <th style="width: 50px;">Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_judul = null;
                                    $unique_hibah = []; // Array untuk menyimpan besar hibah unik

                                    foreach ($pengabdian as $index => $item) {
                                        if ($item['judul'] !== $current_judul) {
                                            $current_judul = $item['judul'];
                                            $current_besar_hibah = $item['besar_hibah'];

                                            // Tambahkan besar hibah unik ke array
                                            $unique_hibah[$current_judul] = $current_besar_hibah;

                                            echo "<tr>";
                                            echo "<td>{$item['nama_ketua']}</td>";
                                            echo "<td>{$item['judul']}</td>";
                                            echo "<td style='text-align: right;'>Rp" . number_format($current_besar_hibah, 2, ',', '.') . "</td>";
                                            echo "</tr>";
                                        } else {
                                            echo "<tr>";
                                            echo "<td>{$item['nama_anggota']}</td>";
                                            echo "<td>{$item['judul']}</td>";
                                            echo "<td></td>"; // Kosongkan untuk anggota
                                            echo "</tr>";
                                        }
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="2" style="font-weight: bold; text-align: right;">Total Hibah Internal</td>
                                        <td style="font-weight: bold; text-align: right;">Rp<?= number_format(array_sum($unique_hibah), 2, ',', '.') ?></td>
                                    </tr>
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
    document.addEventListener("DOMContentLoaded", function() {
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
                            label: function(tooltipItem) {
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