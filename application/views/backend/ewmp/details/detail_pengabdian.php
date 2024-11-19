<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Pelaporan EWMP</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="pt-2"><strong>Daftar Pelaporan EWMP</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek Pelaporan EWMP Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="<?= base_url('ewmp/create_view') ?>" type="button" class="btn btn-warning mb-4">Edit Pelaporan</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width: 100px;">Email</th>
                                    <td style="width: 100px;"><?= htmlspecialchars($pelaporan['email']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Lapor</th>
                                    <td><?= htmlspecialchars($pelaporan['jenis_lapor']) ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu Input</th>
                                    <td><?= formatDateTime($pelaporan['ins_time']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Ketua</th>
                                    <td><?= htmlspecialchars($pengabdian['nama_ketua']) ?></td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
                                    <td><?= htmlspecialchars($pengabdian['prodi']) ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= htmlspecialchars($pengabdian['kategori']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td><?= htmlspecialchars($pengabdian['nama_anggota']) ?></td>
                                </tr>
                                <tr>
                                    <th>Judul Pengabdian</th>
                                    <td><?= htmlspecialchars($pengabdian['judul']) ?></td>
                                </tr>
                                <tr>
                                    <th>Skim Pengabdian</th>
                                    <td><?= htmlspecialchars($pengabdian['skim']) ?></td>
                                </tr>
                                <tr>
                                    <th>Pemberi Hibah</th>
                                    <td><?= htmlspecialchars($pengabdian['pemberi_hibah']) ?></td>
                                </tr>
                                <tr>
                                    <th>Besar Hibah</th>
                                    <td><?= htmlspecialchars($pengabdian['besar_hibah']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Mahasiswa yang Terlibat</th>
                                    <td><?= htmlspecialchars($pengabdian['mahasiswa']) ?></td>
                                </tr>
                                <tr>
                                    <th>File Kontrak pengabdian</th>
                                    <td>
                                        <a href="<?= base_url('./uploads/pengabdian/'. $pengabdian['kontrak'])?>" target="_blank" class="btn btn-danger"><i class="bi bi-file-pdf"></i> PDF</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>File Laporan Maju</th>
                                    <td>
                                        <a href="<?= base_url('./uploads/pengabdian/'. $pengabdian['laporan'])?>" target="_blank" class="btn btn-danger"><i class="bi bi-file-pdf"></i> PDF</a>
                                    </td>
                                </tr>
                            </table>
                            <div class="text-end">
                                <a href="<?= site_url('ewmp') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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