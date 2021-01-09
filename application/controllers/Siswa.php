<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Situasialumni_model');
        $this->load->model('Kelas_model');
    }

    public function index()
    {
        $data['title'] = 'Semua Siswa';
        $data['siswa'] = $this->Siswa_model->get_all();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('siswa/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function tahunajaran()
    {
        $data['title'] = 'Tahun Ajaran';
        $data['siswapertahun'] = $this->Siswa_model->get_siswatahunajaran();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('siswa/tahunajaran.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function deletetahunajaran($tahunajaran)
    {
        $this->Siswa_model->hapus_situasialumni($tahunajaran);
        $this->Siswa_model->hapus_tahunajaran($tahunajaran);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data siswa tahun ajaran ' . $tahunajaran . '/' . ($tahunajaran + 1) . ' Berhasil di hapus</div>');
        redirect('Siswa/tahunajaran');
    }

    public function barudelete($id, $semua = 'ok')
    {
        $this->Siswa_model->hapus_siswa($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data siswa ' . $id . ' Berhasil di hapus</div>');
        if ($semua == 'ok') {
            redirect('Kelas/kelolasiswa');
        } else {
            redirect('Siswa');
        }
    }

    public function baruedit($id)
    {
        $data['title'] = 'Edit Siswa Baru';

        $data['siswa'] = $this->Siswa_model->get_siswabyid($id);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('siswa/editsisbar.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function editsisbar($id)
    {
        $data['title'] = 'Edit Siswa Baru';
        if ($_POST['Nomor_induk'] <> $_POST['Nomor_induk2']) {
            $this->form_validation->set_rules('Nomor_induk', 'Nomor_induk', 'trim|required|is_unique[Siswa.Nomor_induk]', ['required' => '*Field Tidak Boleh Kosong', 'is_unique' => 'Nomor Induk Telah Digunakan']);
        }
        $this->form_validation->set_rules('Kode_jurusan', 'Kode_jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);

        $this->form_validation->set_rules('NISN', 'NISN', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Nama_siswa', 'Nama_siswa', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jenis_kelamin', 'Jenis_kelamin', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tempat_lahir', 'Tempat_lahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tanggal_lahir', 'Tanggal_lahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Agama', 'Agama', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Nama_ayah', 'Nama_ayah', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Nama_ibu', 'Nama_ibu', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pekerjaan_ortu', 'Pekerjaan_ortu', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Alamat', 'Alamat', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Asal_sekolah', 'Asal_sekolah', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Status_keuangan', 'Status_keuangan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tahun_masuk', 'Tahun_masuk', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);

        if ($this->form_validation->run() == false) {
            $data['siswa'] = $this->Siswa_model->get_siswabyid($id);
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('siswa/editsisbar.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            $datainsert['Kode_jurusan'] = htmlspecialchars($this->input->post('Kode_jurusan', true));
            $datainsert['Nomor_induk'] = htmlspecialchars($this->input->post('Nomor_induk', true));
            $datainsert['NISN'] = htmlspecialchars($this->input->post('NISN', true));
            $datainsert['Nama_siswa'] = htmlspecialchars($this->input->post('Nama_siswa', true));
            $datainsert['Jenis_kelamin'] = htmlspecialchars($this->input->post('Jenis_kelamin', true));
            $datainsert['Tempat_lahir'] = htmlspecialchars($this->input->post('Tempat_lahir', true));
            $datainsert['Tanggal_lahir'] = htmlspecialchars($this->input->post('Tanggal_lahir', true));
            $datainsert['Agama'] = htmlspecialchars($this->input->post('Agama', true));
            $datainsert['Nama_ayah'] = htmlspecialchars($this->input->post('Nama_ayah', true));
            $datainsert['Nama_ibu'] = htmlspecialchars($this->input->post('Nama_ibu', true));
            $datainsert['Pekerjaan_ortu'] = htmlspecialchars($this->input->post('Pekerjaan_ortu', true));
            $datainsert['Alamat'] = htmlspecialchars($this->input->post('Alamat', true));
            $datainsert['Asal_sekolah'] = htmlspecialchars($this->input->post('Asal_sekolah', true));
            $datainsert['Status_keuangan'] = htmlspecialchars($this->input->post('Status_keuangan', true));
            $datainsert['Tahun_masuk'] = htmlspecialchars($this->input->post('Tahun_masuk', true));
            $datainsert['Nomor_ijazah'] = htmlspecialchars($this->input->post('Nomor_ijazah', true));
            $datainsert['Nomor_skhun'] = htmlspecialchars($this->input->post('Nomor_skhun', true));
            $datainsert['Nomor_peserta'] = htmlspecialchars($this->input->post('Nomor_peserta', true));
            $datainsert['keterangan'] = htmlspecialchars($this->input->post('keterangan', true));
            $datainsert['Nomor_telp'] = htmlspecialchars($this->input->post('Nomor_telp', true));
            $datainsert['Email'] = htmlspecialchars($this->input->post('Email', true));

            $this->Siswa_model->update_siswa($datainsert, $id);


            if ($_POST['Nomor_induk'] <> $_POST['Nomor_induk2']) {
                $kdkelas = htmlspecialchars($this->input->post('Kode_jurusan', true)) . '10';
                $datainsert2['Nomor_induk'] = htmlspecialchars($this->input->post('Nomor_induk', true));

                $this->Kelas_model->update_kelas($datainsert2, $kdkelas, $_POST['Nomor_induk2']);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data siswa ' . $id . ' Berhasil di ubah</div>');
            redirect('Kelas/kelolasiswa');
        }
    }
}
