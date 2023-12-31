<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_proyek');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['proyek'] = $this->m_proyek->get_all_proyek();
            $this->load->view('admin/proyek', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['proyek'] = $this->m_proyek->get_all_proyek();
            $this->load->view('super_admin/proyek', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['proyek'] = $this->m_proyek->get_all_proyek();
            $this->load->view('manager/proyek', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function edit_proyek()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $id_status_proyek = $this->input->post("id_proyek");
            $nama_proyek = $this->input->post("nama_proyek");
            $gaji = $this->input->post("gaji");
            if ($gaji !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_proyek->edit_proyek($id_status_proyek, $nama_proyek, $gaji);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Proyek/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Proyek/view_super_admin');
                } else {
                    $this->session->set_flashdata('loggin_err', 'loggin_err');
                    redirect('Login/index');
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Proyek/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Proyek/view_super_admin');
                } else {
                    $this->session->set_flashdata('loggin_err', 'loggin_err');
                    redirect('Login/index');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_proyek($id_proyek)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $this->m_proyek->delete_proyek($id_proyek);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Proyek/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Proyek/view_super_admin');
            } else {
                $this->session->set_flashdata('loggin_err', 'loggin_err');
                redirect('Login/index');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_proyek()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $nama_proyek = $this->input->post('nama_proyek');
            $gaji = $this->input->post('gaji');
            if ($gaji !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_proyek->insert_proyek($nama_proyek, $gaji);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Proyek/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Proyek/view_super_admin');
                } else {
                    $this->session->set_flashdata('loggin_err', 'loggin_err');
                    redirect('Login/index');
                }
            } else {
                $this->session->set_flashdata('eror', 'eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Proyek/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Proyek/view_super_admin');
                } else {
                    $this->session->set_flashdata('loggin_err', 'loggin_err');
                    redirect('Login/index');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}