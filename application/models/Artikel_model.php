<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{
    // Mengambil jumlah dosen berdasarkan tahun
    public function getJumlahDosenByYear($tahun)
    {
        $this->db->select('SUM(jumlah) as total_dosen');
        $this->db->from('jumlah_dosen');
        $this->db->where('tahun', $tahun);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Mengambil total Artikel berdasarkan kategori dan tahun
    public function getTotalArtikelByYear($tahun)
    {
        $this->db->select('artikel_ilmiah.kategori, COUNT(artikel_ilmiah.id) as total');
        $this->db->from('artikel_ilmiah');
        $this->db->join('pelaporan_ewmp', 'artikel_ilmiah.id_pelaporan = pelaporan_ewmp.id', 'left');
        $this->db->where('artikel_ilmiah.tahun', $tahun);
        $this->db->group_by('artikel_ilmiah.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Penelitian berdasarkan kategori dan tahun
    public function getTotalPenelitianByYear($tahun)
    {
        $this->db->select('penelitian.kategori, COUNT(*) as total');
        $this->db->from('penelitian');
        $this->db->join('pelaporan_ewmp', 'penelitian.id_pelaporan = pelaporan_ewmp.id', 'left');
        $this->db->where('penelitian.tahun', $tahun);
        $this->db->group_by('penelitian.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Seminar berdasarkan kategori dan tahun
    public function getTotalSeminarByYear($tahun)
    {
        $this->db->select('prosiding.kategori, COUNT(*) as total');
        $this->db->from('prosiding');
        $this->db->join('pelaporan_ewmp', 'prosiding.id_pelaporan = pelaporan_ewmp.id', 'left');
        $this->db->where('prosiding.tahun', $tahun);
        $this->db->group_by('prosiding.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }
}
