<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatan extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_penempatan');
        $this->load->model('m_um');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['penempatan'] = $this->m_penempatan->get_all_penempatan();
            $data['tipe_um'] = $this->m_um->get_all_um();
            $this->load->view('admin/penempatan', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['penempatan'] = $this->m_penempatan->get_all_penempatan();
            $data['tipe_um'] = $this->m_um->get_all_um();
            $this->load->view('super_admin/penempatan', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function edit_penempatan()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $id_penempatan = $this->input->post("id_penempatan");
            $nama_penempatan = $this->input->post("nama_penempatan");
            $gaji = $this->input->post("gaji");
            $tipe_um = $this->input->post("tipe_um");
            if ($gaji !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_penempatan->edit_penempatan($id_penempatan, $nama_penempatan, $gaji, $tipe_um);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Penempatan/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Penempatan/view_super_admin');
                } else {
                    redirect('Penempatan/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Penempatan/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Penempatan/view_super_admin');
                } else {
                    redirect('Penempatan/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_penempatan($id_penempatan)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $this->m_penempatan->delete_penempatan($id_penempatan);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Penempatan/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Penempatan/view_super_admin');
            } else {
                redirect('Penempatan/other_page'); // Ganti dengan halaman yang sesuai
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_penempatan()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 4)) {
            $nama_penempatan = $this->input->post('nama_penempatan');
            $gaji = $this->input->post('gaji');
            $tipe_um = $this->input->post("tipe_um");
            if ($gaji !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_penempatan->insert_penempatan($nama_penempatan, $tipe_um, $gaji);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Penempatan/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Penempatan/view_super_admin');
                } else {
                    redirect('Penempatan/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat menambahkan penempatan.');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Penempatan/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Penempatan/view_super_admin');
                } else {
                    redirect('Penempatan/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}