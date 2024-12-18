<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{
    // Mengambil total artikel berdasarkan kategori dan tahun
    public function getTotalByCategoryAndYear($tahun)
    {
        $this->db->select('kategori, COUNT(*) as total');
        $this->db->from('artikel_ilmiah');
        $this->db->where('tahun', $tahun);
        $this->db->group_by('kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil jumlah dosen berdasarkan tahun
    public function getJumlahDosenByYear($tahun)
    {
        $this->db->select('SUM(jumlah) as total_dosen');
        $this->db->from('jumlah_dosen');
        $this->db->where('tahun', $tahun);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTahunList()
    {
        $this->db->select('tahun');
        $this->db->from('tahun');
        $this->db->order_by('tahun', 'ASC');
        return $this->db->get()->result_array();
    }
}
