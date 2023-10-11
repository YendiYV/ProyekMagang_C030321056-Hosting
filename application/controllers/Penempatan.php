<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_penempatan');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['penempatan'] = $this->m_penempatan->get_all_penempatan();
            $this->load->view('admin/penempatan', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function edit_penempatan()
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $id_penempatan = $this->input->post("id_penempatan");
            $nama_penempatan = $this->input->post("nama_penempatan");
            $gaji = $this->input->post("gaji");
            if ($gaji !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_penempatan->edit_penempatan($id_penempatan,$nama_penempatan,$gaji);
                redirect('Penempatan/view_admin');
            } else {
                $this->session->set_flashdata('eror_edit');
                redirect('Penempatan/view_admin');
            }
            
        }else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_penempatan($id_penempatan)
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $this->m_penempatan->delete_penempatan($id_penempatan);
            redirect('Penempatan/view_admin');
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }

    public function tambah_penempatan() {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $nama_penempatan = $this->input->post('nama_penempatan');
            $gaji = $this->input->post('gaji');
            if ($gaji !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_penempatan->insert_penempatan($nama_penempatan,$gaji);
                redirect('Penempatan/view_admin');
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat mengubah penempatan.');
                redirect('Penempatan/view_admin');
            }
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }
}