<?php

class M_delta extends CI_Model
{
    public function get_all_delta()
    {
        $query = $this->db->query('SELECT * FROM status_delta');
        return $query->result_array();
    }

    public function count_all_delta()
    {
        $hasil = $this->db->query('SELECT COUNT(id_level_delta) as total_delta FROM status_delta ');
        return $hasil;
    }

    public function edit_delta($id_level,$nama_delta,$gaji_delta)
    {
        if ($gaji_delta == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_delta SET nama_delta='$nama_delta',gaji_delta='$gaji_delta' WHERE id_level_delta = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_delta($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_delta WHERE id_level_delta='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_delta($nama_delta,$gaji_delta)
    {
        if ($gaji_delta == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_delta(nama_delta,gaji_delta) VALUES ('$nama_delta','$gaji_delta')");
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
