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
                <li class="breadcrumb-item active">Hibah Penelitian EWMP</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Daftar Hibah Penelitian EWMP</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Hibah Penelitian Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 282px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Data Hibah Penelitian</label>
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
                        <div class="row align-end">
                            <div class="col-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Total Hibah Mandiri</td>
                                            <td id="data-mandiri"><?= 'Rp' . number_format($mandiri_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Internal</td>
                                            <td id="data-internal"><?= 'Rp' . number_format($internal_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Nasional</td>
                                            <td id="data-nasional"><?= 'Rp' . number_format($nasional_data, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Hibah Internasional</td>
                                            <td id="data-internasional"><?= 'Rp' . number_format($internasional_data, 0, ',', '.') ?></td>
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
    new DataTable('#datatable');
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Function to fetch international publication data for a specific year
        function fetchPenelitianData(year) {
            return $.ajax({
                url: '<?= base_url("hasil_pelaporan/get_hibah_penelitian_data") ?>', 
                method: 'POST',
                data: { tahun: year },
                dataType: 'json'
            });
        }

        // Function to format currency in Indonesian Rupiah
        function formatRupiah(amount) {
            // Ensure amount is a number
            const numAmount = parseFloat(amount);
            
            // Check if it's a valid number
            if (isNaN(numAmount)) return "-";

            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(numAmount);
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
        function updatePenelitianData(year) {
            fetchPenelitianData(year)
                .done(function(response) {

                    // Update the statistics
                    $('#data-mandiri').text(formatRupiah(response.mandiri_data));
                    $('#data-internal').text(formatRupiah(response.internal_data));
                    $('#data-nasional').text(formatRupiah(response.nasional_data));
                    $('#data-internasional').text(formatRupiah(response.internasional_data));

                    // Update the table
                    const tableBody = $('#datatable tbody');
                    tableBody.empty(); // Clear existing rows

                    response.penelitian.forEach(function(p) {
                        // Prepare authors string
                        let authorsString = p.nama_ketua + ';';
                        if (p.anggota_penelitian && p.anggota_penelitian.length > 0) {
                            authorsString += p.anggota_penelitian.map(ap => ap.nama).join(';');
                        }

                        const row = `
                            <tr>
                                <td class="align-middle">${p.kategori}</td>
                                <td class="align-middle">${authorsString}</td>
                                <td class="align-middle">${p.skim}</td>
                                <td class="align-middle">${p.judul}</td>
                                <td class="align-middle">${formatRupiah(p.besar_hibah)}</td>
                                <td class="align-middle">${formatDateTime(p.ins_time)}</td>
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
                updatePenelitianData(selectedYear);
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