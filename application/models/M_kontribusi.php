<?php

class M_kontribusi extends CI_Model
{
    public function get_all_kontribusi()
    {
        $query = $this->db->query('SELECT * FROM status_kontribusi');
        return $query->result_array();
    }

    public function count_all_kontribusi()
    {
        $hasil = $this->db->query('SELECT COUNT(id_kontribusi) as total_kontribusi FROM status_kontribusi ');
        return $hasil;
    }

    public function edit_kontribusi($id_level,$nama_kontribusi,$gaji_kontribusi)
    {
        if ($gaji_kontribusi == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_kontribusi SET nama_kontribusi='$nama_kontribusi',tunjangan_kontribusi='$gaji_kontribusi' WHERE id_kontribusi = $id_level");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_kontribusi($id_level)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_kontribusi WHERE id_kontribusi='$id_level'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_kontribusi($nama_kontribusi,$gaji_kontribusi)
    {
        if ($gaji_kontribusi == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_kontribusi(nama_kontribusi,tunjangan_kontribusi) VALUES ('$nama_kontribusi','$gaji_kontribusi')");
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
