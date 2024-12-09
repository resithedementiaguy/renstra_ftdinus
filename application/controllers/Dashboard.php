<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mod_dashboard');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $current_year = date('Y');

        $data['jumlah_dosen'] = $this->Mod_dashboard->get_dosen_by_year($current_year);
        $data['jumlah_mahasiswa'] = $this->Mod_dashboard->get_mahasiswa_by_year($current_year);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/partials/footer');
    }
}
