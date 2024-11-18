<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ewmp_model extends CI_Model
{

    public function add_pelaporan_ewmp($data)
    {
        return $this->db->insert('pelaporan_ewmp', $data);
    }

    public function get_pelaporan_ewmp()
    {
        $this->db->select('*');
        $this->db->from('pelaporan_ewmp');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_last_pelaporan_id()
    {
        $this->db->select('id'); // Asumsi kolom ID adalah 'id'
        $this->db->from('pelaporan_ewmp');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();

        return $result ? $result->id : null;
    }

    public function update_pelaporan_ewmp($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pelaporan_ewmp', $data);
    }

    public function delete_pelaporan_ewmp($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_penelitian($data)
    {
        return $this->db->insert('penelitian', $data);
    }

    public function get_penelitian()
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_penelitian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('penelitian', $data);
    }

    public function delete_penelitian($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }

    public function add_pengabdian($data)
    {
        return $this->db->insert('pengabdian', $data);
    }

    public function get_pengabdian()
    {
        $this->db->select('*');
        $this->db->from('pengabdian');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_pengabdian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('pengabdian', $data);
    }

    public function delete_pengabdian($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('status_stok');
    }
}
