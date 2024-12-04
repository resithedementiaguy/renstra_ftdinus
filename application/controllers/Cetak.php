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

        $data['pengandian_industri'] = $this->Ewmp_model->get_pengabdian_industri();
        log_message('debug', 'Industri pengabdian count: ' . count($data['pengandian_industri']));

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
}
