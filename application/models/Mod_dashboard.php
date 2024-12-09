<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dashboard extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_dosen()
    {
        $this->db->select('*');
        $this->db->from('jumlah_dosen');
        $query = $this->db->get();
        return $query->result();
    }
}
