<?php

class M_transport extends CI_Model
{
    public function get_all_transport()
    {
        $query = $this->db->query('SELECT * FROM status_transport');
        return $query->result_array();
    }

    public function count_all_transport()
    {
        $hasil = $this->db->query('SELECT COUNT(id_transport) as total_transport FROM status_transport ');
        return $hasil;
    }

    public function edit_transport($id_transport,$nama_transport,$tunjangan_transport)
    {
        if ($tunjangan_transport == 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_transport SET nama_transport='$nama_transport',tunjangan_transport='$tunjangan_transport' WHERE id_transport = $id_transport");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_transport($id_transport)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_transport WHERE id_transport='$id_transport'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }


    public function insert_transport($nama_transport,$gaji)
    {
        if ($gaji == 0) {
            $this->session->set_flashdata('eror','eror');
            return false; // Jabatan tidak akan disimpan jika gaji = 0
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_transport(nama_transport,tunjangan_transport) VALUES ('$nama_transport','$gaji')");
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
