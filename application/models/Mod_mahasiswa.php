<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_mahasiswa extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Ambil semua data mahasiswa
    public function get_all_mahasiswa()
    {
        $this->db->select('*');
        $this->db->from('jumlah_mhs');
        $query = $this->db->get();
        return $query->result(); // Mengembalikan data dalam bentuk array objek
    }

    // Ambil data mahasiswa berdasarkan ID
    public function get_mahasiswa_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('jumlah_mhs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Mengembalikan data dalam bentuk objek tunggal
    }

    // Menambahkan data mahasiswa
    public function insert_mahasiswa($data)
    {
        return $this->db->insert('jumlah_mhs', $data);
    }

    // Mengupdate data mahasiswa
    public function update_mahasiswa($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('jumlah_mhs', $data);
    }

    // Menghapus data mahasiswa
    public function delete_mahasiswa($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jumlah_mhs');
    }
}
