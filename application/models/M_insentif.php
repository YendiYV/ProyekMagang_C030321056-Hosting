<?php

class M_insentif extends CI_Model
{
    public function get_all_insentif()
    {
        $query = $this->db->query('SELECT * FROM status_insentif');
        return $query->result_array();
    }

    public function count_all_insentif()
    {
        $hasil = $this->db->query('SELECT COUNT(id_insentif) as total_insentif FROM status_insentif ');
        return $hasil;
    }

    public function edit_insentif($id_level,$nama_insentif,$gaji_insentif)
    {
        if ($gaji_insentif == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_insentif SET nama_insentif='$nama_insentif',tunjangan_insentif='$gaji_insentif' WHERE id_insentif = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_insentif($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_insentif WHERE id_insentif='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_insentif($nama_insentif,$gaji_insentif)
    {
        if ($gaji_insentif == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_insentif(nama_insentif,tunjangan_insentif) VALUES ('$nama_insentif','$gaji_insentif')");
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
