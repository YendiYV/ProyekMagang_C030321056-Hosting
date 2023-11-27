<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_proyek');
		$this->load->model('m_jabatan');
		$this->load->model('m_penempatan');
		$this->load->model('m_bpk');
		$this->load->model('m_delta');
		$this->load->model('m_transport');
		$this->load->model('m_komunikasi');
		$this->load->model('m_uang_hadir');
		$this->load->model('m_kontribusi');
		$this->load->model('m_insentif');
	}
	
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			
			$data['operator'] = $this->m_user->get_all_operator()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['nama_proyek_list'] = $this->m_proyek->get_all_proyek();
			$data['nama_level_list'] = $this->m_jabatan->get_all_jabatan();
			$data['nama_penempatan_list'] = $this->m_penempatan->get_all_penempatan();
			$data['nama_bpk_list'] = $this->m_bpk->get_all_bpk();
			$data['nama_delta_list'] = $this->m_delta->get_all_delta();
			$data['nama_transport_list'] = $this->m_transport->get_all_transport();
			$data['nama_komunikasi_list'] = $this->m_komunikasi->get_all_komunikasi();
			$data['nama_uang_hadir_list'] = $this->m_uang_hadir->get_all_uang_hadir();
			$data['nama_kontribusi_list'] = $this->m_kontribusi->get_all_kontribusi();
			$data['nama_insentif_list'] = $this->m_insentif->get_all_insentif();
			$this->load->view('admin/operator', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}

    public function view_super_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			
			$data['operator'] = $this->m_user->get_all_operator()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['nama_proyek_list'] = $this->m_proyek->get_all_proyek();
			$data['nama_level_list'] = $this->m_jabatan->get_all_jabatan();
			$data['nama_penempatan_list'] = $this->m_penempatan->get_all_penempatan();
			$data['nama_bpk_list'] = $this->m_bpk->get_all_bpk();
			$data['nama_delta_list'] = $this->m_delta->get_all_delta();
			$data['nama_transport_list'] = $this->m_transport->get_all_transport();
			$data['nama_komunikasi_list'] = $this->m_komunikasi->get_all_komunikasi();
			$data['nama_uang_hadir_list'] = $this->m_uang_hadir->get_all_uang_hadir();
			$data['nama_kontribusi_list'] = $this->m_kontribusi->get_all_kontribusi();
			$data['nama_insentif_list'] = $this->m_insentif->get_all_insentif();
			$this->load->view('super_admin/operator', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
    
	public function view_manager()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$data['operator'] = $this->m_user->get_all_operator()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['nama_proyek_list'] = $this->m_proyek->get_all_proyek();
			$data['nama_level_list'] = $this->m_jabatan->get_all_jabatan();
			$data['nama_penempatan_list'] = $this->m_penempatan->get_all_penempatan();
			$data['nama_bpk_list'] = $this->m_bpk->get_all_bpk();
			$data['nama_delta_list'] = $this->m_delta->get_all_delta();
			$data['nama_transport_list'] = $this->m_transport->get_all_transport();
			$data['nama_komunikasi_list'] = $this->m_komunikasi->get_all_komunikasi();
			$data['nama_uang_hadir_list'] = $this->m_uang_hadir->get_all_uang_hadir();
			$data['nama_kontribusi_list'] = $this->m_kontribusi->get_all_kontribusi();
			$data['nama_insentif_list'] = $this->m_insentif->get_all_insentif();
			$this->load->view('manager/operator', $data);
			
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}
    }
	public function tambah_operator()
	{
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$re_password = $this->input->post("confirm_password");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_user_level = 1;
			$id_status_proyek = $this->input->post('id_status_proyek');
			$jabatan = $this->input->post("operator_level");
			$penempatan = $this->input->post("penempatan");
			$tanggal_masuk = $this->input->post("tanggal_masuk");
			$delta = $this->input->post("delta");
			$bpk = $this->input->post("bpk");
			$transport = $this->input->post("transport");
			$komunikasi = $this->input->post("komunikasi");
			$uang_hadir = $this->input->post("uang_hadir");
			$kontribusi = $this->input->post("kontribusi");
			$insentif = $this->input->post("insentif");

			$id = md5($username . $password);
			if ($password == $re_password) {
				// Ubah password menjadi hashed
				$hashed_password = md5($password);
				$password =$hashed_password;
				if ($username !== null){
					$this->session->set_flashdata('input','input');
					$hasil = $this->m_user->insert_operator($id, $username, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat,$id_status_proyek, $jabatan,$penempatan,$bpk,$delta,$transport ,$komunikasi,$uang_hadir,$kontribusi,$insentif ,$tanggal_masuk);
				}
				else {
					$this->session->set_flashdata('eror_ada','eror_ada');
				}
			}else {
				$this->session->set_flashdata('eror_password','eror_password');
			}

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}
	
	public function edit_operator()
	{
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			// Mendapatkan data yang diperlukan dari input form
			$id_user_level = $this->session->userdata('id_user_level');
			$id_user = $this->input->post("id_user");
			$username = $this->input->post("username");
			$newPassword = $this->input->post("password");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$jabatan = $this->input->post("operator_level");
			$penempatan = $this->input->post("penempatan");
			$delta = $this->input->post("delta");
			$bpk = $this->input->post("bpk");
			$transport = $this->input->post("transport");
			$komunikasi = $this->input->post("komunikasi");
			$uang_hadir = $this->input->post("uang_hadir");
			$kontribusi = $this->input->post("kontribusi");
			$insentif = $this->input->post("insentif");
			$id_status_proyek = $this->input->post("id_status_proyek");
			$tanggal_masuk = $this->input->post("tanggal_masuk");

			// Mendapatkan password lama dari database
			$oldPasswordQuery = $this->db->query("SELECT password FROM user WHERE id_user='$id_user'");
			$oldPasswordRow = $oldPasswordQuery->row();
			$oldPasswordFromDatabase = $oldPasswordRow->password;

			
			if ($newPassword === $oldPasswordFromDatabase) {
				// Password baru sama dengan password lama, gunakan password lama yang ada dalam database
				$password = $oldPasswordFromDatabase;
			} else {
				// Password baru berbeda, enkripsi password baru menggunakan MD5
				$password = md5($newPassword);
			}


			if ($username !== null){
			$hasil = $this->m_user->update_operator($id_user, $username, $password, 1, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $jabatan, $penempatan,$bpk,$delta,$transport,$komunikasi,$uang_hadir,$kontribusi,$insentif,$id_status_proyek, $tanggal_masuk);
			$this->session->set_flashdata('edit','edit');
			} else {
				$this->session->set_flashdata('eror_edit','eror_edit');
			}

			if ($id_user_level == 2) {
				// Pengguna dengan id_user_level 2 akan diarahkan ke halaman 'operator/view_admin'
				redirect('operator/view_admin');
			} elseif ($id_user_level == 3) {
				// Pengguna dengan id_user_level 3 akan diarahkan ke halaman 'operator/view_super_admin'
				redirect('operator/view_super_admin');
			}
		}else{
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function hapus_operator()
	{
		// Check if the user is logged in and has the required user level
		if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
			// Get the user ID from the POST data
			$id_user = $this->input->post("id_user");


			// Delete the operator
			$hasil = $this->m_user->delete_operator($id_user);

			// Set flash messages based on the result
			if ($hasil == false) {
				$this->session->set_flashdata('eror_hapus', 'eror_hapus');
			} else {
				$this->session->set_flashdata('hapus', 'hapus');
			}

			// Redirect based on the user level
			$redirect_url = '';
			$id_user_level = $this->session->userdata('id_user_level');

			if ($id_user_level == 2) {
				$redirect_url = 'operator/view_admin';
			} elseif ($id_user_level == 3) {
				$redirect_url = 'operator/view_super_admin';
			}

			redirect($redirect_url);
		} else {
			// Redirect to login page if not logged in or incorrect user level
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}


	
}