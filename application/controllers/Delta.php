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
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['delta'] = $this->m_delta->get_all_delta();
            $this->load->view('super_admin/delta', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['delta'] = $this->m_delta->get_all_delta();
            $this->load->view('manager/delta', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_delta()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $id_level = $this->input->post("id_level");
            $nama_delta = $this->input->post("nama_delta");
            $gaji_delta = $this->input->post("gaji_delta");
            if ($gaji_delta !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_delta->edit_delta($id_level, $nama_delta, $gaji_delta);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Delta/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Delta/view_super_admin');
                } else {
                    redirect('Delta/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Delta/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Delta/view_super_admin');
                } else {
                    redirect('Delta/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_delta($id_level)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $this->m_delta->delete_delta($id_level);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Delta/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Delta/view_super_admin');
            } else {
                redirect('Delta/other_page'); // Ganti dengan halaman yang sesuai
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_delta()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $nama_delta = $this->input->post('nama_delta');
            $gaji_delta = $this->input->post('gaji_delta');
            if ($gaji_delta !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_delta->insert_delta($nama_delta, $gaji_delta);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Delta/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Delta/view_super_admin');
                } else {
                    redirect('Delta/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror', 'eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Delta/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Delta/view_super_admin');
                } else {
                    redirect('Delta/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}