<?php

class M_cuti extends CI_Model
{

    public function get_all_cuti()
    {
        $hasil = $this->db->query('SELECT user_detail.*,cuti.*,tipe_cuti.* FROM cuti JOIN user ON cuti.id_user = user.username 
        JOIN user_detail ON user.username = user_detail.nip 
        LEFT JOIN tipe_cuti ON cuti.tipe_cuti=tipe_cuti.id_tipe_cuti ORDER BY user_detail.nama_lengkap ASC');
        return $hasil;
    }

    public function get_all_cuti_by_id_user($username)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.username
        JOIN user_detail ON user.username = user_detail.nip
        LEFT JOIN tipe_cuti ON cuti.tipe_cuti=tipe_cuti.id_tipe_cuti WHERE cuti.id_user='$username'");
        return $hasil;
    }

    public function get_all_cuti_first_by_id_user($username)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE cuti.id_user='$username' AND cuti.id_status_cuti2='2' ORDER BY cuti.tgl_diajukan DESC LIMIT 1");
        return $hasil;
    }

    public function get_all_cuti_by_id_cuti($id_cuti_detail)
    {
        $hasil = $this->db->query("SELECT * FROM cuti JOIN user ON cuti.id_user = user.username
                                   JOIN user_detail ON user.username = user_detail.nip 
                                   LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                   LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                   LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                   LEFT JOIN tipe_cuti ON cuti.tipe_cuti = tipe_cuti.id_tipe_cuti
                                   WHERE cuti.id_cuti_detail='$id_cuti_detail'");
        return $hasil;
    }

    public function get_data_manager_U()
    {
        $hasil = $this->db->query("SELECT * FROM status_manager_u");
        return $hasil;
    }
    public function get_data_manager()
    {
        $hasil = $this->db->query("SELECT * FROM user_detail LEFT JOIN user ON user_detail.nip = user.username  WHERE user.id_user_level='4'");
        return $hasil;
    }
    public function get_data_supervisior()
    {
        $hasil = $this->db->query("SELECT * FROM user_detail LEFT JOIN user ON user_detail.nip = user.username  WHERE user.id_user_level='3'");
        return $hasil;
    }

   public function insert_data_cuti($nomor_urut_cuti, $username, $alasan, $mulai, $berakhir, $id_status_cuti1, $id_status_cuti2, $id_status_cuti3, $perihal_cuti,$tipe_cuti, $jumlah_hari)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO cuti(id_cuti, id_user, alasan, tgl_diajukan, mulai, berakhir, id_status_cuti1, id_status_cuti2, id_status_cuti3, perihal_cuti,tipe_cuti, jumlah_hari) VALUES ('$nomor_urut_cuti', '$username', '$alasan', NOW(), '$mulai', '$berakhir', '$id_status_cuti1', '$id_status_cuti2', '$id_status_cuti3', '$perihal_cuti','$tipe_cuti', '$jumlah_hari')");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('input','input');
            return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror','eror');
        }
    }

    public function check_data_cuti($id_cuti_detail){
        $hasil = $this->db->query("SELECT cuti.id_cuti_detail FROM cuti WHERE id_cuti_detail='$id_cuti_detail'");
    }

    public function insert_user_detail($username, $total_hari_cuti)
    {
        $this->db->trans_start();

        // Use parameter binding to prevent SQL injection
        $sql = "UPDATE user_detail SET jumlah_cuti = jumlah_cuti + '$total_hari_cuti' WHERE nip = '$username'";
        $this->db->query($sql, array($total_hari_cuti, $username));

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_user_detail_hapus($username, $total_hari_cuti)
    {
        $this->db->trans_start();

        // Use parameter binding to prevent SQL injection
        $sql = "UPDATE user_detail SET jumlah_cuti = jumlah_cuti - '$total_hari_cuti' WHERE nip = '$username'";
        $this->db->query($sql, array($total_hari_cuti, $username));

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function delete_cuti($id_cuti_detail)
    {
        $this->db->trans_start();
        $this->db->query("DELETE FROM cuti WHERE id_cuti_detail='$id_cuti_detail'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_cuti($alasan, $perihal_cuti, $tgl_diajukan, $mulai, $berakhir, $id_cuti_detail,$total_hari_cuti,$tipe_cuti)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET alasan='$alasan', perihal_cuti='$perihal_cuti', tgl_diajukan='$tgl_diajukan', mulai='$mulai', berakhir='$berakhir' ,jumlah_hari='$total_hari_cuti',tipe_cuti='$tipe_cuti' WHERE id_cuti_detail='$id_cuti_detail'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
    
    public function update_cuti_user_detail($username,$total_hari_cuti)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE user_detail SET jumlah_cuti='$total_hari_cuti' WHERE nip='$username'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti1($id_cuti_detail, $id_status_cuti1)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti1='$id_status_cuti1' WHERE id_cuti_detail='$id_cuti_detail'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti2($id_cuti_detail, $id_status_cuti2)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti2='$id_status_cuti2' WHERE id_cuti_detail='$id_cuti_detail'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function confirm_cuti3($id_cuti_detail, $id_status_cuti3)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE cuti SET id_status_cuti3='2' WHERE id_cuti_detail='$id_cuti_detail'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
    
    public function count_all_cuti()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip');
        return $hasil;
    }

    public function count_all_cuti_by_id($username)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE cuti.id_user='$username'");
        return $hasil;
    }

    public function count_all_cuti_acc()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti1=2 AND id_status_cuti2=2 AND id_status_cuti3=2');
        return $hasil;
    }

    public function count_all_cuti_acc_by_id($username)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti1=2 AND id_status_cuti2=2 AND id_status_cuti3=2 AND cuti.id_user='$username'");
        return $hasil;
    }

    public function count_all_cuti_confirm()
    {
        $hasil = $this->db->query('SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti2=1');
        return $hasil;
    }

    public function count_all_cuti_confirm_by_id($username)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.id_user JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti2=1 AND cuti.id_user='$username'");
        return $hasil;
    }

    public function count_all_cuti_reject()
    {
        $hasil = $this->db->query('SELECT COUNT(username) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti1=3 OR id_status_cuti2=3 OR id_status_cuti3=3');
        return $hasil;
    }

    public function count_all_cuti_reject_by_id($username)
    {
        $hasil = $this->db->query("SELECT COUNT(id_cuti_detail) as total_cuti FROM cuti JOIN user ON cuti.id_user = user.username JOIN user_detail ON user.username = user_detail.nip WHERE id_status_cuti2=3 AND cuti.id_user='$username'");
        return $hasil;
    }
    public function total_hari_cuti_by_id_for_form($username)
    {
        $hasil = $this->db->query("SELECT user_detail.jumlah_cuti AS total_cuti  FROM user_detail WHERE nip='$username'");
        return $hasil->row()->total_cuti;
    }
    public function total_hari_cuti_by_id_for_dashboard($username)
    {
        $hasil = $this->db->query("SELECT user_detail.jumlah_cuti AS total_cuti  FROM user_detail WHERE nip='$username'");
        return $hasil;;
    }

    public function get_permohonan_cuti_by_user($username) {
        // Gantilah 'nama_tabel' dengan nama tabel yang sesuai dalam database Anda
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $usernmae);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function hitung_total_hari_cuti_dalam_setahun($username) {
        // Ambil tanggal masuk dari tabel user_detail
        $queryTanggalMasuk = "SELECT tanggal_masuk FROM user_detail WHERE nip = ?";
        $resultTanggalMasuk = $this->db->query($queryTanggalMasuk, array($username));
        $rowTanggalMasuk = $resultTanggalMasuk->row();
        $tanggalMasuk = $rowTanggalMasuk->tanggal_masuk;

        // Hitung selisih dalam hari antara tanggal masuk dan tanggal sekarang
        $selisihHari = floor((strtotime(date('Y-m-d')) - strtotime($tanggalMasuk)) / (60 * 60 * 24));

        // Jika selisih kurang dari atau sama dengan 12 hari, maka cuti termasuk dalam periode 1 tahun
        if ($selisihHari <= 12) {
            // Modifikasi query untuk memeriksa apakah tanggal mulai cuti berada pada atau setelah tanggal_masuk yang tepat satu tahun kemudian
            $query = "SELECT SUM(jumlah_hari) AS total_hari_cuti FROM cuti WHERE id_user = '$username' AND id_status_cuti1 = 2 AND id_status_cuti2 = 2 AND id_status_cuti3 = 2 AND YEAR(mulai) = YEAR(CURDATE())";
        } else {
            // Jika selisih lebih dari 12 hari, maka cuti dihitung dalam periode 1 tahun setelahnya
            $query = "SELECT SUM(jumlah_hari) AS total_hari_cuti FROM cuti WHERE id_user = '$username' AND id_status_cuti1 = 2 AND id_status_cuti2 = 2 AND id_status_cuti3 = 2 AND YEAR(mulai) = YEAR(CURDATE()) + 1";
        }

        // Jalankan query dan kembalikan hasilnya
        $result = $this->db->query($query, array($username));
        $row = $result->row();
        return $row->total_hari_cuti;
    }
    public function get_tipe_cuti(){
        $hasil = $this->db->query("SELECT * FROM tipe_cuti");
        return $hasil;
    }
}