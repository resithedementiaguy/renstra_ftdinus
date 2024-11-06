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
        $this->db->order_by('id', 'DESC');
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
}