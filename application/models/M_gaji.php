<?php
class M_gaji extends CI_Model 
{
    public function get_all_gaji()
    {
        $query = $this->db->query('SELECT user.username,user_detail.nama_lengkap,operator_level.gaji_level,status_proyek.gaji_proyek,status_penempatan.gaji_penempatan,status_tmk.rupiah_tmk,ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365,2) AS lamanya_kerja_dalam_tahun,status_bpk.gaji_bpk,status_delta.gaji_delta , status_transport.tunjangan_transport 
                                    FROM user_detail
                                    LEFT JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_tmk ON LEFT(ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365,2),1) = LEFT(status_tmk.tahun_tmk, 1)
                                    LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                    LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                    LEFT JOIN status_transport ON user_detail.transport = status_transport.id_transport
                                    WHERE user.id_user_level = 1;
                                ');     
        return $query;
    }

    public function update_data_tanpa_delta_same_month($username, $gaji_bulan, $total_per_orang_tanpa_delta) {
        $this->db->trans_start();
        $sql = "UPDATE status_gaji_bulanan SET total_gaji = '$total_per_orang_tanpa_delta', tanpa_delta = '$total_per_orang_tanpa_delta' WHERE id_user_detail = '$username' AND gaji_bulan = '$gaji_bulan'";
        $this->db->query($sql);
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror_edit','eror_edit');
        }
    }

    public function update_data_same_month($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta) {
        $this->db->trans_start();
        $sql = "UPDATE status_gaji_bulanan SET total_gaji = '$total_per_orang', tanpa_delta = '$total_per_orang_tanpa_delta' WHERE id_user_detail = '$username' AND gaji_bulan = '$gaji_bulan'";
        $this->db->query($sql);
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror_edit','eror_edit');
        }
    }

    public function update_data_same_month_tidak_ada_data($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta) {
        $this->db->trans_start();
        $sql = "UPDATE status_gaji_bulanan SET total_gaji = '$total_per_orang', tanpa_delta='$total_per_orang_tanpa_delta' WHERE id_user_detail = '$username' AND gaji_bulan = '$gaji_bulan'";
        $this->db->query($sql);
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror_edit','eror_edit');
        }
    }



    public function insert_data_tanpa_delta($username,$gaji_bulan,$total_per_orang_tanpa_delta){
        $this->db->trans_start();
        $this->db->query("INSERT INTO status_gaji_bulanan (id_user_detail, gaji_bulan, total_gaji , tanpa_delta) VALUES ('$username','$gaji_bulan', '$total_per_orang_tanpa_delta' ,'$total_per_orang_tanpa_delta')");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input','input');
            return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror','eror');
        }
    }
    public function insert_data($username,$gaji_bulan, $total_per_orang,$total_per_orang_tanpa_delta){
        $this->db->trans_start();
        $this->db->query("INSERT INTO status_gaji_bulanan (id_user_detail, gaji_bulan, total_gaji , tanpa_delta) VALUES ('$username','$gaji_bulan','$total_per_orang','$total_per_orang_tanpa_delta')");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input','input');
            return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror','eror');
        }
    }

    public function check_data_exist($username, $gaji_bulan) {
        // Build the query to check if data exists
        $query = $this->db->query("SELECT * FROM `status_gaji_bulanan` WHERE `id_user_detail` = '$username' AND `gaji_bulan` = '$gaji_bulan'");

        if ($query && $query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_tanpa_delta_previous_month($username, $gaji_bulan) {
        // Ubah format tanggal ke bulan sebelumnya
        $bulan_sebelumnya = date('Y-m-d', strtotime($gaji_bulan . ' -1 month'));

        // Lakukan query ke database untuk mendapatkan gaji_total dari bulan sebelumnya
        $query = $this->db->query("SELECT tanpa_delta FROM status_gaji_bulanan WHERE id_user_detail = '$username' AND gaji_bulan = '$bulan_sebelumnya'");

        if ($query && $query->num_rows() > 0) {
            $result = $query->row();
            return $result->tanpa_delta;
        } else {
            return false; // Return false jika data tidak ditemukan
        }
    }
    public function get_dengan_delta_previous_month($username, $gaji_bulan) {
        // Ubah format tanggal ke bulan sebelumnya
        $bulan_sebelumnya = date('Y-m-d', strtotime($gaji_bulan . ' -1 month'));

        // Lakukan query ke database untuk mendapatkan gaji_total dari bulan sebelumnya
        $query = $this->db->query("SELECT total_gaji FROM status_gaji_bulanan WHERE id_user_detail = '$username' AND gaji_bulan = '$bulan_sebelumnya'");

        if ($query && $query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_gaji;
        } else {
            return false; // Return false jika data tidak ditemukan
        }
    }
    public function check_data_availability($username, $gaji_bulan) {
        // Ubah format tanggal ke bulan sebelumnya
        $bulan_sebelumnya = date('Y-m-d', strtotime($gaji_bulan . ' -1 month'));

        // Lakukan query ke database untuk memeriksa ketersediaan data
        $query = $this->db->query("SELECT 1 FROM status_gaji_bulanan WHERE id_user_detail = '$username' AND gaji_bulan = '$bulan_sebelumnya' LIMIT 1");

        if ($query && $query->num_rows() > 0) {
            return true; // Data ditemukan
        } else {
            return false; // Data tidak ditemukan
        }
    }





}
