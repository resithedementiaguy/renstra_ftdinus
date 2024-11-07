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

    public function get_target_level3($level3_id)
    {
        $this->db->select('tahun_target, isi_target');
        $this->db->where('id_level3', $level3_id);
        $query = $this->db->get('target_level3');
        $results = $query->result();

        $targets = [];
        foreach ($results as $row) {
            $targets[$row->tahun_target] = $row->isi_target;
        }
        return $targets;
    }

    public function get_target_level4($level4_id)
    {
        $this->db->select('tahun_target, isi_target');
        $this->db->where('id_level4', $level4_id);
        $query = $this->db->get('target_level4');
        $results = $query->result();

        $targets = [];
        foreach ($results as $row) {
            $targets[$row->tahun_target] = $row->isi_target;
        }
        return $targets;
    }
}
