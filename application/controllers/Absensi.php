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
		date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke Makassar

		$currentTime = date('H:i'); // Dapatkan waktu saat ini dalam format HH:ii
		$startTime= '08:00';
		$endTime = '16:15'; // Waktu berakhir
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input
		$ketersediaan_data = $this->m_absensi->cek_kehadiran_absensi($id_user);	
		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if (strtotime($currentTime) >= strtotime($startTime) && strtotime($currentTime) <= strtotime($endTime)) {	
				if($ketersediaan_data === null){
					$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
					if ($action === 'hadir') {
						$this->session->set_flashdata('input', 'Anda telah melakukan absensi hadir.');
						$this->m_absensi->insert_hadir($id_user); // Panggil fungsi model yang sesuai
					} elseif ($action === 'sakit') {
						$this->session->set_flashdata('input', 'Anda telah melakukan absensi sakit.');
						$this->m_absensi->insert_sakit($id_user); // Panggil fungsi model yang sesuai
					} elseif ($action === 'ijin') {
						$this->session->set_flashdata('input', 'Anda telah melakukan absensi ijin.');
						$this->m_absensi->insert_ijin($id_user); // Panggil fungsi model yang sesuai
					} elseif ($action === 'cuti') {
						$this->session->set_flashdata('input', 'Anda telah melakukan absensi cuti.');
						$this->m_absensi->insert_cuti($id_user); // Panggil fungsi model yang sesuai
					} else {
						$this->session->set_flashdata('error', 'Tindakan tidak valid.');
					}
				}
				else{
					$this->session->set_flashdata('error', 'error');
				}
			}else {
				$this->session->set_flashdata('eror_pagi', 'Anda hanya dapat melakukan absensi antara jam 08:00 dan 08:15.');
			}
		} else {
			$this->session->set_flashdata('error', 'Absensi tidak dapat dilakukan pada hari Sabtu dan Minggu.');
		}

		redirect('Dashboard/dashboard_operator');
	}

	public function tambah_absensi_pulang() {
		date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke Makassar
		$currentTime = date('H:i'); // Dapatkan waktu saat ini dalam format HH:ii
		$startTime = '15:45'; // Waktu mulai
		$endTime = '16:00'; // Waktu berakhir
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input

		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if (strtotime($currentTime) >= strtotime($startTime) && strtotime($currentTime) <= strtotime($endTime)) {
				$cek_absen_pulang = $this->m_absensi->cek_status_untuk_absen_pulang($id_user);

            	if ($cek_absen_pulang === null) {
				$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
				$this->session->set_flashdata('input_pulang', 'Anda telah melakukan absensi Pulang.');
				$this->m_absensi->insert_pulang($id_user); 
				}else{
					$this->session->set_flashdata('mencoba_akses', 'mencoba_akses');
				}

			}else {
				$this->session->set_flashdata('eror_pulang', 'Anda hanya dapat melakukan absensi pulang antara jam 15:45 dan 16:00.');
			}
		}else {
			$this->session->set_flashdata('error', 'Absensi pulang tidak dapat dilakukan pada hari Sabtu dan Minggu.');
		}

		redirect('Dashboard/dashboard_operator');
	}

}