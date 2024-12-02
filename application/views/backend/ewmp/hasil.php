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
                <li class="breadcrumb-item active">Hasil Pencapaian</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Pencapaian Fakultas Teknik</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengisi Rencana Strategis Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('renstra/generate_pdf') ?>" type="button" target="_blank" class="btn btn-danger mb-4"><i class="bi bi-file-pdf"></i> Cetak PDF</a>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6" style="height: 300px;">
                                <div class="chart-container">
                                    <canvas id="chartPublikasi" width="400" height="400"></canvas>
                                </div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Internasional</td>
                                            <td><?= $data_internasional ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nasional</td>
                                            <td><?= $data_nasional ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><?= $total = $data_internasional + $data_nasional ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="text-align: start; width: 50px;">No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td>Total Publikasi Internasional</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">2</td>
                                        <td>Total Publikasi Nasional</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_nasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">3</td>
                                        <td>Total Hibah Penelitian</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">4</td>
                                        <td>Total Hibah Pengabdian</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">5</td>
                                        <td>List Kesesuaian Publikasi per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">6</td>
                                        <td>List Kesesuaian Penelitian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">7</td>
                                        <td>List Kesesuaian Pengabdian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    document.addEventListener("DOMContentLoaded", function() {
        // Data dari PHP
        var nasionalData = <?= json_encode($data_nasional) ?>;
        var internasionalData = <?= json_encode($data_internasional) ?>;

        // Ambil elemen canvas
        var ctx = document.getElementById("chartPublikasi").getContext("2d");

        // Data untuk Chart.js
        var data = {
            labels: ["Nasional", "Internasional"],
            datasets: [{
                data: [nasionalData, internasionalData],
                backgroundColor: ["#FF6384", "#36A2EB"],
                hoverBackgroundColor: ["#FF6384", "#36A2EB"]
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
                        position: 'top', // Menampilkan legend di atas
                        labels: {
                            font: {
                                size: 14 // Ukuran font untuk legend
                            }
                        }
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