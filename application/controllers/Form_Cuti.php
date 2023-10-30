<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Cuti extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}
	
	public function view_operator()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
			// Menggunakan ID pengguna dari sesi saat ini
			$id_user = $this->session->userdata('id_user');

			 // Hitung total cuti dalam setahun
			$total_hari_cuti = $this->m_cuti->total_hari_cuti_by_id_for_form($id_user);

			if ($total_hari_cuti >= 12) {
				// Total cuti dalam setahun lebih dari atau sama dengan 12, Anda dapat mengarahkan pengguna ke tampilan lain
				$this->session->set_flashdata('not_found', 'not_found');
				redirect('Dashboard/dashboard_operator');
			} else {
				// Total cuti dalam setahun kurang dari 12, muat tampilan pengajuan cuti
				$data['operator_data'] = $this->m_user->get_operator_by_id($this->session->userdata('id_user'))->result_array();
				$data['operator'] = $this->m_user->get_operator_by_id($this->session->userdata('id_user'))->row_array();
				$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();	
				$this->load->view('operator/form_pengajuan_cuti', $data);
			}
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function proses_cuti() {
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
			// Menggunakan ID pengguna dari sesi saat ini
			$id_user = $this->input->post("id_user");
			$alasan = $this->input->post("alasan");
			$perihal_cuti = $this->input->post("perihal_cuti");
			$mulai = $this->input->post("mulai");
			$berakhir = $this->input->post("berakhir");

			$total_hari_cuti = $this->hitung_total_cuti($mulai, $berakhir);

			$tahun = date("Y");
			$nomor_urut_cuti_exists = true;
			$nomor_urut = '';

			while ($nomor_urut_cuti_exists) {
				$nomor_urut = mt_rand(1, 9999);
				$nomor_urut_cuti = $nomor_urut . "-SP-Cuti-" . $tahun;
				$nomor_urut_cuti_exists = $this->m_cuti->check_data_cuti($nomor_urut_cuti);
			}

			// Setelah keluar dari loop, Anda memiliki nomor urut acak yang belum pernah digunakan sebelumnya

			$id_status_cuti1 = 1;
			$id_status_cuti2 = 1;
			$id_status_cuti3 = 1;

			$hasil = $this->m_cuti->insert_data_cuti($nomor_urut_cuti, $id_user, $alasan, $mulai, $berakhir, $id_status_cuti1, $id_status_cuti2, $id_status_cuti3, $perihal_cuti, $total_hari_cuti);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_input', 'eror_input');
			} else {
				$this->session->set_flashdata('input', 'input');
			}
			redirect('Dashboard/dashboard_operator');
			
		}else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}


    private function hitung_total_cuti($mulai, $berakhir) 
	{
		$tanggal_mulai = new DateTime($mulai);
		$tanggal_berakhir = new DateTime($berakhir);

		$total_hari_cuti = 0;

		while ($tanggal_mulai <= $tanggal_berakhir) {
			// Periksa apakah hari saat ini bukan hari Sabtu (6) dan Minggu (7)
			if ($tanggal_mulai->format('N') != 6 && $tanggal_mulai->format('N') != 7) {
				$total_hari_cuti++;
			}
			$tanggal_mulai->modify('+1 day');
		}

		// Jika total hari cuti adalah 5, tambahkan 1
		if ($total_hari_cuti == 5) {
			$total_hari_cuti++;
		}

		return $total_hari_cuti;
	}
	
	function hitung_hari_libur($tanggal_masuk, $tahun) {
		$tanggal_masuk = new DateTime($tanggal_masuk);
		$tanggal_masuk->setTime(0, 0, 0); // Tetapkan waktu ke 00:00:00
		$hari_libur = 0;

		for ($i = $tahun; $i < $tahun + 1; $i++) { // Menghitung satu tahun dari tahun masuk pekerja
			$tahun_target = $i;
			for ($bulan = 1; $bulan <= 12; $bulan++) {
				$tanggal_target = new DateTime("$tahun_target-$bulan-01");
				$akhir_bulan = (int)$tanggal_target->format('t');
				for ($hari = 1; $hari <= $akhir_bulan; $hari++) {
					if ($tanggal_target->format('N') != 6 && $tanggal_target->format('N') != 7) {
						$tanggal_libur = new DateTime("$tahun_target-$bulan-$hari");
						if ($tanggal_libur > $tanggal_masuk) {
							$hari_libur++;
						}
					}
					$tanggal_target->modify('+1 day');
				}
			}
		}

		return $hari_libur;
	}
}