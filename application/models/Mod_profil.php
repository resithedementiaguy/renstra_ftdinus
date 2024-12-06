<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_profil extends CI_Model
{
    public function get_user($user_id)
    {
        return $this->db->get_where('user', ['id' => $user_id])->row();
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }
}
