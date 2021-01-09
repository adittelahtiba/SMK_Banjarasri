<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isinilai extends CI_Controller
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
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
    }

    public function manual()
    {
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $data['tahunajaran'] = $tahunajaran;
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $this->db->where('Status', 'Y');

        if ($_POST) {
            $data['title'] = 'Isi Nilai Manual Kelas' . $_POST['kelas'] . ' Semester ' . $_POST['semester'] . ' Jurusan ' . $_POST['kodejurusan'];

            $this->db->where('Semester', $_POST['semester']);
            $this->db->where('Kode_jurusan', $_POST['kodejurusan']);
            $this->db->where('Kelas', $_POST['kelas']);

            $data['sem'] = $_POST['semester'];
            $data['jur'] = $_POST['kodejurusan'];
            $data['kel'] = $_POST['kelas'];
        } else {
            $data['title'] = 'Isi Nilai Manual';
            $this->db->where('Kode_jurusan', '-');
            $this->db->where('Kelas', 0);

            $data['sem'] = 0;
            $data['jur'] = '-';
            $data['kel'] = 0;
        }

        $data['mapel'] = $this->db->get('mapel')->result_array();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/isimanual.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function isimanual($kdmap)
    {
        $data['title'] = 'Kode Mata Pelajaran ' . $kdmap;
        $tahun = substr($kdmap, 3, 2);
        // $data['nilai'] = $this->db->query('select * from mapel join nilai on mapel.Kode_mapel=nilai.Kode_mapel join siswa on nilai.Nomor_induk=siswa.Nomor_induk join detail_kelas on siswa.Nomor_induk=detail_kelas.Nomor_induk')->result_array();
        $data['mapel'] = $this->db->query("select * from mapel where Kode_mapel='" . $kdmap . "'")->row_array();
        $data['nilai'] = $this->db->query("select siswa.Nomor_induk,Nama_siswa,
        (select Angka1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka1,
        (select Angka2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka2,
        (select Deskripsi1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi1,
        (select Deskripsi2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi2 
         from siswa join detail_kelas on siswa.Nomor_induk=detail_kelas.Nomor_induk  where Kode_jurusan=left('" . $kdmap . "',3) and 
         right(Kode_kelas,2)='" . $tahun . "' and Tahun_ajaran=(Select MAX(Tahun_ajaran) from detail_kelas)")->result_array();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/isinilai.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function savemanual()
    {
        $b = count($_POST['Nomor_induk']);

        for ($i = 0; $i < $b; $i++) {
            $datainsert['Gabung'] = $_POST['Nomor_induk'][$i] . $_POST['Kode_mapel'][$i];
            $datainsert['Angka1'] = $_POST['Angka1'][$i];
            $datainsert['Angka2'] = $_POST['Angka2'][$i];
            $datainsert['Deskripsi1'] = $_POST['Deskripsi1'][$i];
            $datainsert['Deskripsi2'] = $_POST['Deskripsi2'][$i];
            $datainsert['Nomor_induk'] = $_POST['Nomor_induk'][$i];
            $datainsert['Kode_mapel'] = $_POST['Kode_mapel'][$i];
            if ($_POST['tindak'][$i] == 'insert') {
                $this->db->insert('nilai', $datainsert);
            } else {
                $this->db->where('Gabung', $datainsert['Gabung']);
                $this->db->update('nilai', $datainsert);
            }
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Nilai siswa berhasil di simpan</div>');

        redirect('Isinilai/isimanual/' . $_POST['Kode_mapel'][0]);
    }




    public function import()
    {
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $data['tahunajaran'] = $tahunajaran;
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $this->db->where('Status', 'Y');

        if ($_POST) {
            $data['title'] = 'Import Excel ' . $_POST['kelas'] . ' Semester ' . $_POST['semester'] . ' Jurusan ' . $_POST['kodejurusan'];

            $this->db->where('Semester', $_POST['semester']);
            $this->db->where('Kode_jurusan', $_POST['kodejurusan']);
            $this->db->where('Kelas', $_POST['kelas']);

            $data['sem'] = $_POST['semester'];
            $data['jur'] = $_POST['kodejurusan'];
            $data['kel'] = $_POST['kelas'];
        } else {
            $data['title'] = 'Import Excel';
            $this->db->where('Kode_jurusan', '-');
            $this->db->where('Kelas', 0);

            $data['sem'] = 0;
            $data['jur'] = '-';
            $data['kel'] = 0;
        }

        $data['mapel'] = $this->db->get('mapel')->result_array();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/importexcel.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function csv($kdmap)
    {
        $data['mapel'] = $this->db->query("select * from mapel where Kode_mapel='" . $kdmap . "'")->row_array();
        $data['title'] = $kdmap . '-' . $data['mapel']['Nama_mapel'];
        $tahun = substr($kdmap, 3, 2);
        // $data['nilai'] = $this->db->query('select * from mapel join nilai on mapel.Kode_mapel=nilai.Kode_mapel join siswa on nilai.Nomor_induk=siswa.Nomor_induk join detail_kelas on siswa.Nomor_induk=detail_kelas.Nomor_induk')->result_array();
        $data['nilai'] = $this->db->query("select siswa.Nomor_induk,Nama_siswa,
        (select Angka1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka1,
        (select Angka2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Angka2,
        (select Deskripsi1 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi1,
        (select Deskripsi2 from nilai WHERE nilai.Nomor_induk=siswa.Nomor_induk GROUP BY Gabung) as Deskripsi2 
         from siswa join detail_kelas on siswa.Nomor_induk=detail_kelas.Nomor_induk  where Kode_jurusan=left('" . $kdmap . "',3) and 
         right(Kode_kelas,2)='" . $tahun . "' and Tahun_ajaran=(Select MAX(Tahun_ajaran) from detail_kelas)")->result_array();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('raport/csv.php');
        $this->load->view('templates/footer.php', $data);
    }

    public function importing()
    {
        if (!$_FILES['inexcel']['name']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                File tidak ditemukan</div>');
            redirect('Isinilai/import');
        }
        $config['upload_path'] = './assets/BackEnd/file/excel';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '5048';
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        $this->upload->do_upload('inexcel');
        if ($this->upload->do_upload('inexcel')) {
            $namefile = $this->upload->data('file_name');
            $objReader  = new PHPExcel_Reader_Excel2007();
            $objPHPExcel = $objReader->load('assets/BackEnd/file/excel/' . $namefile);
            $sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $i = 1;

            // var_dump($sheet);
            // die;
            if (!$sheet[1]['C']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Format data pada excel tidak benar</div>');
                redirect('Isinilai/import/');
                die;
            } else {
                $kdmp = $sheet[1]['C'];
            }

            // $nisanyar = $this->Kelas_model->nisbaru($nisanyar);

            foreach ($sheet as $key) {
                if ($i > 8) {
                    $datainsert['Gabung'] = htmlspecialchars($key['B']) . $kdmp;
                    $datainsert['Angka1'] = htmlspecialchars($key['E']);
                    $datainsert['Angka2'] = htmlspecialchars($key['I']);
                    $datainsert['Deskripsi1'] = htmlspecialchars($key['G']);
                    $datainsert['Deskripsi2'] = htmlspecialchars($key['J']);
                    $datainsert['Nomor_induk'] = htmlspecialchars($key['B']);
                    $datainsert['Kode_mapel'] = $kdmp;

                    if ($key['B']) {
                        $this->db->insert('nilai', $datainsert);
                    }
                }
                $i++;
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data excel berhasil di simpan</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Tipe file tidak sesuai, data input berupa file excel</div>');
            redirect('Kelas/kelolasiswa/a');
            die;
        }
        redirect('Isinilai/csv/' . $kdmp);
    }
}
