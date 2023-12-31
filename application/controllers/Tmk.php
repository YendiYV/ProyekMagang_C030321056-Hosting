<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmk extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_tmk');
	}

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['tmk'] = $this->m_tmk->get_all_tmk();
            $this->load->view('manager/tmk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['tmk'] = $this->m_tmk->get_all_tmk();
            $this->load->view('admin/tmk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['tmk'] = $this->m_tmk->get_all_tmk();
            $this->load->view('super_admin/tmk', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function edit_tmk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $id_status_tmk = $this->input->post("id_status_tmk");
            $rupiah_tmk = $this->input->post("rupiah_tmk");
            if ($rupiah_tmk !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_tmk->edit_tmk($id_status_tmk, $rupiah_tmk);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Tmk/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Tmk/view_super_admin');
                } else {
                    redirect('Tmk/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Tmk/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Tmk/view_super_admin');
                } else {
                    redirect('Tmk/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_tmk($id_status_tmk)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $this->m_tmk->delete_penempatan($id_status_tmk);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Tmk/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Tmk/view_super_admin');
            } else {
                redirect('Tmk/other_page'); // Ganti dengan halaman yang sesuai
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_tmk()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $rupiah_tmk = $this->input->post('rupiah_tmk');
            if ($rupiah_tmk !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_tmk->insert_tmk($rupiah_tmk);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Tmk/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Tmk/view_super_admin');
                } else {
                    redirect('Tmk/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat menambahkan TMK.');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Tmk/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Tmk/view_super_admin');
                } else {
                    redirect('Tmk/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}