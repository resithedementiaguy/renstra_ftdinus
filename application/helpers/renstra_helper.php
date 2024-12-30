<?php
defined('BASEPATH') or exit('No direct script access allowed');

function hitungRataRataJurnal($tahun, $jumlah_dosen)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $artikelData = $CI->Artikel_model->getTotalArtikelByYear($tahun);
    $kategori = [];
    $total_jurnal_bereputasi = 0;
    $total_jurnal_internasional = 0;
    $total_jurnal_nasional = 0;

    if ($artikelData) {
        foreach ($artikelData as $row) {
            $kategori[$row['kategori']] = $row['total'];
            if (strpos($row['kategori'], 'Internasional') !== false) {
                $total_jurnal_internasional += $row['total'];
            }
            if (strpos($row['kategori'], 'Nasional') !== false) {
                $total_jurnal_nasional += $row['total'];
            }
        }

        foreach (['Internasional Q1', 'Internasional Q2', 'Internasional Q3', 'Internasional Q4'] as $kategori_key) {
            $total_jurnal_bereputasi += $kategori[$kategori_key] ?? 0;
        }
    }

    return [
        'bereputasi' => $jumlah_dosen > 0 ? $total_jurnal_bereputasi / $jumlah_dosen : 0,
        'internasional' => $jumlah_dosen > 0 ? $total_jurnal_internasional / $jumlah_dosen : 0,
        'nasional' => $jumlah_dosen > 0 ? $total_jurnal_nasional / $jumlah_dosen : 0,
    ];
}


function hitungRataPenelitian($tahun, $jumlah_dosen)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $penelitianData = $CI->Artikel_model->getTotalPenelitianByYear($tahun);
    $total_penelitian_internal = 0;
    $total_penelitian_dalam_negeri = 0;
    $total_penelitian_luar_negeri = 0;

    if ($penelitianData) {
        foreach ($penelitianData as $row) {
            $kategori = $row['kategori'];
            $total = $row['total'];
            if (in_array($kategori, ['Mandiri', 'Internal'])) {
                $total_penelitian_internal += $total;
            }
            if ($kategori === 'Nasional') {
                $total_penelitian_dalam_negeri += $total;
            }
            if ($kategori === 'Internasional') {
                $total_penelitian_luar_negeri += $total;
            }
        }
    }

    return [
        'internal' => $jumlah_dosen > 0 ? $total_penelitian_internal / $jumlah_dosen : 0,
        'dalam_negeri' => $jumlah_dosen > 0 ? $total_penelitian_dalam_negeri / $jumlah_dosen : 0,
        'luar_negeri' => $jumlah_dosen > 0 ? $total_penelitian_luar_negeri / $jumlah_dosen : 0,
    ];
}

function hitungRataPenelitianMahasiswa($tahun, $jumlah_dosen)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $penelitianMhsData = $CI->Artikel_model->getTotalPenelitianMhsByYear($tahun);
    $total_penelitian_mahasiswa = $penelitianMhsData[0]['total_penelitian'] ?? 0;
    return $jumlah_dosen > 0 ? $total_penelitian_mahasiswa / $jumlah_dosen : 0;
}

function hitungRataSeminar($tahun, $jumlah_dosen)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $seminarData = $CI->Artikel_model->getTotalSeminarByYear($tahun);
    $total_seminar_internasional = 0;
    $total_seminar_nasional = 0;

    if ($seminarData) {
        foreach ($seminarData as $row) {
            if ($row['kategori'] === 'Internasional') {
                $total_seminar_internasional = $row['total'];
            } elseif ($row['kategori'] === 'Nasional') {
                $total_seminar_nasional = $row['total'];
            }
        }
    }

    return [
        'internasional' => $jumlah_dosen > 0 ? $total_seminar_internasional / $jumlah_dosen : 0,
        'nasional' => $jumlah_dosen > 0 ? $total_seminar_nasional / $jumlah_dosen : 0
    ];
}

function hitungTotalDanaPenelitian($tahun)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $CI->load->library('formatter');
    $danaPenelitianData = $CI->Artikel_model->getTotalDanaPenelitianByYear($tahun);

    $total_dana_internal = 0;
    $total_dana_nasional = 0;
    $total_dana_internasional = 0;

    if ($danaPenelitianData) {
        foreach ($danaPenelitianData as $row) {
            $kategori = $row['kategori'];
            $total_hibah = $row['total_hibah'];

            if (in_array($kategori, ['Mandiri', 'Internal'])) {
                $total_dana_internal += $total_hibah;
            }
            if ($kategori === 'Nasional') {
                $total_dana_nasional += $total_hibah;
            }
            if ($kategori === 'Internasional') {
                $total_dana_internasional += $total_hibah;
            }
        }
    }

    $result = [
        'internal' => $CI->formatter->formatToBillions($total_dana_internal),
        'nasional' => $CI->formatter->formatToBillions($total_dana_nasional),
        'internasional' => $CI->formatter->formatToBillions($total_dana_internasional),
    ];

    // log_message('info', 'Total dana penelitian untuk tahun ' . $tahun . ': ' . json_encode($result));

    return $result;
}

