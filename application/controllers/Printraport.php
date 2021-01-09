<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printraport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Analisis_model');
        $this->load->model('Siswa_model');
        $this->load->model('Situasialumni_model');
        $this->load->model('Kelas_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Detailkelas_model');

        // $this->load->library('PHPExcel');
        // $this->load->library('PHPExcel/Writer');
        // $this->load->library('PHPExcel/IOFactory');
    }

    public function index()
    {
        $data['title'] = 'Print Raport';


        $jurusan = "'TAV','TKJ','TKR'";
        $data['tahun'] = $this->Siswa_model->get_tahunmasuk();
        $tahunajaran = $this->Kelas_model->tahun_ajaran();



        $data['kodejurusan'] = '-';
        $data['tahunajaran'] = $tahunajaran;



        if ($_POST) {
            $tahunajaran = $_POST['tahunajaran'];
            $kelas = $_POST['kelas'];
            $data['kel'] = $_POST['kelas'];
            $data['no'] = $kelas;
            $data['tahunajaran'] = $_POST['tahunajaran'];
            if ($_POST['kodejurusan'] <> '-') {
                $jurusan = "'" . $_POST['kodejurusan'] . "'";
                $data['kodejurusan'] = $_POST['kodejurusan'];
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Menampilkan' . $data['title'] . ' jurusan ' . $_POST['kodejurusan'] . ' tahun ajaran ' . $tahunajaran . '/' . ($tahunajaran + 1) . '</div>');
        } else {
            $tahunajaran = $this->Kelas_model->tahun_ajaran();
            $data['tahunajaran'] = $tahunajaran;
            $data['kel'] = 10;
            $kelas = 10;
            $data['no'] = $kelas;
        }


        $data['jurusan'] = $this->Jurusan_model->get_all();
        $data['kelas'] = $this->Detailkelas_model->get_siswakelas($kelas, $jurusan, $tahunajaran);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/raport.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function printpangsaperu($kode)
    {
        $data['title'] = 'Laporan Pangsa Pasar - ' . $kode;
        $tahunajaran = $this->Kelas_model->tahun_ajaran();

        $data['perusahaan'] = $this->Analisis_model->get_perusahaan();
        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $data['jumlahsiswa'] = $this->Analisis_model->get_jumlahsiswa($tahunajaran);

        $data['detailpangsaperu'] = $this->Analisis_model->get_detailpangsaperusahaan($kode);
        $data['tahunajaran'] = $tahunajaran;

        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('Laporan/laporanpangsaperu.php', $data, true);
        $filename = 'Laporan Pangsa Pasar - ' . $kode . '(' . date('d-M-Y') . ').pdf';
        $mpdf->WriteHTML($data);
        $mpdf->Output($filename, 'I');
    }

    public function printrasio($kode, $a)
    {
        $data['title'] = 'Laporan Analisis Rasio - ' . $kode;
        $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
        $a = $a;
        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $tahun = 1 + $tahunajaran;
        $anytahun = $tahunajaran;
        for ($i = $a; $i > 1; $i--) {
            $anytahun = $anytahun . "," . ($tahun - $i);
        }

        $data['drasio'] = $this->Analisis_model->get_detailrasio($kode);
        $data['situasi'] = $this->Situasialumni_model->get_persensituasi2($anytahun);
        $data['jalumni'] = $this->Situasialumni_model->get_jumlahalumni($anytahun);
        $data['jurusana'] = $this->Jurusan_model->get_all();
        $data['tahunajaran'] = $tahunajaran;

        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('Laporan/laporanrasio.php', $data, true);
        $filename = 'Laporan Analisis Rasio - ' . $kode . '(' . date('d-M-Y') . ').pdf';
        $mpdf->WriteHTML($data);
        $mpdf->Output($filename, 'I');
    }

    public function exportexcel($kdmap)
    {
        $data['mapel'] = $this->db->query("select * from mapel where Kode_mapel='" . $kdmap . "'")->row_array();
        $tahun = substr($kdmap, 3, 2);
        $nilai = $this->db->query("select siswa.Nomor_induk,Nama_siswa,
        (select Angka1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka1,
        (select Angka2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka2,
        (select Deskripsi1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi1,
        (select Deskripsi2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi2 
         from siswa join detail_kelas on siswa.Nomor_induk=detail_kelas.Nomor_induk  where Kode_jurusan=left('" . $kdmap . "',3) and 
         right(Kode_kelas,2)='" . $tahun . "' and Tahun_ajaran=(Select MAX(Tahun_ajaran) from detail_kelas)")->result_array();




        // // Load plugin PHPExcel nya
        require(APPPATH . 'libraries/PHPExcel2/Classes/PHPExcel.php');
        // // include(APPPATH . 'libraries/PHPExcel/Writer/Excel2007.php');


        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
            die('This example should only be run from a Web Browser');

        /** Include PHPExcel */
        // require_once base_url() . 'application/libraries/PHPExcel2/Classes/PHPExcel.php';


        // Create new PHPExcel object
        $excel = new PHPExcel();

        // Set document properties
        $excel->getProperties()->setCreator("Aditya Pangestu")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");

        // Add some data
        $excel->setActiveSheetIndex(0)

            ->setCellValue('B1', 'KODE MAPEL')
            ->setCellValue('B2', 'NAMA MAPEL')
            ->setCellValue('B3', 'JURUSAN')
            ->setCellValue('B4', 'KELAS')
            ->setCellValue('B5', 'SEMESTER')
            ->setCellValue('C1', $data['mapel']['Kode_mapel'])
            ->setCellValue('C2', $data['mapel']['Nama_mapel'])
            ->setCellValue('C3', $data['mapel']['Kode_jurusan'])
            ->setCellValue('C4', $data['mapel']['Kelas'])
            ->setCellValue('C5', $data['mapel']['Semester'])

            ->mergeCells('A7:A8')
            ->setCellValue('A7', 'NO')
            ->mergeCells('B7:B8')
            ->setCellValue('B7', 'NOMOR INDUK')
            ->mergeCells('C7:C8')
            ->setCellValue('C7', 'NAMA SISWA')
            ->mergeCells('D7:G7')
            ->setCellValue('D7', 'PENGETAHUAN')
            ->setCellValue('D8', 'KKM')
            ->setCellValue('E8', 'NILAI')
            ->setCellValue('F8', 'PREDIKAT')
            ->setCellValue('G8', 'DESKRIPSI')
            ->mergeCells('H7:K7')
            ->setCellValue('H7', 'KETERAMPILAN')
            ->setCellValue('H8', 'KKM')
            ->setCellValue('I8', 'NILAI')
            ->setCellValue('J8', 'PREDIKAT')
            ->setCellValue('K8', 'DESKRIPSI');


        $i = 0;
        $num = 8;
        foreach ($nilai as $nilai) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A' . $num++, $i++)
                ->setCellValue('B' . $num, $nilai['Nomor_induk'])
                ->setCellValue('C' . $num, $nilai['Nama_siswa'])
                ->setCellValue('D' . $num, $data['mapel']['KKM'])
                ->setCellValue('E' . $num, $nilai['Angka1'])
                ->setCellValue('F' . $num, '=IF(E' . $num . '>=80,"A",IF((E' . $num . '<80)*AND(E' . $num . '>=65),"B",IF((E' . $num . '<65)*AND(E' . $num . '>=50),"C",IF((E' . $num . '<50)*AND(E' . $num . '>=35),"D",IF((E' . $num . '<35)*AND(E' . $num . '>=1),"E","T")))))')
                ->setCellValue('G' . $num, $nilai['Deskripsi1'])
                ->setCellValue('H' . $num, $data['mapel']['KKM'])
                ->setCellValue('I' . $num, $nilai['Angka2'])
                ->setCellValue('J' . $num, '=IF(I' . $num . '>=80,"A",IF((I' . $num . '<80)*AND(I' . $num . '>=65),"B",IF((I' . $num . '<65)*AND(I' . $num . '>=50),"C",IF((I' . $num . '<50)*AND(I' . $num . '>=35),"D",IF((I' . $num . '<35)*AND(I' . $num . '>=1),"E","T")))))')
                ->setCellValue('K' . $num, $nilai['Deskripsi2']);
        }

        $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE); // Set bold kolom 
        $excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(TRUE); // Set bold kolom 
        $excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(TRUE); // Set bold kolom 
        $excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(TRUE); // Set bold kolom 
        $excel->getActiveSheet()->getStyle('B5')->getFont()->setBold(TRUE); // Set bold kolom 

        $excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header

        $excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K7')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('A8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J8')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K8')->applyFromArray($style_col);

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(16); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(22); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(10); // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20); // Set width kolom

        // Rename worksheet
        $excel->getActiveSheet()->setTitle('Simple');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $excel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $data["mapel"]["Kode_mapel"] . '-' . $data["mapel"]["Nama_mapel"] . '.xlsx"'); // NAMA FILE
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}
