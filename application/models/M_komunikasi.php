<?php

class M_komunikasi extends CI_Model
{
    public function get_all_komunikasi()
    {
        $query = $this->db->query('SELECT * FROM status_komunikasi');
        return $query->result_array();
    }

    public function count_all_komunikasi()
    {
        $hasil = $this->db->query('SELECT COUNT(id_komunikasi) as total_komunikasi FROM status_komunikasi ');
        return $hasil;
    }

    public function edit_komunikasi($id_level,$nama_kom,$gaji_kom)
    {
        if ($gaji_kom == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_komunikasi SET nama_komunikasi='$nama_kom',tunjangan_komunikasi='$gaji_kom' WHERE id_komunikasi = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_komunikasi($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_komunikasi WHERE id_komunikasi='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_komunikasi($nama_kom,$gaji_kom)
    {
        if ($gaji_kom == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_komunikasi(nama_komunikasi,tunjangan_komunikasi) VALUES ('$nama_kom','$gaji_kom')");
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
