<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_proyek');
		$this->load->model('m_jabatan');
	}
	
	public function view_manager()
	{

	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) 
	{
		$data['operator'] = $this->m_user->get_all_operator()->result_array();
		$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$this->load->view('manager/operator', $data);
		
	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}
	}		
	
    public function view_super_admin()
	{

	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$data['operator'] = $this->m_user->get_all_operator()->result_array();
		$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$this->load->view('super_admin/operator', $data);
		
	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}

    }
    
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			
			$data['operator'] = $this->m_user->get_all_operator()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['nama_proyek_list'] = $this->m_proyek->get_all_proyek();
			$data['nama_level_list'] = $this->m_jabatan->get_all_jabatan();
			$this->load->view('admin/operator', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function tambah_operator()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$re_password = $this->input->post("confirm_password");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_user_level = 1;
			$id_status_proyek = $this->input->post('id_status_proyek');
			$jabatan = $this->input->post("jabatan");
			$tanggal_masuk = date("Y-m-d");

			$id = md5($username . $password);
			if ($password == $re_password) {
				$hashed_password = md5($password); // Ubah password menjadi hashed

				// Panggil model untuk menyimpan data operator
				$hasil = $this->m_user->insert_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat,$id_status_proyek, $jabatan, $tanggal_masuk);

				if ($hasil == false) {
					$this->session->set_flashdata('eror', 'eror');
				} else {
					$this->session->set_flashdata('input', 'input');
				}
			} else {
				echo '<script>$("#password_err_notification").html("Konfirmasi Password tidak sesuai.").slideDown();</script>';
			}

			redirect('operator/view_admin');
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function edit_operator() {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $id_user = $this->input->post("id_user");
            $username = $this->input->post("username");
            $password = md5($this->input->post("password"));
            $nama_lengkap = $this->input->post("nama_lengkap");
            $id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
            $no_telp = $this->input->post("no_telp");
            $alamat = $this->input->post("alamat");
            $operator_level = $this->input->post("operator_level");
            $id_status_proyek = $this->input->post("id_status_proyek");
			$tanggal_masuk = date("Y-m-d");

            // Call the model method to update the operator
            $hasil = $this->m_user->update_operator($id_user, $username, $password, 1, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $operator_level, $id_status_proyek, $tanggal_masuk);

            if ($hasil == false) {
                $this->session->set_flashdata('error', 'Error');
            } else {
                $this->session->set_flashdata('success', 'Success');
            }

            redirect('operator/view_admin');
        } else {
            $this->session->set_flashdata('login_err', 'Login Error');
            redirect('Login/index');
        }
    }



	public function hapus_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
		
        	$id = $this->input->post("id_user");

        
            $hasil = $this->m_user->delete_operator($id);

            if($hasil==false){
                $this->session->set_flashdata('eror_hapus','eror_hapus');
                redirect('operator/view_admin');
			}else{
				$this->session->set_flashdata('hapus','hapus');
				redirect('operator/view_admin');
			}
			
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}

	public function super_admin_tambah_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$username = $this->input->post("username");
			$password = md5($this->input->post("password"));
			$re_password = $this->input->post("confirm_password");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_user_level = 1;
			$jabatan = $this->input->post("jabatan"); // Menambahkan jabatan ke dalam parameter

			$id = md5($username.$password);
			if ($password == $re_password) {
				$hasil = $this->m_user->insert_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $jabatan); // Memasukkan jabatan sebagai argumen

				if ($hasil == false) {
					$this->session->set_flashdata('eror', 'eror');
					redirect('operator/view_super_admin');
				} else {
					$this->session->set_flashdata('input', 'input');
					redirect('operator/view_super_admin');
				}
			}else {
				$this->session->set_flashdata('password_err', 'password_err');
				redirect('operator/view_super_admin');
			}

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	public function super_admin_edit_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$username = $this->input->post("username");
        $password = $this->input->post("password");
		$nama_lengkap = $this->input->post("nama_lengkap");
		$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
		$no_telp = $this->input->post("no_telp");
		$alamat = $this->input->post("alamat");
		$id_user_level = 1;
        $id = $this->input->post("id_user");

        
            $hasil = $this->m_user->update_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat);

            if($hasil==false){
                $this->session->set_flashdata('eror_edit','eror_edit');
                redirect('operator/view_super_admin');
			}else{
				$this->session->set_flashdata('edit','edit');
				redirect('operator/view_super_admin');
            }

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}

	public function super_admin_hapus_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
		
        	$id = $this->input->post("id_user");

        
            $hasil = $this->m_user->delete_operator($id);

            if($hasil==false){
                $this->session->set_flashdata('eror_hapus','eror_hapus');
                redirect('operator/view_super_admin');
			}else{
				$this->session->set_flashdata('hapus','hapus');
				redirect('operator/view_super_admin');
			}
			
			
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	
    
}