<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('m_absensi');
	}

    public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['absensi'] = $this->m_absensi->get_all_absensi();
			$data['data_absensi'] = $this->m_absensi->get_data_absensi();
			$this->load->view('admin/absensi', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function view_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
			$id_user_detail = $this->session->userdata('id_user');		
			$data['absensi'] = $this->m_absensi->get_data_absensi_operator($id_user_detail);
			$this->load->view('operator/absensi', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
}