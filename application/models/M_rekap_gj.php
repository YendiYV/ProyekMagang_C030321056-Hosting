<?php

class M_rekap_gj extends CI_Model {

    public function count_data_gj()
    {
        $hasil = $this->db->query('SELECT user.*, user_detail.*, COUNT(user_detail.no_spk) AS count_no_spk, status_no_spk.*
                                    FROM user_detail
                                    JOIN user ON user.username = user_detail.nip
                                    LEFT JOIN status_no_spk ON user_detail.no_spk = status_no_spk.id_no_spk
                                    WHERE user.id_user_level = 1
                                    GROUP BY user_detail.no_spk
                                    ORDER BY user_detail.nip ASC
                                ');
        return $hasil;
    }
}
