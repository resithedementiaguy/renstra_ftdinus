<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_auth extends CI_Model
{
    // Mendapatkan data user berdasarkan username
    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    // Validasi login (jika diperlukan)
    public function validate_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    public function register($data)
    {
        $this->db->insert('user', $data);
    }

    public function get_users()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->result();
    }
}
