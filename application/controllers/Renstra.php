<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renstra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_renstra');
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
        $data['iku_level1']=$this->Mod_renstra->get_iku_level1();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level2',$data);
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
        $data['iku_level1']=$this->Mod_renstra->get_iku_level1();
        $data['iku_level2']=$this->Mod_renstra->get_iku_level2();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/add_level3',$data);
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
        $data['iku_level1']=$this->Mod_renstra->get_iku_level1();
        $data['iku_level2']=$this->Mod_renstra->get_iku_level2();
        $data['iku_level3']=$this->Mod_renstra->get_iku_level3();
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
}
