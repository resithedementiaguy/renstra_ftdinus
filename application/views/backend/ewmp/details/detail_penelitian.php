<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Detail Penelitian</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Detail Pelaporan EWMP - Penelitian</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek detail pelaporan penelitian Fakultas Teknik UDINUS Semarang
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
                                    <th>Nama Ketua</th>
                                    <td><?= htmlspecialchars($penelitian['nama_ketua']) ?></td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
                                    <td><?= htmlspecialchars($penelitian['prodi']) ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= htmlspecialchars($penelitian['kategori']) ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Anggota</th>
                                    <td>
                                        <?php foreach ($anggota_penelitian as $ap): ?>
                                            <?= $ap->nama ?> - <?= $ap->prodi ?>;
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Judul Penelitian</th>
                                    <td><?= htmlspecialchars($penelitian['judul']) ?></td>
                                </tr>
                                <tr>
                                    <th>Skim Penelitian</th>
                                    <td><?= htmlspecialchars($penelitian['skim']) ?></td>
                                </tr>
                                <tr>
                                    <th>Pemberi Hibah</th>
                                    <td><?= htmlspecialchars($penelitian['pemberi_hibah']) ?></td>
                                </tr>
                                <tr>
                                    <th>Besar Hibah</th>
                                    <td><?= 'Rp' . number_format($penelitian['besar_hibah'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Mahasiswa yang Terlibat</th>
                                    <td>
                                        <?php foreach ($mahasiswa_penelitian as $mp): ?>
                                            <?= $mp->nama ?> (<?= $mp->nim ?>);
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>File Kontrak Penelitian</th>
                                    <td>
                                        <a href="<?= $penelitian['kontrak'] ?>" target="_blank" class="btn btn-danger">
                                            <i class="bi bi-file-pdf"></i> File PDF
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>File Laporan Maju</th>
                                    <td>
                                        <a href="<?= $penelitian['laporan_maju'] ?>" target="_blank" class="btn btn-danger">
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