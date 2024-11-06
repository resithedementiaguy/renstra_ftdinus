<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iku_model extends CI_Model
{

    public function get_level1()
    {
        $this->db->select('*');
        $this->db->from('iku_level1');
        return $this->db->get()->result();
    }

    public function get_level2($id_level1)
    {
        $this->db->select('*');
        $this->db->from('iku_level2');
        $this->db->where('id_level1', $id_level1);
        return $this->db->get()->result();
    }

    public function get_level3($id_level2)
    {
        $this->db->select('*');
        $this->db->from('iku_level3');
        $this->db->where('id_level2', $id_level2);
        return $this->db->get()->result();
    }

    public function get_level4($id_level3)
    {
        $this->db->select('*');
        $this->db->from('iku_level4');
        $this->db->where('id_level3', $id_level3);
        return $this->db->get()->result();
    }

    public function get_target_level3($level3_id, $tahun = null)
    {
        // Example query to fetch target data
        $this->db->where('id_level3', $level3_id);

        if ($tahun) {
            $this->db->where('tahun_target', $tahun);
        }

        $query = $this->db->get('target_level3');
        return $query->result();
    }


    public function get_target_level4($level4_id, $tahun = null) {
        $this->db->where('id_level4', $level4_id);
        
        if ($tahun) {
            $this->db->where('tahun_target', $tahun);
        }
        
        $query = $this->db->get('target_level4');
        return $query->result();
    }
    
}
