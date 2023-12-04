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
		$username = $this->session->userdata('username');
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$data['manager'] = $this->m_user->get_all_operator_setting($username)->result_array();
			$this->load->view('manager/settings',$data);
		} else {
			// Handle kasus ketika pengguna tidak memiliki hak akses
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
        }
    }
    public function view_super_admin()
	{
		$username = $this->session->userdata('username');
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$data['super_admin'] = $this->m_user->get_all_operator_setting($username)->result_array();
			$this->load->view('super_admin/settings',$data);
		} else {
			// Handle kasus ketika pengguna tidak memiliki hak akses
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
        }
    }
    
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$this->load->view('admin/settings');
		} else {
			// Handle kasus ketika pengguna tidak memiliki hak akses
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
        }
	}
	public function view_admin_plnt()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 5) {
			$this->load->view('admin_plnt/settings');
		} else {
			// Handle kasus ketika pengguna tidak memiliki hak akses
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
        }
	}
	
	public function view_operator()
	{
		$username = $this->session->userdata('username');
		$data['operator'] = $this->m_user->get_all_operator_setting($username)->result_array();
		$this->load->view('operator/settings',$data);
	}

	public function settings_account_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$username = $this->session->userdata('username');
			$password = $this->input->post("password");
			$re_password = $this->input->post("re_password");

			if ($password == $re_password) {
				// Mengenkripsi password menggunakan bcrypt
				$encrypted_password = md5($password);
				
				// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
				$hasil = $this->m_user->update_user($username, $encrypted_password);

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
		}else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function settings_account_super_admin()
	{
		 if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$username = $this->session->userdata('username');
			$password = $this->input->post("password");
			$re_password = $this->input->post("re_password");

			if ($password == $re_password) {
				// Mengenkripsi password menggunakan bcrypt
				$encrypted_password = md5($password);
				
				// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
				$hasil = $this->m_user->update_user($username, $encrypted_password);

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
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}


	public function settings_account_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$username = $this->session->userdata('username');
			$password = $this->input->post("password");
			$re_password = $this->input->post("re_password");

			if ($password == $re_password) {
				// Mengenkripsi password menggunakan bcrypt
				$encrypted_password = md5($password);
				
				// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
				$hasil = $this->m_user->update_user($username, $encrypted_password);

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
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}
	public function settings_account_admin_plnt()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 5) {
			$username = $this->session->userdata('username');
			$password = $this->input->post("password");
			$re_password = $this->input->post("re_password");

			if ($password == $re_password) {
				// Mengenkripsi password menggunakan bcrypt
				$encrypted_password = md5($password);
				
				// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
				$hasil = $this->m_user->update_user($username, $encrypted_password);

				if ($hasil == false) {
					$this->session->set_flashdata('error_edit', 'error_edit');
				} else {
					$this->session->set_flashdata('edit', 'edit');
				}
				
				redirect('Settings/view_admin_plnt');
			} else {
				$this->session->set_flashdata('password_err', 'password_err');
				redirect('Settings/view_admin_plnt');
			}
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}


	public function settings_account_operator()
	{
		$username = $this->session->userdata('username');
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		if ($password == $re_password) {
			// Mengenkripsi password menggunakan MD5
			$encrypted_password = md5($password);
			
			// Memanggil model untuk mengupdate data pengguna dengan password yang terenkripsi
			$hasil = $this->m_user->update_user($username, $encrypted_password);

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
		$username= $this->session->userdata('username');
		$config['upload_path']   = FCPATH . 'assets/ttd/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'ttd-ops-'.$username.'.jpg'; // Set the desired file name with the file extension

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
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
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
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}
	public function upload_ttd_mng() {
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
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
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function upload_foto_ops() {
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
			$username= $this->session->userdata('username');
			$config['upload_path']   = FCPATH . 'assets/pasFoto/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']      = 1024;
			$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
			$config['file_name']     = 'pasFoto-ops-'.$username.'.jpg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('fotoFile')) {
				// File uploaded successfully
				$file_path = 'assets/pasFoto/' . $this->upload->data('file_name');
				// You can do further processing with the file path if needed
				$this->session->set_flashdata('foto_upload', 'foto_upload');
			} else {
				// File upload failed
				$this->session->set_flashdata('foto_gagal', 'foto_gagal');
			}

			redirect('Settings/view_operator');
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}
}
