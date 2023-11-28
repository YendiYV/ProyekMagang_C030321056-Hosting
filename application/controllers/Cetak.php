<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_cuti');
    }
    public function surat_cuti_pdf($id_cuti_detail){

        $data['cuti'] = $this->m_cuti->get_all_cuti_by_id_cuti($id_cuti_detail)->result_array();
        $data['mng'] = $this->m_cuti->get_data_manager()->result_array();
        $data['spv'] = $this->m_cuti->get_data_supervisior()->result_array();
        $data['mng_u'] = $this->m_cuti->get_data_manager_u()->result_array();

        $this->load->library('pdf');

    
        $this->pdf->setPaper('letter', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "surat-cuti.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    
    
    }
    
}