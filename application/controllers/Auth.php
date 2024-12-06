<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Mod_auth');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        } else {
            $this->load->view('backend/auth/login');
        }
    }

    public function login()
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->Mod_auth->validate_login($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'level' => $user['level'],
                    'logged_in' => true
                ]);

                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect('auth');
            }
        } else {
            redirect('auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('backend/auth/register');
        } else {
            $password = $this->input->post('password');

            $data_user = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => sha1('jksdhf832746aiH{}{()&(*&(*' . md5($password) . 'HdfevgyDDw{}{}{;;*766&*&*'),
                'ins_time' => date('Y-m-d H:i:s')
            ];

            $this->Mod_auth->register($data_user);
            $this->session->set_flashdata('success', 'Registration successful. Please log in.');

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have been logged out.');
        redirect('auth');
    }
}
