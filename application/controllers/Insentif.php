<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insentif extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_insentif');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['insentif'] = $this->m_insentif->get_all_insentif();
            $this->load->view('admin/insentif', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['insentif'] = $this->m_insentif->get_all_insentif();
            $this->load->view('super_admin/insentif', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['insentif'] = $this->m_insentif->get_all_insentif();
            $this->load->view('manager/insentif', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_insentif()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $id_level = $this->input->post("id_level");
            $nama_insentif = $this->input->post("nama_insentif");
            $gaji_insentif = $this->input->post("gaji_insentif");
            if ($gaji_insentif !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_insentif->edit_insentif($id_level, $nama_insentif, $gaji_insentif);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Insentif/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Insentif/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Insentif/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Insentif/view_super_admin');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_insentif($id_level)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $this->m_insentif->delete_insentif($id_level);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Insentif/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Insentif/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_insentif()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $nama_insentif = $this->input->post('nama_insentif');
            $gaji_insentif = $this->input->post('gaji_insentif');
            if ($gaji_insentif !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_insentif->insert_insentif($nama_insentif, $gaji_insentif);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Insentif/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Insentif/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror','eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Insentif/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Insentif/view_super_admin');
                } 
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}