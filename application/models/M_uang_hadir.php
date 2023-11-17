<?php

class M_uang_hadir extends CI_Model
{
    public function get_all_uang_hadir()
    {
        $query = $this->db->query('SELECT * FROM status_uang_hadir');
        return $query->result_array();
    }

    public function count_all_uang_hadir()
    {
        $hasil = $this->db->query('SELECT COUNT(id_uang_hadir) as total_uang_hadir FROM status_uang_hadir ');
        return $hasil;
    }

    public function edit_uang_hadir($id_level,$nama_uang_hadir,$gaji_uang_hadir)
    {
        if ($gaji_uang_hadir == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_uang_hadir SET nama_uang_hadir='$nama_uang_hadir',tunjangan_uang_hadir='$gaji_uang_hadir' WHERE id_uang_hadir = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_uang_hadir($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_uang_hadir WHERE id_uang_hadir='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_uang_hadir($nama_uang_hadir,$gaji_uang_hadir)
    {
        if ($gaji_uang_hadir == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_uang_hadir(nama_uang_hadir,tunjangan_uang_hadir) VALUES ('$nama_uang_hadir','$gaji_uang_hadir')");
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
