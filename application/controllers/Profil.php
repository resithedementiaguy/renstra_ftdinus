<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Mod_profil');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Mod_profil->get_user($user_id);

        $this->load->view('backend/partials/header');
        $this->load->view('backend/profil/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $user_id = $this->session->userdata('user_id');
            $data = [
                'nama' => $this->input->post('nama'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];

            if ($this->Mod_profil->update_user($user_id, $data)) {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui profil.');
            }
            redirect('profil');
        }
    }
}
