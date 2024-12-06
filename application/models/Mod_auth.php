<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_auth extends CI_Model
{
    public function validate_login($username, $password)
    {
        $hashed_password = sha1('jksdhf832746aiH{}{()&(*&(*' . md5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');
        $query = $this->db->get_where('user', ['username' => $username, 'password' => $hashed_password]);

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