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
    public function save_total_per_orang() {
        $usernames = $this->input->post('username'); // Array usernames
        $total_per_orangs = $this->input->post('total_per_orang'); // Array total_per_orang

        // Inisialisasi array untuk pesan kesalahan atau berhasil
        $messages = [];

        // Loop melalui data dan lakukan sesuatu, misalnya simpan ke database
        for ($i = 0; $i < count($usernames); $i++) {
            $username = $usernames[$i];
            $total_per_orang = $total_per_orangs[$i];

            // Lakukan sesuatu dengan $username dan $total_per_orang, misalnya simpan ke database
            $hasil = $this->m_gaji->gaji_bulan($username, $total_per_orang);

            if ($hasil == false) {
                $messages[] = "Gagal menyimpan data untuk username: $username";
            } else {
                $messages[] = "Berhasil menyimpan data untuk username: $username";
            }
        }

        // Redirect atau berikan respons sesuai dengan kebutuhan Anda
        $this->session->set_flashdata('massages', $messages);
        redirect('Gaji/view_admin'); // Redirect dengan pesan kesalahan/berhasil
    }


}