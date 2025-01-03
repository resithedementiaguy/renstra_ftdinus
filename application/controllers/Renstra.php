<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renstra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_renstra');
        $this->load->model('Mod_iku');
        $this->load->model('Mod_tahun');
        $this->load->model('Artikel_model');
        $this->load->helper('renstra_helper');

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
        $data['tahun'] = $this->Mod_tahun->get_all_tahun();
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
            $rata_rata_jurnal_per_tahun[$tahun] = hitungRataRataJurnal($tahun, $jumlah_dosen);
            $rata_rata_penelitian_per_tahun[$tahun] = hitungRataPenelitian($tahun, $jumlah_dosen);
            $rata_rata_penelitian_mahasiswa_per_tahun[$tahun] = hitungRataPenelitianMahasiswa($tahun, $jumlah_dosen);
            $rata_rata_seminar_per_tahun[$tahun] = hitungRataSeminar($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_per_tahun[$tahun] = hitungRataPengabdian($tahun, $jumlah_dosen);
            $rata_rata_pengabdian_mahasiswa_per_tahun[$tahun] = hitungRataPengabdianMahasiswa($tahun, $jumlah_mahasiswa);

            $rata_rata_jurnal_pengabdian_per_tahun[$tahun] = hitungRataJurnalPengabdian($tahun, $jumlah_dosen);
            $rata_rata_prosiding_pengabdian_per_tahun[$tahun] = hitungRataProsidingPengabdian($tahun, $jumlah_dosen);

            // Total Dana Penelitian dan Pengabdian per tahun
            $total_dana_penelitian_per_tahun[$tahun] = hitungTotalDanaPenelitian($tahun);
            $total_dana_pengabdian_per_tahun[$tahun] = hitungTotalDanaPengabdian($tahun);

            // Total HAKI per tahun
            $total_haki_per_tahun[$tahun] = hitungTotalHaki($tahun);
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
