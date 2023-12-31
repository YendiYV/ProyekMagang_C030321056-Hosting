<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_user');
		$this->load->model('m_gaji');
	}

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['operator'] = $this->m_gaji->get_all_gaji()->result_array();
            $data['operator2'] = $this->m_gaji->get_all_gaji_baru()->result_array();
            $this->load->view('admin/gaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_super_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
            $data['operator'] = $this->m_gaji->get_all_gaji()->result_array();
            $data['operator2'] = $this->m_gaji->get_all_gaji_baru()->result_array();
            $this->load->view('super_admin/gaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function view_manager()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['operator'] = $this->m_gaji->get_all_gaji()->result_array();
            $data['operator2'] = $this->m_gaji->get_all_gaji_baru()->result_array();
            $this->load->view('manager/gaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function save_total_semua() {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $usernames = $this->input->post('username');
            $gaji_bulans = $this->input->post('gaji_bulan');
            $total_per_orangs = $this->input->post('total_per_orang');
            $tanggal_inputs = $this->input->post('tanggal_input');

            $messages = [];
            if (is_array($usernames) && count($usernames) > 0) {
                for ($i = 0; $i < count($usernames); $i++) {
                    $username = $usernames[$i];
                    $total_per_orang = $total_per_orangs[$i];
                    $gaji_bulan = $gaji_bulans[$i];
                    $tanggal_input=$tanggal_inputs[$i];

                    if ($total_per_orang >0) {
                        // Ubah format tanggal untuk memeriksa apakah tanggal adalah 1
                        $selected_date = date('d', strtotime($gaji_bulan));

                        if ($selected_date === '01') {
                            // Periksa apakah data dengan username dan bulan yang sama sudah ada
                            $data_exist = $this->m_gaji->check_data_exist($username, $gaji_bulan);

                            if ($data_exist) {
                                $hasil = $this->m_gaji->update_data($username, $gaji_bulan, $total_per_orang ,$tanggal_input);
                                if ($hasil) {
                                    $this->session->set_flashdata('input','input');
                                } else {
                                    $this->session->set_flashdata('eror','eror');
                                }
                            }else {
                                $hasil = $this->m_gaji->insert_data($username, $gaji_bulan, $total_per_orang ,$tanggal_input);
                                if ($hasil) {
                                    $this->session->set_flashdata('input','input');
                                } else {
                                    $this->session->set_flashdata('eror','eror');
                                }
                            }
                        }else {
                            $this->session->set_flashdata('eror','eror');
                        }
                    }
                }
            }
            // Redirect atau berikan respons sesuai dengan kebutuhan Anda
            if ($this->session->userdata('id_user_level') == 2) {
            redirect('Gaji/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Gaji/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

    public function save_total_semua_baru() {
        if ($this->session->userdata('logged_in') == true && ($this->session->userdata('id_user_level') >= 2 && $this->session->userdata('id_user_level') <= 3)) {
            $usernames = $this->input->post('username2');
            $gaji_bulans = $this->input->post('gaji_bulan2');
            $total_per_orangs = $this->input->post('total_per_orang2');
            $tanggal_inputs = $this->input->post('tanggal_input2');

            $messages = [];
            if ($usernames !== null && is_array($usernames)) {
                for ($i = 0; $i < count($usernames); $i++) {
                    $username = $usernames[$i];
                    $total_per_orang = $total_per_orangs[$i];
                    $gaji_bulan = $gaji_bulans[$i];
                    $tanggal_input=$tanggal_inputs[$i];
                    // Ubah format tanggal untuk memeriksa apakah tanggal adalah 1
                    $selected_date = date('d', strtotime($gaji_bulan));

                    if ($total_per_orang >0) {
                        if ($selected_date === '01') {
                            // Periksa apakah data dengan username dan bulan yang sama sudah ada
                            $data_exist = $this->m_gaji->check_data_exist($username, $gaji_bulan);
                            if ($data_exist) {
                                $hasil = $this->m_gaji->update_data($username, $gaji_bulan, $total_per_orang ,$tanggal_input);
                                        if ($hasil) {
                                            $this->session->set_flashdata('input_baru','input_baru');
                                        } else {
                                            $this->session->set_flashdata('eror_baru','eror_baru');
                                        }
                            }else {
                                $hasil = $this->m_gaji->insert_data($username, $gaji_bulan, $total_per_orang ,$tanggal_input);
                                    if ($hasil) {
                                        $this->session->set_flashdata('input_baru','input_baru');
                                    } else {
                                        $this->session->set_flashdata('eror_baru','eror_baru');
                                    }
                            }
                        }else {
                            $this->session->set_flashdata('eror','eror');
                        }
                    }
                }
            }
            // Redirect atau berikan respons sesuai dengan kebutuhan Anda
            if ($this->session->userdata('id_user_level') == 2) {
            redirect('Gaji/view_admin');
            } elseif ($this->session->userdata('id_user_level') == 3) {
                redirect('Gaji/view_super_admin');
            }
        } else {
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }


}