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
}