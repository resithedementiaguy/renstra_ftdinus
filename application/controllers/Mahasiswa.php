<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_mahasiswa');
    }

    public function index()
    {
        // Mendapatkan data mahasiswa dari model
        $data['mahasiswa'] = $this->Mod_mahasiswa->get_all_mahasiswa();

        // Memuat view dengan data mahasiswa
        $this->load->view('backend/partials/header');
        $this->load->view('backend/mahasiswa/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function delete($id)
    {
        // Menghapus data mahasiswa berdasarkan ID
        $this->Mod_mahasiswa->delete_mahasiswa($id);

        // Mengarahkan ke halaman utama setelah penghapusan
        redirect('mahasiswa');
    }
}
