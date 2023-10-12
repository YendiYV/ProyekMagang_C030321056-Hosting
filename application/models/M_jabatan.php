<?php

class M_jabatan extends CI_Model
{
    public function get_all_jabatan()
    {
        $query = $this->db->query('SELECT * FROM operator_level');
        return $query->result_array();
    }

    public function count_all_jabatan()
    {
        $hasil = $this->db->query('SELECT COUNT(id_level) as total_jabatan FROM operator_level ');
        return $hasil;
    }

    public function edit_jabatan($id_level,$operator_level,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE operator_level SET operator_level='$operator_level',gaji_level='$gaji' WHERE id_level = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_jabatan($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM operator_level WHERE id_level='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_jabatan($operator_level,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO operator_level(operator_level,gaji_level) VALUES ('$operator_level','$gaji')");
            $this->db->trans_complete();
            
            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('input','input');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror','eror');
            }
        }
    }

}
