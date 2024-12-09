<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
        $this->load->model('Mod_iku');
        $this->load->model('Mod_renstra');
        $this->load->model('Ewmp_model');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function generate_pdf_renstra()
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();
        $data['level1'] = $this->Mod_iku->get_level1();

        // Ambil nilai tahun dari database
        $years = $this->db->select('tahun')->from('tahun')->order_by('tahun', 'ASC')->get()->result_array();
        $data['years'] = array_column($years, 'tahun');

        // Load view sebagai HTML
        $html = $this->load->view('backend/renstra/pdf/cetak_renstra', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("renstra.pdf", array("Attachment" => 0));
    }

    public function generate_pdf_renstra_tahunan($year = null)
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Gunakan tahun yang dipilih atau tahun pertama dari database
        if ($year === null) {
            $year = $this->db->select('tahun')->from('tahun')->order_by('tahun', 'ASC')->get()->row()->tahun;
        }

        $data['selected_year'] = $year;
        $data['level1'] = $this->Mod_iku->get_level1_for_year($year);

        // Load view sebagai HTML
        $html = $this->load->view('backend/renstra/pdf/cetak_renstra_tahunan', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("renstra_{$year}.pdf", array("Attachment" => 0));
    }

    public function generate_pdf_rekapitulasi()
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Fetch data penelitian untuk masing-masing prodi
        $data['penelitian_elektro'] = $this->Ewmp_model->get_penelitian_elektro();
        log_message('debug', 'Elektro penelitian count: ' . count($data['penelitian_elektro']));

        $data['penelitian_industri'] = $this->Ewmp_model->get_penelitian_industri();
        log_message('debug', 'Industri penelitian count: ' . count($data['penelitian_industri']));

        $data['penelitian_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis();
        log_message('debug', 'Biomedis penelitian count: ' . count($data['penelitian_biomedis']));

        // Fetch data pengabdian untuk masing-masing prodi
        $data['pengabdian_elektro'] = $this->Ewmp_model->get_pengabdian_elektro();
        log_message('debug', 'Elektro pengabdian count: ' . count($data['pengabdian_elektro']));

        $data['pengabdian_industri'] = $this->Ewmp_model->get_pengabdian_industri();
        log_message('debug', 'Industri pengabdian count: ' . count($data['pengabdian_industri']));

        $data['pengabdian_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis();
        log_message('debug', 'Biomedis pengabdian count: ' . count($data['pengabdian_biomedis']));

        // Load view sebagai HTML
        $html = $this->load->view('backend/ewmp/pdf/cetak_rekapitulasi', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("rekapitulasi.pdf", array("Attachment" => 0));
    }

    public function generate_pdf_hasil()
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();

        $data['penelitian_eksternal'] = $this->Ewmp_model->get_penelitian_eksternal();

        // Iterasi untuk mendapatkan anggota setiap penelitian
        foreach ($data['penelitian_eksternal'] as $key => $penelitian) {
            $id_penelitian_eksternal = $penelitian->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal'][$key]->anggota_penelitian_eksternal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal, $kategori);
        }

        $data['penelitian_internal'] = $this->Ewmp_model->get_penelitian_internal();

        // Iterasi untuk mendapatkan anggota setiap penelitian
        foreach ($data['penelitian_internal'] as $key => $penelitian) {
            $id_penelitian_internal = $penelitian->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal'][$key]->anggota_penelitian_internal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal, $kategori);
        }

        $data['pengabdian_eksternal'] = $this->Ewmp_model->get_pengabdian_eksternal();

        // Iterasi untuk mendapatkan anggota setiap pengabdian
        foreach ($data['pengabdian_eksternal'] as $key => $pengabdian) {
            $id_pengabdian_eksternal = $pengabdian->id;
            $kategori = 'Pengabdian';
            $data['pengabdian_eksternal'][$key]->anggota_pengabdian_eksternal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_eksternal, $kategori);
        }

        $data['pengabdian_internal'] = $this->Ewmp_model->get_pengabdian_internal();

        // Iterasi untuk mendapatkan anggota setiap pengabdian
        foreach ($data['pengabdian_internal'] as $key => $pengabdian) {
            $id_pengabdian_internal = $pengabdian->id;
            $kategori = 'Pengabdian';
            $data['pengabdian_internal'][$key]->anggota_pengabdian_internal = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_pengabdian_internal, $kategori);
        }

        // Fetch data penelitian untuk masing-masing prodi
        $data['penelitian_elektro'] = $this->Ewmp_model->get_penelitian_elektro();
        log_message('debug', 'Elektro penelitian count: ' . count($data['penelitian_elektro']));

        $data['penelitian_industri'] = $this->Ewmp_model->get_penelitian_industri();
        log_message('debug', 'Industri penelitian count: ' . count($data['penelitian_industri']));

        $data['penelitian_biomedis'] = $this->Ewmp_model->get_penelitian_biomedis();
        log_message('debug', 'Biomedis penelitian count: ' . count($data['penelitian_biomedis']));

        // Fetch data pengabdian untuk masing-masing prodi
        $data['pengabdian_elektro'] = $this->Ewmp_model->get_pengabdian_elektro();
        log_message('debug', 'Elektro pengabdian count: ' . count($data['pengabdian_elektro']));

        $data['pengabdian_industri'] = $this->Ewmp_model->get_pengabdian_industri();
        log_message('debug', 'Industri pengabdian count: ' . count($data['pengabdian_industri']));

        $data['pengabdian_biomedis'] = $this->Ewmp_model->get_pengabdian_biomedis();
        log_message('debug', 'Biomedis pengabdian count: ' . count($data['pengabdian_biomedis']));

        // CETAK PELAPORAN TEKNIK ELEKTRO

        // Publikasi Teknik Elektro
        $data['publikasi_nasional_elektro'] = $this->Ewmp_model->get_publikasi_nasional_elektro();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_elektro'] as $key => $publikasi) {
            $id_publikasi_nasional_elektro = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_elektro'][$key]->anggota_publikasi_nasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_elektro, $kategori);
        }

        $data['publikasi_internasional_elektro'] = $this->Ewmp_model->get_publikasi_internasional_elektro();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_elektro'] as $key => $publikasi) {
            $id_publikasi_internasional_elektro = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_elektro'][$key]->anggota_publikasi_internasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_elektro, $kategori);
        }

        $data['seminar_nasional_elektro'] = $this->Ewmp_model->get_seminar_nasional_elektro();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_elektro'] as $key => $seminar) {
            $id_seminar_nasional_elektro = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_elektro'][$key]->anggota_seminar_nasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_elektro, $kategori);
        }

        $data['seminar_internasional_elektro'] = $this->Ewmp_model->get_seminar_internasional_elektro();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_elektro'] as $key => $seminar) {
            $id_seminar_internasional_elektro = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_elektro'][$key]->anggota_seminar_internasional_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_elektro, $kategori);
        }

        $data['hcipta_elektro'] = $this->Ewmp_model->get_hcipta_elektro();

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_elektro'] as $key => $hcipta) {
            $id_hcipta_elektro = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_elektro'][$key]->anggota_hcipta_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_hcipta_elektro, $kategori);
        }

        $data['dindustri_elektro'] = $this->Ewmp_model->get_dindustri_elektro();

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_elektro'] as $key => $dindustri) {
            $id_dindustri_elektro = $dindustri->id;
            $kategori = 'Hak Cipta';
            $data['dindustri_elektro'][$key]->anggota_dindustri_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_dindustri_elektro, $kategori);
        }

        $data['paten_elektro'] = $this->Ewmp_model->get_paten_elektro();

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_elektro'] as $key => $paten) {
            $id_paten_elektro = $paten->id;
            $kategori = 'Paten';
            $data['paten_elektro'][$key]->anggota_paten_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_paten_elektro, $kategori);
        }

        $data['penelitian_eksternal_elektro'] = $this->Ewmp_model->get_penelitian_eksternal_elektro();

        // Iterasi untuk mendapatkan anggota setiap penelitian_eksternal
        foreach ($data['penelitian_eksternal_elektro'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_elektro = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_elektro'][$key]->anggota_penelitian_eksternal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_elektro, $kategori);
        }

        $data['penelitian_internal_elektro'] = $this->Ewmp_model->get_penelitian_internal_elektro();

        // Iterasi untuk mendapatkan anggota setiap penelitian_internal
        foreach ($data['penelitian_internal_elektro'] as $key => $penelitian_internal) {
            $id_penelitian_internal_elektro = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_elektro'][$key]->anggota_penelitian_internal_elektro = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_elektro, $kategori);
        }

        // CETAK PELAPORAN TEKNIK INDUSTRI

        // Publikasi Teknik Industri
        $data['publikasi_nasional_industri'] = $this->Ewmp_model->get_publikasi_nasional_industri();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_industri'] as $key => $publikasi) {
            $id_publikasi_nasional_industri = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_industri'][$key]->anggota_publikasi_nasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_industri, $kategori);
        }

        $data['publikasi_internasional_industri'] = $this->Ewmp_model->get_publikasi_internasional_industri();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_industri'] as $key => $publikasi) {
            $id_publikasi_internasional_industri = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_industri'][$key]->anggota_publikasi_internasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_industri, $kategori);
        }

        $data['seminar_nasional_industri'] = $this->Ewmp_model->get_seminar_nasional_industri();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_industri'] as $key => $seminar) {
            $id_seminar_nasional_industri = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_industri'][$key]->anggota_seminar_nasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_industri, $kategori);
        }

        $data['seminar_internasional_industri'] = $this->Ewmp_model->get_seminar_internasional_industri();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_industri'] as $key => $seminar) {
            $id_seminar_internasional_industri = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_industri'][$key]->anggota_seminar_internasional_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_industri, $kategori);
        }

        $data['hcipta_industri'] = $this->Ewmp_model->get_hcipta_industri();

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_industri'] as $key => $hcipta) {
            $id_hcipta_industri = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_industri'][$key]->anggota_hcipta_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_hcipta_industri, $kategori);
        }

        $data['dindustri_industri'] = $this->Ewmp_model->get_dindustri_industri();

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_industri'] as $key => $dindustri) {
            $id_dindustri_industri = $dindustri->id;
            $kategori = 'Hak Cipta';
            $data['dindustri_industri'][$key]->anggota_dindustri_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_dindustri_industri, $kategori);
        }

        $data['paten_industri'] = $this->Ewmp_model->get_paten_industri();

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_industri'] as $key => $paten) {
            $id_paten_industri = $paten->id;
            $kategori = 'Paten';
            $data['paten_industri'][$key]->anggota_paten_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_paten_industri, $kategori);
        }

        $data['penelitian_eksternal_industri'] = $this->Ewmp_model->get_penelitian_eksternal_industri();

        // Iterasi untuk mendapatkan anggota setiap penelitian eksternal
        foreach ($data['penelitian_eksternal_industri'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_industri = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_industri'][$key]->anggota_penelitian_eksternal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_industri, $kategori);
        }

        $data['penelitian_internal_industri'] = $this->Ewmp_model->get_penelitian_internal_industri();

        // Iterasi untuk mendapatkan anggota setiap penelitian internal
        foreach ($data['penelitian_internal_industri'] as $key => $penelitian_internal) {
            $id_penelitian_internal_industri = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_industri'][$key]->anggota_penelitian_internal_industri = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_industri, $kategori);
        }

        // CETAK PELAPORAN TEKNIK BIOMEDIS

        // CETAK PELAPORAN BIOMEDIS

        // Publikasi Biomedis
        $data['publikasi_nasional_biomedis'] = $this->Ewmp_model->get_publikasi_nasional_biomedis();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_nasional_biomedis'] as $key => $publikasi) {
            $id_publikasi_nasional_biomedis = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_nasional_biomedis'][$key]->anggota_publikasi_nasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_nasional_biomedis, $kategori);
        }

        $data['publikasi_internasional_biomedis'] = $this->Ewmp_model->get_publikasi_internasional_biomedis();

        // Iterasi untuk mendapatkan anggota setiap publikasi
        foreach ($data['publikasi_internasional_biomedis'] as $key => $publikasi) {
            $id_publikasi_internasional_biomedis = $publikasi->id;
            $kategori = 'Artikel/Karya Ilmiah';
            $data['publikasi_internasional_biomedis'][$key]->anggota_publikasi_internasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_publikasi_internasional_biomedis, $kategori);
        }

        $data['seminar_nasional_biomedis'] = $this->Ewmp_model->get_seminar_nasional_biomedis();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_nasional_biomedis'] as $key => $seminar) {
            $id_seminar_nasional_biomedis = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_nasional_biomedis'][$key]->anggota_seminar_nasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_nasional_biomedis, $kategori);
        }

        $data['seminar_internasional_biomedis'] = $this->Ewmp_model->get_seminar_internasional_biomedis();

        // Iterasi untuk mendapatkan anggota setiap seminar
        foreach ($data['seminar_internasional_biomedis'] as $key => $seminar) {
            $id_seminar_internasional_biomedis = $seminar->id;
            $kategori = 'Prosiding';
            $data['seminar_internasional_biomedis'][$key]->anggota_seminar_internasional_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_seminar_internasional_biomedis, $kategori);
        }

        $data['hcipta_biomedis'] = $this->Ewmp_model->get_hcipta_biomedis();

        // Iterasi untuk mendapatkan anggota setiap hcipta
        foreach ($data['hcipta_biomedis'] as $key => $hcipta) {
            $id_hcipta_biomedis = $hcipta->id;
            $kategori = 'Hak Cipta';
            $data['hcipta_biomedis'][$key]->anggota_hcipta_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_hcipta_biomedis, $kategori);
        }

        $data['dindustri_biomedis'] = $this->Ewmp_model->get_dindustri_biomedis();

        // Iterasi untuk mendapatkan anggota setiap dindustri
        foreach ($data['dindustri_biomedis'] as $key => $dindustri) {
            $id_dindustri_biomedis = $dindustri->id;
            $kategori = 'Hak Cipta';
            $data['dindustri_biomedis'][$key]->anggota_dindustri_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_dindustri_biomedis, $kategori);
        }

        $data['paten_biomedis'] = $this->Ewmp_model->get_paten_biomedis();

        // Iterasi untuk mendapatkan anggota setiap paten
        foreach ($data['paten_biomedis'] as $key => $paten) {
            $id_paten_biomedis = $paten->id;
            $kategori = 'Paten';
            $data['paten_biomedis'][$key]->anggota_paten_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_paten_biomedis, $kategori);
        }

        $data['penelitian_eksternal_biomedis'] = $this->Ewmp_model->get_penelitian_eksternal_biomedis();

        // Iterasi untuk mendapatkan anggota setiap penelitian eksternal
        foreach ($data['penelitian_eksternal_biomedis'] as $key => $penelitian_eksternal) {
            $id_penelitian_eksternal_biomedis = $penelitian_eksternal->id;
            $kategori = 'Penelitian';
            $data['penelitian_eksternal_biomedis'][$key]->anggota_penelitian_eksternal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_eksternal_biomedis, $kategori);
        }

        $data['penelitian_internal_biomedis'] = $this->Ewmp_model->get_penelitian_internal_biomedis();

        // Iterasi untuk mendapatkan anggota setiap penelitian internal
        foreach ($data['penelitian_internal_biomedis'] as $key => $penelitian_internal) {
            $id_penelitian_internal_biomedis = $penelitian_internal->id;
            $kategori = 'Penelitian';
            $data['penelitian_internal_biomedis'][$key]->anggota_penelitian_internal_biomedis = $this->Ewmp_model->get_anggota_pelaporan_by_id($id_penelitian_internal_biomedis, $kategori);
        }

        // Load view sebagai HTML
        $html = $this->load->view('backend/ewmp/pdf/cetak_hasil', $data, true);

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("rekapitulasi.pdf", array("Attachment" => 0));
    }
}
