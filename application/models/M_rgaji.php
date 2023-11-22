<?php

class M_rgaji extends CI_Model
{
    public function get_all_gaji_bulan()
    {
        $query = $this->db->query('SELECT * FROM status_gaji_bulanan LEFT JOIN user_detail ON status_gaji_bulanan.id_user_detail = user_detail.id_user_detail');

        return $query->result_array();
    }

    public function get_all_gaji_bulan_manager()
    {
        $query = $this->db->query('SELECT user_detail.nama_lengkap ,user_detail.nip, status_gaji_bulanan.* FROM status_gaji_bulanan LEFT JOIN user_detail ON user_detail.id_user_detail = status_gaji_bulanan.id_user_detail');

        return $query->result_array();
    }

    public function count_all_rgaji()
    {
        $hasil = $this->db->query('SELECT COUNT(no_sgb) as total_rgaji FROM status_gaji_bulanan ');
        return $hasil;
    }

    public function count_all_rgaji_bulan_ini()
    {
        $hasil = $this->db->query("SELECT COUNT(id_user_detail) as total_data_gaji FROM status_gaji_bulanan WHERE DATE_FORMAT(gaji_bulan, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')");
        return $hasil;
    }

    public function data_per_tanggal(){
        $hasil = $this->db->query("SELECT gaji_bulan, COUNT(*) AS jumlah_record FROM status_gaji_bulanan GROUP BY gaji_bulan");
        return $hasil;
    }

    public function insert_gaji_bulan($username, $tanggal_gaji,$total_gaji,$tanggal_simpan)
    {
        if ($total_gaji < 0) {
            $this->session->set_flashdata('eror');
            return false;
        }else{
            $this->db->trans_start();
            $this->db->query("INSERT INTO status_gaji_bulanan(id_user_detail,gaji_bulan,total_gaji,tgl_simpan) VALUES ('$username','$tanggal_gaji', '$total_gaji','$tanggal_simpan')");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('input','input');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror','eror');}
        }
    }

    public function edit_gaji_bulan($id_user_detail,$gaji_bulan,$total_gaji,$tanggal_simpan)
    {
        if ($gaji_bulan < 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false;
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_gaji_bulanan SET total_gaji='$total_gaji',gaji_bulan='$gaji_bulan', tgl_simpan='$tanggal_simpan' WHERE id_user_detail = '$id_user_detail'");
            $this->db->trans_complete();

            if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
            } else {
                $this->session->set_flashdata('eror_edit','eror_edit');}
        }
    }
    public function edit_gaji_bulan_tambah($username, $tanggal_gaji, $total_gaji,$tanggal_simpan)
    {
        if ($gaji_bulan < 0) {
            $this->session->set_flashdata('eror_edit','eror_edit');
            return false;
        }else{
            $this->db->trans_start();
            $this->db->query("UPDATE status_gaji_bulanan SET total_gaji='$total_gaji',gaji_bulan='$tanggal_gaji', tgl_simpan='$tanggal_simpan' WHERE id_user_detail = '$username'");
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

    public function check_data_gaji($username,$tanggal_simpan){
        $query = $this->db->query("SELECT * FROM status_gaji_bulanan WHERE id_user_detail='$username' AND tgl_simpan='$tanggal_simpan'");

        return $query->result_array();
    }
}
