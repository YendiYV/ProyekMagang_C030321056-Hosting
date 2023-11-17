<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uang_Hadir extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_uang_hadir');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['uang_hadir'] = $this->m_uang_hadir->get_all_uang_hadir();
            $this->load->view('admin/uang_hadir', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['uang_hadir'] = $this->m_uang_hadir->get_all_uang_hadir();
            $this->load->view('super_admin/uang_hadir', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['uang_hadir'] = $this->m_uang_hadir->get_all_uang_hadir();
            $this->load->view('manager/uang_hadir', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_uh()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_level = $this->input->post("id_level");
            $nama_uang_hadir = $this->input->post("nama_uh");
            $gaji_uang_hadir = $this->input->post("gaji_uh");
            if ($gaji_uang_hadir !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_uang_hadir->edit_uang_hadir($id_level, $nama_uang_hadir, $gaji_uang_hadir);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Uang_Hadir/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Uang_Hadir/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Uang_Hadir/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Uang_Hadir/view_super_admin');
                }
                
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_uh($id_level)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $this->m_uang_hadir->delete_uang_hadir($id_level);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Uang_Hadir/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Uang_Hadir/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_uh()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $nama_uang_hadir = $this->input->post('nama_uh');
            $gaji_uang_hadir = $this->input->post('gaji_uh');
            if ($gaji_uang_hadir !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_uang_hadir->insert_uang_hadir($nama_uang_hadir, $gaji_uang_hadir);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Uang_Hadir/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Uang_Hadir/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror','eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Uang_Hadir/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Uang_Hadir/view_super_admin');
                } else {
                    redirect('Uang_Hadir/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}