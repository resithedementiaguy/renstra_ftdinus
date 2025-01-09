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
                <li class="breadcrumb-item active">Kesesuaian Pengabdian Program Studi</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Daftar Kesesuaian Pengabdian Program Studi</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Kesesuaian Pengabdian Program Studi Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex flex-column">
                            <!-- Select Option -->
                            <div style="width: 400px;" class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun Data Kesesuaian Pengabdian per Program Studi</label>
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
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <h5><strong>Total Hibah Pengabdian Teknik Elektro</strong></h5>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Total Hibah Mandiri</td>
                                                    <td id="data-mandiri-elektro"><?= 'Rp' . number_format($elektro_data['mandiri'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internal</td>
                                                    <td id="data-internal-elektro"><?= 'Rp' . number_format($elektro_data['internal'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Nasional</td>
                                                    <td id="data-nasional-elektro"><?= 'Rp' . number_format($elektro_data['nasional'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internasional</td>
                                                    <td id="data-internasional-elektro"><?= 'Rp' . number_format($elektro_data['internasional'], 0, ',', '.') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="datatable-elektro">
                                        <thead>
                                            <tr>
                                                <th class="text-start align-middle" style="width: 300px;">Kategori Publikasi</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Ketua</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Anggota</th>
                                                <th class="text-start align-middle" style="width: 350px;">Judul Pengabdian</th>
                                                <th class="text-start align-middle" style="width: 350px;">Skim</th>
                                                <th class="text-start align-middle" style="width: 200px;">Biaya</th>
                                                <th class="text-start align-middle" style="width: 500px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_elektro as $elektro): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($elektro->kategori) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($elektro->nama_ketua) ?></td>
                                                    <td class="align-middle">
                                                        <!-- Iterasi anggota penelitian -->
                                                        <?php if (!empty($elektro->anggota_pengabdian)): ?>
                                                            <?php foreach ($elektro->anggota_pengabdian as $anggota): ?>
                                                                <?= htmlspecialchars($anggota->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= htmlspecialchars($elektro->judul) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($elektro->skim) ?></td>
                                                    <td class="align-middle"><?= 'Rp' . number_format($elektro->besar_hibah, 0, ',', '.') ?></td>
                                                    <td class="align-middle">
                                                        <select class="form-select" name="kesesuaian_pengabdian" id="kesesuaian_pengabdian_<?= $elektro->id ?>" onchange="updateKesesuaian(<?= $elektro->id ?>)" required>
                                                            <?php if ($elektro->kesesuaian) { ?>
                                                                <option value="" selected hidden><?= $elektro->kesesuaian ?></option>
                                                            <?php } else { ?>
                                                                <option value="" selected hidden>Pilih Kesesuaian</option>
                                                            <?php } ?>
                                                            <option value="Kurang Sesuai">Kurang Sesuai</option>
                                                            <option value="Sesuai">Sesuai</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="industri" role="tabpanel" aria-labelledby="industri-tab">
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <h5><strong>Total Hibah Pengabdian Teknik Industri</strong></h5>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Total Hibah Mandiri</td>
                                                    <td id="data-mandiri-industri"><?= 'Rp' . number_format($industri_data['mandiri'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internal</td>
                                                    <td id="data-internal-industri"><?= 'Rp' . number_format($industri_data['internal'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Nasional</td>
                                                    <td id="data-nasional-industri"><?= 'Rp' . number_format($industri_data['nasional'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internasional</td>
                                                    <td id="data-internasional-industri"><?= 'Rp' . number_format($industri_data['internasional'], 0, ',', '.') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="datatable-industri">
                                        <thead>
                                            <tr>
                                                <th class="text-start align-middle" style="width: 300px;">Kategori Publikasi</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Ketua</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Anggota</th>
                                                <th class="text-start align-middle" style="width: 350px;">Judul Pengabdian</th>
                                                <th class="text-start align-middle" style="width: 350px;">Skim</th>
                                                <th class="text-start align-middle" style="width: 200px;">Biaya</th>
                                                <th class="text-start align-middle" style="width: 500px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_industri as $industri): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($industri->kategori) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($industri->nama_ketua) ?></td>
                                                    <td class="align-middle">
                                                        <!-- Iterasi anggota penelitian -->
                                                        <?php if (!empty($industri->anggota_pengabdian)): ?>
                                                            <?php foreach ($industri->anggota_pengabdian as $anggota): ?>
                                                                <?= htmlspecialchars($anggota->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= htmlspecialchars($industri->judul) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($industri->skim) ?></td>
                                                    <td class="align-middle"><?= 'Rp' . number_format($industri->besar_hibah, 0, ',', '.') ?></td>
                                                    <td class="align-middle">
                                                        <select class="form-select" name="kesesuaian_pengabdian" id="kesesuaian_pengabdian_<?= $industri->id ?>" onchange="updateKesesuaian(<?= $industri->id ?>)" required>
                                                            <?php if ($industri->kesesuaian) { ?>
                                                                <option value="" selected hidden><?= $industri->kesesuaian ?></option>
                                                            <?php } else { ?>
                                                                <option value="" selected hidden>Pilih Kesesuaian</option>
                                                            <?php } ?>
                                                            <option value="Kurang Sesuai">Kurang Sesuai</option>
                                                            <option value="Sesuai">Sesuai</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="biomedis" role="tabpanel" aria-labelledby="biomedis-tab">
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <h5><strong>Total Hibah Pengabdian Teknik Biomedis</strong></h5>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Total Hibah Mandiri</td>
                                                    <td id="data-mandiri-biomedis"><?= 'Rp' . number_format($biomedis_data['mandiri'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internal</td>
                                                    <td id="data-internal-biomedis"><?= 'Rp' . number_format($biomedis_data['internal'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Nasional</td>
                                                    <td id="data-nasional-biomedis"><?= 'Rp' . number_format($biomedis_data['nasional'], 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Hibah Internasional</td>
                                                    <td id="data-internasional-biomedis"><?= 'Rp' . number_format($biomedis_data['internasional'], 0, ',', '.') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="datatable-biomedis">
                                        <thead>
                                            <tr>
                                                <th class="text-start align-middle" style="width: 300px;">Kategori Publikasi</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Ketua</th>
                                                <th class="text-start align-middle" style="width: 350px;">Nama Anggota</th>
                                                <th class="text-start align-middle" style="width: 350px;">Judul Pengabdian</th>
                                                <th class="text-start align-middle" style="width: 350px;">Skim</th>
                                                <th class="text-start align-middle" style="width: 200px;">Biaya</th>
                                                <th class="text-start align-middle" style="width: 500px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_biomedis as $biomedis): ?>
                                                <tr>
                                                    <td class="align-middle"><?= htmlspecialchars($biomedis->kategori) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($biomedis->nama_ketua) ?></td>
                                                    <td class="align-middle">
                                                        <!-- Iterasi anggota penelitian -->
                                                        <?php if (!empty($biomedis->anggota_pengabdian)): ?>
                                                            <?php foreach ($biomedis->anggota_pengabdian as $anggota): ?>
                                                                <?= htmlspecialchars($anggota->nama) ?>;
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="align-middle"><?= htmlspecialchars($biomedis->judul) ?></td>
                                                    <td class="align-middle"><?= htmlspecialchars($biomedis->skim) ?></td>
                                                    <td class="align-middle"><?= 'Rp' . number_format($biomedis->besar_hibah, 0, ',', '.') ?></td>
                                                    <td class="align-middle">
                                                        <select class="form-select" name="kesesuaian_pengabdian" id="kesesuaian_pengabdian_<?= $biomedis->id ?>" onchange="updateKesesuaian(<?= $biomedis->id ?>)" required>
                                                            <?php if ($biomedis->kesesuaian) { ?>
                                                                <option value="" selected hidden><?= $biomedis->kesesuaian ?></option>
                                                            <?php } else { ?>
                                                                <option value="" selected hidden>Pilih Kesesuaian</option>
                                                            <?php } ?>
                                                            <option value="Kurang Sesuai">Kurang Sesuai</option>
                                                            <option value="Sesuai">Sesuai</option>
                                                        </select>
                                                    </td>
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
                            <a href="<?= base_url('ewmp/hasil') ?>" type="button" class="btn btn-secondary my-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data berhasil diperbarui!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    // new DataTable('#datatable-elektro');
    // new DataTable('#datatable-industri');
    // new DataTable('#datatable-biomedis');
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateKesesuaian(id) {
        const kesesuaian = document.getElementById(`kesesuaian_pengabdian_${id}`).value;

        $.ajax({
            url: '<?= base_url("hasil_pelaporan/update_kesesuaian_pengabdian/") ?>' + id,
            method: 'POST',
            data: {
                kesesuaian_pengabdian: kesesuaian
            },
            success: function(response) {
                if (response === 'success') {
                    $('#successModal').modal('show');
                } else {
                    alert('Terjadi kesalahan saat memperbarui data!');
                }
            },
            error: function() {
                alert('Gagal menghubungi server!');
            }
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        // Store DataTable instances
        let datatables = {
            elektro: null,
            industri: null,
            biomedis: null
        };

        // Initialize datatables with basic configuration
        function initializeDatatables() {
            ['elektro', 'industri', 'biomedis'].forEach(program => {
                datatables[program] = new DataTable(`#datatable-${program}`, {
                    responsive: true,
                    // Remove the external language file dependency
                    language: {
                        "decimal":        "",
                        "emptyTable":     "Tidak ada data yang tersedia",
                        "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 entri",
                        "infoFiltered":   "(difilter dari _MAX_ total entri)",
                        "infoPostFix":    "",
                        "thousands":      ".",
                        "lengthMenu":     "Tampilkan _MENU_ entri",
                        "loadingRecords": "Memuat...",
                        "processing":     "Memproses...",
                        "search":         "Cari:",
                        "zeroRecords":    "Tidak ditemukan data yang sesuai",
                        "paginate": {
                            "first":      "Pertama",
                            "last":       "Terakhir",
                            "next":       "Selanjutnya",
                            "previous":   "Sebelumnya"
                        },
                        "aria": {
                            "sortAscending":  ": aktifkan untuk mengurutkan kolom secara ascending",
                            "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                        }
                    },
                    order: [[0, 'asc']]
                });
            });
        }

        // Rest of your existing code remains the same
        function fetchPengabdianData(year) {
            return $.ajax({
                url: '<?= base_url("hasil_pelaporan/get_kesesuaian_pengabdian_data") ?>', 
                method: 'POST',
                data: { tahun: year },
                dataType: 'json'
            });
        }

        function updatePengabdianData(year) {
            fetchPengabdianData(year)
                .done(function(response) {
                    updateProgramStatistics('elektro', response.elektro_data);
                    updateProgramStatistics('industri', response.industri_data);
                    updateProgramStatistics('biomedis', response.biomedis_data);

                    updateProgramTable('elektro', response.data_elektro);
                    updateProgramTable('industri', response.data_industri);
                    updateProgramTable('biomedis', response.data_biomedis);
                })
                .fail(function(xhr, status, error) {
                    console.error("Error fetching research data:", error);
                    alert("Gagal memuat data pengabdian.");
                });
        }

        function updateProgramStatistics(program, data) {
            $(`#data-mandiri-${program}`).text(formatRupiah(data.mandiri));
            $(`#data-internal-${program}`).text(formatRupiah(data.internal));
            $(`#data-nasional-${program}`).text(formatRupiah(data.nasional));
            $(`#data-internasional-${program}`).text(formatRupiah(data.internasional));
        }

        function updateProgramTable(program, data) {
            if (datatables[program]) {
                datatables[program].destroy();
            }

            const tableBody = $(`#datatable-${program} tbody`);
            tableBody.empty();

            data.forEach(function(item) {
                let anggotaNames = '';
                if (item.anggota_pengabdian && item.anggota_pengabdian.length > 0) {
                    anggotaNames = item.anggota_pengabdian
                        .map(anggota => anggota.nama)
                        .join('; ');
                }

                const selectHtml = `
                    <select class="form-select" name="kesesuaian_pengabdian" 
                            id="kesesuaian_pengabdian_${item.id}" 
                            onchange="updateKesesuaian(${item.id})" required>
                        <option value="" ${!item.kesesuaian ? 'selected' : ''} hidden>
                            ${item.kesesuaian || 'Pilih Kesesuaian'}
                        </option>
                        <option value="Kurang Sesuai" ${item.kesesuaian === 'Kurang Sesuai' ? 'selected' : ''}>
                            Kurang Sesuai
                        </option>
                        <option value="Sesuai" ${item.kesesuaian === 'Sesuai' ? 'selected' : ''}>
                            Sesuai
                        </option>
                    </select>
                `;

                const row = `
                    <tr>
                        <td style="width: 300px;" class="align-middle">${escapeHtml(item.kategori || '-')}</td>
                        <td style="width: 350px;" class="align-middle">${escapeHtml(item.nama_ketua || '-')}</td>
                        <td style="width: 350px;" class="align-middle">${escapeHtml(anggotaNames || '-')}</td>
                        <td style="width: 350px;" class="align-middle">${escapeHtml(item.judul || '-')}</td>
                        <td style="width: 350px;" class="align-middle">${escapeHtml(item.skim || '-')}</td>
                        <td style="width: 200px;" class="align-middle">${formatRupiah(item.besar_hibah)}</td>
                        <td style="width: 500px;" class="align-middle">${selectHtml}</td>
                    </tr>
                `;
                tableBody.append(row);
            });

            // Reinitialize DataTable with the same configuration
            datatables[program] = new DataTable(`#datatable-${program}`, {
                responsive: true,
                language: {
                    "decimal":        "",
                    "emptyTable":     "Tidak ada data yang tersedia",
                    "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered":   "(difilter dari _MAX_ total entri)",
                    "infoPostFix":    "",
                    "thousands":      ".",
                    "lengthMenu":     "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing":     "Memproses...",
                    "search":         "Cari:",
                    "zeroRecords":    "Tidak ditemukan data yang sesuai",
                    "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Selanjutnya",
                        "previous":   "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending":  ": aktifkan untuk mengurutkan kolom secara ascending",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                    }
                },
                order: [[0, 'asc']]
            });
        }

        function formatRupiah(amount) {
            if (!amount || isNaN(amount)) return 'Rp0';
            return 'Rp' + new Intl.NumberFormat('id-ID').format(amount);
        }

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        $('#tahun').on('change', function() {
            const selectedYear = $(this).val();
            if (selectedYear) {
                updatePengabdianData(selectedYear);
            }
        });

        const currentYear = $('#tahun').val();
        if (currentYear) {
            updatePengabdianData(currentYear);
        }

        // Initialize datatables when the page loads
        initializeDatatables();
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