<?php

class M_absensi extends CI_Model
{
    public function get_all_absensi()
    {
        $query = $this->db->query('SELECT user_detail.nip, user_detail.nama_lengkap, tanggal_absen, absensi_level.nama_status
                                    FROM status_absensi
                                    LEFT JOIN user_detail ON user_detail.id_user_detail = status_absensi.id_user_detail
                                    LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                    WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW());
                                    ');
        return $query->result_array();
    }
}
