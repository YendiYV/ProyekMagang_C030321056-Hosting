<?php
class M_gaji extends CI_Model 
{
    public function get_all_gaji()
    {
        $query = $this->db->query('SELECT user.*, user_detail.*,operator_level.* ,status_proyek.*,status_penempatan.*
                                    FROM user_detail
                                    LEFT JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    WHERE user.id_user_level = 1');
        return $query;
    }
}
