<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_user');
    }

    public function view_super_admin()
	{
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

        $data['admin_data'] = $this->m_user->get_all_admin()->result_array();

        $this->load->view('super_admin/admin', $data);
        
        }else{

            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');

        }
        
        
    }
    
}