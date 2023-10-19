<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rgaji extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_rgaji');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['gaji_bulan'] = $this->m_rgaji->get_all_gaji_bulan();
            $this->load->view('admin/rgaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['gaji_bulan'] = $this->m_rgaji->get_all_gaji_bulan();
            $this->load->view('super_admin/rgaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_gaji_bulan()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_user_detail = $this->input->post("id_user_detail");
            $gaji_bulan = $this->input->post("gaji_bulan");
            $total_gaji = $this->input->post("total_gaji");

            if ($this->session->userdata('id_user_level') == 2) {
                if ($gaji_bulan !== null) {
                    $this->session->set_flashdata('edit');
                    $hasil = $this->m_rgaji->edit_gaji_bulan($id_user_detail, $gaji_bulan, $total_gaji);
                    redirect('Rgaji/view_admin');
                } else {
                    $this->session->set_flashdata('eror_edit');
                    redirect('Rgaji/view_admin');
                }
            }elseif ($this->session->userdata('id_user_level') == 3) {
                if ($gaji_bulan !== null) {
                    $this->session->set_flashdata('edit');
                    $hasil = $this->m_rgaji->edit_gaji_bulan($id_user_detail, $gaji_bulan, $total_gaji);
                    redirect('Rgaji/view_super_admin');
                } else {
                    $this->session->set_flashdata('eror_edit');
                    redirect('Rgaji/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_gaji_bulan($id_user_detail)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $this->m_rgaji->delete_gaji_bulan($id_user_detail);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Rgaji/view_admin');
            }elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Rgaji/view_super_admin');
            }else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');}
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}