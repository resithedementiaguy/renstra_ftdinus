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
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp/hasil') ?>">Hasil Pelaporan EWMP</a></li>
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
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 282px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Data Publikasi Internasional</label>
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
                            <a href="<?= base_url('hasil_pelaporan') ?>" type="button" class="btn btn-secondary my-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Make sure these script inclusions are in the correct order -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Function to fetch international publication data for a specific year
        function fetchPublicationData(year) {
            return $.ajax({
                url: '<?= base_url("hasil_pelaporan/get_publikasi_internasional_data") ?>', 
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
        function updatePublicationData(year) {
            fetchPublicationData(year)
                .done(function(response) {

                    // Update the table
                    const tableBody = $('#datatable tbody');
                    tableBody.empty(); // Clear existing rows

                    response.pub_internasional.forEach(function(pi) {
                        // Prepare authors string
                        let authorsString = pi.nama_pertama + ';';
                        if (pi.anggota_ilmiah && pi.anggota_ilmiah.length > 0) {
                            authorsString += pi.anggota_ilmiah.map(ai => ai.nama).join(';');
                        }

                        const row = `
                            <tr>
                                <td class="align-middle">${pi.kategori}</td>
                                <td class="align-middle">${authorsString}</td>
                                <td class="align-middle">${pi.judul_artikel}</td>
                                <td class="align-middle">${pi.judul_jurnal}</td>
                                <td class="align-middle">${formatDateTime(pi.ins_time)}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });

                    new DataTable('#datatable');
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
                updatePublicationData(selectedYear);
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