<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Kegiatan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
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

	public function upload_kegiatan1()
	{
		$username = $this->session->userdata('username');
		$config['upload_path']   = FCPATH . 'assets/kegiatan/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'k1-ops-'.$username.'.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fotoKegiatan1')) {
			// File uploaded successfully
			$file_path = 'assets/kegiatan/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('foto_upload', 'foto_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('foto_gagal', 'foto_gagal');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
	public function upload_kegiatan2()
	{
		$username = $this->session->userdata('username');
		$config['upload_path']   = FCPATH . 'assets/kegiatan/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'k2-ops-'.$username.'.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fotoKegiatan2')) {
			// File uploaded successfully
			$file_path = 'assets/kegiatan/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('foto_upload', 'foto_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('foto_gagal', 'foto_gagal');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
	public function upload_kegiatan3()
	{
		$username = $this->session->userdata('username');
		$config['upload_path']   = FCPATH . 'assets/kegiatan/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'k3-ops-'.$username.'.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fotoKegiatan3')) {
			// File uploaded successfully
			$file_path = 'assets/kegiatan/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('foto_upload', 'foto_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('foto_gagal', 'foto_gagal');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
	public function upload_kegiatan4()
	{
		$username = $this->session->userdata('username');
		$config['upload_path']   = FCPATH . 'assets/kegiatan/'; // FCPATH gives you the full server path to the CodeIgniter index.php file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 1024;
		$config['overwrite']     = TRUE; // Set to TRUE to overwrite the file if it already exists
		$config['file_name']     = 'k4-ops-'.$username.'.jpg'; // Set the desired file name with the file extension

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fotoKegiatan4')) {
			// File uploaded successfully
			$file_path = 'assets/kegiatan/' . $this->upload->data('file_name');
			// You can do further processing with the file path if needed
			$this->session->set_flashdata('foto_upload', 'foto_upload');
		} else {
			// File upload failed
			$this->session->set_flashdata('foto_gagal', 'foto_gagal');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function delete_kegiatan1() {
		$username = $this->session->userdata('username');
        $imagePath = FCPATH . 'assets/kegiatan/k1-ops-'.$username . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file dari direktori
            $this->session->set_flashdata('foto_hapus', 'foto_hapus');
        } else {
            $this->session->set_flashdata('foto_gagal_hapus', 'foto_gagal_hapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
	public function delete_kegiatan2() {
		$username = $this->session->userdata('username');
        $imagePath = FCPATH . 'assets/kegiatan/k2-ops-'.$username . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file dari direktori
            $this->session->set_flashdata('foto_hapus', 'foto_hapus');
        } else {
            $this->session->set_flashdata('foto_gagal_hapus', 'foto_gagal_hapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
	public function delete_kegiatan3() {
		$username = $this->session->userdata('username');
        $imagePath = FCPATH . 'assets/kegiatan/k3-ops-'.$username . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file dari direktori
            $this->session->set_flashdata('foto_hapus', 'foto_hapus');
        } else {
            $this->session->set_flashdata('foto_gagal_hapus', 'foto_gagal_hapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
	public function delete_kegiatan4() {
		$username = $this->session->userdata('username');
        $imagePath = FCPATH . 'assets/kegiatan/k4-ops-'.$username . '.jpg';

        if (file_exists($imagePath)) {
            unlink($imagePath); // Menghapus file dari direktori
            $this->session->set_flashdata('foto_hapus', 'foto_hapus');
        } else {
            $this->session->set_flashdata('foto_gagal_hapus', 'foto_gagal_hapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}