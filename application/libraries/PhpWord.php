<?php defined('BASEPATH') OR exit('Akses skrip langsung tidak diizinkan.');
require_once FCPATH . 'vendor/phpoffice/phpword/src/PhpWord/PhpWord.php';

class PhpWord {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        // Memuat dependensi atau menginisialisasi pengaturan jika diperlukan
    }

    public function generateDocument($data, $filename) {
        // Membuat objek PHPWord baru
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // Menambahkan sebuah bagian ke dokumen
        $section = $phpWord->addSection();

        // Menambahkan konten ke bagian
        foreach ($data as $key => $value) {
            $section->addText("$key: $value");
        }

        // Menyimpan dokumen
        $filepath = FCPATH . 'assets/plnt/' . $filename . '.docx';
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filepath);

        return $filepath;
    }

}
