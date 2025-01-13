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

            // Cek apakah username ada di database
            $user = $this->Mod_auth->get_user_by_username($username);

            if ($user) {
                // Jika username ditemukan, hash password yang dimasukkan
                $hashed_password = sha1('jksdhf832746aiH{}{()&(*&(*' . md5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');

                // Cek apakah password yang dimasukkan sesuai dengan yang disimpan
                if ($hashed_password === $user['password']) {
                    // Jika password benar, login sukses
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'nama' => $user['nama'],
                        'username' => $user['username'],
                        'level' => $user['level'],
                        'logged_in' => true
                    ]);
                    redirect('dashboard');
                } else {
                    // Jika password salah
                    $this->session->set_flashdata('error', 'Password yang Anda masukkan salah!');
                    redirect('auth');
                }
            } else {
                // Jika username tidak ditemukan
                $this->session->set_flashdata('error', 'Username yang Anda masukkan tidak terdaftar!');
                redirect('auth');
            }
        } else {
            redirect('auth');
        }
    }

    public function register()
    {
        // Set rules untuk validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim|matches[password]'); // Validasi konfirmasi password

        // Jika validasi gagal, load halaman register kembali
        if ($this->form_validation->run() == false) {
            // Set flash message untuk password yang kurang dari 6 karakter
            if (form_error('password')) {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
            }

            $this->load->view('backend/auth/register');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $ins_time = date('Y-m-d H:i:s', time());
            // Ambil data yang dimasukkan oleh pengguna
            $password = $this->input->post('password');

            // Proses password menggunakan sha1 dan md5 yang digabung
            $hashed_password = sha1('jksdhf832746aiH{}{()&(*&(*' . md5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');

            // Persiapkan data untuk dimasukkan ke database
            $data_user = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => $hashed_password,
                'ins_time' => $ins_time
            ];

            // Panggil model untuk menambahkan data user ke database
            $this->Mod_auth->register($data_user);

            // Set flash message untuk memberi tahu pengguna bahwa registrasi berhasil
            $this->session->set_flashdata('success', 'Registration successful. Please log in.');

            // Redirect ke halaman login setelah berhasil
            redirect('auth/register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have been logged out.');
        redirect('auth');
    }
}
