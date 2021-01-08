<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
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
    }

    public function index($jurusan = 'TAV')
    {
        $data['title'] = 'Print Raport';
        $this->db->where('Kode_jurusan', $jurusan);
        $data['mapel'] = $this->db->get('mapel')->result_array();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('mapel/mapel.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function import($kelas = '10')
    {
        $data['title'] = 'Print Raport';


        $jurusan = "'TAV','TKJ','TKR'";
        $data['tahun'] = $this->Siswa_model->get_tahunmasuk();
        $tahunajaran = $this->Kelas_model->tahun_ajaran();

        $data['no'] = $kelas;

        $data['kodejurusan'] = '-';
        $data['tahunajaran'] = $tahunajaran;


        if ($_POST) {
            $tahunajaran = $_POST['tahunajaran'];
            $data['tahunajaran'] = $_POST['tahunajaran'];
            if ($_POST['kodejurusan'] <> '-') {
                $jurusan = "'" . $_POST['kodejurusan'] . "'";
                $data['kodejurusan'] = $_POST['kodejurusan'];
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Menampilkan' . $data['title'] . ' jurusan ' . $_POST['kodejurusan'] . ' tahun ajaran ' . $tahunajaran . '/' . ($tahunajaran + 1) . '</div>');
        }

        if ($kelas == '13') {
            $data['title'] = 'Lulusan ' . $tahunajaran . '-' . $jurusan;
        } else {
            $data['title'] = 'Siswa Kelas ' . $kelas . '-' . $tahunajaran . '-' . $jurusan;
        }

        $data['jurusan'] = $this->Jurusan_model->get_all();
        $data['kelas'] = $this->Detailkelas_model->get_siswakelas($kelas, $jurusan, $tahunajaran);

        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $data['tahunajaran'] = $tahunajaran;
        $data['jurusan'] = $this->Jurusan_model->get_all();
        $data['kelas'] = $this->Detailkelas_model->get_siswakelas($kelas, $jurusan, $tahunajaran);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/raport.php');
        $this->load->view('templates/footer.php', $data);
    }
}
