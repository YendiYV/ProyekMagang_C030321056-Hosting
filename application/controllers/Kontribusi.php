<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontribusi extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_kontribusi');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['kontribusi'] = $this->m_kontribusi->get_all_kontribusi();
            $this->load->view('admin/kontribusi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['kontribusi'] = $this->m_kontribusi->get_all_kontribusi();
            $this->load->view('super_admin/kontribusi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['kontribusi'] = $this->m_kontribusi->get_all_kontribusi();
            $this->load->view('manager/kontribusi', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    
    public function edit_kontribusi()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_level = $this->input->post("id_level");
            $nama_kontribusi = $this->input->post("nama_kontribusi");
            $gaji_kontribusi = $this->input->post("gaji_kontribusi");
            if ($gaji_kontribusi !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_kontribusi->edit_kontribusi($id_level, $nama_kontribusi, $gaji_kontribusi);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Kontribusi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Kontribusi/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Kontribusi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Kontribusi/view_super_admin');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_kontribusi($id_level)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $this->m_kontribusi->delete_kontribusi($id_level);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Kontribusi/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Kontribusi/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_kontribusi()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $nama_kontribusi = $this->input->post('nama_kontribusi');
            $gaji_kontribusi = $this->input->post('gaji_kontribusi');
            if ($gaji_kontribusi !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_kontribusi->insert_kontribusi($nama_kontribusi, $gaji_kontribusi);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Kontribusi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Kontribusi/view_super_admin');
                }
            } else {
                $this->session->set_flashdata('eror','eror');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Kontribusi/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Kontribusi/view_super_admin');
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}