<?php

class M_user extends CI_Model
{
    public function get_all_operator()
    {
        $hasil = $this->db->query('SELECT user.*, user_detail.*, jenis_kelamin.*,operator_level.* ,status_proyek.nama_proyek,status_penempatan.*,status_bpk.*,status_delta.*,status_transport.*,status_komunikasi.*,status_uang_hadir.*,status_kontribusi.*,status_insentif.*, status_wajib.*,status_kategori.*
                                    FROM user_detail
                                    JOIN user ON user.username = user_detail.nip
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
                                    LEFT JOIN status_kategori ON user_detail.kategori = status_kategori.id_kategori
                                    LEFT JOIN status_wajib ON user_detail.kode_wajib = status_wajib.id_wajib
                                    WHERE user.id_user_level = 1
                                    ORDER BY user_detail.nip ASC
                                ');
        return $hasil;
    }
    public function get_manager_u()
    {
         $hasil = $this->db->query('SELECT * FROM status_manager_u JOIN jenis_kelamin ON status_manager_u.jk = jenis_kelamin.id_jenis_kelamin');
        return $hasil;
    }

    public function edit_data_manager_u($nama_manager_u,$nip_manager_u,$id_jenis_kelamin,$nomor_telp,$alamat_manager_u,$nip_awal)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE status_manager_u SET nip_manager_u ='$nip_manager_u',nama_manager_u='$nama_manager_u', jk='$id_jenis_kelamin' , nomor_telp= '$nomor_telp', alamat_manager_u = '$alamat_manager_u' WHERE nip_manager_u='$nip_awal'");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true) {
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();
        }else {
            $this->session->set_flashdata('eror_edit','eror_edit');
        }
    }
    public function get_all_operator_setting($username)
    {
        $hasil = $this->db->query("SELECT user.*, user_detail.*, jenis_kelamin.*,operator_level.* ,status_proyek.nama_proyek,status_penempatan.*,status_bpk.*,status_delta.*
                                    FROM user_detail
                                    JOIN user ON user.username = user_detail.nip
                                    LEFT JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin
                                    LEFT JOIN status_proyek ON user_detail.proyek = status_proyek.id_status_proyek
                                    LEFT JOIN operator_level ON user_detail.jabatan = operator_level.id_level
                                    LEFT JOIN status_penempatan ON user_detail.penempatan = status_penempatan.id_penempatan
                                    LEFT JOIN status_bpk ON user_detail.bpk = status_bpk.id_level_bpk
                                    LEFT JOIN status_delta ON user_detail.delta = status_delta.id_level_delta
                                    WHERE user_detail.nip = '$username'
                                    ORDER BY user_detail.nama_lengkap ASC
                                ");
        return $hasil;
    }

    public function count_all_operator()
    {
        $hasil = $this->db->query('SELECT COUNT(username) as total_user FROM user JOIN user_detail ON user.username = user_detail.nip 
        JOIN jenis_kelamin ON user_detail.id_jenis_kelamin = jenis_kelamin.id_jenis_kelamin 
        WHERE id_user_level = 1');
        return $hasil;
    }

    public function count_all_admin()
    {
        $hasil = $this->db->query('SELECT COUNT(username) as total_user FROM user
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
        $hasil = $this->db->query("SELECT * FROM user JOIN user_detail ON user.username = user_detail.nip 
        WHERE user.username='$id_user'");
        return $hasil;
    }

    public function cek_login($username)
    {  
        $hasil=$this->db->query("SELECT * FROM user JOIN user_detail ON user.username = user_detail.nip WHERE nip='$username'");
        return $hasil;
    } 
    
    public function getDaftarProyek() {
        $query = $this->db->query("SELECT id_status_proyek, nama_proyek FROM status_proyek");
        return $query->result_array();
    }

    public function insert_operator($id, $username, $password, $id_user_level, $nama_lengkap,$nik, $id_jenis_kelamin, $no_telp, $alamat,$spk, $proyek, $jabatan,$penempatan,$bpk,$delta ,$transport ,$komunikasi,$uang_hadir,$kontribusi,$insentif,$tanggal_masuk)
    {
        $this->db->trans_start();
        $query = $this->db->query("SELECT * FROM `user` WHERE `username` = '$username'");
        if ($query->num_rows() == 0) {   
            // Insert data ke tabel 'user'
            $this->db->query("INSERT INTO user(username, password, id_user_level) VALUES ( '$username', '$password', '$id_user_level')");
            // Insert data ke tabel 'user_detail' termasuk jabatan dan tanggal_masuk
            $this->db->query("INSERT INTO user_detail(nama_lengkap,nik, id_jenis_kelamin, no_telp, alamat,spk, proyek, nip, jabatan,penempatan,bpk,delta,transport,komunikasi,uang_hadir,kontribusi,insentif, tanggal_masuk ) VALUES ('$nama_lengkap', '$nik','$id_jenis_kelamin', '$no_telp', '$alamat','$spk', '$proyek', '$username', '$jabatan','$penempatan', '$bpk','$delta','$transport' ,'$komunikasi','$uang_hadir','$kontribusi','$insentif','$tanggal_masuk')");
            // Insert data ke tabel 'status_insfeksi'
            $this->db->query("INSERT INTO status_insfeksi(nip) VALUES ('$username')");
            
            $this->db->trans_complete();

            return $this->db->trans_status();
        } else {
            $this->session->set_flashdata('eror_ada','eror_ada');
        }
    }

    public function update_operator($id_user, $username, $password, $id_user_level, $nama_lengkap,$nik, $id_jenis_kelamin, $no_telp, $alamat,$spk, $jabatan, $penempatan, $bpk, $delta, $transport,$komunikasi,$uang_hadir,$kontribusi,$insentif, $id_status_proyek, $tanggal_masuk)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE user SET username='$username',password='$password', id_user_level='$id_user_level' WHERE username='$username'");
        // NIP ada, lakukan update di tabel user_detail
        $this->db->query("UPDATE user_detail SET nama_lengkap='$nama_lengkap',nik='$nik' , id_jenis_kelamin='$id_jenis_kelamin', no_telp='$no_telp', nip='$username', alamat='$alamat',spk='$spk', jabatan='$jabatan', penempatan='$penempatan', bpk='$bpk', delta='$delta', transport='$transport',komunikasi='$komunikasi',uang_hadir='$uang_hadir',kontribusi='$kontribusi',insentif='$insentif', proyek='$id_status_proyek', tanggal_masuk='$tanggal_masuk' WHERE nip='$username'");

        $this->db->trans_complete();
        if ($this->db->trans_status() == true){
            $this->session->set_flashdata('edit','edit');
            return $this->db->trans_status();}
        else{
            $this->session->set_flashdata('eror_edit','eror_edit');}
    }


    public function delete_operator($username)
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
    public function update_user($username, $password)
    {
       $this->db->trans_start();
       $this->db->query("UPDATE user SET  password='$password' WHERE username='$username'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function update_data_plnt($username,$no_spk,$spk,$no_serti,$tgl_berlaku,$tgl_berakhir,$id_kategori,$id_wajib)
    {
        $this->db->trans_start();  
        $this->db->query("UPDATE user_detail SET  no_spk='$no_spk',spk='$spk' ,no_serti='$no_serti',tgl_berlaku='$tgl_berlaku' , tgl_berakhir='$tgl_berakhir',kategori='$id_kategori',kode_wajib='$id_wajib' WHERE nip='$username'");
        $this->db->trans_complete();
    }
}