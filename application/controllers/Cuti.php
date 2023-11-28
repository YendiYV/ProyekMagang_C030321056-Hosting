<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}
	

	public function view_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
			$this->load->view('manager/cuti', $data);
		}else{
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
			}
    }

    public function view_super_admin()
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
		$data['tabel_tipe_cuti'] = $this->m_cuti->get_tipe_cuti()->result_array();	
		$this->load->view('super_admin/cuti', $data);

	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}
    }
    
	public function view_admin()
	{
		
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {

			$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
			$data['tabel_tipe_cuti'] = $this->m_cuti->get_tipe_cuti()->result_array();
			$this->load->view('admin/cuti', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}

	}
	
	public function view_operator()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
			$id_user = $this->session->userdata('id_user');	
			$data['cuti'] = $this->m_cuti->get_all_cuti_by_id_user($id_user)->result_array();
			$data['operator'] = $this->m_user->get_operator_by_id($id_user)->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['operator_data'] = $this->m_user->get_operator_by_id($id_user)->result_array();
		
		$this->load->view('operator/cuti', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}
	}
	
	public function hapus_cuti()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");

			$hasil = $this->m_cuti->delete_cuti($id_cuti_detail);
			
			if($hasil==false){
				$this->session->set_flashdata('eror_hapus','eror_hapus');
			}else{
				$this->session->set_flashdata('hapus','hapus');
			}

			redirect('Cuti/view_operator');
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function hapus_cuti_admin()
	{
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");

			$hasil = $this->m_cuti->delete_cuti($id_cuti_detail);
			$this->session->set_flashdata('hapus','hapus');

			if ($this->session->userdata('id_user_level') == 2) {
				redirect('Cuti/view_admin');
			} elseif ($this->session->userdata('id_user_level') == 3) {
				redirect('Cuti/view_super_admin');
			}
		
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function edit_cuti_admin()
	{
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			$id_user = $this->input->post("id_user");
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$alasan = $this->input->post("alasan");
			$tipe_cuti= $this->input->post("tipe_cuti");
			$perihal_cuti = $this->input->post("perihal_cuti");
			$tgl_diajukan = $this->input->post("tgl_diajukan");
			$mulai = $this->input->post("mulai");
			$berakhir = $this->input->post("berakhir");

			// Hitung jumlah hari cuti
			$total_hari_cuti = $this->hitung_hari_cuti($mulai, $berakhir);

			$hasil = $this->m_cuti->update_cuti($alasan, $perihal_cuti, $tgl_diajukan, $mulai, $berakhir, $id_cuti_detail,$total_hari_cuti,$tipe_cuti);
			$hasil = $this->m_cuti->update_cuti_user_detail($id_user ,$total_hari_cuti);
			
			if($hasil==false){
				$this->session->set_flashdata('eror_edit','eror_edit');
			}else{
				$this->session->set_flashdata('edit','edit');
			}
			if ($this->session->userdata('id_user_level') == 2) {
				redirect('Cuti/view_admin');
			} elseif ($this->session->userdata('id_user_level') == 3) {
				redirect('Cuti/view_super_admin');
			}
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	private function hitung_hari_cuti($mulai, $berakhir) 
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
	public function acc_cuti_admin($id_status_cuti1)
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$id_cuti_detail= $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");
			
			$hasil = $this->m_cuti->confirm_cuti1($id_cuti_detail, $id_status_cuti1);

			if($hasil==false){
				$this->session->set_flashdata('eror_input','eror_input');
			}else{
				$this->session->set_flashdata('input','input');
			}
		
			redirect('Cuti/view_admin');
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function acc_cuti_super_admin($id_status_cuti2)
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");

			$hasil = $this->m_cuti->confirm_cuti2($id_cuti_detail, $id_status_cuti2);

			if($hasil==false){
				$this->session->set_flashdata('eror_input','eror_input');
			}else{
				$this->session->set_flashdata('input','input');
			}

			redirect('Cuti/view_super_admin');
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
	}

	public function acc_cuti_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");
			$tipe_cuti = $this->input->post("id_tipe_cuti");
			$mulai = $this->input->post("mulai");
			$berakhir = $this->input->post("berakhir");
			
			$total_hari_cuti = $this->hitung_total_cuti($mulai, $berakhir);
			$hasil = $this->m_cuti->confirm_cuti3($id_cuti_detail, $id_status_cuti3);
			if($tipe_cuti == 3){
				$hasil = $this->m_cuti->insert_user_detail_sakit($id_user, $total_hari_cuti);
			}
			if ($hasil == false) {
				$this->session->set_flashdata('eror_input', 'eror_input');
			} else {
				$this->session->set_flashdata('input', 'input');
			}
			redirect('Cuti/view_manager');
		} else {
		// Handle kasus ketika pengguna tidak memiliki hak akses
		$this->session->set_flashdata('loggin_err', 'loggin_err');
		redirect('Login/index');
        }
	}

	public function tolak_cuti_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$id_cuti_detail = $this->input->post("id_cuti_detail");
			$id_user = $this->input->post("id_user");
			$mulai = $this->input->post("mulai");
			$tipe_cuti = $this->input->post("id_tipe_cuti");
			$berakhir = $this->input->post("berakhir");
			$id_status_cuti3 = $this->input->post("id_status_cuti3");
			
			if ($id_status_cuti3=== '2') {
				$total_hari_cuti = $this->hitung_total_cuti($mulai, $berakhir);
				
				$hasil = $this->m_cuti->tolak_cuti3($id_cuti_detail, $id_status_cuti3);
				if($tipe_cuti == 3){
				$hasil = $this->m_cuti->insert_user_detail_hapus($id_user, $total_hari_cuti);
				}
				if ($hasil == false) {
					$this->session->set_flashdata('eror_input', 'eror_input');
				}else {
					$this->session->set_flashdata('input', 'input');
				}
			}elseif ($id_status_cuti3 === '1') {
				$total_hari_cuti = $this->hitung_total_cuti($mulai, $berakhir);
				$hasil = $this->m_cuti->confirm_cuti3($id_cuti_detail, $id_status_cuti3);
				if ($hasil == false) {
					$this->session->set_flashdata('eror_input', 'eror_input');
				}else {
					$this->session->set_flashdata('input', 'input');
				}
			}
			redirect('Cuti/view_manager');
		} else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
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
}