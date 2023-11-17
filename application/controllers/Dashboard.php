<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_cuti');
		$this->load->model('m_jabatan');
		$this->load->model('m_proyek');
		$this->load->model('m_penempatan');
		$this->load->model('m_tmk');
		$this->load->model('m_bpk');
		$this->load->model('m_delta');
		$this->load->model('m_rgaji');
		$this->load->model('m_reset_cuti');
		$this->load->model('m_absensi');
		$this->load->model('m_komunikasi');
		$this->load->model('m_uang_hadir');
		$this->load->model('m_kontribusi');
		$this->load->model('m_insentif');
	}

	public function dashboard_manager()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 4) {
			$data['cuti'] = $this->m_cuti->count_all_cuti()->row_array();
			$data['cuti_acc'] = $this->m_cuti->count_all_cuti_acc()->row_array();
			$data['cuti_confirm'] = $this->m_cuti->count_all_cuti_confirm()->row_array();
			$data['cuti_reject'] = $this->m_cuti->count_all_cuti_reject()->row_array();
			$data['operator'] = $this->m_user->count_all_operator()->row_array();
			$data['jabatan'] = $this->m_jabatan->count_all_jabatan()->row_array();
			$data['proyek'] = $this->m_proyek->count_all_proyek()->row_array();
			$data['penempatan'] = $this->m_penempatan->count_all_penempatan()->row_array();
			$data['tmk'] = $this->m_tmk->count_all_tmk()->row_array();
			$data['bpk'] = $this->m_bpk->count_all_bpk()->row_array();
			$data['delta'] = $this->m_delta->count_all_delta()->row_array();
			$data['rgaji'] = $this->m_rgaji->count_all_rgaji()->row_array();
			$data['rgaji_bulan_ini'] = $this->m_rgaji->count_all_rgaji_bulan_ini()->row_array();
			$data['data_per_tanggal'] = $this->m_rgaji->data_per_tanggal()->row_array();
			$this->load->view('manager/dashboard', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	public function dashboard_super_admin()
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$data['cuti'] = $this->m_cuti->count_all_cuti()->row_array();
			$data['cuti_acc'] = $this->m_cuti->count_all_cuti_acc()->row_array();
			$data['cuti_confirm'] = $this->m_cuti->count_all_cuti_confirm()->row_array();
			$data['cuti_reject'] = $this->m_cuti->count_all_cuti_reject()->row_array();
			$data['operator'] = $this->m_user->count_all_operator()->row_array();
			$data['jabatan'] = $this->m_jabatan->count_all_jabatan()->row_array();
			$data['proyek'] = $this->m_proyek->count_all_proyek()->row_array();
			$data['penempatan'] = $this->m_penempatan->count_all_penempatan()->row_array();
			$data['tmk'] = $this->m_tmk->count_all_tmk()->row_array();
			$data['bpk'] = $this->m_bpk->count_all_bpk()->row_array();
			$data['delta'] = $this->m_delta->count_all_delta()->row_array();
			$data['rgaji'] = $this->m_rgaji->count_all_rgaji()->row_array();
			$data['rgaji_bulan_ini'] = $this->m_rgaji->count_all_rgaji_bulan_ini()->row_array();
			$data['data_per_tanggal'] = $this->m_rgaji->data_per_tanggal()->row_array();
			$this->load->view('super_admin/dashboard', $data);
	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}
	}

	public function dashboard_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$data['cuti'] = $this->m_cuti->count_all_cuti()->row_array();
			$data['cuti_acc'] = $this->m_cuti->count_all_cuti_acc()->row_array();
			$data['cuti_confirm'] = $this->m_cuti->count_all_cuti_confirm()->row_array();
			$data['cuti_reject'] = $this->m_cuti->count_all_cuti_reject()->row_array();
			$data['operator'] = $this->m_user->count_all_operator()->row_array();
			$data['jabatan'] = $this->m_jabatan->count_all_jabatan()->row_array();
			$data['proyek'] = $this->m_proyek->count_all_proyek()->row_array();
			$data['penempatan'] = $this->m_penempatan->count_all_penempatan()->row_array();
			$data['tmk'] = $this->m_tmk->count_all_tmk()->row_array();
			$data['bpk'] = $this->m_bpk->count_all_bpk()->row_array();
			$data['delta'] = $this->m_delta->count_all_delta()->row_array();
			$data['rgaji'] = $this->m_rgaji->count_all_rgaji()->row_array();
			$data['rgaji_bulan_ini'] = $this->m_rgaji->count_all_rgaji_bulan_ini()->row_array();
			$data['data_per_tanggal'] = $this->m_rgaji->data_per_tanggal()->row_array();
			$data['tunj_kom'] = $this->m_komunikasi->count_all_komunikasi()->row_array();
			$data['tunj_uh'] = $this->m_uang_hadir->count_all_uang_hadir()->row_array();
			$data['tunj_kontribusi'] = $this->m_kontribusi->count_all_kontribusi()->row_array();
			$data['tunj_insentif'] = $this->m_insentif->count_all_insentif()->row_array();
			$this->load->view('admin/dashboard', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	
	public function dashboard_operator()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
			$id_user = $this->session->userdata('id_user');			
			$this->m_reset_cuti->reset_jumlah_hari($id_user);
			$cek_absensi_hari_ini = $this->m_absensi->cek_absensi_hari_ini($id_user);

			if ($cek_absensi_hari_ini < 1) {
				$timezone = new DateTimeZone('Asia/Makassar');
				$datetime = new DateTime('now', $timezone);

				// Check if the current day is Monday (1) to Friday (5)
				$dayOfWeek = $datetime->format('N');
				if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
					$datetime->modify('+5 minutes +23 seconds');
					$waktu_sekarang = $datetime->format('H:i');

					if ($waktu_sekarang >= '08:21' && $waktu_sekarang <= '23:59') {
						$this->m_absensi->insert_alfa($id_user);
					}
				}
			}
			
			$data['cuti_operator'] = $this->m_cuti->get_all_cuti_first_by_id_user($id_user)->result_array();
			$data['cuti'] = $this->m_cuti->count_all_cuti_by_id($id_user)->row_array();
			$data['operator'] = $this->m_user->get_operator_by_id($id_user)->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['operator_data'] = $this->m_user->get_operator_by_id($id_user)->result_array();
			$data['total_cuti'] = $this->m_cuti->total_hari_cuti_by_id_for_dashboard($id_user)->row_array();
			$data['status_absensi'] = $this->m_absensi->cek_status_absensi($id_user)->result_array();
			$data['cek_status_absensi_untuk_absen_pulang'] = $this->m_absensi->cek_status_untuk_absen_pulang($id_user)->result_array();
			$data['ketersediaan_data'] = $this->m_absensi->cek_kehadiran_absensi($id_user);
			$data['ketersediaan_data2'] = $this->m_absensi->cek_kehadiran_absensi2($id_user)->row_array();
			$data['ketersediaan_data_pulang'] = $this->m_absensi->cek_status_untuk_absen_pulang($id_user)->row_array();
			$this->load->view('operator/dashboard', $data);
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}
	 
}