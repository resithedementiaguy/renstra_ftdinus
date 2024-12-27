<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renstra extends CI_Controller
{
    private $formatter;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_renstra');
        $this->load->model('Mod_iku');
        $this->load->model('Mod_tahun');
        $this->load->model('Artikel_model');
        $this->load->helper('custom_helper');
        $this->formatter = new Formatter();

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Cek level user
        $user_level = $this->session->userdata('level');
        if ($user_level != 'Admin' && $user_level != 'Koordinator') {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['level1'] = $this->Mod_iku->get_level1();
        $years = $this->Mod_tahun->getTahunList();
        $data['years'] = array_column($years, 'tahun');

        // Inisialisasi array untuk menyimpan rata-rata per tahun
        $rata_rata_jurnal_per_tahun = [];
        $rata_rata_penelitian_per_tahun = [];
        $rata_rata_penelitian_mahasiswa_per_tahun = [];
        $rata_rata_seminar_per_tahun = [];
        $total_dana_penelitian_per_tahun = [];

        $rata_rata_pengabdian_per_tahun = [];
        $rata_rata_pengabdian_mahasiswa_per_tahun = [];
        $total_dana_pengabdian_per_tahun = [];
        $total_haki_per_tahun = [];

        $rata_rata_jurnal_pengabdian_per_tahun = [];
        $rata_rata_prosiding_pengabdian_per_tahun = [];

        foreach ($data['years'] as $tahun) {
            $dosenData = $this->Artikel_model->getJumlahDosenByYear($tahun);
            $mahasiswaData = $this->Artikel_model->getJumlahMahasiswaByYear($tahun);
            $jumlah_dosen = $dosenData['total_dosen'] ?? 0;
            $jumlah_mahasiswa = $mahasiswaData['total_mahasiswa'] ?? 0;

            // Rata rata per tahun
            $rata_rata_jurnal_per_tahun[$tahun] = $this->hitungRataRataJurnal($tahun, $jumlah_dosen);
            $rata_rata_penelitian_per_tahun[$tahun] = $this->hitungRataPenelitian($tahun, $jumlah_dosen);
            $rata_rata_penelitian_mahasiswa_per_tahun[$tahun] = $this->hitungRataPenelitianMahasiswa($tahun, $jumlah_dosen);
            $rata_rata_seminar_per_tahun[$tahun] = $this->hitungRataSeminar($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_per_tahun[$tahun] = $this->hitungRataPengabdian($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_mahasiswa_per_tahun[$tahun] = $this->hitungRataPengabdianMahasiswa($tahun, $jumlah_mahasiswa);

            $rata_rata_jurnal_pengabdian_per_tahun[$tahun] = $this->hitungRataJurnalPengabdian($tahun, $jumlah_dosen);
            $rata_rata_prosiding_pengabdian_per_tahun[$tahun] = $this->hitungRataProsidingPengabdian($tahun, $jumlah_dosen);

            // Total Dana Penelitian dan Pengabdian per tahun
            $total_dana_penelitian_per_tahun[$tahun] = $this->hitungTotalDanaPenelitian($tahun);
            $total_dana_pengabdian_per_tahun[$tahun] = $this->hitungTotalDanaPengabdian($tahun);

            // Total HAKI per tahun
            $total_haki_per_tahun[$tahun] = $this->hitungTotalHaki($tahun);
        }

        // Menyiapkan data untuk view
        $data['rata_rata_jurnal_per_tahun'] = $rata_rata_jurnal_per_tahun;
        $data['rata_rata_penelitian_per_tahun'] = $rata_rata_penelitian_per_tahun;
        $data['rata_rata_penelitian_mahasiswa_per_tahun'] = $rata_rata_penelitian_mahasiswa_per_tahun;
        $data['rata_rata_seminar_per_tahun'] = $rata_rata_seminar_per_tahun;
        $data['total_dana_penelitian_per_tahun'] = $total_dana_penelitian_per_tahun;
        $data['total_dana_pengabdian_per_tahun'] = $total_dana_pengabdian_per_tahun;
        $data['rata_rata_pengabdian_per_tahun'] = $rata_rata_pengabdian_per_tahun;
        $data['rata_rata_pengabdian_mahasiswa_per_tahun'] = $rata_rata_pengabdian_mahasiswa_per_tahun;
        $data['total_haki_per_tahun'] = $total_haki_per_tahun;
        $data['rata_rata_jurnal_pengabdian_per_tahun'] = $rata_rata_jurnal_pengabdian_per_tahun;
        $data['rata_rata_prosiding_pengabdian_per_tahun'] = $rata_rata_prosiding_pengabdian_per_tahun;

        // Load view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/view', $data);
        $this->load->view('backend/partials/footer');
    }

    private function hitungRataRataJurnal($tahun, $jumlah_dosen)
    {
        $artikelData = $this->Artikel_model->getTotalArtikelByYear($tahun);
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

    private function hitungRataPenelitian($tahun, $jumlah_dosen)
    {
        $penelitianData = $this->Artikel_model->getTotalPenelitianByYear($tahun);
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

    private function hitungRataPenelitianMahasiswa($tahun, $jumlah_dosen)
    {
        $penelitianMhsData = $this->Artikel_model->getTotalPenelitianMhsByYear($tahun);
        $total_penelitian_mahasiswa = $penelitianMhsData[0]['total_penelitian'] ?? 0;
        return $jumlah_dosen > 0 ? $total_penelitian_mahasiswa / $jumlah_dosen : 0;
    }

    private function hitungRataSeminar($tahun, $jumlah_dosen)
    {
        $seminarData = $this->Artikel_model->getTotalSeminarByYear($tahun);
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

    private function hitungTotalDanaPenelitian($tahun)
    {
        $danaPenelitianData = $this->Artikel_model->getTotalDanaPenelitianByYear($tahun);

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
            'internal' => $this->formatter->formatToBillions($total_dana_internal),
            'nasional' => $this->formatter->formatToBillions($total_dana_nasional),
            'internasional' => $this->formatter->formatToBillions($total_dana_internasional),
        ];

        log_message('info', 'Total dana penelitian untuk tahun ' . $tahun . ': ' . json_encode($result));

        return $result;
    }

    private function hitungRataPengabdian($tahun, $jumlah_dosen)
    {
        $pengabdianData = $this->Artikel_model->getTotalPenelitianByYear($tahun);
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

    private function hitungTotalDanaPengabdian($tahun)
    {
        $danaPengabdianData = $this->Artikel_model->getTotalDanaPengabdianByYear($tahun);

        $total_dana_internal = 0;
        $total_dana_nasional = 0;
        $total_dana_internasional = 0;

        if ($danaPengabdianData) {
            foreach ($danaPengabdianData as $row) {
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
            'internal' => $this->formatter->formatToBillions($total_dana_internal),
            'nasional' => $this->formatter->formatToBillions($total_dana_nasional),
            'internasional' => $this->formatter->formatToMillions($total_dana_internasional),
        ];

        log_message('info', 'Total dana pengabdian untuk tahun ' . $tahun . ': ' . json_encode($result));

        return $result;
    }

    private function hitungRataPengabdianMahasiswa($tahun, $jumlah_mahasiswa)
    {
        $pengabdianMhsData = $this->Artikel_model->getTotalPengabdianMhsByYear($tahun);
        $total_pengabdian_mahasiswa = $pengabdianMhsData[0]['total_pengabdian'] ?? 0;
        return $jumlah_mahasiswa > 0 ? $total_pengabdian_mahasiswa / $jumlah_mahasiswa : 0;
    }

    private function hitungTotalHaki($tahun)
    {
        // Ambil data dari masing-masing kategori HAKI berdasarkan tahun
        $haki_paten = $this->Artikel_model->getTotalHakiPatenByYear($tahun);
        $haki_hakcipta = $this->Artikel_model->getTotalHakiCiptaByYear($tahun);
        $haki_merk = $this->Artikel_model->getTotalHakiMerkByYear($tahun);
        $haki_buku = $this->Artikel_model->getTotalHakiBukuByYear($tahun);
        $haki_lisensi = $this->Artikel_model->getTotalHakiLisensiByYear($tahun);
        $haki_desainindustri = $this->Artikel_model->getTotalHakiDesainIndustriByYear($tahun);

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

        // Return data total untuk masing-masing kategori
        return [
            'paten' => $total_haki_paten,
            'hak_cipta' => $total_haki_hakcipta,
            'merk' => $total_haki_merk,
            'buku' => $total_haki_buku,
            'lisensi' => $total_haki_lisensi,
            'desain_industri' => $total_haki_desainindustri,
        ];
    }

    private function hitungRataJurnalPengabdian($tahun)
    {
        $jurnalPengabdianData = $this->Artikel_model->getTotalArtikelPengabdianByYear($tahun);

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

    private function hitungRataProsidingPengabdian($tahun)
    {
        $prosidingPengabdianData = $this->Artikel_model->getTotalProsidingPegabdiannByYear($tahun);
        $total_prosiding_internasional = 0;
        $total_prosiding_nasional = 0;

        if ($prosidingPengabdianData) {
            foreach ($prosidingPengabdianData as $row) {
                if ($row['kategori_jurnal'] === 'Internasional') {
                    $total_prosiding_internasional = $row['total'];
                } elseif ($row['kategori_jurnal'] === 'Nasional') {
                    $total_prosiding_nasional = $row['total'];
                }
            }
        }

        log_message('info', 'Result hitungRataJurnalPengabdian - Internasional: ' . $total_prosiding_internasional);
        log_message('info', 'Result hitungRataJurnalPengabdian - Nasional: ' . $total_prosiding_nasional);

        return [
            'internasional' => $total_prosiding_internasional ?: 0,
            'nasional' => $total_prosiding_nasional ?: 0,
        ];
    }

    public function level2($id_level1)
    {
        $this->load->model('Mod_iku');

        // Get level 2 data for the selected level 1
        $data['level2'] = $this->Mod_iku->get_level2($id_level1);

        $this->load->view('iku_level2_view', $data);
    }

    public function level3($id_level2)
    {
        $this->load->model('Mod_iku');

        // Get level 3 data for the selected level 2
        $data['level3'] = $this->Mod_iku->get_level3($id_level2);

        // Optionally: Get the target for the selected year, for example 2023
        $data['target'] = $this->Mod_iku->get_target_level3($id_level2, 2023);

        // Get the capaian for the selected year, for example 2023
        $data['capaian'] = $this->Mod_iku->get_capaian_level3($id_level2, 2023);

        $this->load->view('iku_level3_view', $data);
    }

    public function level4($id_level3)
    {
        $this->load->model('Mod_iku');

        // Get level 4 data for the selected level 3
        $data['level4'] = $this->Mod_iku->get_level4($id_level3);

        // Optionally: Get the target for the selected year, for example 2023
        $data['target'] = $this->Mod_iku->get_target_level4($id_level3, 2023);

        // Get the capaian for the selected year, for example 2023
        $data['capaian'] = $this->Mod_iku->get_capaian_level4($id_level3, 2023);

        $this->load->view('iku_level4_view', $data);
    }

    public function update_target()
    {
        log_message('debug', 'update_target() called');
        $target_id = $this->input->post('target_id');
        $year = $this->input->post('year');
        $value = $this->input->post('value');
        $level_type = $this->input->post('level_type');

        if (!isset($target_id, $year, $value, $level_type) || $target_id === '' || $year === '' || $level_type === '') {
            log_message('error', 'Data tidak lengkap: target_id=' . $target_id . ', year=' . $year . ', value=' . $value . ', level_type=' . $level_type);
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $this->load->model('Mod_iku');
        $updated = $this->Mod_iku->update_target($target_id, $year, $value, $level_type);

        if ($updated) {
            log_message('debug', 'Update berhasil');
            echo json_encode(['success' => true]);
        } else {
            log_message('error', 'Gagal memperbarui target');
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui target']);
        }
    }

    public function update_capaian()
    {
        log_message('debug', 'update_capaian() called');
        $capaian_id = $this->input->post('capaian_id');
        $year = $this->input->post('year');
        $value = $this->input->post('value');
        $level_type = $this->input->post('level_type');

        if (!isset($capaian_id, $year, $value, $level_type) || $capaian_id === '' || $year === '' || $level_type === '') {
            log_message('error', 'Data tidak lengkap: capaian_id=' . $capaian_id . ', year=' . $year . ', value=' . $value . ', level_type=' . $level_type);
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $this->load->model('Mod_iku');
        $updated = $this->Mod_iku->update_capaian($capaian_id, $year, $value, $level_type);

        if ($updated) {
            log_message('debug', 'Update capaian berhasil');
            echo json_encode(['success' => true]);
        } else {
            log_message('error', 'Gagal memperbarui capaian');
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui capaian']);
        }
    }

    public function create_view1()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level1');
        $this->load->view('backend/partials/footer');
    }

    public function add_level1()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'no_iku' => $this->input->post('no_iku'),
            'isi_iku' => $this->input->post('isi_iku1'),
            'ins_time' => $tgl
        );

        $this->Mod_renstra->add_iku_level1($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('renstra/create_view1');
    }

    public function create_view2()
    {
        $data['iku_level1'] = $this->Mod_renstra->get_iku_level1();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level2', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_level2()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'id_level1' => $this->input->post('id_level1'),
            'no_iku' => $this->input->post('no_iku'),
            'isi_iku' => $this->input->post('isi_iku2'),
            'ins_time' => $tgl
        );

        $this->Mod_renstra->add_iku_level2($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('renstra/create_view2');
    }

    public function create_view3()
    {
        $data['iku_level1'] = $this->Mod_renstra->get_iku_level1();
        $data['iku_level2'] = $this->Mod_renstra->get_iku_level2();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level3', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_level3()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'id_level1' => $this->input->post('id_level1'),
            'id_level2' => $this->input->post('id_level2'),
            'no_iku' => $this->input->post('no_iku'),
            'isi_iku' => $this->input->post('isi_iku3'),
            'ket_target' => $this->input->post('ket_target'),
            'ins_time' => $tgl
        );

        $this->Mod_renstra->add_iku_level3($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('renstra/create_view3');
    }

    public function create_view4()
    {
        $data['iku_level1'] = $this->Mod_renstra->get_iku_level1();
        $data['iku_level2'] = $this->Mod_renstra->get_iku_level2();
        $data['iku_level3'] = $this->Mod_renstra->get_iku_level3();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level4', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add_level4()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'id_level1' => $this->input->post('id_level1'),
            'id_level2' => $this->input->post('id_level2'),
            'id_level3' => $this->input->post('id_level3'),
            'no_iku' => $this->input->post('no_iku'),
            'isi_iku' => $this->input->post('isi_iku4'),
            'ins_time' => $tgl
        );

        $this->Mod_renstra->add_iku_level4($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('renstra/create_view4');
    }

    public function get_level2_by_level1()
    {
        $id_level1 = $this->input->post('id_level1');

        if (!$id_level1) {
            echo json_encode(['error' => 'ID Level 1 tidak ditemukan']);
            return;
        }

        $this->load->model('Mod_renstra');
        $level2_options = $this->Mod_renstra->get_level2_by_level1($id_level1);

        if ($level2_options) {
            echo json_encode($level2_options);
        } else {
            echo json_encode(['error' => 'Data IKU Level 2 tidak ditemukan']);
        }
    }

    public function get_level3_by_level2()
    {
        $id_level2 = $this->input->post('id_level2');
        $this->load->model('Mod_renstra');
        $level3_options = $this->Mod_renstra->get_level3_by_level2($id_level2);
        echo json_encode($level3_options);
    }
}
