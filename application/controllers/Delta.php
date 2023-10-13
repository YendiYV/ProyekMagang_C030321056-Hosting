<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delta extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_delta');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['delta'] = $this->m_delta->get_all_delta();
            $this->load->view('admin/delta', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_delta()
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $id_level = $this->input->post("id_level");
            $nama_delta = $this->input->post("nama_delta");
            $gaji_delta = $this->input->post("gaji_delta");
            if ($gaji_delta !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_delta->edit_delta($id_level,$nama_delta,$gaji_delta);
                redirect('Delta/view_admin');
            } else {
                $this->session->set_flashdata('eror_edit');
                redirect('Delta/view_admin');
            }
            
        }else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function delete_delta($id_level)
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $this->m_delta->delete_delta($id_level);
            redirect('Delta/view_admin');
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }

    public function tambah_delta(){
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $nama_delta = $this->input->post('nama_delta');
            $gaji_delta = $this->input->post('gaji_delta');
            if ($gaji_delta !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_delta->insert_delta($nama_delta,$gaji_delta);
                redirect('Delta/view_admin');
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat mengubah Delta.');
                redirect('Delta/view_admin');
            }
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }
}