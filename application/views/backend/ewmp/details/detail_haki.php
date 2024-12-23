<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('ewmp') ?>">Pelaporan EWMP</a></li>
                <li class="breadcrumb-item active">Detail HAKI</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="pt-2"><strong>Detail Pelaporan EWMP - HAKI</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Silahkan untuk mengecek detail Pelaporan HAKI Fakultas Teknik UDINUS Semarang
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
                                    <th>Kategori HAKI</th>
                                    <td><?= htmlspecialchars($haki['kategori']) ?></td>
                                </tr>
                                <?php
                                if ($haki['kategori'] == "Hak Cipta") {
                                ?>
                                    <tr>
                                        <th>Nama Pengusul</th>
                                        <td><?= htmlspecialchars($haki_hcipta['nama_usul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemegang Hak Cipta</th>
                                        <td>
                                            <?php foreach ($pemegang_hcipta as $ph): ?>
                                                <?= $ph->nama ?>;
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul Hak Cipta</th>
                                        <td><?= htmlspecialchars($haki_hcipta['judul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Hak Cipta</th>
                                        <td>
                                            <a href="<?= $haki_hcipta['sertifikat'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } elseif ($haki['kategori'] == "Merk") {
                                ?>
                                    <tr>
                                        <th>Nama Pengusul</th>
                                        <td><?= htmlspecialchars($haki_merk['nama_usul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemegang Merk</th>
                                        <td>
                                            <?php foreach ($pemegang_merk as $pm): ?>
                                                <?= $pm->nama ?>;
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul Merk</th>
                                        <td><?= htmlspecialchars($haki_merk['judul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Merk</th>
                                        <td>
                                            <a href="<?= $haki_merk['sertifikat'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } elseif ($haki['kategori'] == "Lisensi") {
                                ?>
                                    <tr>
                                        <th>Nama Pengusul</th>
                                        <td><?= htmlspecialchars($haki_lisensi['nama_usul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemegang Lisensi</th>
                                        <td>
                                            <?php foreach ($pemegang_lisensi as $pl): ?>
                                                <?= $pl->nama ?>;
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul Lisensi</th>
                                        <td><?= htmlspecialchars($haki_lisensi['judul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Lisensi</th>
                                        <td>
                                            <a href="<?= $haki_lisensi['sertifikat'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } elseif ($haki['kategori'] == "Buku") {
                                ?>
                                    <tr>
                                        <th>Nama Pengusul</th>
                                        <td><?= htmlspecialchars($haki_buku['nama_usul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>ISBN Buku</th>
                                        <td><?= htmlspecialchars($haki_buku['isbn']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <td><?= htmlspecialchars($haki_buku['judul_buku']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>File Buku</th>
                                        <td>
                                            <a href="<?= $haki_buku['file_buku'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } elseif ($haki['kategori'] == "Paten") {
                                ?>
                                    <tr>
                                        <th>Nama Inventor</th>
                                        <td>
                                            <?php foreach ($pemegang_paten as $pp): ?>
                                                <?= $pp->nama ?>;
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Judul Invensi</th>
                                        <td><?= htmlspecialchars($haki_paten['judul']) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Paten</th>
                                        <td>
                                            <a href="<?= $haki_paten['sertifikat'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } elseif ($haki['kategori'] == "Desain Industri") {
                                ?>
                                    <tr>
                                        <th>Nama Pengusul</th>
                                        <td>
                                            <?php foreach ($pemegang_dindustri as $pd): ?>
                                                <?= $pd->nama ?>;
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Desain Industri</th>
                                        <td>
                                            <a href="<?= $haki_dindustri['sertifikat'] ?>" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf"></i> File PDF
                                            </a>
                                        </td>
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