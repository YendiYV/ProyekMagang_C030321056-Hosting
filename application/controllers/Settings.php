<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
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
		$id = $this->session->userdata('id_user');
		$data['operator'] = $this->m_user->get_all_operator_setting($id)->result_array();
		$this->load->view('operator/settings',$data);
	}

	public function settings_account_manager()
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
			$encrypted_password = md5($password);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($id, $encrypted_password);

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

	public function upload_ttd_ops() {
		$id = $this->session->userdata('id_user');
		$config['upload_path']   = FCPATH . 'assets/ttd/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'ttd-ops-'.$id.'.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('signatureFile')) {
			// File uploaded successfully
			$file_path = 'assets/ttd/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('ttd_upload', 'ttd_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('ttd_gagal', 'ttd_gagal');
		}

		redirect('Settings/view_operator');
	}
	public function upload_ttd_spv() {
		$config['upload_path']   = FCPATH . 'assets/ttd/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'ttd-spv.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('signatureFile')) {
			// File uploaded successfully
			$file_path = 'assets/ttd/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('ttd_upload', 'ttd_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('ttd_gagal', 'ttd_gagal');
		}

		redirect('Settings/view_super_admin');
	}
	public function upload_ttd_mng() {
		$config['upload_path']   = FCPATH . 'assets/ttd/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'ttd-mng.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('signatureFile')) {
			// File uploaded successfully
			$file_path = 'assets/ttd/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('ttd_upload', 'ttd_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('ttd_gagal', 'ttd_gagal');
		}

		redirect('Settings/view_manager');
	}
}
