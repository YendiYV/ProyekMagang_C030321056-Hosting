<?php

class M_tmk extends CI_Model
{
    public function get_all_tmk()
    {
        $query = $this->db->query('SELECT * FROM status_tmk');
        return $query->result_array();
    }

    public function edit_tmk($id_status_tmk,$rupiah_tmk)
    {
        if ($rupiah_tmk == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_tmk SET rupiah_tmk='$rupiah_tmk' WHERE id_status_tmk = $id_status_tmk");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function insert_tmk($rupiah_tmk)
    {
        if ($rupiah_tmk== 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $query = $this->db->query("SELECT MAX(id_status_tmk) AS max_id, MAX(tahun_tmk) AS max_tahun FROM status_tmk");
            $result = $query->row();

            // Menambahkan 1 ke nilai maksimum
            $new_id = $result->max_id + 1;
            $new_tahun = $result->max_tahun + 1;

            $this->db->trans_start();
            // Melakukan INSERT dengan nilai yang lebih besar
            $this->db->query("INSERT INTO status_tmk(id_status_tmk, tahun_tmk, rupiah_tmk) VALUES ('$new_id', '$new_tahun', '$rupiah_tmk')");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('input', 'input');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('error', 'error');
                
            }
        }
    }

}
