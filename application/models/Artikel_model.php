<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{
    // Mengambil jumlah total dosen berdasarkan tahun
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
        $this->db->select('artikel_ilmiah.kategori, COUNT(*) as total');
        $this->db->from('artikel_ilmiah');
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
        $this->db->where('penelitian.tahun', $tahun);
        $this->db->group_by('penelitian.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total penelitian yang melibatkan mahasiswa berdasarkan tahun
    public function getTotalPenelitianMhsByYear($tahun)
    {
        $this->db->select('p.tahun, COUNT(DISTINCT p.id) AS total_penelitian');
        $this->db->from('pelaporan_ewmp pe');
        $this->db->join('penelitian p', 'pe.id = p.id_pelaporan', 'inner');
        $this->db->join('mhs_pelaporan mp', 'p.id = mp.id_jenis_lapor', 'inner');
        $this->db->where('p.tahun', $tahun);
        $this->db->group_by('p.tahun');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Seminar berdasarkan kategori dan tahun
    public function getTotalSeminarByYear($tahun)
    {
        $this->db->select('prosiding.kategori, COUNT(*) as total');
        $this->db->from('prosiding');
        $this->db->where('prosiding.tahun', $tahun);
        $this->db->group_by('prosiding.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Dana Penelitian berdasarkan kategori dan tahun
    public function getTotalDanaPenelitianByYear($tahun)
    {
        $this->db->select('penelitian.kategori, SUM(penelitian.besar_hibah) as total_hibah');
        $this->db->from('penelitian');
        $this->db->where('penelitian.tahun', $tahun);
        $this->db->group_by('penelitian.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Pengabdian berdasarkan kategori dan tahun
    public function getTotalPengabdianByYear($tahun)
    {
        $this->db->select('pengabdian.kategori, COUNT(*) as total');
        $this->db->from('pengabdian');
        $this->db->where('pengabdian.tahun', $tahun);
        $this->db->group_by('pengabdian.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil total Dana Pengabdian berdasarkan kategori dan tahun
    public function getTotalDanaPengabdianByYear($tahun)
    {
        $this->db->select('pengabdian.kategori, SUM(pengabdian.besar_hibah) as total_hibah');
        $this->db->from('pengabdian');
        $this->db->where('pengabdian.tahun', $tahun);
        $this->db->group_by('pengabdian.kategori');
        $query = $this->db->get();
        return $query->result_array();
    }
}
