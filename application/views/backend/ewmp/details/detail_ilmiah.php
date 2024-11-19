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
                                    <th>Kategori Artikel/Karya Ilmiah</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['kategori']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penulis Pertama</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nama_pertama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penulis Korespondensi</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nama_korespon']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nama_anggota']) ?></td>
                                </tr>
                                <tr>
                                    <th>Judul Artikel</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['judul_artikel']) ?></td>
                                </tr>
                                <tr>
                                    <th>Judul Jurnal</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['judul_jurnal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Link Jurnal</th>
                                    <td>
                                        <a href="<?= $artikel_ilmiah['link_jurnal']?>" target="_blank" class="btn btn-primary"><i class="bi bi-link"></i> Link</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Volume Jurnal</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['volume_jurnal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor Jurnal</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nomor_jurnal']) ?></td>
                                </tr>
                                <tr>
                                    <th>DOI</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['doi']) ?></td>
                                </tr>
                                <?php 
                                $internasional = [
                                    "Internasional Q1", 
                                    "Internasional Q2", 
                                    "Internasional Q3",
                                    "Internasional Q4", 
                                    "Internasional Non Scopus"
                                ];
                                if (in_array($artikel_ilmiah['kategori'], $internasional)) {
                                ?>
                                <tr>
                                    <th>Pengindeks</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['pengindeks']) ?></td>
                                </tr>
                                <?php
                                }
                                ?>
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