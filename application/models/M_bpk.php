<?php

class M_bpk extends CI_Model
{
    public function get_all_bpk()
    {
        $query = $this->db->query('SELECT * FROM status_bpk');
        return $query->result_array();
    }

    public function count_all_bpk()
    {
        $hasil = $this->db->query('SELECT COUNT(id_level) as total_bpk FROM status_bpk ');
        return $hasil;
    }

    public function edit_bpk($id_level,$nama_bpk,$gaji_bpk)
    {
        if ($gaji_bpk == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_bpk SET nama_bpk='$nama_bpk',gaji_bpk='$gaji_bpk' WHERE id_level_bpk = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_bpk($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_bpk WHERE id_level_bpk='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_bpk($nama_bpk,$gaji_bpk)
    {
        if ($gaji_bpk == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_bpk(nama_bpk,gaji_bpk) VALUES ('$nama_bpk','$gaji_bpk')");
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
