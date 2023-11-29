<?php

class M_kategori extends CI_Model
{
    public function get_all_kategori()
    {
        $query = $this->db->query('SELECT * FROM status_kategori');
        return $query->result_array();
    }
}