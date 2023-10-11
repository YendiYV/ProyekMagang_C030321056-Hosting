<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}

	public function view_manager()
	{
		$this->load->view('manager/settings');
    }
    public function view_super_admin()
	{
		$this->load->view('super_admin/settings');
    }
    
	public function view_admin()
	{
		$this->load->view('admin/settings');
	}
	
	public function view_operator()
	{
		$data['operator_data'] = $this->m_user->get_operator_by_id($this->session->userdata('id_user'))->result_array();
		$data['operator'] = $this->m_user->get_operator_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$this->load->view('operator/settings', $data);
	}

	public function settings_account_manager()
	{
		$id = $this->session->userdata('id_user');
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		if ($password == $re_password) {
			// Mengenkripsi password menggunakan bcrypt
			$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($id, $hashed_password);

			if ($hasil == false) {
				$this->session->set_flashdata('error_edit', 'error_edit');
			} else {
				$this->session->set_flashdata('edit', 'edit');
			}
			
			redirect('Settings/view_manager');
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_manager');
		}
	}

	public function settings_account_super_admin()
	{
		$id = $this->session->userdata('id_user');
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		if ($password == $re_password) {
			// Mengenkripsi password menggunakan bcrypt
			$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($id,$hashed_password);

			if ($hasil == false) {
				$this->session->set_flashdata('error_edit', 'error_edit');
			} else {
				$this->session->set_flashdata('edit', 'edit');
			}
			
			redirect('Settings/view_super_admin');
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_super_admin');
		}
	}


	public function settings_account_admin()
	{
		$id = $this->session->userdata('id_user');
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		if ($password == $re_password) {
			// Mengenkripsi password menggunakan bcrypt
			$encrypted_password = md5($password);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($id, $encrypted_password);

			if ($hasil == false) {
				$this->session->set_flashdata('error_edit', 'error_edit');
			} else {
				$this->session->set_flashdata('edit', 'edit');
			}
			
			redirect('Settings/view_admin');
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_admin');
		}
	}


	public function settings_account_operator()
	{
		$id = $this->session->userdata('id_user');
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		if ($password == $re_password) {
			// Mengenkripsi password menggunakan MD5
			$encrypted_password = md5($password);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($id, $encrypted_password);

			if ($hasil == false) {
				$this->session->set_flashdata('error_edit', 'error_edit');
			} else {
				$this->session->set_flashdata('edit', 'edit');
			}
			
			redirect('Settings/view_operator');
		} else {
			$this->session->set_flashdata('password_err', 'password_err');
			redirect('Settings/view_operator');
		}
	}

    
}