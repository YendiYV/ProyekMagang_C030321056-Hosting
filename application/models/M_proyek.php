<?php

class M_proyek extends CI_Model
{
    public function get_all_proyek()
    {
        $query = $this->db->query('SELECT * FROM status_proyek');
        return $query->result_array();
    }

    public function count_all_proyek()
    {
        $hasil = $this->db->query('SELECT COUNT(id_status_proyek) as total_proyek FROM status_proyek');
        return $hasil;
    }

    public function edit_proyek($id_status_proyek,$nama_proyek,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Proyek tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_proyek SET nama_proyek='$nama_proyek',gaji='$gaji' WHERE id_status_proyek = $id_status_proyek");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_proyek($id_proyek)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_proyek WHERE id_status_proyek='$id_proyek'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_proyek($nama_proyek,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Proyek tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_proyek(nama_proyek,gaji) VALUES ('$nama_proyek','$gaji')");
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
