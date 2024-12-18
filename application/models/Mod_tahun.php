<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_tahun extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data tahun
    public function get_all_tahun()
    {
        $this->db->select('*');
        $this->db->from('tahun');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTahunList()
    {
        $this->db->select('tahun');
        $this->db->from('tahun');
        $this->db->order_by('tahun', 'ASC');
        return $this->db->get()->result_array();
    }

    // Ambil data tahun berdasarkan ID
    public function get_tahun_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tahun');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan data dalam bentuk objek tunggal
    }

    // Menambahkan data tahun
    public function insert_tahun($data)
    {
        return $this->db->insert('tahun', $data);
    }

    // Mengupdate data tahun
    public function update_tahun($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tahun', $data);
    }

    // Menghapus data tahun
    public function delete_tahun($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tahun');
    }
}
