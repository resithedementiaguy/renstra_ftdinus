<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Iku_model');
    }

    public function index()
    {
        $data['level1'] = $this->Iku_model->get_level1();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/renstra/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function level2($id_level1)
    {
        $this->load->model('Iku_model');

        // Get level 2 data for the selected level 1
        $data['level2'] = $this->Iku_model->get_level2($id_level1);

        $this->load->view('iku_level2_view', $data);
    }

    public function level3($id_level2)
    {
        $this->load->model('Iku_model');

        // Get level 3 data for the selected level 2
        $data['level3'] = $this->Iku_model->get_level3($id_level2);

        // Optionally: Get the target for the selected year, for example 2023
        $data['target'] = $this->Iku_model->get_target_level3($id_level2, 2023);

        $this->load->view('iku_level3_view', $data);
    }

    public function level4($id_level3)
    {
        $this->load->model('Iku_model');

        // Get level 4 data for the selected level 3
        $data['level4'] = $this->Iku_model->get_level4($id_level3);

        // Optionally: Get the target for the selected year, for example 2023
        $data['target'] = $this->Iku_model->get_target_level4($id_level3, 2023);

        $this->load->view('iku_level4_view', $data);
    }

    public function update_target()
    {
        log_message('debug', 'update_target() called');
        $target_id = $this->input->post('target_id');
        $year = $this->input->post('year');
        $value = $this->input->post('value');
        $level_type = $this->input->post('level_type');

        if (!$target_id || !$year || !$value || !$level_type) {
            log_message('error', 'Data tidak lengkap: target_id=' . $target_id . ', year=' . $year . ', value=' . $value . ', level_type=' . $level_type);
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $this->load->model('Iku_model');
        $updated = $this->Iku_model->update_target($target_id, $year, $value, $level_type);

        if ($updated) {
            log_message('debug', 'Update berhasil');
            echo json_encode(['success' => true]);
        } else {
            log_message('error', 'Gagal memperbarui target');
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui target']);
        }
    }
}
