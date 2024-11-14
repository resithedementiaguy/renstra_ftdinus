<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_renstra extends CI_Model
{

    public function add_iku_level1($data)
    {
        return $this->db->insert('iku_level1', $data);
    }

    public function get_iku_level1()
    {
        $this->db->select('*');
        $this->db->from('iku_level1');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_iku_level1($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('iku_level1', $data);
    }

    public function delete_iku_level1($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_iku_level2($data)
    {
        return $this->db->insert('iku_level2', $data);
    }

    public function get_iku_level2()
    {
        $this->db->select('*');
        $this->db->from('iku_level2');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_iku_level2($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('iku_level2', $data);
    }

    public function delete_iku_level2($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_iku_level3($data)
    {
        return $this->db->insert('iku_level3', $data);
    }

    public function get_iku_level3()
    {
        $this->db->select('*');
        $this->db->from('iku_level3');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_iku_level3($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('iku_level3', $data);
    }

    public function delete_iku_level3($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_iku_level4($data)
    {
        return $this->db->insert('iku_level4', $data);
    }

    public function get_iku_level4()
    {
        $this->db->select('*');
        $this->db->from('iku_level4');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_iku_level4($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('iku_level4', $data);
    }

    public function delete_iku_level4($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function get_level2_by_level1($id_level1)
    {
        $this->db->where('id_level1', $id_level1);
        $query = $this->db->get('iku_level2');

        if ($query->num_rows() == 0) {
            log_message('error', 'Tidak ada data yang cocok untuk ID Level 1: ' . $id_level1);
            return false;
        }

        return $query->result();
    }

    public function get_level3_by_level2($id_level2)
    {
        $this->db->where('id_level2', $id_level2);
        $query = $this->db->get('iku_level3');
        return $query->result();
    }
}
