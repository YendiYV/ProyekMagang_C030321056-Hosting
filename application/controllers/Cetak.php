<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpWord\TemplateProcessor;

class Cetak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('m_cuti');
        $this->load->library('PhpWord');

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
    public function surat_cuti_acc_pdf($id_cuti){

        $data['cuti'] = $this->m_cuti->get_all_cuti_by_id_cuti($id_cuti)->result_array();
        $data['mng'] = $this->m_cuti->get_data_manager()->result_array();
        $data['spv'] = $this->m_cuti->get_data_supervisior()->result_array();
        $data['mng_u'] = $this->m_cuti->get_data_manager_u()->result_array();
    
        $this->load->library('pdf');

    
        $this->pdf->setPaper('Letter', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "surat-cuti.pdf";
        $this->pdf->load_view('konfir_pdf', $data);
    }
    
    public function cetak_fakta_integritas($username)
    {
        $nama = $this->input->post("nama_lengkap");
        $nik = $this->input->post("nik");
        $alamat = $this->input->post("alamat");

        // Lokasi template Word
        $templatePath = 'assets/plnt/integritas.docx';

        // Inisialisasi TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Ganti variabel dalam template dengan data yang diberikan
        $templateProcessor->setValue('nama', $nama);
        $templateProcessor->setValue('nik', $nik);
        $templateProcessor->setValue('alamat', $alamat);

        // Menetapkan lokal ke Indonesia
        setlocale(LC_TIME, 'id_ID');

        // Mengambil tanggal dan hari dalam bahasa Indonesia
        $tanggal = strftime('%d %B %Y'); // %d untuk tanggal, %B untuk nama bulan, %Y untuk tahun
        $hari = strftime('%A'); // %A untuk nama hari

        // Menambahkan nilai tanggal dan hari ke template
        $templateProcessor->setValue('tanggal', $tanggal);
        $templateProcessor->setValue('hari', $hari);

        // Nama file output
        $outputFileName = 'Integritas.docx';

        // Set header untuk memberi tahu browser bahwa ini adalah dokumen Word
        header("Content-Disposition: attachment; filename=$outputFileName");
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");

        // Simpan hasil ke output HTTP
        $templateProcessor->saveAs('php://output');
    }




}