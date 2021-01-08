<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printpdf extends CI_Controller
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
    }

    public function index()
    {
        $data = $this->load->view('dashboard/index.php');
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

    public function print($nis, $kelas, $semester)
    {
        $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('raport/pdf.php', $data, true) . $this->load->view('raport/pdf.php', $data, true);
        $filename = 'Raport' . $nis . '-' . $kelas . '-' . $semester . '(' . date('d-M-Y') . ').pdf';
        $mpdf->WriteHTML($data);
        $mpdf->Output($filename, 'I');
    }

    public function download($nis, $kelas, $semester)
    {
        $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
        $mpdf = new \Mpdf\Mpdf();
        $data = $this->load->view('raport/pdf.php', $data, true);
        $filename = 'Raport' . $nis . '-' . $kelas . '-' . $semester . '(' . date('d-M-Y') . ').pdf';
        $mpdf->WriteHTML($data);
        $mpdf->Output($filename, 'D');
    }
}
