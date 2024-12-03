<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_dosen');
    }

    // Menampilkan daftar dosen
    public function index()
    {
        // Mengambil semua data dosen dari model
        $data['dosen'] = $this->Mod_dosen->get_all_dosen();

        // Memuat view dengan data dosen
        $this->load->view('backend/partials/header');
        $this->load->view('backend/dosen/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function create_view()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/dosen/add');
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s', time());

        $data = array(
            'tahun' => $this->input->post('tahun'),
            'prodi' => $this->input->post('prodi'),
            'jumlah' => $this->input->post('jumlah'),
            'ins_time' => $tgl
        );

        $this->Mod_dosen->insert_dosen($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('dosen/create_view');
    }

    // Menghapus data dosen berdasarkan ID
    public function delete($id)
    {
        // Menghapus data dosen
        $this->Mod_dosen->delete_dosen($id);

        // Mengarahkan kembali ke halaman daftar dosen
        redirect('dosen');
    }
}
