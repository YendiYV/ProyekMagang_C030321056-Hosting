<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_transport');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['transport'] = $this->m_transport->get_all_transport();
            $this->load->view('admin/transport', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['transport'] = $this->m_transport->get_all_transport();
            $this->load->view('super_admin/transport', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['transport'] = $this->m_transport->get_all_transport();
            $this->load->view('manager/transport', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }
    public function edit_transport()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $id_transport = $this->input->post("id_level");
            $nama_transport = $this->input->post("nama_transport");
            $tunjangan_transport = $this->input->post("tunjangan_transport");
            if ($tunjangan_transport !== null) {
                $this->session->set_flashdata('edit');
                $hasil = $this->m_transport->edit_transport($id_transport, $nama_transport, $tunjangan_transport);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Transport/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Transport/view_super_admin');
                } else {
                    redirect('Transport/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror_edit');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Transport/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Transport/view_super_admin');
                } else {
                    redirect('Transport/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function delete_transport($id_transport)
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $this->m_transport->delete_transport($id_transport);
            if ($this->session->userdata('id_user_level') == 2) {
                redirect('Transport/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Transport/view_super_admin');
            } else {
                redirect('Transport/other_page'); // Ganti dengan halaman yang sesuai
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_transport()
    {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $nama_transport = $this->input->post('nama_transport');
            $tunjangan_transport = $this->input->post('gaji');
            if ($tunjangan_transport !== null) {
                $this->session->set_flashdata('input');
                $hasil = $this->m_transport->insert_transport($nama_transport, $tunjangan_transport);
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Transport/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Transport/view_super_admin');
                } else {
                    redirect('Transport/other_page'); // Ganti dengan halaman yang sesuai
                }
            } else {
                $this->session->set_flashdata('eror', 'Terjadi kesalahan saat menambahkan Transport.');
                if ($this->session->userdata('id_user_level') == 2) {
                    redirect('Transport/view_admin');
                } elseif ($this->session->userdata('id_user_level') == 3) {
                    redirect('Transport/view_super_admin');
                } else {
                    redirect('Transport/other_page'); // Ganti dengan halaman yang sesuai
                }
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

}