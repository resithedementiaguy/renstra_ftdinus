<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_tahun');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // Mendapatkan data tahun dari model
        $data['tahun'] = $this->Mod_tahun->get_all_tahun();

        // Memuat view dengan data tahun
        $this->load->view('backend/partials/header');
        $this->load->view('backend/tahun/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'tahun' => $this->input->post('tahun'),
            'ins_time' => $tgl
        );

        $this->Mod_tahun->insert_tahun($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('tahun');
    }

    public function delete($id)
    {
        // Menghapus data tahun berdasarkan ID
        $this->Mod_tahun->delete_tahun($id);

        // Mengarahkan ke halaman utama setelah penghapusan
        redirect('tahun');
    }
}
