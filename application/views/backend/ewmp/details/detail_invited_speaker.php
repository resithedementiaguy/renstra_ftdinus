<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Pelaporan EWMP</li>
                <li class="breadcrumb-item active">Detail Invited Speaker</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Detail Pelaporan EWMP - Invited Speaker</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek detail pelaporan Invited Speaker Fakultas Teknik UDINUS Semarang
                        </div>
                        <!-- <div class="d-flex justify-content-between">
                            <a href="<?= base_url('ewmp/create_view') ?>" type="button" class="btn btn-warning mb-4"><i class="bi bi-pencil"></i> <strong>Edit Pelaporan</strong></a>
                        </div> -->
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
                                    <th>Nama Pengusul</th>
                                    <td><?= htmlspecialchars($invited_speaker['nama_usul']) ?></td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
                                    <td><?= htmlspecialchars($invited_speaker['prodi']) ?></td>
                                </tr>
                                <tr>
                                    <th>Judul Kegiatan</th>
                                    <td><?= htmlspecialchars($invited_speaker['judul']) ?></td>
                                </tr>
                                <tr>
                                    <th>Penyelenggara</th>
                                    <td><?= htmlspecialchars($invited_speaker['penyelenggara']) ?></td>
                                </tr>
                                <tr>
                                    <th>Undangan, Sertifikat, dan Bukti Telah Menyelesaikan Kegiatan (Dijadikan 1 Dokumen)</th>
                                    <td>
                                        <a href="<?= $invited_speaker['dokumen'] ?>" target="_blank" class="btn btn-danger">
                                            <i class="bi bi-file-pdf"></i> File PDF
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="<?= site_url('ewmp') ?>" class="btn btn-secondary">Kembali</a>
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