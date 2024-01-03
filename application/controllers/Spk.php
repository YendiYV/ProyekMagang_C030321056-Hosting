<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_spk');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['spk'] = $this->m_spk->get_all_spk();
            $this->load->view('admin/spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['spk'] = $this->m_spk->get_all_spk();
            $this->load->view('super_admin/spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['spk'] = $this->m_spk->get_all_spk();
            $this->load->view('manager/spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_spk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $id_spk = $this->input->post("id_spk");
            $nama_spk = $this->input->post("nama_spk");
            $hasil = $this->m_spk->edit_spk($id_spk, $nama_spk);
            if($hasil){
                $this->session->set_flashdata('eror_edit');
            }else{
                $this->session->set_flashdata('edit');
            } 
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_operasional()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 5) {
            $data['spk'] = $this->m_spk->get_all_spk();
            $this->load->view('operasional/spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function delete_spk($id_spk)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $this->m_spk->delete_spk($id_spk);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_spk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $nama_spk = $this->input->post('nama_spk');
            
            $hasil = $this->m_spk->insert_spk($nama_spk);
            if($hasil){
                $this->session->set_flashdata('eror_input');
            }else{
                $this->session->set_flashdata('input');
            }
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}