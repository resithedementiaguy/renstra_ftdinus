<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Detail Artikel/Karya Ilmiah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Detail Pelaporan EWMP - Artikel/Karya Ilmiah</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek detail pelaporan karya Artikel/Karya Ilmiah Fakultas Teknik UDINUS Semarang
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('ewmp/edit_pelaporan/' . $pelaporan['id']) ?>" type="button" class="btn btn-warning mb-4">
                                <i class="bi bi-pencil"></i> <strong>Edit Artikel Ilmiah</strong>
                            </a>
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
                                    <th>Kategori Jurnal</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['kategori_jurnal']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penulis Pertama</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nama_pertama']) ?></td>
                                </tr>
                                <tr>
                                    <th>Program Studi Penulis Pertama</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['prodi']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Penulis Korespondensi</th>
                                    <td><?= htmlspecialchars($artikel_ilmiah['nama_korespon']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td>
                                        <?php foreach ($anggota_ilmiah as $ai): ?>
                                            <?= $ai->nama ?> - <?= $ai->prodi ?>;
                                        <?php endforeach; ?>
                                    </td>
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
                                        <a href="<?= $artikel_ilmiah['link_jurnal'] ?>" target="_blank" class="btn btn-primary"><i class="bi bi-link"></i> Link</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama Mahasiswa yang Terlibat</th>
                                    <td>
                                        <?php foreach ($mahasiswa_ilmiah as $mi): ?>
                                            <?= $mi->nama ?> (<?= $mi->nim ?>);
                                        <?php endforeach; ?>
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