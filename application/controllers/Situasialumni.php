<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Situasialumni extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Situasialumni_model');
        $this->load->model('Detailkelas_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');
    }

    public function alumni()
    {
        $data['title'] = 'Situasi Alumni';

        $jurusan = "'TAV','TKJ','TKR'";
        $data['tahun'] = $this->Siswa_model->get_tahunmasuk();
        $tahunajaran = $this->Situasialumni_model->tahun_ajaran();
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

        $data['situasialumni'] = $this->Situasialumni_model->get_alumnijurusan($jurusan, $tahunajaran);
        $data['jurusan'] = $this->Jurusan_model->get_all();
        $data['tahun'] = $this->Siswa_model->get_tahunmasuk();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('situasialumni/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function edit($nis)
    {
        $data['title'] = 'Edit Situasi Alumsni';

        $data['alumni'] = $this->Situasialumni_model->get_alumni($nis);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('situasialumni/edit.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function index()
    {
        $data['title'] = $this->session->userdata('name');
        $nis = $this->session->userdata('nis');

        $data['active'] = '1';
        $data['alumni'] = $this->Situasialumni_model->get_alumni($nis);

        $this->load->view('profilalumni/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function update()
    {
        $data['title'] = $this->session->userdata('name');
        $nis = $this->session->userdata('nis');

        $data['active'] = '1';
        $data['alumni'] = $this->Situasialumni_model->get_alumni($nis);

        if ($_POST['Bekerja']) {
            $this->form_validation->set_rules('Linear_kompetensi', 'Linear_kompetensi', 'trim|required', ['required' => '*Pilih Ya atau Tidak terlebih dahulu']);
            $this->form_validation->set_rules('Kepuasan_kerja', 'Kepuasan_kerja', 'trim|required', ['required' => '*Pilih Ya atau Tidak terlebih dahulu']);
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Pilih Ya atau Tidak untuk Linear Kompetensi dan Kepusan Kerja pada detail informasi pekerjaan terlebih dahulu!</div>');


                redirect('Situasialumni/index');
                die;
            }
        }


        $dataupdate['Bekerja'] = htmlspecialchars($this->input->post('Bekerja', true));
        $dataupdate['Wiraswasta'] = htmlspecialchars($this->input->post('Wiraswasta', true));
        $dataupdate['Kuliah'] = htmlspecialchars($this->input->post('Kuliah', true));
        $dataupdate['Pencaker'] = htmlspecialchars($this->input->post('Pencaker', true));
        $dataupdate['Gaji_pertama'] = htmlspecialchars($this->input->post('Gaji_pertama', true));
        $dataupdate['Waktu_tunggu'] = htmlspecialchars($this->input->post('Waktu_tunggu', true));
        $dataupdate['Linear_kompetensi'] = htmlspecialchars($this->input->post('Linear_kompetensi', true));
        $dataupdate['Kepuasan_kerja'] = htmlspecialchars($this->input->post('Kepuasan_kerja', true));
        $dataupdate['Keterangan'] = htmlspecialchars($this->input->post('Keterangan', true));
        $dataupdate['Tanggal_isi'] = date('Y-m-d');;

        $this->Situasialumni_model->update_situasi($dataupdate, $nis);

        $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Informasi anda berhasil di simpan!</div>');


        redirect('Situasialumni/index');
    }

    public function editsave($nis)
    {
        if ($_POST['Bekerja']) {
            $this->form_validation->set_rules('Linear_kompetensi', 'Linear_kompetensi', 'trim|required', ['required' => '*Pilih Ya atau Tidak terlebih dahulu']);
            $this->form_validation->set_rules('Kepuasan_kerja', 'Kepuasan_kerja', 'trim|required', ['required' => '*Pilih Ya atau Tidak terlebih dahulu']);
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Pilih Ya atau Tidak untuk Linear Kompetensi dan Kepusan Kerja pada detail informasi pekerjaan terlebih dahulu!</div>');


                redirect('Situasialumni/alumni');
                die;
            }
        }
        $data['alumni'] = $this->Situasialumni_model->get_alumni($nis);

        $dataupdate['Bekerja'] = htmlspecialchars($this->input->post('Bekerja', true));
        $dataupdate['Wiraswasta'] = htmlspecialchars($this->input->post('Wiraswasta', true));
        $dataupdate['Kuliah'] = htmlspecialchars($this->input->post('Kuliah', true));
        $dataupdate['Pencaker'] = htmlspecialchars($this->input->post('Pencaker', true));
        $dataupdate['Gaji_pertama'] = htmlspecialchars($this->input->post('Gaji_pertama', true));
        $dataupdate['Waktu_tunggu'] = htmlspecialchars($this->input->post('Waktu_tunggu', true));
        $dataupdate['Linear_kompetensi'] = htmlspecialchars($this->input->post('Linear_kompetensi', true));
        $dataupdate['Kepuasan_kerja'] = htmlspecialchars($this->input->post('Kepuasan_kerja', true));
        $dataupdate['Keterangan'] = htmlspecialchars($this->input->post('Keterangan', true));
        $dataupdate['Tanggal_isi'] = date('Y-m-d');;

        $this->Situasialumni_model->update_situasi($dataupdate, $nis);

        $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Data situasi alumni ' . $nis . ' !</div>');


        redirect('Situasialumni/alumni');
    }

    public function ubahpass()
    {

        $nis = $this->session->userdata('nis');
        $data['title'] = $this->session->userdata('name');
        $data['alumni'] = $this->Situasialumni_model->get_alumni($nis);
        $data['active'] = '2';

        $this->form_validation->set_rules('passlama', 'passlama', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Pengulangan password tidak sama!',
            'min_length' => 'Minimal password terdiri dari 6 karakter!',
            'required' => 'Password tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('profilalumni/index.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            if ($_POST['passlama'] == $data['alumni']['password']) {
                $passbaru = $_POST['password1'];
                $this->db->set('Password', $passbaru);
                $this->db->where('Nomor_induk', $nis);
                $this->db->update('Situasi_alumni');
                $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Password berhasil diubah!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Password salah, silahkan ulangi!</div>');
            }
            $this->load->view('profilalumni/index.php', $data);
            $this->load->view('templates/footer.php', $data);
        }
    }
}
