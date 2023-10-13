<?php
class M_gaji extends CI_Model 
{
    public function get_all_gaji()
    {
        $query = $this->db->query('SELECT
                                    user.username,
                                    user_detail.nama_lengkap,
                                    operator_level.gaji_level,
                                    status_proyek.gaji_proyek,
                                    status_penempatan.gaji_penempatan,
                                    status_tmk.rupiah_tmk,
                                    ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365, 2) AS lamanya_kerja_dalam_tahun
                                FROM user_detail
                                    LEFT JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_tmk ON
                                    LEFT(ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365, 2), 1) = LEFT(status_tmk.tahun_tmk, 1)
                                WHERE user.id_user_level = 1;
                                ');     
        return $query;
    }
}
