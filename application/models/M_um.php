<?php

class M_um extends CI_Model
{  
    public function get_all_um()
    {
        $query = $this->db->query('SELECT * FROM status_um');
        return $query->result_array();
    }
}