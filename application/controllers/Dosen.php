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

    // Menghapus data dosen berdasarkan ID
    public function delete($id)
    {
        // Menghapus data dosen
        $this->Mod_dosen->delete_dosen($id);

        // Mengarahkan kembali ke halaman daftar dosen
        redirect('dosen');
    }
}
