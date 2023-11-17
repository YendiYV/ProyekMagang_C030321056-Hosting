<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komunikasi extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_komunikasi');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['komunikasi'] = $this->m_komunikasi->get_all_komunikasi();
            $this->load->view('admin/komunikasi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['komunikasi'] = $this->m_komunikasi->get_all_komunikasi();
            $this->load->view('super_admin/komunikasi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['komunikasi'] = $this->m_komunikasi->get_all_komunikasi();
            $this->load->view('manager/komunikasi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_komunikasi()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_level = $this->input->post("id_level");
            $nama_kom = $this->input->post("nama_kom");
            $gaji_kom = $this->input->post("gaji_kom");
            if ($gaji_kom !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_komunikasi->edit_komunikasi($id_level, $nama_kom, $gaji_kom);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Komunikasi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Komunikasi/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Komunikasi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Komunikasi/view_super_admin');
                }
            } 
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_komunikasi($id_level)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $this->m_komunikasi->delete_komunikasi($id_level);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Komunikasi/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Komunikasi/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_komunikasi()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $nama_kom = $this->input->post('nama_komunikasi');
            $gaji_kom = $this->input->post('gaji_kom');
            if ($gaji_kom !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_komunikasi->insert_komunikasi($nama_kom, $gaji_kom);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Komunikasi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Komunikasi/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror','eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Komunikasi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Komunikasi/view_super_admin');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}