<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
	}

	public function index()
	{
		$this->load->view('login');
	}

		
	
	public function proses()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		// Melakukan pencarian pengguna berdasarkan username
		$user = $this->m_user->cek_login($username);

		if ($user->num_rows() > 0) {
			$user = $user->row_array();

			// Membandingkan kata sandi yang dimasukkan oleh pengguna dengan kata sandi di database
			if ($user['password'] == md5($password)) { // Menggunakan md5() untuk membandingkan kata sandi

				// Berdasarkan tingkat pengguna (id_user_level), sesi pengguna akan diatur
				if ($user['id_user_level'] == 1) {
					// Jika tingkat pengguna adalah 1 (Operator), sesi diatur untuk Operator
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('id_user', $user['id_user']);
					$this->session->set_userdata('username', $user['username']);
					$this->session->set_userdata('id_user_level', $user['id_user_level']);
					$this->session->set_userdata('nama_lengkap', $user['nama_lengkap']);

					$this->session->set_flashdata('success_login', 'success_login');
					redirect('Dashboard/dashboard_operator');
				} else if ($user['id_user_level'] == 2) {
					// Jika tingkat pengguna adalah 2 (Admin), sesi diatur untuk Admin
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('id_user', $user['id_user']);
					$this->session->set_userdata('username', $user['username']);
					$this->session->set_userdata('id_user_level', $user['id_user_level']);

					$this->session->set_flashdata('success_login', 'success_login');
					redirect('Dashboard/dashboard_admin');
				} else if ($user['id_user_level'] == 3) {
					// Jika tingkat pengguna adalah 3 (Super Admin), sesi diatur untuk Super Admin
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('id_user', $user['id_user']);
					$this->session->set_userdata('username', $user['username']);
					$this->session->set_userdata('id_user_level', $user['id_user_level']);

					$this->session->set_flashdata('success_login', 'success_login');
					redirect('Dashboard/dashboard_super_admin');
				} else if ($user['id_user_level'] == 4) {
					// Jika tingkat pengguna adalah 4 (Manager), sesi diatur untuk Manager
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('id_user', $user['id_user']);
					$this->session->set_userdata('username', $user['username']);
					$this->session->set_userdata('id_user_level', $user['id_user_level']);

					$this->session->set_flashdata('success_login', 'success_login');
					redirect('Dashboard/dashboard_manager');
				} else {
					// Jika tingkat pengguna tidak sesuai dengan yang diharapkan
					$this->session->set_flashdata('loggin_err', 'loggin_err');
					redirect('Login/index');
				}
			} else {
				// Jika kata sandi yang dimasukkan tidak cocok dengan yang ada di database
				$this->session->set_flashdata('loggin_err_pass', 'loggin_err_pass');
				redirect('Login/index');
			}
		} else {
			// Jika pengguna dengan username yang dimasukkan tidak ditemukan
			$this->session->set_flashdata('loggin_err_no_user', 'loggin_err_no_user');
			redirect('Login/index');
		}
	}





	public function log_out(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id_user');
        $this->session->set_flashdata('success_log_out','success_log_out');
            redirect('Login/index');
	}
}