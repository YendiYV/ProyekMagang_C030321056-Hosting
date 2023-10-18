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

   public function save_total_semua() {
        $usernames = $this->input->post('username');
        $gaji_bulans = $this->input->post('gaji_bulan');
        $total_per_orang_tanpa_deltas = $this->input->post('total_per_orang_tanpa_delta');
        $total_per_orangs = $this->input->post('total_per_orang');

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
                    // Dapatkan total per orang tanpa delta sebelumnya untuk bulan sebelumnya
                    $total_sebelumnya = $this->m_gaji->get_gaji_total_previous_month($username, $gaji_bulan);
                    if ($total_per_orang_tanpa_delta > $total_sebelumnya) {
                            // Perbarui data dengan nilai delta yang baru
                            $hasil = $this->m_gaji->update_data_tanpa_delta($username, $gaji_bulan, $total_per_orang_tanpa_delta);
                            if ($hasil) {
                                $messages[] = "Berhasil memperbarui data untuk username: $username. Total per orang tanpa delta bulan ini lebih besar dari bulan sebelumnya. Delta diatur menjadi 0.";
                            } else {
                                $messages[] = "Gagal memperbarui data untuk username: $username.";
                            }
                    } else {
                        // Lakukan perbaruan data biasa
                        $hasil = $this->m_gaji->update_data($username, $gaji_bulan, $total_per_orang, $tambah_total_per_orang_tanpa_delta);
                        if ($hasil) {
                            $messages[] = "Berhasil memperbarui data untuk username: $username.";
                        } else {
                            $messages[] = "Gagal memperbarui data untuk username: $username.";
                        }
                    }   

                }else {
                    $total_sebelumnya = $this->m_gaji->get_gaji_total_previous_month($username, $gaji_bulan);
                    if ($total_per_orang_tanpa_delta > $total_sebelumnya) {
                        $hasil = $this->m_gaji->insert_data_tanpa_delta($username, $gaji_bulan, $total_per_orang_tanpa_delta);
                        if ($hasil) {
                            $messages[] = "Berhasil menambahkan data untuk username: $username";
                        } else {
                            $messages[] = "Gagal menambahkan data untuk username: $username";
                        }
                    }else{
                        $hasil = $this->m_gaji->insert_data($username, $gaji_bulan, $total_per_orang, $total_per_orang_tanpa_delta);
                        if ($hasil) {
                            $messages[] = "Berhasil menambahkan data untuk username: $username";
                        } else {
                            $messages[] = "Gagal menambahkan data untuk username: $username";
                        }
                    }
                }
            }else {
                $messages[] = "Gagal menginputkan data untuk username: $username. Hanya tanggal 1 yang dapat diinput.";
            }

        }

        // Redirect atau berikan respons sesuai dengan kebutuhan Anda
        $this->session->set_flashdata('messages', $messages);
        redirect('Gaji/view_admin');
    }


}