<style>
    div.dt-container select.dt-input {
        margin-right: 8px;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
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
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 282px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Cetak PDF dan Tahun Grafik</label>
                                <select class="form-select" name="tahun" id="tahun" required>
                                    <option value="" hidden>Pilih Tahun</option>
                                    <?php 
                                    $current_year = date('Y');
                                    foreach ($tahun as $thn): 
                                    ?>
                                        <option value="<?= $thn->tahun ?>">
                                            <?= $thn->tahun ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tombol Tambah dan Cetak -->
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <a id="cetak-hasil" href="#" target="_blank" class="btn btn-danger mb-4">
                                        <i class="bi bi-file-pdf"></i> Cetak PDF Hasil Pelaporan EWMP
                                    </a>
                                </div>
                                <div>
                                    <a id="cetak-rekapitulasi" href="#" target="_blank" class="btn btn-danger mb-4">
                                        <i class="bi bi-file-pdf"></i> Cetak PDF Rekapitulasi Penelitian & Pengabdian
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 style="text-align: center;">Grafik Publikasi Internasional & Nasional</h4>
                        <div class="row mb-3">
                            <div class="col-6" style="height: 300px;">
                                <div id="chart-publikasi"></div>
                            </div>
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Internasional</td>
                                            <td id="data-internasional"><?= $data_internasional ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nasional</td>
                                            <td id="data-nasional"><?= $data_nasional ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="data-total-publikasi"><?= ($data_internasional ?? 0) + ($data_nasional ?? 0) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row mb-3">
                            <div class="col-6" style="text-align: center;">
                                <h4>Grafik Publikasi Internasional</h4>
                            </div>
                            <div class="col-6" style="text-align: center;">
                                <h4>Grafik Publikasi Nasional</h4>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3" style="height: 300px;">
                                <div id="chart-internasional"></div>
                            </div>
                            <div class="col-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 120px;">Q1</td>
                                            <td id="data-q1" style="width: 50px;"><?= $q1_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q2</td>
                                            <td id="data-q2"><?= $q2_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q3</td>
                                            <td id="data-q3"><?= $q3_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Q4</td>
                                            <td id="data-q4"><?= $q4_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="data-total-internasional"><?= ($q1_data ?? 0) + ($q2_data ?? 0) + ($q3_data ?? 0) + ($q4_data ?? 0) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3" style="height: 300px;">
                                <div id="chart-nasional"></div>
                            </div>
                            <div class="col-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 180px;">S1</td>
                                            <td id="data-s1"><?= $s1_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>S2</td>
                                            <td id="data-s2"><?= $s2_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>S3</td>
                                            <td id="data-s3"><?= $s3_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>S4</td>
                                            <td id="data-s4"><?= $s4_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>S5</td>
                                            <td id="data-s5"><?= $s5_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>S6</td>
                                            <td id="data-s6"><?= $s6_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nasional Tidak Terakreditasi</td>
                                            <td id="data-tdk-terakreditasi"><?= $tdk_terakreditasi_data ?? 0 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="data-total-nasional"><?= ($s1_data ?? 0) + ($s2_data ?? 0) + ($s3_data ?? 0) + ($s4_data ?? 0) + ($s5_data ?? 0) + ($s6_data ?? 0) + ($tdk_terakreditasi_data ?? 0) ?></td>
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
                                            <a href="<?= base_url('hasil_pelaporan/publikasi_internasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">2</td>
                                        <td>Total Publikasi Nasional</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/publikasi_nasional') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">3</td>
                                        <td>Total Hibah Penelitian</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/hibah_penelitian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">4</td>
                                        <td>Total Hibah Pengabdian</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/hibah_pengabdian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">5</td>
                                        <td>List Kesesuaian Publikasi per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/kesesuaian_publikasi') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">6</td>
                                        <td>List Kesesuaian Penelitian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/kesesuaian_penelitian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">7</td>
                                        <td>List Kesesuaian Pengabdian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('hasil_pelaporan/kesesuaian_pengabdian') ?>" type="button" class="btn btn-sm btn-success">
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

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="responseMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Global variable to store the chart instance
    let publicationChart = null;
    let publicationInternasionalChart = null;
    let publicationNasionalChart = null;

    document.addEventListener("DOMContentLoaded", () => {
        // Function to fetch publication data for a specific year
        function fetchPublicationData(year) {
            return $.ajax({
                url: '<?= base_url('hasil_pelaporan/get_publikasi_data') ?>', // You'll need to create this route
                method: 'POST',
                data: { tahun: year },
                dataType: 'json'
            });
        }

        // Function to update the chart and statistics
        function updatePublicationChart(year) {
            fetchPublicationData(year)
                .done(function(response) {
                    // Update the table statistics
                    $('#data-internasional').text(response.data_internasional);
                    $('#data-nasional').text(response.data_nasional);
                    $('#data-total-publikasi').text(response.total_publikasi);

                    // Update or render the pie chart
                    const chartOptions = {
                        series: [response.persentase_nasional, response.persentase_internasional],
                        chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                                show: true
                            }
                        },
                        labels: ['Nasional', 'Internasional'],
                        colors: ["#FF6384", "#36A2EB"],
                        tooltip: {
                            y: {
                                formatter: function(value) {
                                    return value.toFixed(2) + '%';
                                }
                            }
                        },
                        legend: {
                            position: 'top'
                        }
                    };

                    // Destroy existing chart if it exists
                    if (publicationChart) {
                        publicationChart.destroy();
                    }

                    // Create new chart
                    publicationChart = new ApexCharts(document.querySelector("#chart-publikasi"), chartOptions);
                    publicationChart.render();

                    // Update the statistics
                    $('#data-q1').text(response.q1_data);
                    $('#data-q2').text(response.q2_data);
                    $('#data-q3').text(response.q3_data);
                    $('#data-q4').text(response.q4_data);
                    $('#data-total-internasional').text(response.total_internasional);

                    // Render new chart
                    const internasionalChart = {
                        series: [response.persentase_q1, response.persentase_q2,response.persentase_q3,response.persentase_q4],
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
                                    return value.toFixed(2) + '%';
                                },
                            },
                        },
                        legend: {
                            position: 'top',
                        }
                    };

                    // Destroy existing chart if it exists
                    if (publicationInternasionalChart) {
                        publicationInternasionalChart.destroy();
                    }

                    // Create and render the chart
                    publicationInternasionalChart = new ApexCharts(document.querySelector("#chart-internasional"), internasionalChart);
                    publicationInternasionalChart.render();

                    // Update the statistics
                    $('#data-s1').text(response.s1_data);
                    $('#data-s2').text(response.s2_data);
                    $('#data-s3').text(response.s3_data);
                    $('#data-s4').text(response.s4_data);
                    $('#data-s5').text(response.s5_data);
                    $('#data-s6').text(response.s6_data);
                    $('#data-tdk-terakreditasi').text(response.tdk_terakreditasi_data);
                    $('#data-total-nasional').text(response.total_nasional);

                    // Render new chart
                    const nasionalChart = {
                        series: [response.persentase_s1, response.persentase_s2,response.persentase_s3,response.persentase_s4,response.persentase_s5,response.persentase_s6,response.persentase_tdk_terakreditasi],
                        chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                                show: true,
                            },
                        },
                        labels: ["S1", "S2", "S3", "S4", "S5", "S6", "Tidak Terakreditasi"],
                        colors: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#9966FF",
                            "#FF9F40",
                            "#E0E0E0",
                        ],
                        tooltip: {
                            y: {
                                formatter: function(value) {
                                    return value.toFixed(2) + '%';
                                },
                            },
                        },
                        legend: {
                            position: 'top',
                        }
                    };

                    // Destroy existing chart if it exists
                    if (publicationNasionalChart) {
                        publicationNasionalChart.destroy();
                    }

                    // Create and render the chart
                    publicationNasionalChart = new ApexCharts(document.querySelector("#chart-nasional"), nasionalChart);
                    publicationNasionalChart.render();
                })
                .fail(function(xhr, status, error) {
                    console.error("Error fetching publication data:", error);
                    
                    // Show error modal
                    $('#responseModalLabel').text('Error');
                    $('#responseMessage').html('Gagal mengambil data publikasi. Silakan coba lagi.');
                    $('#responseModal').modal('show');
                });
        }

        // Event listener for year selection
        $('#tahun').on('change', function() {
            const selectedYear = $(this).val();
            if (selectedYear) {
                updatePublicationChart(selectedYear);
            }
        });
    });

    // Event listener untuk tombol cetak PDF Rekapitulasi
    $('#cetak-rekapitulasi').on('click', function(e) {
        var selectedYear = $('#tahun').val();

        if (!selectedYear) {
            e.preventDefault(); // Mencegah aksi default tombol

            // Menampilkan modal dengan pesan peringatan
            $('#responseModalLabel').text('Peringatan');
            $('#responseMessage').html('Silahkan pilih tahun terlebih dahulu sebelum mencetak Rekapitulasi Penelitian & Pengabdian.');
            $('#responseModal').modal('show');
        }
    });

    // Event listener untuk tombol cetak PDF Rekapitulasi
    $('#cetak-hasil').on('click', function(e) {
        var selectedYear = $('#tahun').val();

        if (!selectedYear) {
            e.preventDefault(); // Mencegah aksi default tombol

            // Menampilkan modal dengan pesan peringatan
            $('#responseModalLabel').text('Peringatan');
            $('#responseMessage').html('Silahkan pilih tahun terlebih dahulu sebelum mencetak Hasil Pelaporan EWMP.');
            $('#responseModal').modal('show');
        }
    });

    // Event listener untuk mengubah URL tombol cetak saat tahun dipilih
    document.getElementById('tahun').addEventListener('change', function() {
        var selectedYear = this.value;
        var rekapitulasiLink = '<?= base_url('cetak/generate_pdf_rekapitulasi/') ?>' + selectedYear;
        document.getElementById('cetak-rekapitulasi').setAttribute('href', rekapitulasiLink);
        var hasilLink = '<?= base_url('cetak/generate_pdf_hasil/') ?>' + selectedYear;
        document.getElementById('cetak-hasil').setAttribute('href', hasilLink);
    });
</script>