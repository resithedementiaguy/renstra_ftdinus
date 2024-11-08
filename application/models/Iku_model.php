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

    public function update_target($target_id, $year, $value, $level_type)
    {
        // Tentukan tabel berdasarkan level_type
        $table = ($level_type === 'level3') ? 'target_level3' : 'target_level4';

        // Cek apakah target sudah ada atau belum
        $this->db->where('id_level' . ($level_type === 'level3' ? '3' : '4'), $target_id);
        $this->db->where('tahun_target', $year);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            // Jika target ada, lakukan update
            $this->db->where('id_level' . ($level_type === 'level3' ? '3' : '4'), $target_id);
            $this->db->where('tahun_target', $year);
            return $this->db->update($table, ['isi_target' => $value]);
        } else {
            // Jika tidak ada, lakukan insert
            return $this->db->insert($table, [
                'id_level' . ($level_type === 'level3' ? '3' : '4') => $target_id,
                'tahun_target' => $year,
                'isi_target' => $value
            ]);
        }
    }
}
