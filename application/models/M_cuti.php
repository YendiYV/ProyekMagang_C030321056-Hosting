<?php

class M_cuti extends CI_Model
{

    public function get_all_cuti()
    {
        $hasil = $this->db->query('SELECT * FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail ORDER BY user_detail.nama_lengkap ASC');
        return $hasil;
    }

    public function get_all_cuti_by_id_user($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE cuti.id_user='$id_user'");
        return $hasil;
    }

    public function get_all_cuti_first_by_id_user($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE cuti.id_user='$id_user' AND cuti.id_status_cuti2='2' ORDER BY cuti.tgl_diajukan DESC LIMIT 1");
        return $hasil;
    }

    public function get_all_cuti_by_id_cuti($id_cuti)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.id_user 
                                   JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
                                   LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                   LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                   WHERE cuti.id_cuti='$id_cuti'");
        return $hasil;
    }

   public function insert_data_cuti($id_cuti, $id_user, $alasan, $mulai, $berakhir, $id_status_cuti1, $id_status_cuti2, $id_status_cuti3, $perihal_cuti, $jumlah_hari)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO cuti(id_cuti, id_user, alasan, tgl_diajukan, mulai, berakhir, id_status_cuti1, id_status_cuti2, id_status_cuti3, perihal_cuti, jumlah_hari) VALUES ('$id_cuti', '$id_user', '$alasan', NOW(), '$mulai', '$berakhir', '$id_status_cuti1', '$id_status_cuti2', '$id_status_cuti3', '$perihal_cuti', '$jumlah_hari')");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }

    public function delete_cuti($id_cuti)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM cuti WHERE id_cuti='$id_cuti'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_cuti($alasan, $perihal_cuti, $tgl_diajukan, $mulai, $berakhir, $id_cuti)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET alasan='$alasan', perihal_cuti='$perihal_cuti', tgl_diajukan='$tgl_diajukan', mulai='$mulai', berakhir='$berakhir' WHERE id_cuti='$id_cuti'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti1($id_cuti, $id_status_cuti1)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti1='$id_status_cuti1' WHERE id_cuti='$id_cuti'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti2($id_cuti, $id_status_cuti2)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti2='$id_status_cuti2' WHERE id_cuti='$id_cuti'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti3($id_cuti, $id_status_cuti3)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti3='$id_status_cuti3' WHERE id_cuti='$id_cuti'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

   
    public function count_all_cuti()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail');
        return $hasil;
    }

    public function count_all_cuti_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE cuti.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_cuti_acc()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti1=2 AND id_status_cuti2=2 AND id_status_cuti3=2');
        return $hasil;
    }

    public function count_all_cuti_acc_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti1=2 AND id_status_cuti2=2 AND id_status_cuti3=2 AND cuti.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_cuti_confirm()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti2=1');
        return $hasil;
    }

    public function count_all_cuti_confirm_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti2=1 AND cuti.id_user='$id_user'");
        return $hasil;
    }

    public function count_all_cuti_reject()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti1=3 OR id_status_cuti2=3 OR id_status_cuti3=3');
        return $hasil;
    }

    public function count_all_cuti_reject_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE id_status_cuti2=3 AND cuti.id_user='$id_user'");
        return $hasil;
    }

    public function get_permohonan_cuti_by_user($id_user) {
        // Gantilah 'nama_tabel' dengan nama tabel yang sesuai dalam database Anda
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function hitung_total_hari_cuti_dalam_setahun($id_user) {
        // Ambil tanggal masuk dari tabel user_detail
        $queryTanggalMasuk = "SELECT tanggal_masuk FROM user_detail WHERE id_user_detail = ?";
        $resultTanggalMasuk = $this->db->query($queryTanggalMasuk, array($id_user));
        $rowTanggalMasuk = $resultTanggalMasuk->row();
        $tanggalMasuk = $rowTanggalMasuk->tanggal_masuk;

        // Hitung selisih dalam hari antara tanggal masuk dan tanggal sekarang
        $selisihHari = floor((strtotime(date('Y-m-d')) - strtotime($tanggalMasuk)) / (60 * 60 * 24));

        // Jika selisih kurang dari atau sama dengan 12 hari, maka cuti termasuk dalam periode 1 tahun
        if ($selisihHari <= 12) {
            // Modifikasi query untuk memeriksa apakah tanggal mulai cuti berada pada atau setelah tanggal_masuk yang tepat satu tahun kemudian
            $query = "SELECT SUM(jumlah_hari) AS total_hari_cuti FROM cuti WHERE id_user = '$id_user' AND id_status_cuti1 = 2 AND id_status_cuti2 = 2 AND id_status_cuti3 = 2 AND YEAR(mulai) = YEAR(CURDATE())";
        } else {
            // Jika selisih lebih dari 12 hari, maka cuti dihitung dalam periode 1 tahun setelahnya
            $query = "SELECT SUM(jumlah_hari) AS total_hari_cuti FROM cuti WHERE id_user = '$id_user' AND id_status_cuti1 = 2 AND id_status_cuti2 = 2 AND id_status_cuti3 = 2 AND YEAR(mulai) = YEAR(CURDATE()) + 1";
        }

        // Jalankan query dan kembalikan hasilnya
        $result = $this->db->query($query, array($id_user));
        $row = $result->row();
        return $row->total_hari_cuti;
    }
}