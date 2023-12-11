<?php

class M_no_spk extends CI_Model
{
    public function get_all_no_spk()
    {
        $query = $this->db->query('SELECT * FROM status_no_spk');
        return $query->result_array();
    }

    public function count_all_no_spk()
    {
        $hasil = $this->db->query('SELECT COUNT(id_no_spk) as total_no_spk FROM status_no_spk ');
        return $hasil;
    }

    public function edit_no_spk($id_no_spk,$nama_no_spk)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE status_no_spk SET nama_no_spk='$nama_no_spk' WHERE id_no_spk = $id_no_spk");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror_edit','eror_edit');}
    }

    public function delete_no_spk($id_no_spk)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_no_spk WHERE id_no_spk='$id_no_spk'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_no_spk($nama_no_spk)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO status_no_spk(nama_no_spk) VALUES ('$nama_no_spk')");
        $this->db->trans_complete();
        
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input','input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror','eror');
        }
    }

}
