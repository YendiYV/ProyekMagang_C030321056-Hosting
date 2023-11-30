<?php

class M_absensi extends CI_Model
{
    public function get_all_absensi()
    {
        $query = $this->db->query('SELECT user_detail.nip, user_detail.nama_lengkap, tanggal_absen, absensi_level.*,status_absensi.*
                                    FROM status_absensi
                                    LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
                                    LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                    ');

        return $query->result_array();
    }

    public function get_data_absensi() {
        $query = $this->db->query('SELECT user_detail.nip, tanggal_absen, absensi_level.nama_status,absensi_level.id_absen_level,absensi_level.singkatan_status
            FROM status_absensi
            LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW())');

        $data_absensi = array();

        foreach ($query->result() as $row) {
            $tanggal = $row->tanggal_absen;
            $nip = $row->nip;
            $status = $row->singkatan_status;

            // Mengelompokkan data berdasarkan tanggal dan NIP
            if (!isset($data_absensi[$tanggal])) {
                $data_absensi[$tanggal] = array();
            }

            $data_absensi[$tanggal][$nip] = $status;
        }

        return $data_absensi;
    }

    public function get_all_absensi_menurut_bulan($cari_bulan)
    {
        $query = $this->db->query("SELECT user_detail.nip, user_detail.nama_lengkap, tanggal_absen, absensi_level.nama_status
                                    FROM status_absensi
                                    LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
                                    LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                    WHERE DATE_FORMAT(tanggal_absen, '%Y-%m') = '$cari_bulan'");
        return $query->result_array();
    }

    public function get_data_absensi_bulan($cari_bulan)
    {
        $query = $this->db->query("SELECT user_detail.nip, tanggal_absen, absensi_level.nama_status, absensi_level.id_absen_level, absensi_level.singkatan_status
            FROM status_absensi
            LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE DATE_FORMAT(tanggal_absen, '%Y-%m') = '$cari_bulan'");

        $data_absensi = array();

        foreach ($query->result() as $row) {
            $tanggal = $row->tanggal_absen;
            $nip = $row->nip;
            $status = $row->singkatan_status;

            // Mengelompokkan data berdasarkan tanggal dan NIP
            if (!isset($data_absensi[$tanggal])) {
                $data_absensi[$tanggal] = array();
            }

            $data_absensi[$tanggal][$nip] = $status;
        }

        return $data_absensi;
    }


    public function get_all_absensi_menurut_tanggal($tanggal)
    {
        $query = $this->db->query('SELECT user_detail.nip, user_detail.nama_lengkap, tanggal_absen, absensi_level.nama_status
                                    FROM status_absensi
                                    LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
                                    LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                    ');

        return $query->result_array();
    }

    public function get_data_absensi_menurut_tanggal($tanggal) {
        $query = $this->db->query('SELECT user_detail.nip, tanggal_absen, absensi_level.nama_status,absensi_level.id_absen_level,absensi_level.singkatan_status
            FROM status_absensi
            LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW())');

        $data_absensi = array();

        foreach ($query->result() as $row) {
            $tanggal = $row->tanggal_absen;
            $nip = $row->nip;
            $status = $row->singkatan_status;

            // Mengelompokkan data berdasarkan tanggal dan NIP
            if (!isset($data_absensi[$tanggal])) {
                $data_absensi[$tanggal] = array();
            }

            $data_absensi[$tanggal][$nip] = $status;
        }

        return $data_absensi;
    }

    public function get_data_absensi_operator($username) {
        $query = $this->db->query("SELECT tanggal_absen, absensi_level.nama_status,status_absen,absensi_level.singkatan_status
            FROM status_absensi
            LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
            WHERE MONTH(tanggal_absen) = MONTH(NOW()) AND YEAR(tanggal_absen) = YEAR(NOW()) AND id_user_detail = ?", array($username));

        $data_absensi = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tanggal = $row->tanggal_absen;
                $status = $row->singkatan_status;

                // Mengelompokkan data berdasarkan tanggal
                if (!isset($data_absensi[$tanggal])) {
                    $data_absensi[$tanggal] = array();
                }

                $data_absensi[$tanggal][] = $status;
            }
        }
        return $data_absensi;
    }

    public function cek_kehadiran_absensi($username) {
        $today = date('Y-m-d');

        $ketersediaan_data = $this->db->query("SELECT COUNT(*) as jumlah_kehadiran
            FROM status_absensi
            WHERE id_user_detail = '$username'
            AND tanggal_absen = '$today'
            AND status_absen BETWEEN 1 AND 4
        ");

        $row = $ketersediaan_data->row();
        return $row;
    }

    public function cek_kehadiran_absensi2($username) {
        $today = date('Y-m-d');

        $ketersediaan_data2 = $this->db->query("SELECT * FROM status_absensi WHERE id_user_detail = '$username' AND tanggal_absen = '$today' ");
        
        // Mengambil hasil dari kueri dan mengembalikannya sebagai array
        return $ketersediaan_data2;
    }

    public function cek_status_absensi($username) {
        $today = date('Y-m-d');  

        $hasil = $this->db->query("SELECT 
                                    status_absen, 
                                    nama_status,
                                    CASE
                                        WHEN status_absen = 1 THEN 'text-success'
                                        WHEN status_absen = 2 THEN 'text-primary'
                                        WHEN status_absen = 3 THEN 'text-warning'
                                        WHEN status_absen = 4 THEN 'text-primary'
                                        WHEN status_absen = 5 THEN 'text-danger'   
                                        WHEN status_absen = 6 THEN 'text-success'                   
                                        END AS color_class
                                FROM status_absensi
                                LEFT JOIN absensi_level ON absensi_level.id_absen_level = status_absensi.status_absen
                                WHERE id_user_detail = '$username' AND tanggal_absen = '$today'
                                ");
        return $hasil;
    }

    public function cek_status_untuk_absen_pulang($username) {
        $today = date('Y-m-d');  

        $hasil = $this->db->query("SELECT COUNT(*) as count FROM status_absensi WHERE id_user_detail = '$username' AND tanggal_absen = '$today' AND status_absen ='1'");
        
        return $hasil;
    }




    public function insert_hadir($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$username', '$currentDateTime', '1')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_sakit($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$username', '$currentDateTime', '3')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_ijin($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$username', '$currentDateTime', '4')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }

    public function insert_cuti($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$username', '$currentDateTime', '2')");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input', 'input');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_pulang($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("UPDATE status_absensi SET status_absen='6' WHERE id_user_detail = '$username' AND tanggal_absen= '$currentDateTime'");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input_pulang', 'input_pulang');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('error', 'error');
            
        }
    }
    public function insert_alfa($username){
        $this->db->trans_start();
        $currentDateTime = date('Y-m-d');
        $this->db->query("INSERT INTO status_absensi(id_user_detail, tanggal_absen, status_absen) VALUES ('$username', '$currentDateTime', '5')");

        $this->db->trans_complete();
    }

    public function cek_absensi_hari_ini($username){
        $currentDateTime = date('Y-m-d');
        $hasil = $this->db->query("SELECT COUNT(*) as jumlah_absensi FROM status_absensi WHERE id_user_detail = '$username' AND tanggal_absen= '$currentDateTime'");
        $row = $hasil->row();
        return $row->jumlah_absensi;
    }
    
    public function hapus_absensi_admin($nip,$tanggal) {
        $this->db->trans_start();

        // Perbaikan pernyataan SQL
        $sql = "DELETE status_absensi FROM status_absensi 
                LEFT JOIN user_detail  ON status_absensi.id_user_detail = user_detail.nip
                WHERE status_absensi.tanggal_absen = ? AND user_detail.nip = ?";

        $this->db->query($sql, array($tanggal, $nip));

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->session->set_flashdata('hapus', 'hapus');
            return TRUE;
        } else {
            $this->session->set_flashdata('eror_hapus', 'eror_hapus');
            return FALSE;
        }
    }

    public function edit_absensi_admin($nip, $tanggal, $status_absen) {
        $this->db->trans_start();

        // Perbaikan pernyataan SQL
        $sql = "UPDATE status_absensi AS sa
                LEFT JOIN user_detail AS ud ON sa.id_user_detail = ud.nip
                SET sa.status_absen = ?
                WHERE sa.tanggal_absen = ? AND ud.nip = ?";

        $this->db->query($sql, array($status_absen, $tanggal, $nip));

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->session->set_flashdata('edit', 'edit');
            return TRUE;
        } else {
            $this->session->set_flashdata('eror_edit', 'eror_edit');
            return FALSE;
        }
    }

    public function cek_edit_absensi_admin_data_kosong($nip, $tanggal) {
        $query = $this->db->query("SELECT COUNT(*) as edit_admin_kosong
            FROM status_absensi
            LEFT JOIN user_detail ON user_detail.nip = status_absensi.id_user_detail
            WHERE user_detail.nip = '$nip'  
            AND tanggal_absen = '$tanggal'  
        ");

        $row = $query->row();
        return $row->edit_admin_kosong;
    }

    public function edit_absensi_admin_data_kosong($username,$tanggal,$status_absen){
        $this->db->trans_start();

        // Perbaikan pernyataan SQL
        $this->db->query("INSERT INTO status_absensi (id_user_detail, tanggal_absen, status_absen) VALUES ('$username','$tanggal','$status_absen')");  
        
        $this->db->trans_complete();
            
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit2','edit2');
            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror','eror');
        }
    }
    public function cari_absensi_admin_data_kosong($nip){
        $query = $this->db->query("SELECT nip FROM user_detail WHERE nip='$nip'");
        $result = $query->row(); // Mengambil satu baris data dari hasil query
        return $result; // Mengembalikan hasil query sebagai nilai kembali
    }

}
