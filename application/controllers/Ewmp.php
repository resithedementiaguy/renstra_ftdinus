<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ewmp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ewmp_model');
    }

    public function index()
    {
        $data['pelaporan']=$this->Ewmp_model->get_pelaporan_ewmp();
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function create_view()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/ewmp/add');
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        $jenis_lapor = $this->input->post('jenis_lapor');

        date_default_timezone_set('Asia/Jakarta');
        $ins_time = date('Y-m-d H:i:s', time());

        $data = array(
            'email' => $this->input->post('email'),
            'jenis_lapor' => $jenis_lapor,
            'ins_time' => $ins_time
        );

        $this->Ewmp_model->add_pelaporan_ewmp($data);

        if ($jenis_lapor == 'Penelitian') {
            $data = array(
                'glukosa' => $this->input->post('glukosa'),
                'hb' => $this->input->post('hb'),
                'spo2' => $this->input->post('spo2'),
                'kolesterol' => $this->input->post('kolesterol'),
                'asam_urat' => $this->input->post('asam_urat')
            );
            $this->Mod_darah->add_suntik($data);
        } elseif ($jenis_lapor == 'ultraSound') {
            $data = array(
                'us1' => $this->input->post('us1'),
                'us2' => $this->input->post('us2'),
                'us3' => $this->input->post('us3'),
                'us4' => $this->input->post('us4'),
                'us5' => $this->input->post('us5'),
                'us6' => $this->input->post('us6'),
                'us7' => $this->input->post('us7'),
                'us8' => $this->input->post('us8'),
                'us9' => $this->input->post('us9'),
                'us10' => $this->input->post('us10')
            );
            $this->Mod_darah->add_ultrasound($data);
        } elseif ($jenis_lapor == 'superBright') {
            $data = array(
                'sb1' => $this->input->post('sb1'),
                'sb2' => $this->input->post('sb2'),
                'sb3' => $this->input->post('sb3'),
                'sb4' => $this->input->post('sb4'),
                'sb5' => $this->input->post('sb5'),
                'sb6' => $this->input->post('sb6'),
                'sb7' => $this->input->post('sb7'),
                'sb8' => $this->input->post('sb8'),
                'sb9' => $this->input->post('sb9'),
                'sb10' => $this->input->post('sb10')
            );
            $this->Mod_darah->add_superbright($data);
        } elseif ($jenis_lapor == 'magnetik') {
            $data = array(
                'jtg_mag1' => $this->input->post('jtg_mag1'),
                'jtg_mag2' => $this->input->post('jtg_mag2'),
                'jtg_mag3' => $this->input->post('jtg_mag3'),
                'jtg_mag4' => $this->input->post('jtg_mag4'),
                'jtg_mag5' => $this->input->post('jtg_mag5'),
                'jtg_mag6' => $this->input->post('jtg_mag6'),
                'jtg_mag7' => $this->input->post('jtg_mag7'),
                'jtg_mag8' => $this->input->post('jtg_mag8'),
                'jtg_mag9' => $this->input->post('jtg_mag9'),
                'jtg_mag10' => $this->input->post('jtg_mag10'),
                'srf_mag1' => $this->input->post('srf_mag1'),
                'srf_mag2' => $this->input->post('srf_mag2'),
                'srf_mag3' => $this->input->post('srf_mag3'),
                'srf_mag4' => $this->input->post('srf_mag4'),
                'srf_mag5' => $this->input->post('srf_mag5'),
                'srf_mag6' => $this->input->post('srf_mag6'),
                'srf_mag7' => $this->input->post('srf_mag7'),
                'srf_mag8' => $this->input->post('srf_mag8'),
                'srf_mag9' => $this->input->post('srf_mag9'),
                'srf_mag10' => $this->input->post('srf_mag10'),
                'drh_mag1' => $this->input->post('drh_mag1'),
                'drh_mag2' => $this->input->post('drh_mag2'),
                'drh_mag3' => $this->input->post('drh_mag3'),
                'drh_mag4' => $this->input->post('drh_mag4'),
                'drh_mag5' => $this->input->post('drh_mag5'),
                'drh_mag6' => $this->input->post('drh_mag6'),
                'drh_mag7' => $this->input->post('drh_mag7'),
                'drh_mag8' => $this->input->post('drh_mag8'),
                'drh_mag9' => $this->input->post('drh_mag9'),
                'drh_mag10' => $this->input->post('drh_mag10'),
                'sel_mag1' => $this->input->post('sel_mag1'),
                'sel_mag2' => $this->input->post('sel_mag2'),
                'sel_mag3' => $this->input->post('sel_mag3'),
                'sel_mag4' => $this->input->post('sel_mag4'),
                'sel_mag5' => $this->input->post('sel_mag5'),
                'sel_mag6' => $this->input->post('sel_mag6'),
                'sel_mag7' => $this->input->post('sel_mag7'),
                'sel_mag8' => $this->input->post('sel_mag8'),
                'sel_mag9' => $this->input->post('sel_mag9'),
                'sel_mag10' => $this->input->post('sel_mag10'),
                'tgi_mag1' => $this->input->post('tgi_mag1'),
                'tgi_mag2' => $this->input->post('tgi_mag2'),
                'tgi_mag3' => $this->input->post('tgi_mag3'),
                'tgi_mag4' => $this->input->post('tgi_mag4'),
                'tgi_mag5' => $this->input->post('tgi_mag5'),
                'tgi_mag6' => $this->input->post('tgi_mag6'),
                'tgi_mag7' => $this->input->post('tgi_mag7'),
                'tgi_mag8' => $this->input->post('tgi_mag8'),
                'tgi_mag9' => $this->input->post('tgi_mag9'),
                'tgi_mag10' => $this->input->post('tgi_mag10'),

            );
            $this->Mod_darah->add_magnetik($data);
        }

        if ($this->input->post('completed') == 'yes') {
            $this->session->unset_userdata('pasien_id');
        }

        redirect('analisis_darah');
    }

    public function delete_pelaporan($id)
    {
        $this->Ewmp_model->delete_pelaporan_ewmp($id);
        redirect('ewmp');
    }
}
