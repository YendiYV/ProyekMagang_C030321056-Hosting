<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('m_absensi');
	}

	public function view_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$cari_bulan = $this->input->get('cari_bulan'); // Corrected variable name
			if ($cari_bulan === null) {
				$data['absensi'] = $this->m_absensi->get_all_absensi();
				$data['data_absensi'] = $this->m_absensi->get_data_absensi();
				$this->load->view('manager/absensi', $data);
			} else {
				$data['absensi'] = $this->m_absensi->get_all_absensi_menurut_bulan($cari_bulan);
				$data['data_absensi'] = $this->m_absensi->get_data_absensi_bulan($cari_bulan);
				$this->load->view('manager/absensi', $data);
			}
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function view_super_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$cari_bulan = $this->input->get('cari_bulan'); // Corrected variable name
			if ($cari_bulan === null) {
				$data['absensi'] = $this->m_absensi->get_all_absensi();
				$data['data_absensi'] = $this->m_absensi->get_data_absensi();
				$this->load->view('super_admin/absensi', $data);
			} else {
				$data['absensi'] = $this->m_absensi->get_all_absensi_menurut_bulan($cari_bulan);
				$data['data_absensi'] = $this->m_absensi->get_data_absensi_bulan($cari_bulan);
				$this->load->view('super_admin/absensi', $data);
			}
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

    public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$cari_bulan = $this->input->get('cari_bulan'); // Corrected variable name
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
			$username = $this->session->userdata('username');		
			$data['absensi'] = $this->m_absensi->get_data_absensi_operator($username);
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
		$username = $this->input->post("username"); // Dapatkan id_user dari input
		$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if ($waktu_sekarang >= '08:00' && $waktu_sekarang <= '08:20')  {	
				$ketersediaan_data = $this->m_absensi->cek_kehadiran_absensi($username);	
				if($ketersediaan_data !== null){
					if ($action === 'hadir') {
						$this->session->set_flashdata('input_hadir', 'input_hadir');
						$this->m_absensi->insert_hadir($username); // Panggil fungsi model yang sesuai
					} elseif ($action === 'sakit') {
						$this->session->set_flashdata('input_sakit', 'input_sakit');
						$this->m_absensi->insert_sakit($username); // Panggil fungsi model yang sesuai
					} elseif ($action === 'ijin') {
						$this->session->set_flashdata('input_izin', 'input_izin');
						$this->m_absensi->insert_ijin($username); // Panggil fungsi model yang sesuai
					} elseif ($action === 'cuti') {
						$this->session->set_flashdata('input_cuti', 'input_cuti');
						$this->m_absensi->insert_cuti($username); // Panggil fungsi model yang sesuai
					} else {
						$this->session->set_flashdata('error', 'Tindakan tidak valid.');
					}
				}else{	
					$this->session->set_flashdata('error', 'error');
				}
			}else {
				$this->session->set_flashdata('eror_pagi', 'eror_pagi');
			}
		}else {
			$this->session->set_flashdata('error', 'error');
		}

		redirect('Dashboard/dashboard_operator');
	}

	public function tambah_absensi_pulang() {
		$timezone = new DateTimeZone('Asia/Makassar');
		$datetime = new DateTime('now', $timezone);

		// Tambahkan 5 menit dan 13 detik
		$datetime->modify('+5 minutes +23 seconds');
		$waktu_sekarang = $datetime->format('H:i:s');
		$username = $this->input->post("username"); // Dapatkan id_user dari input
		
		// Pemeriksaan hari
		$dayOfWeek = date('N'); // Dapatkan hari dalam format 1 hingga 7 (Senin hingga Minggu)

		if ($dayOfWeek >= 1 && $dayOfWeek <= 5) { // Hanya lanjutkan jika hari Senin hingga Jumat
			if ($waktu_sekarang >= '15:40' && $waktu_sekarang <= '16:00') {
				$cek_absen_pulang = $this->m_absensi->cek_status_untuk_absen_pulang($username);

				if ($cek_absen_pulang > 0) {
					$action = $this->input->post('action'); // Dapatkan tindakan yang diambil dari input
					$this->session->set_flashdata('input_pulang', 'input_pulang');
					$this->m_absensi->insert_pulang($username);
				} else {
					$this->session->set_flashdata('mencoba_akses', 'mencoba_akses');
				}

			} else {
				$this->session->set_flashdata('eror_pulang', 'eror_pulang');
			}
		} else {
			$this->session->set_flashdata('error', 'error');
		}

		redirect('Dashboard/dashboard_operator');
	}


	public function edit_absensi_admin(){
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$username = $this->input->post("username");
            $nip = $this->input->post("nip");
            $tanggal = $this->input->post("tanggal");
            $status_absen = $this->input->post("status");
			
			$edit_admin_kosong = $this->m_absensi->cek_edit_absensi_admin_data_kosong($nip, $tanggal);
			if($status_absen == 0){
				$hasil = $this->m_absensi->hapus_absensi_admin($nip,$tanggal);
				$this->session->set_flashdata('hapus', 'hapus');
			}else{
				if($edit_admin_kosong >0){
					$hasil = $this->m_absensi->edit_absensi_admin($nip, $tanggal,$status_absen);
					$this->session->set_flashdata('edit','edit');
				}else{
					$result = $this->m_absensi->cari_absensi_admin_data_kosong($nip);
					$hasil = $this->m_absensi->edit_absensi_admin_data_kosong($username, $tanggal,$status_absen);
					$this->session->set_flashdata('edit2','edit2');
				}
			}
			
			redirect($_SERVER['HTTP_REFERER']);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function edit_absensi_super_admin(){
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$username = $this->input->post("username");
            $nip = $this->input->post("nip");
            $tanggal = $this->input->post("tanggal");
            $status_absen = $this->input->post("status");
			
			$edit_admin_kosong = $this->m_absensi->cek_edit_absensi_admin_data_kosong($nip, $tanggal);
			if($status_absen == 0){
				$hasil = $this->m_absensi->hapus_absensi_admin($nip,$tanggal);
				$this->session->set_flashdata('hapus', 'hapus');
			}else{
				if($edit_admin_kosong >0){
					$hasil = $this->m_absensi->edit_absensi_admin($nip, $tanggal,$status_absen);
					$this->session->set_flashdata('edit','edit');
				}else{
					$result = $this->m_absensi->cari_absensi_admin_data_kosong($nip);
					$hasil = $this->m_absensi->edit_absensi_admin_data_kosong($username, $tanggal,$status_absen);
					$this->session->set_flashdata('edit2','edit2');
				}
			}
			
			//redirect('Absensi/view_admin');
			redirect($_SERVER['HTTP_REFERER']);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}
}