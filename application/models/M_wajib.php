<?php

class M_wajib extends CI_Model
{
    public function get_all_wajib()
    {
        $query = $this->db->query('SELECT * FROM status_wajib');
        return $query->result_array();
    }
}