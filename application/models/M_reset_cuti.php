<?php
class M_reset_cuti extends CI_Model 
{
    public function reset_jumlah_hari($id_user) {
        $this->db->trans_start();
        $this->db->query("UPDATE user_detail SET jumlah_cuti = 0 WHERE DATE_FORMAT(tanggal_masuk, '%m-%d') = DATE_FORMAT(CURRENT_DATE, '%m-%d') AND DATE_FORMAT(tanggal_masuk, '%Y') != DATE_FORMAT(CURRENT_DATE, '%Y') AND id_user_detail = '$id_user'");
        $this->db->trans_complete();
    }

}
