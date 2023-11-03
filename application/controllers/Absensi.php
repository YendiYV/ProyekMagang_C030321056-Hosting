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
	public function tambah_absensi_masuk() {
		$currentTime = date('H:i'); // Dapatkan waktu saat ini dalam format HH:ii
		$startTime = '08:00'; // Waktu mulai
		$endTime = '08:15'; // Waktu berakhir
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input

		if (strtotime($currentTime) >= strtotime($startTime) && strtotime($currentTime) <= strtotime($endTime)) {
			// Jika waktu saat ini berada dalam jangka waktu yang diizinkan, lanjutkan
			$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input

			// Pemrosesan sesuai dengan tindakan yang diambil
			if ($action === 'hadir') {
				$this->session->set_flashdata('input', 'Anda telah melakukan absensi hadir.');
				$this->m_delta->insert_hadir($id_user); // Panggil fungsi model yang sesuai
			} elseif ($action === 'sakit') {
				$this->session->set_flashdata('input', 'Anda telah melakukan absensi sakit.');
				$this->m_delta->insert_sakit($id_user); // Panggil fungsi model yang sesuai
			} elseif ($action === 'ijin') {
				$this->session->set_flashdata('input', 'Anda telah melakukan absensi ijin.');
				$this->m_delta->insert_ijin($id_user); // Panggil fungsi model yang sesuai
			} elseif ($action === 'cuti') {
				$this->session->set_flashdata('input', 'Anda telah melakukan absensi cuti.');
				$this->m_delta->insert_cuti($id_user); // Panggil fungsi model yang sesuai
			} else {
				$this->session->set_flashdata('error', 'Tindakan tidak valid.');
			}
		} else {
			// Jika waktu saat ini berada di luar jangka waktu yang diizinkan, set pesan kesalahan
			$this->session->set_flashdata('eror', 'Anda hanya dapat melakukan absensi antara jam 08:00 dan 08:15.');
		}
		redirect('Dashboard/dashboard_operator');
	}
	public function tambah_absensi_pulang() {
		$currentTime = date('H:i'); // Dapatkan waktu saat ini dalam format HH:ii
		$startTime = '15:45'; // Waktu mulai
		$endTime = ':16.00'; // Waktu berakhir
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input

		if (strtotime($currentTime) >= strtotime($startTime) && strtotime($currentTime) <= strtotime($endTime)) {
			// Jika waktu saat ini berada dalam jangka waktu yang diizinkan, lanjutkan
			$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
			$this->session->set_flashdata('input_pulang', 'Anda telah melakukan absensi Pulang.');
			$this->m_delta->insert_pulang($id_user); 
		} else {
			// Jika waktu saat ini berada di luar jangka waktu yang diizinkan, set pesan kesalahan
			$this->session->set_flashdata('eror','eror');
		}
		redirect('Dashboard/dashboard_operator');
	}
}