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
        $query = $this->db->query('SELECT user_detail.nip, tanggal_absen, absensi_level.nama_status,absensi_level.id_absen_level
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
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW()) AND id_user_detail = ?", array($id_user_detail));

        $data_absensi = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tanggal = $row->tanggal_absen;
                $status = $row->nama_status;

                // Mengelompokkan data berdasarkan tanggal
                if (!isset($data_absensi[$tanggal])) {
                    $data_absensi[$tanggal] = array();
                }

                $data_absensi[$tanggal][] = $status;
            }
        }
        return $data_absensi;
    }


    public function cek_status_absensi($id_user) {
        $today = date('Y-m-d');  

        $hasil = $this->db->query("SELECT 
                                    status_absen, 
                                    nama_status,
                                    CASE
                                        WHEN status_absen = 1 THEN 'text-success'
                                        WHEN status_absen = 2 THEN 'text-success'
                                        WHEN status_absen = 3 THEN 'text-warning'
                                        WHEN status_absen = 4 THEN 'text-primary'
                                        WHEN status_absen = 5 THEN 'text-danger'                      
                                        END AS color_class
                                FROM status_absensi
                                LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                WHERE id_user_detail = '$id_user' AND tanggal_absen = '$today'
                                ");
        return $hasil;
    }
    public function insert_hadir($id_user){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$id_user', '$currentDateTime', '1')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_sakit($id_user){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$id_user', '$currentDateTime', '3')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_ijin($id_user){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$id_user', '$currentDateTime', '4')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }

    public function insert_cuti($id_user){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$id_user', '$currentDateTime', '2')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_pulang($id_user){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query("UPDATE status_absensi SET status_absen='6' WHERE id_user_level = $id_user");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input_pulang', 'input_pulang');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }

}
