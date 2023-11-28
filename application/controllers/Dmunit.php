<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dmunit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');	
	}
    public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			
			$data['manager_u'] = $this->m_user->get_manager_u()->result_array();
			$data['jk'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
	
			$this->load->view('admin/dmunit', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function view_super_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			
			$data['manager_u'] = $this->m_user->get_manager_u()->result_array();
			$data['jk'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
	
			$this->load->view('super_admin/dmunit', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function view_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			
			$data['manager_u'] = $this->m_user->get_manager_u()->result_array();
			$this->load->view('manager/dmunit', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function upload_ttd_mng_u() {
			$config['upload_path']   = FCPATH . 'assets/ttd/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']      = 1024;
			$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
			$config['file_name']     = 'ttd-mng-u.jpg'; // Set the desired file name with the file extension

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('signatureFile')) {
				$file_path = 'assets/ttd/' . $this->upload->data('file_name');
				$this->session->set_flashdata('ttd_upload', 'ttd_upload');
			} else {
				$this->session->set_flashdata('ttd_gagal', 'ttd_gagal');
			}

			if ($this->session->userdata('id_user_level') == 2) {
				redirect('Dmunit/view_admin');
			} elseif ($this->session->userdata('id_user_level') == 3) {
				redirect('Dmunit/view_super_admin');
			}	
	}
	public function edit_data(){
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			$nama_manager_u = $this->input->post("nama_manager_u");
			$nip_awal = $this->input->post("nip_awal");
			$nip_manager_u = $this->input->post("nip_manager_u");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$nomor_telp = $this->input->post("nomor_telp");
			$alamat_manager_u = $this->input->post("alamat_manager_u");

			$this->session->set_flashdata('edit');
			$hasil = $this -> m_user -> edit_data_manager_u($nama_manager_u,$nip_manager_u,$id_jenis_kelamin,$nomor_telp,$alamat_manager_u,$nip_awal);
			if ($this->session->userdata('id_user_level') == 2) {
            	redirect('Dmunit/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
            	redirect('Dmunit/view_super_admin');
            }
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
}
