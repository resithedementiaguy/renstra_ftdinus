<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data user
    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result(); // Mengembalikan data dalam bentuk array objek
    }

    // Ambil data user berdasarkan ID
    public function get_user_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan data dalam bentuk objek tunggal
    }

    // Menambahkan data user
    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    // Mengupdate data user
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    // Menghapus data user
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
}
