<?php

class M_insfeksi extends CI_Model
{
    public function get_all_insfeksi()
    {
        $query = $this->db->query('SELECT * FROM status_insfeksi LEFT JOIN user_detail ON user_detail.nip = status_insfeksi.id_user_detail ORDER BY user_detail.nip ASC');
        return $query->result_array();
    }

    public function count_all_insfeksi()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user_detail) as total_data_insfeksi FROM status_insfeksi WHERE  gaji_insfeksi > 0;');
        return $hasil;
    }

    public function edit_insfeksi($id_user_detail,$gaji_insfeksi)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE status_insfeksi SET gaji_insfeksi='$gaji_insfeksi' WHERE id_user_detail = '$id_user_detail'");
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror_edit','eror_edit');}
    }
}
