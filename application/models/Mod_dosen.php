<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dosen extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data dosen
    public function get_all_dosen()
    {
        $this->db->select('*');
        $this->db->from('jumlah_dosen');
        $query = $this->db->get();
        return $query->result(); // Mengembalikan data dalam bentuk array objek
    }

    // Ambil data dosen berdasarkan ID
    public function get_dosen_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('jumlah_dosen');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan data dalam bentuk objek tunggal
    }

    // Menambahkan data dosen
    public function insert_dosen($data)
    {
        return $this->db->insert('jumlah_dosen', $data);
    }

    // Mengupdate data dosen
    public function update_dosen($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('jumlah_dosen', $data);
    }

    // Menghapus data dosen
    public function delete_dosen($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jumlah_dosen');
    }
}
