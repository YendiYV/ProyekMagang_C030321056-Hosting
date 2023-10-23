<?php

class M_rgaji extends CI_Model
{
    public function get_all_gaji_bulan()
    {
        $query = $this->db->query('SELECT * FROM status_gaji_bulanan');

        return $query->result_array();
    }

    public function count_all_rgaji()
    {
        $hasil = $this->db->query('SELECT COUNT(no_sgb) as total_rgaji FROM status_gaji_bulanan ');
        return $hasil;
    }

    public function insert_gaji_bulan($username, $tanggal_gaji,$total_gaji,$total_delta)
    {
        if ($total_gaji < 0) {
            $this->session->set_flashdata('eror');
            return false;
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_gaji_bulanan(id_user_detail,gaji_bulan,total_gaji,jumlah_delta) VALUES ('$username','$tanggal_gaji', '$total_gaji','$total_delta')");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('input','input');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror','eror');}
        }
    }

    public function edit_gaji_bulan($id_user_detail,$gaji_bulan,$total_gaji)
    {
        if ($gaji_bulan < 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false;
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_gaji_bulanan SET total_gaji='$total_gaji',gaji_bulan='$gaji_bulan' WHERE id_user_detail = '$id_user_detail'");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }

    public function delete_gaji_bulan($id_user_detail)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM status_gaji_bulanan WHERE id_user_detail='$id_user_detail'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('hapus','hapus');
        } else {
            $this->session->set_flashdata('eror_hapus','eror_hapus');
        }
    }

}
