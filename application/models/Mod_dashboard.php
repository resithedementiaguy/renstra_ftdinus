<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_dosen_by_year($year)
    {
        $this->db->select_sum('jumlah', 'total');
        $this->db->from('jumlah_dosen');
        $this->db->where('tahun', $year);
        $query = $this->db->get();
        return $query->row()->total ?? 0;
    }

    public function get_mahasiswa_by_year($year)
    {
        $this->db->select_sum('jumlah', 'total');
        $this->db->from('jumlah_mhs');
        $this->db->where('tahun', $year);
        $query = $this->db->get();
        return $query->row()->total ?? 0;
    }
}