function hitungRataPengabdian($tahun, $jumlah_dosen)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $pengabdianData = $CI->Artikel_model->getTotalPenelitianByYear($tahun);
    $total_pengabdian_internal = 0;
    $total_pengabdian_dalam_negeri = 0;
    $total_pengabdian_luar_negeri = 0;

    if ($pengabdianData) {
        foreach ($pengabdianData as $row) {
            $kategori = $row['kategori'];
            $total = $row['total'];
            if (in_array($kategori, ['Mandiri', 'Internal'])) {
                $total_pengabdian_internal += $total;
            }
            if ($kategori === 'Nasional') {
                $total_pengabdian_dalam_negeri += $total;
            }
            if ($kategori === 'Internasional') {
                $total_pengabdian_luar_negeri += $total;
            }
        }
    }

    return [
        'internal' => $jumlah_dosen > 0 ? $total_pengabdian_internal / $jumlah_dosen : 0,
        'dalam_negeri' => $jumlah_dosen > 0 ? $total_pengabdian_dalam_negeri / $jumlah_dosen : 0,
        'luar_negeri' => $jumlah_dosen > 0 ? $total_pengabdian_luar_negeri / $jumlah_dosen : 0,
    ];
}

function hitungTotalDanaPengabdian($tahun)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $CI->load->library('formatter');
    $danaPengabdianData = $CI->Artikel_model->getTotalDanaPengabdianByYear($tahun);

    // Inisialisasi total dana berdasarkan kategori
    $total_dana_internal = 0;
    $total_dana_nasional = 0;
    $total_dana_internasional = 0;

    // Periksa data yang diterima
    if ($danaPengabdianData) {
        foreach ($danaPengabdianData as $row) {
            $kategori = $row['kategori'];
            $total_hibah = $row['total_hibah'];

            // Penentuan kategori dana
            if (in_array($kategori, ['Mandiri', 'Internal'])) {
                $total_dana_internal += $total_hibah;
            }
            if ($kategori === 'Nasional') {
                $total_dana_nasional += $total_hibah;
            }
            if ($kategori === 'Internasional') {
                $total_dana_internasional += $total_hibah;
            }
        }
    }

    $result = [
        'internal' => $CI->formatter->formatToBillions($total_dana_internal),
        'nasional' => $CI->formatter->formatToBillions($total_dana_nasional),
        'internasional' => $CI->formatter->formatToMillions($total_dana_internasional),
    ];

    // Optional: Uncomment this line if logging is needed
    // log_message('info', 'Total dana pengabdian untuk tahun ' . $tahun . ': ' . json_encode($result));

    return $result;
}

function hitungRataPengabdianMahasiswa($tahun, $jumlah_mahasiswa)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $pengabdianMhsData = $CI->Artikel_model->getTotalPengabdianMhsByYear($tahun);
    $total_pengabdian_mahasiswa = $pengabdianMhsData[0]['total_pengabdian'] ?? 0;
    return $jumlah_mahasiswa > 0 ? $total_pengabdian_mahasiswa / $jumlah_mahasiswa : 0;
}

function hitungTotalHaki($tahun)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    // Ambil data dari masing-masing kategori HAKI berdasarkan tahun
    $haki_paten = $CI->Artikel_model->getTotalHakiPatenByYear($tahun);
    $haki_hakcipta = $CI->Artikel_model->getTotalHakiCiptaByYear($tahun);
    $haki_merk = $CI->Artikel_model->getTotalHakiMerkByYear($tahun);
    $haki_buku = $CI->Artikel_model->getTotalHakiBukuByYear($tahun);
    $haki_lisensi = $CI->Artikel_model->getTotalHakiLisensiByYear($tahun);
    $haki_desainindustri = $CI->Artikel_model->getTotalHakiDesainIndustriByYear($tahun);

    // Inisialisasi total untuk setiap kategori
    $total_haki_paten = 0;
    $total_haki_hakcipta = 0;
    $total_haki_merk = 0;
    $total_haki_buku = 0;
    $total_haki_lisensi = 0;
    $total_haki_desainindustri = 0;

    // Proses data dari setiap kategori HAKI
    foreach ([$haki_paten, $haki_hakcipta, $haki_merk, $haki_buku, $haki_lisensi, $haki_desainindustri] as $hakiData) {
        if ($hakiData) {
            foreach ($hakiData as $row) {
                $kategori = $row['kategori'];
                $total = $row['total'];

                // Console log untuk menampilkan kategori dan totalnya
                log_message('info', "Kategori: " . $kategori . " - Total: " . $total);

                // Menambahkan total sesuai dengan kategori
                switch ($kategori) {
                    case 'Paten':
                        $total_haki_paten += $total;
                        break;
                    case 'Hak Cipta':
                        $total_haki_hakcipta += $total;
                        break;
                    case 'Merk':
                        $total_haki_merk += $total;
                        break;
                    case 'Buku':
                        $total_haki_buku += $total;
                        break;
                    case 'Lisensi':
                        $total_haki_lisensi += $total;
                        break;
                    case 'Desain Industri':
                        $total_haki_desainindustri += $total;
                        break;
                }
            }
        }
    }

    return [
        'paten' => $total_haki_paten,
        'hak_cipta' => $total_haki_hakcipta,
        'merk' => $total_haki_merk,
        'buku' => $total_haki_buku,
        'lisensi' => $total_haki_lisensi,
        'desain_industri' => $total_haki_desainindustri,
    ];
}

