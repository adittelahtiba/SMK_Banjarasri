<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perusahaan_model');
        $this->load->model('Situasialumni_model');
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $data['title'] = 'Perusahaan Patner';
        $data['perusahaan'] = $this->Perusahaan_model->get_all();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('perusahaan/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function nonpatner()
    {
        $data['title'] = 'Perusahaan non Patner';

        if ($_POST) {
            $data['kodejurusan'] = $_POST['kodejurusan'];
            $jurusan = "'" . $_POST['kodejurusan'] . "'";
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Menampilkan data dari jurusan ' . $_POST['kodejurusan'] . '</div>');
        } else {
            $data['kodejurusan'] = '-';
            $jurusan = "'TAV','TKJ','TKR'";
        }
        $data['jurusan'] = $this->Jurusan_model->get_all();
        $data['situasiperu'] = $this->Situasialumni_model->get_perusahaan($jurusan);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('perusahaan/nonpatner.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Perusahaan';

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('perusahaan/add.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Perusahaan';

        $data['perusahaan'] = $this->Perusahaan_model->get_byid($id);

        // var_dump($data['perusahaan']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('perusahaan/edit.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function addsave()
    {
        $data['title'] = 'Tambah Perusahaan';
        $this->form_validation->set_rules('Nama_perusahaan', 'Nama_perusahaan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Lama_kontrak', 'Lama_kontrak', 'trim|required|numeric', ['required' => '*Field Tidak Boleh Kosong', 'numeric' => 'Input harus berupa nilai angka decimal']);
        $this->form_validation->set_rules('Tanggal_kontrak', 'Tanggal_kontrak', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pihak_kedua', 'Pihak_kedua', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Penyerapan', 'Penyerapan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Kode_jurusan', 'Kode_jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Aktif', 'Aktif', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('perusahaan/add.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            $datainsert['Nama_perusahaan'] = htmlspecialchars($this->input->post('Nama_perusahaan', true));
            $datainsert['Lama_kontrak'] = htmlspecialchars($this->input->post('Lama_kontrak', true));
            $datainsert['Tanggal_kontrak'] = htmlspecialchars($this->input->post('Tanggal_kontrak', true));
            $datainsert['Pihak_kedua'] = htmlspecialchars($this->input->post('Pihak_kedua', true));
            $datainsert['Jumlah_penyerapan'] = htmlspecialchars($this->input->post('Penyerapan', true));
            $datainsert['Kode_jurusan'] = htmlspecialchars($this->input->post('Kode_jurusan', true));
            $datainsert['Aktif'] = htmlspecialchars($this->input->post('Aktif', true));

            if (($this->session->userdata('level') == 1) or ($this->session->userdata('level') == 4)) {
                $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
            SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('Perusahaan'),CONCAT('perusahaan'),CONCAT('Bursa kerja khusus menambah perusahaan baru " . $datainsert['Nama_perusahaan'] . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
            CONCAT(1) From pegawai_guru WHERE level > 0");
            }

            $_SESSION['notif'] = $_SESSION['notif'] + 1;

            $this->Perusahaan_model->insert_perusahaan($datainsert);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Perusahaan ' . $datainsert['Nama_perusahaan'] . ' Berhasil di simpan</div>');

            redirect('Perusahaan');
        }
    }

    public function editsave()
    {
        $data['title'] = 'Tambah Perusahaan';
        $this->form_validation->set_rules('Nama_perusahaan', 'Nama_perusahaan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Lama_kontrak', 'Lama_kontrak', 'trim|required|numeric', ['required' => '*Field Tidak Boleh Kosong', 'numeric' => 'Input harus berupa nilai angka decimal']);
        $this->form_validation->set_rules('Tanggal_kontrak', 'Tanggal_kontrak', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pihak_kedua', 'Pihak_kedua', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Penyerapan', 'Penyerapan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Kode_jurusan', 'Kode_jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Aktif', 'Aktif', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('perusahaan/add.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            $id = $this->input->post('Id_perusahaan', true);
            $dataupdate['Nama_perusahaan'] = htmlspecialchars($this->input->post('Nama_perusahaan', true));
            $dataupdate['Lama_kontrak'] = htmlspecialchars($this->input->post('Lama_kontrak', true));
            $dataupdate['Tanggal_kontrak'] = htmlspecialchars($this->input->post('Tanggal_kontrak', true));
            $dataupdate['Pihak_kedua'] = htmlspecialchars($this->input->post('Pihak_kedua', true));
            $dataupdate['Jumlah_penyerapan'] = htmlspecialchars($this->input->post('Penyerapan', true));
            $dataupdate['Kode_jurusan'] = htmlspecialchars($this->input->post('Kode_jurusan', true));
            $dataupdate['Aktif'] = htmlspecialchars($this->input->post('Aktif', true));

            $this->Perusahaan_model->update_perusahaan($dataupdate, $id);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Perusahaan ' . $dataupdate['Nama_perusahaan'] . ' Berhasil di ubah</div>');

            redirect('Perusahaan');
        }
    }

    public function delete()
    {
        $data['id'] = $_POST['id'];
        $data['peru'] = $_POST['peru'];
        $this->Perusahaan_model->delete($_POST['id']);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Perusahaan ' . $data['peru'] . ' Berhasil di hapus</div>');
        echo json_encode($_POST['id']);
    }
}
