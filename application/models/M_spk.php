<?php

class M_spk extends CI_Model
{
    public function get_all_spk()
    {
        $query = $this->db->query('SELECT * FROM status_spk');
        return $query->result_array();
    }

    public function count_all_spk()
    {
        $hasil = $this->db->query('SELECT COUNT(id_spk) as total_spk FROM status_spk ');
        return $hasil;
    }

    public function edit_spk($id_spk,$nama_spk)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE status_spk SET nama_spk='$nama_spk' WHERE id_spk = $id_spk");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror_edit','eror_edit');}
    }

    public function delete_spk($id_spk)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_spk WHERE id_spk='$id_spk'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_spk($nama_spk)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO status_spk(nama_spk) VALUES ('$nama_spk')");
        $this->db->trans_complete();
        
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input','input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror','eror');
        }
    }

}
