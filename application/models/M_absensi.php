<?php

class M_absensi extends CI_Model
{
    public function get_all_absensi()
    {
        $query = $this->db->query('SELECT user_detail.nip, user_detail.nama_lengkap, tanggal_absen, absensi_level.nama_status
                                    FROM status_absensi
                                    LEFT JOIN user_detail ON user_detail.id_user_detail = status_absensi.id_user_detail
                                    LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                    ');

        return $query->result_array();
    }

    public function get_data_absensi() {
        $query = $this->db->query('SELECT user_detail.nip, tanggal_absen, absensi_level.nama_status
            FROM status_absensi
            LEFT JOIN user_detail ON user_detail.id_user_detail = status_absensi.id_user_detail
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW())');

        $data_absensi = array();

        foreach ($query->result() as $row) {
            $tanggal = $row->tanggal_absen;
            $nip = $row->nip;
            $status = $row->nama_status;

            // Mengelompokkan data berdasarkan tanggal dan NIP
            if (!isset($data_absensi[$tanggal])) {
                $data_absensi[$tanggal] = array();
            }

            $data_absensi[$tanggal][$nip] = $status;
        }

        return $data_absensi;
    }

    public function get_data_absensi_operator($id_user_detail) {
        $query = $this->db->query("SELECT tanggal_absen, absensi_level.nama_status
            FROM status_absensi
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW()) AND id_user_detail = '$id_user_detail'");

        $data_absensi = array();

        if ($query) {
            foreach ($query->result() as $row) {
                $tanggal = $row->tanggal_absen;
                $status = $row->nama_status;

                // Mengelompokkan data berdasarkan tanggal dan NIP
                if (!isset($data_absensi[$tanggal])) {
                    $data_absensi[$tanggal] = array();
                }

                $data_absensi[$tanggal]= $status;
            }
        }
        return $data_absensi;
    }

}
