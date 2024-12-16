<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_user');

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Menampilkan daftar user
    public function index()
    {
        // Mengambil semua data user dari model
        $data['users'] = $this->Mod_user->get_all_user();

        // Memuat view dengan data user
        $this->load->view('backend/partials/header');
        $this->load->view('backend/user/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function create_view()
    {
        $this->load->view('backend/partials/header');
        $this->load->view('backend/user/add');
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

        $this->Mod_user->insert_user($data);

        // Set flashdata for success message
        $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        redirect('user/create_view');
    }

    public function update_level($id)
    {
        $this->load->model('Mod_user');

        $data = array(
            'level' => $this->input->post('level')
        );

        if ($this->Mod_user->update_user($id, $data)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    // Menghapus data user berdasarkan ID
    public function delete($id)
    {
        // Menghapus data user
        $this->Mod_user->delete_user($id);

        // Mengarahkan kembali ke halaman daftar user
        redirect('user');
    }
}
