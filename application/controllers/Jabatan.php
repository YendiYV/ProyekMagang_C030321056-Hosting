<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_jabatan');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['jabatan'] = $this->m_jabatan->get_all_jabatan();
            $this->load->view('admin/jabatan', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function edit_jabatan()
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $id_level = $this->input->post("id_level");
            $operator_level = $this->input->post("operator_level");
            $gaji = $this->input->post("gaji");
            if ($gaji !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_jabatan->edit_jabatan($id_level,$operator_level,$gaji);
                redirect('Jabatan/view_admin');
            } else {
                $this->session->set_flashdata('eror_edit');
                redirect('Jabatan/view_admin');
            }
            
        }else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_jabatan($id_level)
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $this->m_jabatan->delete_jabatan($id_level);
            redirect('Jabatan/view_admin');
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }

    public function tambah_jabatan(){
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $operator_level = $this->input->post('operator_level');
            $gaji = $this->input->post('gaji');
            if ($gaji !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_jabatan->insert_jabatan($operator_level,$gaji);
                redirect('Jabatan/view_admin');
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat mengubah Jabatan.');
                redirect('Jabatan/view_admin');
            }
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }
}