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
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 282px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Cetak PDF</label>
                                <select class="form-select" name="tahun" id="tahun" required>
                                    <option value="" selected hidden>Pilih Tahun</option>
                                    <?php foreach($tahun as $thn): ?>
                                        <option value="<?= $thn->tahun?>"><?= $thn->tahun?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            
                            <!-- Tombol Tambah dan Cetak -->
                            <div class="d-flex justify-content-between w-100">               
                                <div>                                    
                                    <a href="<?= base_url('cetak/generate_pdf_hasil') ?>" type="button" target="_blank" class="btn btn-danger mb-4"><i class="bi bi-file-pdf"></i> Cetak PDF Hasil Pelaporan EWMP</a>
                                </div>                 
                                <div>
                                    <a href="<?= base_url('cetak/generate_pdf_rekapitulasi') ?>" type="button" target="_blank" class="btn btn-danger mb-4"><i class="bi bi-file-pdf"></i> Cetak PDF Rekapitulasi Penelitian & Pengabdian</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6" style="height: 300px;">
                                <div id="pieChart"></div>
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
                                            <a href="<?= base_url('ewmp/hibah_penelitian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">4</td>
                                        <td>Total Hibah Pengabdian</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/hibah_pengabdian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">5</td>
                                        <td>List Kesesuaian Publikasi per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/kesesuaian_publikasi') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">6</td>
                                        <td>List Kesesuaian Penelitian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/kesesuaian_penelitian') ?>" type="button" class="btn btn-sm btn-success">
                                                <i class="bi bi-journal-text"></i> Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;">7</td>
                                        <td>List Kesesuaian Pengabdian per Program Studi</td>
                                        <td>
                                            <a href="<?= base_url('ewmp/kesesuaian_pengabdian') ?>" type="button" class="btn btn-sm btn-success">
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
<div id="pieChart"></div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Data dari PHP
        var persentaseNasional = <?= json_encode($persentase_nasional) ?>;
        var persentaseInternasional = <?= json_encode($persentase_internasional) ?>;

        // Data untuk ApexCharts
        new ApexCharts(document.querySelector("#pieChart"), {
            series: [persentaseNasional, persentaseInternasional],
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
                        return value.toFixed(2) + '%'; // Menampilkan 2 angka desimal
                    }
                }
            },
            legend: {
                position: 'top' // Menampilkan legend di atas
            }
        }).render();
    });
</script>