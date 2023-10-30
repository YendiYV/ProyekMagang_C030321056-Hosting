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
            $data['data_per_tanggal'] = $this->m_rgaji->data_per_tanggal();
            $data['username'] = $this->m_user->get_all_operator()->result_array();
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
    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['gaji_bulan'] = $this->m_rgaji->get_all_gaji_bulan();
            $this->load->view('manager/rgaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_rgaji(){
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $username = $this->input->post('username');
            $tanggal_gaji = $this->input->post('tanggal_gaji');
            $total_gaji = $this->input->post('total_gaji');
            $total_delta = $this->input->post('total_delta');
            $tanggal_simpan = $this->input->post('tanggal_input');

            $check_data= $this->m_rgaji->check_data_gaji($username, $tanggal_simpan);
            if($check_data == null){
                if ($total_gaji !== null){
                $this->session->set_flashdata('input');
                $hasil = $this->m_rgaji->insert_gaji_bulan($username,$tanggal_gaji, $total_gaji,$total_delta,$tanggal_simpan);
                redirect('Rgaji/view_admin');
                }else {
                    $this->session->set_flashdata('eror');
                    redirect('Rgaji/view_admin');
                } 
            }else{
                if ($total_gaji !== null){
                    $this->session->set_flashdata('edit');
                    $hasil = $this->m_rgaji->edit_gaji_bulan_tambah($username, $tanggal_gaji, $total_gaji,$total_delta,$tanggal_simpan);
                    redirect('Rgaji/view_admin');
                }else {
                    $this->session->set_flashdata('eror');
                    redirect('Rgaji/view_admin');
                } 
            }
        }
        else {
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
            $total_delta = $this->input->post("total_delta");
            $tanggal_simpan = $this->input->post('tanggal_input');

            if ($this->session->userdata('id_user_level') == 2) {
                if ($gaji_bulan !== null) {
                    $this->session->set_flashdata('edit');
                    $hasil = $this->m_rgaji->edit_gaji_bulan($id_user_detail, $gaji_bulan, $total_gaji,$tanggal_simpan,$total_delta);
                    redirect('Rgaji/view_admin');
                } else {
                    $this->session->set_flashdata('eror_edit');
                    redirect('Rgaji/view_admin');
                }
            }elseif ($this->session->userdata('id_user_level') == 3) {
                if ($gaji_bulan !== null) {
                    $this->session->set_flashdata('edit');
                    $hasil = $this->m_rgaji->edit_gaji_bulan($id_user_detail, $gaji_bulan, $total_gaji,$tanggal_simpan,$total_delta);
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