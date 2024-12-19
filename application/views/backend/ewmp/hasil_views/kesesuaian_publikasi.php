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
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp/hasil') ?>">Hasil Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Kesesuaian Publikasi Program Studi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Daftar Kesesuaian Publikasi Program Studi</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Kesesuaian Publikasi Program Studi Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 282px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Data Publikasi per Program Studi</label>
                                <select class="form-select" name="tahun" id="tahun" required>
                                    <option value="" hidden>Pilih Tahun</option>
                                    <?php 
                                    $current_year = date('Y');
                                    foreach ($tahun as $thn): 
                                    ?>
                                        <option value="<?= $thn->tahun ?>" <?= $thn->tahun == $current_year ? 'selected' : '' ?>>
                                            <?= $thn->tahun ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="elektro-tab" data-bs-toggle="tab" data-bs-target="#elektro" type="button" role="tab" aria-controls="elektro" aria-selected="true">Teknik Elektro</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="industri-tab" data-bs-toggle="tab" data-bs-target="#industri" type="button" role="tab" aria-controls="industri" aria-selected="false">Teknik Industri</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="biomedis-tab" data-bs-toggle="tab" data-bs-target="#biomedis" type="button" role="tab" aria-controls="biomedis" aria-selected="false">Teknik Biomedis</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="elektro" role="tabpanel" aria-labelledby="elektro-tab">
                                <div class="table-responsive">
                                    <table class="table" id="datatable-elektro">
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
                                            <?php foreach ($data_elektro as $elektro): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($elektro->kategori) ?></td>
                                                    <td class="align-middle">
                                                        <?= htmlspecialchars($elektro->nama_pertama) ?>;
                                                        <?php if (!empty($elektro->anggota_ilmiah)): ?>
                                                            <?php foreach ($elektro->anggota_ilmiah as $anggota): ?>
                                                                <?= htmlspecialchars($anggota->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= $elektro->judul_artikel ?></td>
                                                    <td class="align-middle"><?= $elektro->judul_jurnal ?></td>
                                                    <td class="align-middle"><?= formatDateTime($elektro->ins_time) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="industri" role="tabpanel" aria-labelledby="industri-tab">
                                <div class="table-responsive">
                                    <table class="table" id="datatable-industri">
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
                                            <?php foreach ($data_industri as $industri): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($industri->kategori) ?></td>
                                                    <td class="align-middle">
                                                        <!-- Tampilkan nama pertama -->
                                                        <?= htmlspecialchars($industri->nama_pertama) ?>;
                                                        <!-- Iterasi anggota ilmiah -->
                                                        <?php if (!empty($industri->anggota_ilmiah)): ?>
                                                            <?php foreach ($industri->anggota_ilmiah as $ai): ?>
                                                                <?= htmlspecialchars($ai->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= $industri->judul_artikel ?></td>
                                                    <td class="align-middle"><?= $industri->judul_jurnal ?></td>
                                                    <td class="align-middle"><?= formatDateTime($industri->ins_time) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="biomedis" role="tabpanel" aria-labelledby="biomedis-tab">
                                <div class="table-responsive">
                                    <table class="table" id="datatable-biomedis">
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
                                            <?php foreach ($data_biomedis as $biomedis): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($biomedis->kategori) ?></td>
                                                    <td class="align-middle">
                                                        <!-- Tampilkan nama pertama -->
                                                        <?= htmlspecialchars($biomedis->nama_pertama) ?>;
                                                        <!-- Iterasi anggota ilmiah -->
                                                        <?php if (!empty($biomedis->anggota_ilmiah)): ?>
                                                            <?php foreach ($biomedis->anggota_ilmiah as $ai): ?>
                                                                <?= htmlspecialchars($ai->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= $biomedis->judul_artikel ?></td>
                                                    <td class="align-middle"><?= $biomedis->judul_jurnal ?></td>
                                                    <td class="align-middle"><?= formatDateTime($biomedis->ins_time) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="<?= base_url('hasil_pelaporan') ?>" type="button" class="btn btn-secondary my-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    new DataTable('#datatable-elektro');
    new DataTable('#datatable-industri');
    new DataTable('#datatable-biomedis');
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Function to fetch international publication data for a specific year
        function fetchPublikasinData(year) {
            return $.ajax({
                url: '<?= base_url("hasil_pelaporan/get_kesesuaian_publikasi_data") ?>', 
                method: 'POST',
                data: { tahun: year },
                dataType: 'json'
            });
        }

        // Function to format date time (matching the PHP function)
        function formatDateTime(datetime) {
            if (!datetime) return "-";

            const date = new Date(datetime);
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            const time = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            return `${day} ${month} ${year}, ${time} WIB`;
        }

        // Function to update the chart and table
        function updatePublikasiData(year) {
            fetchPublikasinData(year)
                .done(function(response) {

                    // Update the table
                    const elektroBody = $('#datatable-elektro tbody');
                    elektroBody.empty(); // Clear existing rows

                    response.data_elektro.forEach(function(elektro) {
                        // Prepare authors string
                        let authorsString = elektro.nama_pertama + ';';
                        if (elektro.anggota_ilmiah && elektro.anggota_ilmiah.length > 0) {
                            authorsString += elektro.anggota_ilmiah.map(ai => ai.nama).join(';');
                        }

                        const row = `
                            <tr>
                                <td class="align-middle">${elektro.kategori}</td>
                                <td class="align-middle">${authorsString}</td>
                                <td class="align-middle">${elektro.judul_artikel}</td>
                                <td class="align-middle">${elektro.judul_jurnal}</td>
                                <td class="align-middle">${formatDateTime(elektro.ins_time)}</td>
                            </tr>
                        `;
                        elektroBody.append(row);
                    });

                    new DataTable('#datatable-elektro');

                    // Update the table
                    const industriBody = $('#datatable-industri tbody');
                    industriBody.empty(); // Clear existing rows

                    response.data_industri.forEach(function(industri) {
                        // Prepare authors string
                        let authorsString = industri.nama_pertama + ';';
                        if (industri.anggota_ilmiah && industri.anggota_ilmiah.length > 0) {
                            authorsString += industri.anggota_ilmiah.map(ai => ai.nama).join(';');
                        }

                        const row = `
                            <tr>
                                <td class="align-middle">${industri.kategori}</td>
                                <td class="align-middle">${authorsString}</td>
                                <td class="align-middle">${industri.judul_artikel}</td>
                                <td class="align-middle">${industri.judul_jurnal}</td>
                                <td class="align-middle">${formatDateTime(industri.ins_time)}</td>
                            </tr>
                        `;
                        industriBody.append(row);
                    });

                    new DataTable('#datatable-industri');

                    // Update the table
                    const biomedisBody = $('#datatable-biomedis tbody');
                    biomedisBody.empty(); // Clear existing rows

                    response.data_biomedis.forEach(function(biomedis) {
                        // Prepare authors string
                        let authorsString = biomedis.nama_pertama + ';';
                        if (biomedis.anggota_ilmiah && biomedis.anggota_ilmiah.length > 0) { 
                            authorsString += biomedis.anggota_ilmiah.map(ai => ai.nama).join(';');
                        }

                        const row = `
                            <tr>
                                <td class="align-middle">${biomedis.kategori}</td>
                                <td class="align-middle">${authorsString}</td>
                                <td class="align-middle">${biomedis.judul_artikel}</td>
                                <td class="align-middle">${biomedis.judul_jurnal}</td>
                                <td class="align-middle">${formatDateTime(biomedis.ins_time)}</td>
                            </tr>
                        `;
                        biomedisBody.append(row);
                    });

                    new DataTable('#datatable-biomedis');
                })
                .fail(function(xhr, status, error) {
                    console.error("Error fetching publication data:", error);

                    // Optionally show an error message
                    alert("Gagal memuat data publikasi internasional.");
                });
        }

        // Event listener for year selection
        $('#tahun').on('change', function() {
            const selectedYear = $(this).val();
            if (selectedYear) {
                updatePublikasiData(selectedYear);
            }
        });

        /// Optional: Trigger initial load with first available year
        const firstYear = <?= $current_year?>;
        if (firstYear) {
            $('#tahun').val(firstYear).trigger('change');
        }
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