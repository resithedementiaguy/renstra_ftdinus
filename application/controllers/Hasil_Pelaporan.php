<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Hasil_pelaporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
        $this->load->model('Mod_tahun');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $current_year = date('Y');

        $data['data_internasional'] = $this->Ewmp_model->count_publikasi_internasional_data($current_year);
        $data['data_nasional'] = $this->Ewmp_model->count_publikasi_nasional_data($current_year);

        // Hitung total data
        $data['total'] = $data['data_nasional'] + $data['data_internasional'];

        $data['q1_data'] = $this->Ewmp_model->count_q1_data($current_year);
        $data['q2_data'] = $this->Ewmp_model->count_q2_data($current_year);
        $data['q3_data'] = $this->Ewmp_model->count_q3_data($current_year);
        $data['q4_data'] = $this->Ewmp_model->count_q4_data($current_year);

        // Hitung total data
        $data['total_internasional'] = $data['q1_data'] + $data['q2_data'] + $data['q3_data'] + $data['q4_data'];

        // Data publikasi
        $data['s1_data'] = $this->Ewmp_model->count_s1_data($current_year);
        $data['s2_data'] = $this->Ewmp_model->count_s2_data($current_year);
        $data['s3_data'] = $this->Ewmp_model->count_s3_data($current_year);
        $data['s4_data'] = $this->Ewmp_model->count_s4_data($current_year);
        $data['s5_data'] = $this->Ewmp_model->count_s5_data($current_year);
        $data['s6_data'] = $this->Ewmp_model->count_s6_data($current_year);
        $data['tdk_terakreditasi_data'] = $this->Ewmp_model->count_tidak_terakreditasi_data($current_year);

        // Hitung total data
        $data['total_nasional'] = $data['s1_data'] + $data['s2_data'] + $data['s3_data'] + $data['s4_data'] + $data['s5_data'] + $data['s6_data'] + $data['tdk_terakreditasi_data'];

        // Hitung persentase
        if ($data['total'] > 0) { // Hindari pembagian dengan nol
            $data['persentase_nasional'] = ($data['data_nasional'] / $data['total']) * 100;
            $data['persentase_internasional'] = ($data['data_internasional'] / $data['total']) * 100;
        } else {
            $data['persentase_nasional'] = 0;
            $data['persentase_internasional'] = 0;
        }

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Kirim data ke view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_publikasi_data()
    {
        // Get the year from POST request
        $tahun = $this->input->post('tahun');

        // Fetch data for the specific year (you'll need to modify your model)
        $data_internasional = $this->Ewmp_model->count_publikasi_internasional_data($tahun);
        $data_nasional = $this->Ewmp_model->count_publikasi_nasional_data($tahun);

        // Calculate total and percentages
        $total_publikasi = $data_nasional + $data_internasional;

        $persentase_nasional = $total_publikasi > 0 ? ($data_nasional / $total_publikasi) * 100 : 0;
        $persentase_internasional = $total_publikasi > 0 ? ($data_internasional / $total_publikasi) * 100 : 0;

        $q1_data=$this->Ewmp_model->count_q1_data($tahun);
        $q2_data=$this->Ewmp_model->count_q2_data($tahun);
        $q3_data=$this->Ewmp_model->count_q3_data($tahun);
        $q4_data=$this->Ewmp_model->count_q4_data($tahun);

        $total_internasional=$q1_data+$q2_data+$q3_data+$q4_data;

        $persentase_q1=$total_internasional > 0 ? ($q1_data / $total_internasional) * 100 : 0;
        $persentase_q2=$total_internasional > 0 ? ($q2_data / $total_internasional) * 100 : 0;
        $persentase_q3=$total_internasional > 0 ? ($q3_data / $total_internasional) * 100 : 0;
        $persentase_q4=$total_internasional > 0 ? ($q4_data / $total_internasional) * 100 : 0;

        // Data publikasi
        $s1_data = $this->Ewmp_model->count_s1_data($tahun);
        $s2_data = $this->Ewmp_model->count_s2_data($tahun);
        $s3_data = $this->Ewmp_model->count_s3_data($tahun);
        $s4_data = $this->Ewmp_model->count_s4_data($tahun);
        $s5_data = $this->Ewmp_model->count_s5_data($tahun);
        $s6_data = $this->Ewmp_model->count_s6_data($tahun);
        $tdk_terakreditasi_data = $this->Ewmp_model->count_tidak_terakreditasi_data($tahun);

        // Hitung total data
        $total_nasional = $s1_data + $s2_data + $s3_data + $s4_data + $s5_data + $s6_data + $tdk_terakreditasi_data;

        $persentase_s1=$total_nasional > 0 ? ($s1_data / $total_nasional) * 100 : 0;
        $persentase_s2=$total_nasional > 0 ? ($s2_data / $total_nasional) * 100 : 0;
        $persentase_s3=$total_nasional > 0 ? ($s3_data / $total_nasional) * 100 : 0;
        $persentase_s4=$total_nasional > 0 ? ($s4_data / $total_nasional) * 100 : 0;
        $persentase_s5=$total_nasional > 0 ? ($s5_data / $total_nasional) * 100 : 0;
        $persentase_s6=$total_nasional > 0 ? ($s6_data / $total_nasional) * 100 : 0;
        $persentase_tdk_terakreditasi=$total_nasional > 0 ? ($tdk_terakreditasi_data / $total_nasional) * 100 : 0;

        // Prepare response
        $response = [
            'data_internasional' => $data_internasional,
            'data_nasional' => $data_nasional,
            'total_publikasi' => $total_publikasi,
            'persentase_nasional' => $persentase_nasional,
            'persentase_internasional' => $persentase_internasional,
            'q1_data' => $q1_data,
            'q2_data' => $q2_data,
            'q3_data' => $q3_data,
            'q4_data' => $q4_data,
            'total_internasional' => $total_internasional,
            'persentase_q1' => $persentase_q1,
            'persentase_q2' => $persentase_q2,
            'persentase_q3' => $persentase_q3,
            'persentase_q4' => $persentase_q4,
            's1_data' => $s1_data,
            's2_data' => $s2_data,
            's3_data' => $s3_data,
            's4_data' => $s4_data,
            's5_data' => $s5_data,
            's6_data' => $s6_data,
            'tdk_terakreditasi_data' => $tdk_terakreditasi_data,
            'total_nasional' => $total_nasional,
            'persentase_s1' => $persentase_s1,
            'persentase_s2' => $persentase_s2,
            'persentase_s3' => $persentase_s3,
            'persentase_s4' => $persentase_s4,
            'persentase_s5' => $persentase_s5,
            'persentase_s6' => $persentase_s6,
            'persentase_tdk_terakreditasi' => $persentase_tdk_terakreditasi
        ];

        // Send JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    

    public function publikasi_internasional()
    {
        $current_year = date('Y');

        $data['pub_internasional'] = $this->Ewmp_model->get_publikasi_internasional($current_year);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_internasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_internasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        $data['q1_data'] = $this->Ewmp_model->count_q1_data($current_year);
        $data['q2_data'] = $this->Ewmp_model->count_q2_data($current_year);
        $data['q3_data'] = $this->Ewmp_model->count_q3_data($current_year);
        $data['q4_data'] = $this->Ewmp_model->count_q4_data($current_year);

        // Hitung total data
        $data['total_data'] = $data['q1_data'] + $data['q2_data'] + $data['q3_data'] + $data['q4_data'];

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_internasional', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_publikasi_internasional_data()
    {
        $tahun = $this->input->post('tahun');

        $data['pub_internasional'] = $this->Ewmp_model->get_publikasi_internasional($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_internasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_internasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        $data['q1_data'] = $this->Ewmp_model->count_q1_data($tahun);
        $data['q2_data'] = $this->Ewmp_model->count_q2_data($tahun);
        $data['q3_data'] = $this->Ewmp_model->count_q3_data($tahun);
        $data['q4_data'] = $this->Ewmp_model->count_q4_data($tahun);

        // Hitung total data
        $data['total_data'] = $data['q1_data'] + $data['q2_data'] + $data['q3_data'] + $data['q4_data'];

        $q1_data=$this->Ewmp_model->count_q1_data($tahun);
        $q2_data=$this->Ewmp_model->count_q2_data($tahun);
        $q3_data=$this->Ewmp_model->count_q3_data($tahun);
        $q4_data=$this->Ewmp_model->count_q4_data($tahun);

        $total_data=$q1_data+$q2_data+$q3_data+$q4_data;

        $data['persentase_q1']=$total_data > 0 ? ($q1_data / $total_data) * 100 : 0;
        $data['persentase_q2']=$total_data > 0 ? ($q2_data / $total_data) * 100 : 0;
        $data['persentase_q3']=$total_data > 0 ? ($q3_data / $total_data) * 100 : 0;
        $data['persentase_q4']=$total_data > 0 ? ($q4_data / $total_data) * 100 : 0;

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }


    public function publikasi_nasional()
    {
        $current_year = date('Y');

        $data['pub_nasional'] = $this->Ewmp_model->get_publikasi_nasional($current_year);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_nasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_nasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        // Data publikasi
        $data['s1_data'] = $this->Ewmp_model->count_s1_data($current_year);
        $data['s2_data'] = $this->Ewmp_model->count_s2_data($current_year);
        $data['s3_data'] = $this->Ewmp_model->count_s3_data($current_year);
        $data['s4_data'] = $this->Ewmp_model->count_s4_data($current_year);
        $data['s5_data'] = $this->Ewmp_model->count_s5_data($current_year);
        $data['s6_data'] = $this->Ewmp_model->count_s6_data($current_year);
        $data['tdk_terakreditasi_data'] = $this->Ewmp_model->count_tidak_terakreditasi_data($current_year);

        // Hitung total data
        $data['total_data'] = $data['s1_data'] + $data['s2_data'] + $data['s3_data'] + $data['s4_data'] + $data['s5_data'] + $data['s6_data'] + $data['tdk_terakreditasi_data'];

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_nasional', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_publikasi_nasional_data()
    {
        $tahun = $this->input->post('tahun');

        $data['pub_nasional'] = $this->Ewmp_model->get_publikasi_nasional($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_nasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_nasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        // Data publikasi
        $data['s1_data'] = $this->Ewmp_model->count_s1_data($tahun);
        $data['s2_data'] = $this->Ewmp_model->count_s2_data($tahun);
        $data['s3_data'] = $this->Ewmp_model->count_s3_data($tahun);
        $data['s4_data'] = $this->Ewmp_model->count_s4_data($tahun);
        $data['s5_data'] = $this->Ewmp_model->count_s5_data($tahun);
        $data['s6_data'] = $this->Ewmp_model->count_s6_data($tahun);
        $data['tdk_terakreditasi_data'] = $this->Ewmp_model->count_tidak_terakreditasi_data($tahun);

        // Hitung total data
        $data['total_data'] = $data['s1_data'] + $data['s2_data'] + $data['s3_data'] + $data['s4_data'] + $data['s5_data'] + $data['s6_data'] + $data['tdk_terakreditasi_data'];

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function hibah_penelitian()
    {
        $current_year = date('Y');

        $data['penelitian'] = $this->Ewmp_model->get_hibah_penelitian($current_year);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['penelitian'] as $key => $penelitian) {
            $id_penelitian = $penelitian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Penelitian';
            $data['penelitian'][$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_penelitian($current_year);
        $data['internal_data'] = $this->Ewmp_model->count_internal_penelitian($current_year);
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_penelitian($current_year);
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_penelitian($current_year);

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_penelitian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_hibah_penelitian_data()
    {
        $tahun = $this->input->post('tahun');

        $data['penelitian'] = $this->Ewmp_model->get_hibah_penelitian($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['penelitian'] as $key => $penelitian) {
            $id_penelitian = $penelitian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Penelitian';
            $data['penelitian'][$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_penelitian($tahun);
        $data['internal_data'] = $this->Ewmp_model->count_internal_penelitian($tahun);
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_penelitian($tahun);
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_penelitian($tahun);

        // Hitung total data
        $data['total_data'] = $data['mandiri_data'] + $data['internal_data'] + $data['nasional_data'] + $data['internasional_data'];

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function hibah_pengabdian()
    {
        $current_year = date('Y');

        $data['pengabdian'] = $this->Ewmp_model->get_hibah_pengabdian($current_year);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pengabdian'] as $key => $pengabdian) {
            $id_pengabdian = $pengabdian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'pengabdian';
            $data['pengabdian'][$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_pengabdian($current_year);
        $data['internal_data'] = $this->Ewmp_model->count_internal_pengabdian($current_year);
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_pengabdian($current_year);
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_pengabdian($current_year);

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_pengabdian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_hibah_pengabdian_data()
    {
        $tahun = $this->input->post('tahun');

        $data['pengabdian'] = $this->Ewmp_model->get_hibah_pengabdian($tahun);

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pengabdian'] as $key => $pengabdian) {
            $id_pengabdian = $pengabdian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'pengabdian';
            $data['pengabdian'][$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_pengabdian($tahun);
        $data['internal_data'] = $this->Ewmp_model->count_internal_pengabdian($tahun);
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_pengabdian($tahun);
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_pengabdian($tahun);

        // Hitung total data
        $data['total_data'] = $data['mandiri_data'] + $data['internal_data'] + $data['nasional_data'] + $data['internasional_data'];

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function kesesuaian_publikasi()
    {
        // Add logging to debug data retrieval
        log_message('debug', 'Starting kesesuaian_publikasi method');

        $current_year = date('Y');

        // Fetch publikasi data for each department with error checking
        $data['data_elektro'] = $this->Ewmp_model->get_publikasi_elektro($current_year);
        log_message('debug', 'Elektro publikasi count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_publikasi_industri($current_year);
        log_message('debug', 'Industri publikasi count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_publikasi_biomedis($current_year);
        log_message('debug', 'Biomedis publikasi count: ' . count($data['data_biomedis']));

        // Add anggota information for each publikasi
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$publikasi_collection) {
            foreach ($publikasi_collection as $key => $publikasi) {
                $id_ilmiah = $publikasi->id;
                $kategori = 'Artikel/Karya Ilmiah';
                $publikasi_collection[$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);

                // Add debug logging
                log_message('debug', 'Publikasi ID: ' . $id_ilmiah . ', Anggota count: ' . count($publikasi_collection[$key]->anggota_ilmiah));
            }
        }

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_publikasi', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_kesesuaian_publikasi_data()
    {
        $tahun = $this->input->post('tahun');

        // Fetch publikasi data for each department with error checking
        $data['data_elektro'] = $this->Ewmp_model->get_publikasi_elektro($tahun);

        $data['data_industri'] = $this->Ewmp_model->get_publikasi_industri($tahun);

        $data['data_biomedis'] = $this->Ewmp_model->get_publikasi_biomedis($tahun);

        // Add anggota information for each publikasi
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$publikasi_collection) {
            foreach ($publikasi_collection as $key => $publikasi) {
                $id_ilmiah = $publikasi->id;
                $kategori = 'Artikel/Karya Ilmiah';
                $publikasi_collection[$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);

                // Add debug logging
                log_message('debug', 'Publikasi ID: ' . $id_ilmiah . ', Anggota count: ' . count($publikasi_collection[$key]->anggota_ilmiah));
            }
        }

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function kesesuaian_penelitian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_penelitian method');

        $current_year=date('Y');

        // Fetch data penelitian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_penelitian_elektro($current_year);

        $data['data_industri'] = $this->Ewmp_model->get_penelitian_industri($current_year);

        $data['data_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis($current_year);

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$penelitian_collection) {
            foreach ($penelitian_collection as $key => $penelitian) {
                $id_penelitian = $penelitian->id; // Pastikan nama kolom sesuai database
                $kategori = 'Penelitian';
                $penelitian_collection[$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);

                // Logging jumlah anggota penelitian
                log_message('debug', 'penelitian ID: ' . $id_penelitian . ', Anggota count: ' . count($penelitian_collection[$key]->anggota_penelitian));
            }
        }

        // Hitung jumlah penelitian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($current_year,'Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($current_year,'Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($current_year,'Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($current_year,'Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($current_year,'Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($current_year,'Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($current_year,'Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($current_year,'Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($current_year,'Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($current_year,'Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($current_year,'Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($current_year,'Teknik Biomedis'),
        ];

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_penelitian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_kesesuaian_penelitian_data()
    {
        $tahun = $this->input->post('tahun');

        // Fetch data penelitian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_penelitian_elektro($tahun);
        log_message('debug', 'Elektro penelitian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_penelitian_industri($tahun);
        log_message('debug', 'Industri penelitian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis($tahun);
        log_message('debug', 'Biomedis penelitian count: ' . count($data['data_biomedis']));

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$penelitian_collection) {
            foreach ($penelitian_collection as $key => $penelitian) {
                $id_penelitian = $penelitian->id; // Pastikan nama kolom sesuai database
                $kategori = 'Penelitian';
                $penelitian_collection[$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);

                // Logging jumlah anggota penelitian
                log_message('debug', 'penelitian ID: ' . $id_penelitian . ', Anggota count: ' . count($penelitian_collection[$key]->anggota_penelitian));
            }
        }

        // Hitung jumlah penelitian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($tahun,'Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($tahun,'Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($tahun,'Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($tahun,'Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($tahun,'Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($tahun,'Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($tahun,'Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($tahun,'Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian($tahun,'Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_penelitian($tahun,'Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian($tahun,'Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian($tahun,'Teknik Biomedis'),
        ];

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function kesesuaian_pengabdian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_pengabdian method');

        $current_year=date('Y');

        // Fetch data pengabdian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_pengabdian_elektro($current_year);
        log_message('debug', 'Elektro pengabdian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_pengabdian_industri($current_year);
        log_message('debug', 'Industri pengabdian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis($current_year);
        log_message('debug', 'Biomedis pengabdian count: ' . count($data['data_biomedis']));

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$pengabdian_collection) {
            foreach ($pengabdian_collection as $key => $pengabdian) {
                $id_pengabdian = $pengabdian->id;
                $kategori = 'Pengabdian';
                $pengabdian_collection[$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);

                // Logging jumlah anggota pengabdian
                log_message('debug', 'Pengabdian ID: ' . $id_pengabdian . ', Anggota count: ' . count($pengabdian_collection[$key]->anggota_pengabdian));
            }
        }

        // Hitung jumlah pengabdian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($current_year,'Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($current_year,'Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($current_year,'Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($current_year,'Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($current_year,'Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($current_year,'Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($current_year,'Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($current_year,'Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($current_year,'Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($current_year,'Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($current_year,'Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($current_year,'Teknik Biomedis'),
        ];

        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_pengabdian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function get_kesesuaian_pengabdian_data()
    {
        $tahun = $this->input->post('tahun');

        // Fetch data pengabdian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_pengabdian_elektro($tahun);
        log_message('debug', 'Elektro pengabdian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_pengabdian_industri($tahun);
        log_message('debug', 'Industri pengabdian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis($tahun);
        log_message('debug', 'Biomedis pengabdian count: ' . count($data['data_biomedis']));

        // Data koleksi untuk mempermudah pengolahan anggota
        $data_collections = [
            &$data['data_elektro'],
            &$data['data_industri'],
            &$data['data_biomedis']
        ];

        foreach ($data_collections as &$pengabdian_collection) {
            foreach ($pengabdian_collection as $key => $pengabdian) {
                $id_pengabdian = $pengabdian->id;
                $kategori = 'Pengabdian';
                $pengabdian_collection[$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);

                // Logging jumlah anggota pengabdian
                log_message('debug', 'Pengabdian ID: ' . $id_pengabdian . ', Anggota count: ' . count($pengabdian_collection[$key]->anggota_pengabdian));
            }
        }

        // Hitung jumlah pengabdian berdasarkan kategori
        $data['elektro_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($tahun,'Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($tahun,'Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($tahun,'Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($tahun,'Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($tahun,'Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($tahun,'Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($tahun,'Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($tahun,'Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian($tahun,'Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian($tahun,'Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian($tahun,'Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian($tahun,'Teknik Biomedis'),
        ];

        // Return as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function update_kesesuaian_penelitian($id)
    {
        $this->load->model('Ewmp_model');

        $data = array(
            'kesesuaian' => $this->input->post('kesesuaian_penelitian')
        );

        if ($this->Ewmp_model->update_penelitian($id, $data)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function update_kesesuaian_pengabdian($id)
    {
        $this->load->model('Ewmp_model');

        $data = array(
            'kesesuaian' => $this->input->post('kesesuaian_pengabdian')
        );

        if ($this->Ewmp_model->update_pengabdian($id, $data)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }
}
