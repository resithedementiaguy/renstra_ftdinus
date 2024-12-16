<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class hasil_pelaporan extends CI_Controller
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
        $data['data_internasional'] = $this->Ewmp_model->count_publikasi_internasional_data();
        $data['data_nasional'] = $this->Ewmp_model->count_publikasi_nasional_data();

        // Hitung total data
        $data['total'] = $data['data_nasional'] + $data['data_internasional'];

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

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }

    public function publikasi_internasional()
    {
        $data['pub_internasional'] = $this->Ewmp_model->get_publikasi_internasional();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_internasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_internasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        $data['q1_data'] = $this->Ewmp_model->count_q1_data();
        $data['q2_data'] = $this->Ewmp_model->count_q2_data();
        $data['q3_data'] = $this->Ewmp_model->count_q3_data();
        $data['q4_data'] = $this->Ewmp_model->count_q4_data();

        // Hitung total data
        $data['total_data'] = $data['q1_data'] + $data['q2_data'] + $data['q3_data'] + $data['q4_data'];

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_internasional', $data);
        $this->load->view('backend/partials/footer');
    }


    public function publikasi_nasional()
    {
        $data['pub_nasional'] = $this->Ewmp_model->get_publikasi_nasional();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pub_nasional'] as $key => $publikasi) {
            $id_ilmiah = $publikasi->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Artikel/Karya Ilmiah';
            $data['pub_nasional'][$key]->anggota_ilmiah = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_ilmiah, $kategori);
        }

        // Data publikasi
        $data['s1_data'] = $this->Ewmp_model->count_s1_data();
        $data['s2_data'] = $this->Ewmp_model->count_s2_data();
        $data['s3_data'] = $this->Ewmp_model->count_s3_data();
        $data['s4_data'] = $this->Ewmp_model->count_s4_data();
        $data['s5_data'] = $this->Ewmp_model->count_s5_data();
        $data['s6_data'] = $this->Ewmp_model->count_s6_data();
        $data['tdk_terakreditasi_data'] = $this->Ewmp_model->count_tidak_terakreditasi_data();

        // Hitung total data
        $data['total_data'] = $data['s1_data'] + $data['s2_data'] + $data['s3_data'] + $data['s4_data'] + $data['s5_data'] + $data['s6_data'] + $data['tdk_terakreditasi_data'];

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/publikasi_nasional', $data);
        $this->load->view('backend/partials/footer');
    }

    public function hibah_penelitian()
    {
        $data['penelitian'] = $this->Ewmp_model->get_hibah_penelitian();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['penelitian'] as $key => $penelitian) {
            $id_penelitian = $penelitian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'Penelitian';
            $data['penelitian'][$key]->anggota_penelitian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_penelitian();
        $data['internal_data'] = $this->Ewmp_model->count_internal_penelitian();
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_penelitian();
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_penelitian();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_penelitian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function hibah_pengabdian()
    {
        $data['pengabdian'] = $this->Ewmp_model->get_hibah_pengabdian();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['pengabdian'] as $key => $pengabdian) {
            $id_pengabdian = $pengabdian->id; // Pastikan sesuai nama kolom di database
            $kategori = 'pengabdian';
            $data['pengabdian'][$key]->anggota_pengabdian = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian, $kategori);
        }

        $data['mandiri_data'] = $this->Ewmp_model->count_mandiri_pengabdian();
        $data['internal_data'] = $this->Ewmp_model->count_internal_pengabdian();
        $data['nasional_data'] = $this->Ewmp_model->count_nasional_pengabdian();
        $data['internasional_data'] = $this->Ewmp_model->count_internasional_pengabdian();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/hibah_pengabdian', $data);
        $this->load->view('backend/partials/footer');
    }

    public function kesesuaian_publikasi()
    {
        // Add logging to debug data retrieval
        log_message('debug', 'Starting kesesuaian_publikasi method');

        // Fetch publikasi data for each department with error checking
        $data['data_elektro'] = $this->Ewmp_model->get_publikasi_elektro();
        log_message('debug', 'Elektro publikasi count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_publikasi_industri();
        log_message('debug', 'Industri publikasi count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_publikasi_biomedis();
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

        // Add a debug view to print out raw data
        $data['debug_elektro'] = $data['data_elektro'];
        $data['debug_industri'] = $data['data_industri'];
        $data['debug_biomedis'] = $data['data_biomedis'];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_publikasi', $data);
        $this->load->view('backend/partials/footer');
    }

    public function kesesuaian_penelitian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_penelitian method');

        // Fetch data penelitian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_penelitian_elektro();
        log_message('debug', 'Elektro penelitian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_penelitian_industri();
        log_message('debug', 'Industri penelitian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis();
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
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_penelitian('Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_penelitian('Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_penelitian('Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_penelitian('Teknik Biomedis'),
        ];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_penelitian', $data);
        $this->load->view('backend/partials/footer');
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


    public function kesesuaian_pengabdian()
    {
        // Logging untuk debugging
        log_message('debug', 'Starting kesesuaian_pengabdian method');

        // Fetch data pengabdian untuk masing-masing prodi
        $data['data_elektro'] = $this->Ewmp_model->get_pengabdian_elektro();
        log_message('debug', 'Elektro pengabdian count: ' . count($data['data_elektro']));

        $data['data_industri'] = $this->Ewmp_model->get_pengabdian_industri();
        log_message('debug', 'Industri pengabdian count: ' . count($data['data_industri']));

        $data['data_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis();
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
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Elektro'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Elektro'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Elektro'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Elektro'),
        ];

        $data['industri_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Industri'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Industri'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Industri'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Industri'),
        ];

        $data['biomedis_data'] = [
            'mandiri' => $this->Ewmp_model->count_mandiri_pengabdian('Teknik Biomedis'),
            'internal' => $this->Ewmp_model->count_internal_pengabdian('Teknik Biomedis'),
            'nasional' => $this->Ewmp_model->count_nasional_pengabdian('Teknik Biomedis'),
            'internasional' => $this->Ewmp_model->count_internasional_pengabdian('Teknik Biomedis'),
        ];

        // Load views
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/hasil_views/kesesuaian_pengabdian', $data);
        $this->load->view('backend/partials/footer');
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
}
