<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_Gj extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_rekap_gj');
    }

    public function view_admin_plnt() {
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 5) {
            $data['count_data_gj'] = $this->m_rekap_gj->count_data_gj()->result();
            $this->load->view('admin_plnt/rekap_gj', $data);
        }else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
    }
}
