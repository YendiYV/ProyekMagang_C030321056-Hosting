<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Kegiatan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->library('upload');

	}
    public function view_operator()
	{
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
            $username = $this->session->userdata('username');
            $data['kegiatan'] = $this->m_user->get_operator_by_id($this->session->userdata('username'))->result_array();
            $this->load->view('operator/form_kegiatan', $data);
        }else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
    }
	public function edit_data_operator(){
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
			$username = $this->session->userdata('username');
			$kegiatan1 = $this->input->post("kegiatan1");
			$kegiatan2 = $this->input->post("kegiatan2");
			$kegiatan3 = $this->input->post("kegiatan3");
			$kegiatan4 = $this->input->post("kegiatan4");

			$hasil = $this->m_user->update_data_kegiatan($username,$kegiatan1,$kegiatan2,$kegiatan3,$kegiatan4);
			if($hasil){
				$this->session->set_flashdata('eror_edit','eror_edit');	
			}else{
				$this->session->set_flashdata('edit','edit');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function upload_foto_kegiatan() {
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
			$username = $this->session->userdata('username');
			$config['upload_path']   = FCPATH . 'assets/kegiatan/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']      = 1024;
			$config['overwrite']     = TRUE;
			$config['file_name1']    = 'fotoKegiatan1-ops-' . $username . '.jpg';
			$config['file_name2']    = 'fotoKegiatan2-ops-' . $username . '.jpg';
			$config['file_name3']    = 'fotoKegiatan3-ops-' . $username . '.jpg';
			$config['file_name4']    = 'fotoKegiatan4-ops-' . $username . '.jpg';

			$this->upload->initialize($config);

			$file_paths = array();

			// Upload File 1
			if ($this->upload->do_upload('fotoKegiatan1')) {
				$file_paths[] = 'assets/kegiatan/' . $this->upload->data('file_name1');
			}

			// Upload File 2
			if ($this->upload->do_upload('fotoKegiatan2')) {
				$file_paths[] = 'assets/kegiatan/' . $this->upload->data('file_name2');
			}

			// Upload File 3
			if ($this->upload->do_upload('fotoKegiatan3')) {
				$file_paths[] = 'assets/kegiatan/' . $this->upload->data('file_name3');
			}

			// Upload File 4
			if ($this->upload->do_upload('fotoKegiatan4')) {
				$file_paths[] = 'assets/kegiatan/' . $this->upload->data('file_name4');
			}

		} else {
			
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
		$this->session->set_flashdata('foto_gagal', 'foto_gagal');
		redirect($_SERVER['HTTP_REFERER']);
	}

}