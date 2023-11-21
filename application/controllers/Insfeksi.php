<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insfeksi extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_insfeksi');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['insfeksi'] = $this->m_insfeksi->get_all_insfeksi();
            $this->load->view('admin/insfeksi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['insfeksi'] = $this->m_insfeksi->get_all_insfeksi();
            $this->load->view('super_admin/insfeksi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['insfeksi'] = $this->m_insfeksi->get_all_insfeksi();
            $this->load->view('manager/insfeksi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_insfeksi()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_user_detail = $this->input->post("id_user_detail");
            $gaji_insfeksi = $this->input->post("gaji_insfeksi");

            $this->session->set_flashdata('edit');
            $hasil = $this->m_insfeksi->edit_insfeksi($id_user_detail, $gaji_insfeksi);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Insfeksi/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Insfeksi/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
}