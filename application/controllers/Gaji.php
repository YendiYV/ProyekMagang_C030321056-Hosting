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
            $this->load->view('super_admin/gaji', $data);
        } else {
            // Handle kasus ketika pengguna tidak memiliki hak akses
            $this->session->set_flashdata('loggin_err', 'loggin_err');
            redirect('Login/index');
        }
    }

   public function save_total_semua() {
        $usernames = $this->input->post('username');
        $gaji_bulans = $this->input->post('gaji_bulan');
        $total_per_orang_tanpa_deltas = $this->input->post('total_per_orang_tanpa_delta');
        $total_per_orangs = $this->input->post('total_per_orang');
        $status_deltas = $this->input->post('status_delta');

        $messages = [];

        for ($i = 0; $i < count($usernames); $i++) {
            $username = $usernames[$i];
            $total_per_orang_tanpa_delta = $total_per_orang_tanpa_deltas[$i];
            $total_per_orang = $total_per_orangs[$i];
            $gaji_bulan = $gaji_bulans[$i];

            // Ubah format tanggal untuk memeriksa apakah tanggal adalah 1
            $selected_date = date('d', strtotime($gaji_bulan));

            if ($selected_date === '01') {
                // Periksa apakah data dengan username dan bulan yang sama sudah ada
                $data_exist = $this->m_gaji->check_data_exist($username, $gaji_bulan);

                if ($data_exist) {
                    $total_sebelumnya = $this->m_gaji->get_tanpa_delta_previous_month($username, $gaji_bulan);
                    if($total_sebelumnya){
                        if ($total_per_orang_tanpa_delta > $total_sebelumnya){ //Berhasil
                            $hasil = $this->m_gaji->update_data_tanpa_delta_same_month($username, $gaji_bulan, $total_per_orang_tanpa_delta);
                            if ($hasil) {
                                $this->session->set_flashdata('edit');
                            } else {
                                $this->session->set_flashdata('error_edit');
                            }
                        } else {//Berhasil
                            $total_sebelumnya_dengan_delta = $this->m_gaji->get_dengan_delta_previous_month($username, $gaji_bulan);
                            $total_per_orang = $total_sebelumnya_dengan_delta;
                            $hasil = $this->m_gaji->update_data_same_month($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta);
                            if ($hasil) {
                                $this->session->set_flashdata('edit');
                            } else {
                                $this->session->set_flashdata('error_edit');
                            }
                        }   
                    }else{//Berhasil
                        $hasil = $this->m_gaji->update_data_same_month_tidak_ada_data($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta);
                        if ($hasil) {
                            $this->session->set_flashdata('edit');
                        } else {
                            $this->session->set_flashdata('error_edit');
                        }
                    }
                }else {
                    $cek_bulan_sebelumnya = $this->m_gaji->check_data_availability($username, $gaji_bulan);
                    if($cek_bulan_sebelumnya){
                        $total_sebelumnya_tanpa_delta = $this->m_gaji->get_tanpa_delta_previous_month($username, $gaji_bulan);
                        if ($total_per_orang_tanpa_delta > $total_sebelumnya_tanpa_delta){ //Berhasil 
                            $hasil = $this->m_gaji->insert_data_tanpa_delta($username, $gaji_bulan, $total_per_orang_tanpa_delta);
                            if ($hasil) {
                                $this->session->set_flashdata('input');
                            } else {
                                $this->session->set_flashdata('eror');
                            }
                        }else{//Berhasil 
                            $total_sebelumnya_dengan_delta = $this->m_gaji->get_dengan_delta_previous_month($username, $gaji_bulan);
                            $total_per_orang = $total_sebelumnya_dengan_delta;
                            $hasil = $this->m_gaji->insert_data($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta);
                            if ($hasil) {
                                $this->session->set_flashdata('input');
                            } else {
                                $this->session->set_flashdata('eror');
                            }
                        }
                    }else{ //Berhasil
                        $hasil = $this->m_gaji->insert_data($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta);
                        if ($hasil) {
                                $this->session->set_flashdata('input');
                            } else {
                                $this->session->set_flashdata('eror');
                            }
                    }
                }
            }else {
                $messages[] = "Gagal menginputkan data untuk username: $username. Hanya tanggal 1 yang dapat diinput.";
            }

        }
        // Redirect atau berikan respons sesuai dengan kebutuhan Anda
        if ($this->session->userdata('id_user_level') == 2) {
        redirect('Gaji/view_admin');
        } elseif ($this->session->userdata('id_user_level') == 3) {
            redirect('Gaji/view_super_admin');
        }
    }


}