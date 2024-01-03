<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class No_Spk extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_no_spk');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['no_spk'] = $this->m_no_spk->get_all_no_spk();
            $this->load->view('admin/no_spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['no_spk'] = $this->m_no_spk->get_all_no_spk();
            $this->load->view('super_admin/no_spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['no_spk'] = $this->m_no_spk->get_all_no_spk();
            $this->load->view('manager/no_spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function view_operasional()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 5) {
            $data['no_spk'] = $this->m_no_spk->get_all_no_spk();
            $this->load->view('operasional/no_spk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function edit_no_spk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $id_no_spk = $this->input->post("id_no_spk");
            $nama_no_spk = $this->input->post("nama_no_spk");
            $hasil = $this->m_no_spk->edit_no_spk($id_no_spk, $nama_no_spk);
            if($hasil){
                $this->session->set_flashdata('eror_edit');
            }else{
                $this->session->set_flashdata('edit');
            } 
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('No_Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('No_Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('No_Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function delete_no_spk($id_no_spk)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $this->m_no_spk->delete_no_spk($id_no_spk);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('No_Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('No_Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('No_Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_no_spk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 5)) {
            $nama_no_spk = $this->input->post('nama_no_spk');
            
            $hasil = $this->m_no_spk->insert_no_spk($nama_no_spk);
            if($hasil){
                $this->session->set_flashdata('eror_input');
            }else{
                $this->session->set_flashdata('input');
            }
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('No_Spk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('No_Spk/view_super_admin');
            }elseif ($this->session->userdata('id_user_level') == 5) {
                redirect('No_Spk/view_admin_plnt');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}