function hitungRataJurnalPengabdian($tahun)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $jurnalPengabdianData = $CI->Artikel_model->getTotalArtikelPengabdianByYear($tahun);

    $total_jurnal_internasional = 0;
    $total_jurnal_nasional = 0;
    $total_penelitian_internasional = 0;
    $total_penelitian_nasional = 0;
    $total_pengabdian_internasional = 0;
    $total_pengabdian_nasional = 0;

    // Process the fetched data
    if ($jurnalPengabdianData) {
        foreach ($jurnalPengabdianData as $row) {
            $kategori = trim($row['kategori']);
            $kategori_jurnal = trim($row['kategori_jurnal']);

            // Handle "Penelitian" kategori_jurnal
            if ($kategori_jurnal === 'Penelitian') {
                if (strpos($kategori, 'Q1') !== false || strpos($kategori, 'Q2') !== false || strpos($kategori, 'Q3') !== false || strpos($kategori, 'Q4') !== false) {
                    // Internasional
                    $total_penelitian_internasional = $row['total'];
                } elseif (strpos($kategori, 'Sinta') !== false) {
                    // Nasional Sinta 1-6
                    preg_match('/Sinta (\d+)/', $kategori, $matches);
                    if (isset($matches[1]) && (int)$matches[1] >= 1 && (int)$matches[1] <= 6) {
                        $total_penelitian_nasional = $row['total'];
                    }
                }
            }
            // Handle "Pengabdian" kategori_jurnal
            elseif ($kategori_jurnal === 'Pengabdian') {
                if (strpos($kategori, 'Q1') !== false || strpos($kategori, 'Q2') !== false || strpos($kategori, 'Q3') !== false || strpos($kategori, 'Q4') !== false) {
                    // Internasional
                    $total_pengabdian_internasional = $row['total'];
                } elseif (strpos($kategori, 'Sinta') !== false) {
                    // Nasional Sinta 1-6
                    preg_match('/Sinta (\d+)/', $kategori, $matches);
                    if (isset($matches[1]) && (int)$matches[1] >= 1 && (int)$matches[1] <= 6) {
                        $total_pengabdian_nasional = $row['total'];
                    }
                }
            }
        }
    }

    // Summing up the totals for each category
    $total_jurnal_internasional = $total_penelitian_internasional + $total_pengabdian_internasional;
    $total_jurnal_nasional = $total_penelitian_nasional + $total_pengabdian_nasional;

    return [
        'internasional' =>  $total_jurnal_internasional ?: 0,
        'nasional' =>  $total_jurnal_nasional ?: 0,
    ];
}

function hitungRataProsidingPengabdian($tahun)
{
    $CI = &get_instance();
    $CI->load->model('Artikel_model');
    $prosidingPengabdianData = $CI->Artikel_model->getTotalProsidingPegabdiannByYear($tahun);

    $totals = [
        'internasional_pengabdian' => 0,
        'nasional_pengabdian' => 0,
        'internasional_penelitian' => 0,
        'nasional_penelitian' => 0
    ];

    if ($prosidingPengabdianData) {
        foreach ($prosidingPengabdianData as $row) {
            if ($row['kategori'] === 'Internasional' && $row['kategori_jurnal'] === 'Pengabdian') {
                $totals['internasional_pengabdian'] += $row['total'];
            } elseif ($row['kategori'] === 'Nasional' && $row['kategori_jurnal'] === 'Pengabdian') {
                $totals['nasional_pengabdian'] += $row['total'];
            } elseif ($row['kategori'] === 'Internasional' && $row['kategori_jurnal'] === 'Penelitian') {
                $totals['internasional_penelitian'] += $row['total'];
            } elseif ($row['kategori'] === 'Nasional' && $row['kategori_jurnal'] === 'Penelitian') {
                $totals['nasional_penelitian'] += $row['total'];
            }
        }
    }

    log_message('info', 'Total Rata Prosiding Pengabdian: ' . json_encode($totals));

    // Return separate totals for pengabdian_internasional and penelitian
    return [
        'prosiding_pengabdian_internasional' => $totals['internasional_pengabdian'],
        'prosiding_pengabdian_nasional' => $totals['nasional_pengabdian'],

        'prosiding_penelitian_internasional' => $totals['internasional_penelitian'],
        'prosiding_penelitian_nasional' => $totals['nasional_penelitian'],
    ];
}
