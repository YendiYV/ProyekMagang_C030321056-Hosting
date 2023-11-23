<?php

class M_user extends CI_Model
{
    public function get_all_operator()
    {
        $hasil = $this->db->query('SELECT user.*, user_detail.*, jenis_kelamin.*,operator_level.* ,status_proyek.nama_proyek,status_penempatan.*,status_bpk.*,status_delta.*,status_transport.*,            status_komunikasi.*,status_uang_hadir.*,status_kontribusi.*,status_insentif.*
                                    FROM user_detail
                                    JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                    LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                    LEFT JOIN status_transport ON user_detail.transport = status_transport.id_transport
                                    LEFT JOIN status_komunikasi ON user_detail.komunikasi = status_komunikasi.id_komunikasi
                                    LEFT JOIN status_uang_hadir ON user_detail.uang_hadir = status_uang_hadir.id_uang_hadir
                                    LEFT JOIN status_kontribusi ON user_detail.kontribusi = status_kontribusi.id_kontribusi
                                    LEFT JOIN status_insentif ON user_detail.insentif = status_insentif.id_insentif
                                    WHERE user.id_user_level = 1
                                    ORDER BY user_detail.nip ASC
                                ');
        return $hasil;
    }
    public function get_all_operator_setting($id)
    {
        $hasil = $this->db->query("SELECT user.*, user_detail.*, jenis_kelamin.*,operator_level.* ,status_proyek.nama_proyek,status_penempatan.*,status_bpk.*,status_delta.*
                                    FROM user_detail
                                    JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                    LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                    WHERE user_detail.id_user_detail = '$id'
                                    ORDER BY user_detail.nama_lengkap ASC
                                ");
        return $hasil;
    }
    public function count_all_operator()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user) as total_user FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
        JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin 
        WHERE id_user_level = 1');
        return $hasil;
    }

    public function count_all_admin()
    {
        $hasil = $this->db->query('SELECT COUNT(id_user) as total_user FROM user
        WHERE id_user_level = 2');
        return $hasil;
    }

    public function get_all_admin()
    {
        $hasil = $this->db->query('SELECT * FROM user
        WHERE id_user_level = 2');
        return $hasil;
    }

    public function get_operator_by_id($id_user)
    {
        $hasil = $this->db->query("SELECT * FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail 
        WHERE user.id_user='$id_user'");
        return $hasil;
    }

    public function cek_login($username)
    {  
        $hasil=$this->db->query("SELECT * FROM user JOIN user_detail ON user.id_user_detail = user_detail.id_user_detail WHERE username='$username'");
        return $hasil;
    } 
    
    public function getDaftarProyek() {
        $query = $this->db->query("SELECT id_status_proyek, nama_proyek FROM status_proyek");
        return $query->result_array();
    }

    public function insert_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $proyek, $jabatan,$penempatan,$bpk,$delta ,$transport ,$komunikasi,$uang_hadir,$kontribusi,$insentif,$tanggal_masuk)
    {
        $this->db->trans_start();
        $query = $this->db->query("SELECT * FROM `user` WHERE `username` = '$username'");
        if ($query->num_rows() == 0) {   
            // Insert data ke tabel 'user'
            $this->db->query("INSERT INTO user(id_user, username, password, id_user_level, id_user_detail) VALUES ('$id', '$username', '$password', '$id_user_level', '$id')");
            // Insert data ke tabel 'user_detail' termasuk jabatan dan tanggal_masuk
            $this->db->query("INSERT INTO user_detail(id_user_detail, nama_lengkap, id_jenis_kelamin, no_telp, alamat,proyek, nip, jabatan,penempatan,bpk,delta,transport,komunikasi,uang_hadir,kontribusi,insentif, tanggal_masuk ) VALUES ('$id', '$nama_lengkap', '$id_jenis_kelamin', '$no_telp', '$alamat', '$proyek', '$username', '$jabatan','$penempatan', '$bpk','$delta','$transport' ,'$komunikasi','$uang_hadir','$kontribusi','$insentif','$tanggal_masuk')");
            // Insert data ke tabel 'status_insfeksi'
            $this->db->query("INSERT INTO status_insfeksi(id_user_detail) VALUES ('$id')");
            
            $this->db->trans_complete();

            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror_ada','eror_ada');
        }
    }

    public function update_operator($id_user, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $jabatan, $penempatan, $bpk, $delta, $transport,$komunikasi,$uang_hadir,$kontribusi,$insentif, $id_status_proyek, $tanggal_masuk)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE user SET username='$username',password='$password', id_user_level='$id_user_level' WHERE id_user='$id_user'");
        // NIP ada, lakukan update di tabel user_detail
        $this->db->query("UPDATE user_detail SET nama_lengkap='$nama_lengkap', id_jenis_kelamin='$id_jenis_kelamin', no_telp='$no_telp', nip='$username', alamat='$alamat', jabatan='$jabatan', penempatan='$penempatan', bpk='$bpk', delta='$delta', transport='$transport',komunikasi='$komunikasi',uang_hadir='$uang_hadir',kontribusi='$kontribusi',insentif='$insentif', proyek='$id_status_proyek', tanggal_masuk='$tanggal_masuk' WHERE nip='$username'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true){
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();}
        else{
            $this->session->set_flashdata('eror_edit','eror_edit');}
    }


    public function delete_operator($id_user)
    {
        $this->db->trans_start();

        $this->db->query("DELETE FROM user WHERE id_user='$id_user'");
        $this->db->query("DELETE FROM user_detail WHERE id_user_detail='$id_user'");
        $this->db->query("DELETE FROM cuti WHERE id_user='$id_user'");
        $this->db->query("DELETE FROM status_absensi WHERE id_user_detail='$id_user'");
        $this->db->query("DELETE FROM status_gaji_bulanan WHERE id_user_detail='$id_user'");
        $this->db->query("DELETE FROM status_insfeksi WHERE id_user_detail='$id_user'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
    public function update_user($id, $password)
    {
       $this->db->trans_start();

       $this->db->query("UPDATE user SET  password='$password' WHERE id_user='$id'");
      
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
}