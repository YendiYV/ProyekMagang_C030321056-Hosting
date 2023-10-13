<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpk extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_bpk');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['bpk'] = $this->m_bpk->get_all_bpk();
            $this->load->view('admin/bpk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_bpk()
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $id_level = $this->input->post("id_level");
            $nama_bpk = $this->input->post("nama_bpk");
            $gaji_bpk = $this->input->post("gaji_bpk");
            if ($gaji_bpk !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_bpk->edit_bpk($id_level,$nama_bpk,$gaji_bpk);
                redirect('Bpk/view_admin');
            } else {
                $this->session->set_flashdata('eror_edit');
                redirect('Bpk/view_admin');
            }
            
        }else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function delete_bpk($id_level)
    {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $this->m_bpk->delete_bpk($id_level);
            redirect('Bpk/view_admin');
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }

    public function tambah_bpk(){
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
            $nama_bpk = $this->input->post('nama_bpk');
            $gaji_bpk = $this->input->post('gaji_bpk');
            if ($gaji_bpk !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_bpk->insert_bpk($nama_bpk,$gaji_bpk);
                redirect('Bpk/view_admin');
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat mengubah BPK.');
                redirect('Bpk/view_admin');
            }
        }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
        }
    }
}