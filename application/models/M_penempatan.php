<?php

class M_penempatan extends CI_Model
{
    public function get_all_penempatan()
    {
        $query = $this->db->query('SELECT * FROM status_penempatan');
        return $query->result_array();
    }

    public function count_all_penempatan()
    {
        $hasil = $this->db->query('SELECT COUNT(id_penempatan) as total_penempatan FROM penempatan ');
        return $hasil;
    }

    public function edit_penempatan($id_penempatan,$nama_penempatan,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_penempatan SET nama_penempatan='$nama_penempatan',gaji='$gaji' WHERE id_penempatan = $id_penempatan");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_penempatan($id_penempatan)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_penempatan WHERE id_penempatan='$id_penempatan'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_penempatan($nama_penempatan,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_penempatan(nama_penempatan,gaji) VALUES ('$nama_penempatan','$gaji')");
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
