<?php
class M_gaji extends CI_Model 
{
    public function get_all_gaji()
    {
        $query = $this->db->query("SELECT
                                    user.username,
                                    user_detail.nama_lengkap,
                                    FLOOR(DATEDIFF(NOW(), tanggal_masuk) / 365) AS lamanya_kerja_dalam_tahun,
                                    operator_level.gaji_level,
                                    status_proyek.gaji_proyek AS gaji_proyek,
                                    status_penempatan.gaji_penempatan,
                                    status_tmk.rupiah_tmk,
                                    status_bpk.gaji_bpk,
                                    status_transport.tunjangan_transport,
                                    status_komunikasi.tunjangan_komunikasi,
                                    status_uang_hadir.tunjangan_uang_hadir,
                                    status_kontribusi.tunjangan_kontribusi,
                                    status_insentif.tunjangan_insentif,
                                    status_gaji_bulanan.total_gaji
                                    FROM user_detail
                                        LEFT JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                        LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                        LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                        LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                        LEFT JOIN status_tmk ON LEFT(ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365, 2), 1) = status_tmk.tahun_tmk
                                        LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                        LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                        LEFT JOIN status_transport ON user_detail.transport = status_transport.id_transport
                                        LEFT JOIN status_gaji_bulanan ON user.username = status_gaji_bulanan.id_user_detail
                                        LEFT JOIN status_komunikasi ON user_detail.komunikasi = status_komunikasi.id_komunikasi
                                        LEFT JOIN status_uang_hadir ON user_detail.uang_hadir = status_uang_hadir.id_uang_hadir
                                        LEFT JOIN status_kontribusi ON user_detail.kontribusi = status_kontribusi.id_kontribusi
                                        LEFT JOIN status_insentif ON user_detail.insentif = status_insentif.id_insentif
                                        WHERE user.id_user_level = 1
                                        AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 MONTH), '%Y-%m-01') = DATE_FORMAT(status_gaji_bulanan.gaji_bulan, '%Y-%m-01')
                                        ORDER BY user.username ASC;
        ");
        return $query;
    }
    public function get_all_gaji_baru()
    {
        $query = $this->db->query("SELECT
                                    user.username,
                                    user_detail.nama_lengkap,
                                    FLOOR(DATEDIFF(NOW(), tanggal_masuk) / 365) AS lamanya_kerja_dalam_tahun,
                                    operator_level.gaji_level,
                                    status_proyek.gaji_proyek AS gaji_proyek,
                                    status_penempatan.gaji_penempatan,
                                    status_tmk.rupiah_tmk,
                                    status_bpk.gaji_bpk,
                                    status_transport.tunjangan_transport,
                                    status_delta.gaji_delta
                                    FROM user_detail
                                        LEFT JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                        LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                        LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                        LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                        LEFT JOIN status_tmk ON LEFT(ROUND(DATEDIFF(NOW(), tanggal_masuk) / 365, 2), 1) = status_tmk.tahun_tmk
                                        LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                        LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                        LEFT JOIN status_transport ON user_detail.transport = status_transport.id_transport 
                                        LEFT JOIN status_gaji_bulanan ON user.username = status_gaji_bulanan.id_user_detail 
                                        WHERE user.id_user_level = 1  AND DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 1 MONTH), '%Y-%m-01') = DATE_FORMAT(status_gaji_bulanan.gaji_bulan, '%Y-%m-01') IS NULL
                                        ORDER BY user.username ASC;
        ");
        return $query;
    }

   public function update_data($username, $gaji_bulan, $total_per_orang,$tanggal_input) {
        $this->db->trans_start();
        $sql = "UPDATE status_gaji_bulanan SET total_gaji = '$total_per_orang', tgl_simpan='$tanggal_input' WHERE id_user_detail = '$username' AND gaji_bulan = '$gaji_bulan'";
        $this->db->query($sql);
        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
                $this->session->set_flashdata('edit','edit');
                return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror_edit','eror_edit');
        }
    }

    public function insert_data($username,$gaji_bulan, $total_per_orang,$tanggal_input){
        $this->db->trans_start();
        $this->db->query("INSERT INTO status_gaji_bulanan (id_user_detail, gaji_bulan, total_gaji ,tgl_simpan) VALUES ('$username','$gaji_bulan','$total_per_orang','$tanggal_input')");
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
