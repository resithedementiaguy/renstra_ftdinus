<?php
defined('BASEPATH') or exit('No direct script access allowed');

//Include autoloader dari Composer
require 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Renstra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_renstra');
        $this->load->model('Mod_iku');
    }

    public function index()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/view');
        $this->load->view('backend/partials/footer');
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

    public function generate_pdf()
    {
        // Buat instance Dompdf
        $dompdf = new Dompdf();
        $data['level1'] = $this->Mod_iku->get_level1();

        // Ambil nilai tahun dari database
        $years = $this->db->select('tahun')->from('tahun')->order_by('tahun', 'ASC')->get()->result_array();
        $data['years'] = array_column($years, 'tahun');

        // Load view sebagai HTML
        $html = $this->load->view('backend/renstra/pdf/cetak_renstra', $data, true); // Pass true to get the output as a string

        // Load HTML content ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF (1 = download, 0 = preview)
        $dompdf->stream("renstra.pdf", array("Attachment" => 0));
    }
}
