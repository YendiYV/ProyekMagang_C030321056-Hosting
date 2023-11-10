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
			$cari_bulan = $this->input->post('cari_bulan'); // Corrected variable name
			if ($cari_bulan === null) {
				$data['absensi'] = $this->m_absensi->get_all_absensi();
				$data['data_absensi'] = $this->m_absensi->get_data_absensi();
				$this->load->view('admin/absensi', $data);
			} else {
				$data['absensi'] = $this->m_absensi->get_all_absensi_menurut_bulan($cari_bulan);
				$data['data_absensi'] = $this->m_absensi->get_data_absensi_bulan($cari_bulan);
				$this->load->view('admin/absensi', $data);
			}
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
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
		$timezone = new DateTimeZone('Asia/Makassar');
		$datetime = new DateTime('now', $timezone);

		// Tambahkan 5 menit dan 13 detik
		$datetime->modify('+5 minutes +23 seconds');
		$waktu_sekarang = $datetime->format('H:i:s');
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input
		$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if ($waktu_sekarang >= '08:00' && $waktu_sekarang <= '08:20')  {	
				$ketersediaan_data = $this->m_absensi->cek_kehadiran_absensi($id_user);	
				if($ketersediaan_data !== null){
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
				}else{	
					$this->session->set_flashdata('error', 'error');
				}
			}else {
				$this->session->set_flashdata('eror_pagi', 'Anda hanya dapat melakukan absensi antara jam 08:00 dan 08:20.');
			}
		}else {
			$this->session->set_flashdata('error', 'Absensi tidak dapat dilakukan pada hari Sabtu dan Minggu.');
		}

		redirect('Dashboard/dashboard_operator');
	}

	public function tambah_absensi_pulang() {
		$timezone = new DateTimeZone('Asia/Makassar');
		$datetime = new DateTime('now', $timezone);

		// Tambahkan 5 menit dan 13 detik
		$datetime->modify('+5 minutes +23 seconds');
		$waktu_sekarang = $datetime->format('H:i:s');
		$id_user = $this->input->post("id_user"); // Dapatkan id_user dari input
		
		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if ($waktu_sekarang >= '15:40' && $waktu_sekarang <= '17:00') {
				$cek_absen_pulang = $this->m_absensi->cek_status_untuk_absen_pulang($id_user);

				if ($cek_absen_pulang > 0) {
					$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
					$this->session->set_flashdata('input_pulang', 'Anda telah melakukan absensi Pulang.');
					$this->m_absensi->insert_pulang($id_user);
				} else {
					$this->session->set_flashdata('mencoba_akses', 'mencoba_akses');
				}

			} else {
				$this->session->set_flashdata('eror_pulang', 'Anda hanya dapat melakukan absensi pulang antara jam 15:40 dan 16:00.');
			}
		} else {
			$this->session->set_flashdata('error', 'Absensi pulang tidak dapat dilakukan pada hari Sabtu dan Minggu.');
		}

		redirect('Dashboard/dashboard_operator');
	}


	public function edit_absensi_admin(){
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $nip = $this->input->post("nip");
            $tanggal = $this->input->post("tanggal");
            $status_absen = $this->input->post("status");
			
			$edit_admin_kosong = $this->m_absensi->cek_edit_absensi_admin_data_kosong($nip, $tanggal);
			if($edit_admin_kosong >0){
				$hasil = $this->m_absensi->edit_absensi_admin($nip, $tanggal,$status_absen);
				$this->session->set_flashdata('edit','edit');
			}else{
				$result = $this->m_absensi->cari_absensi_admin_data_kosong($nip);
				$id_user_detail = $result->id_user_detail;
				$hasil = $this->m_absensi->edit_absensi_admin_data_kosong($id_user_detail, $tanggal,$status_absen);
				$this->session->set_flashdata('edit2','edit2');
			}
			
			redirect('Absensi/view_admin');
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}
}