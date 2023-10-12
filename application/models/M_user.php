<?php

class M_user extends CI_Model
{
    public function get_all_operator()
    {
        $hasil = $this->db->query('SELECT user.*, user_detail.*, jenis_kelamin.*,operator_level.* ,status_proyek.nama_proyek,status_penempatan.*
                                    FROM user_detail
                                    JOIN user ON user.id_user_detail = user_detail.id_user_detail
                                    JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    WHERE user.id_user_level = 1
                                    ORDER BY user.username ASC
                                ');
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
    
    public function pendaftaran_user($id, $username, $password, $id_user_level)
    {
       $this->db->trans_start();

       $this->db->query("INSERT INTO user(id_user,username,password,id_user_level, id_user_detail) VALUES ('$id','$username','$password','$id_user_level','$id')");
       $this->db->query("INSERT INTO user_detail(id_user_detail) VALUES ('$id')");

       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_user_detail($id, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $nip, $operator_level, $proyek,$penempatan)
    {
        $this->db->trans_start();
    
        $this->db->query("UPDATE user_detail SET nama_lengkap='$nama_lengkap', id_jenis_kelamin='$id_jenis_kelamin', no_telp='$no_telp', alamat='$alamat', nip='$nip', jabatan='$operator_level', proyek='$proyek' ,penempatan ='$penempatan' WHERE id_user_detail='$id'");
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }
    
    public function getDaftarProyek() {
        $query = $this->db->query("SELECT id_status_proyek, nama_proyek FROM status_proyek");
        return $query->result_array();
    }

    public function insert_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $proyek, $jabatan,$penempatan ,$tanggal_masuk)
    {
        $this->db->trans_start();

        // Insert data ke tabel 'user'
        $this->db->query("INSERT INTO user(id_user, username, password, id_user_level, id_user_detail) VALUES ('$id', '$username', '$password', '$id_user_level', '$id')");

        // Insert data ke tabel 'user_detail' termasuk jabatan dan tanggal_masuk
        $this->db->query("INSERT INTO user_detail(id_user_detail, nama_lengkap, id_jenis_kelamin, no_telp, alamat,proyek, nip, jabatan,penempatan, tanggal_masuk ) VALUES ('$id', '$nama_lengkap', '$id_jenis_kelamin', '$no_telp', '$alamat', '$proyek', '$username', '$jabatan','$penempatan', '$tanggal_masuk')");

        $this->db->trans_complete();

        return $this->db->trans_status();
    }



    public function update_operator($id_user, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $jabatan,$penempatan, $id_status_proyek, $tanggal_masuk)
    {
        $this->db->trans_start();

        // Update user information in the 'user' table
        $this->db->query("UPDATE user SET username='$username', password='$password', id_user_level='$id_user_level' WHERE id_user='$id_user'");

        // Update user information including 'jabatan', 'proyek', and 'tanggal_masuk' in the 'user_detail' table
        $this->db->query("UPDATE user_detail SET nama_lengkap='$nama_lengkap', nip='$username' ,id_jenis_kelamin='$id_jenis_kelamin', no_telp='$no_telp', alamat='$alamat', jabatan='$jabatan', penempatan = '$penempatan', proyek='$id_status_proyek', tanggal_masuk='$tanggal_masuk' WHERE id_user_detail='$id_user'");

        $this->db->trans_complete();

        if ($this->db->trans_status() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_operator($id)
    {
       $this->db->trans_start();

       $this->db->query("DELETE FROM user WHERE id_user='$id'");
       $this->db->query("DELETE FROM user_detail WHERE id_user_detail='$id'");

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

    

    public function delete_admin($id)
    {
       $this->db->trans_start();

       $this->db->query("DELETE FROM user WHERE id_user='$id'");
       $this->db->query("DELETE FROM user_detail WHERE id_user_detail='$id'");

       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

}