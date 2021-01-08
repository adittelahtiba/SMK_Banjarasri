<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Analisis extends CI_Controller
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

    public function pangsapasar()
    {
        $data['title'] = 'Analisis Pangsa Pasar';
        $data['perusahaan'] = $this->Analisis_model->get_perusahaan();
        $tahunajaran = $this->Kelas_model->tahun_ajaran();
        $data['jumlahsiswa'] = $this->Analisis_model->get_jumlahsiswa($tahunajaran);
        $data['tahunajaran'] = $tahunajaran;
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('analisis/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function pasarperusahaan($pangsa, $penye)
    {
        $data['perusahaan'] = $this->Analisis_model->get_perusahaan();
        $data['array_pangsa'] = $_SESSION['array_pangsa'];
        $data['pangsa'] = $pangsa;
        $data['penye'] = $penye;
        // var_dump($data['array_pangsa']);
        $this->load->view('analisis/tabelperusahaan.php', $data);
    }

    public function rasiosiswa()
    {
        $data['title'] = 'Analisis Pangsa Pasar';

        $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('analisis/rasio.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function tabelpersen($a)
    {
        if ($a > 0) {
            $tahunajaran = $this->Kelas_model->tahun_ajaran();
            $tahun = 1 + $tahunajaran;
            $anytahun = $tahunajaran;
            for ($i = $a; $i > 1; $i--) {
                $anytahun = $anytahun . "," . ($tahun - $i);
            }

            $data['histori'] = $a;
            $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
            $data['situasi'] = $this->Situasialumni_model->get_persensituasi2($anytahun);
            $data['jalumni'] = $this->Situasialumni_model->get_jumlahalumni($anytahun);
            $data['jurusana'] = $this->Jurusan_model->get_all();
            $data['tahunajaran'] = $tahunajaran;
            // var_dump($data['jurusan']);
            $this->load->view('analisis/tabelpersen.php', $data);
        } else {
            echo "<div class='alert alert-warning'>Pilih data alumni terlebih dahulu! </div>";
        }
    }

    public function simpanrasio()
    {
        $_SESSION['notif'] = $_SESSION['notif'] + 1;
        $kdrasiobaru = $this->Analisis_model->kdrasiobaru();
        $kdrasio = date('YmdH') * 100 + $kdrasiobaru;
        $datainsert['Kd_rasio'] = $kdrasio;
        $datainsert['Tahun_ajaran'] = $this->input->post('Tahun_ajaran', true);
        $datainsert['Histori'] = $this->input->post('histori', true);
        $datainsert['Tanggal'] = date('Y-m-d H:i:s');
        $datainsert['Status'] = 'Belum di konfirmasi';
        $this->Analisis_model->insert_rasio($datainsert);
        $datainsert3['Kode_hasil'] = $kdrasio;
        $datainsert3['Tanggal_pesan'] = date('Y-m-d H:i:s');
        $datainsert3['NIP'] = $this->session->userdata('id');
        $datainsert3['Isi_Pesan'] = htmlspecialchars($this->input->post('pesan', true));
        $this->Analisis_model->insert_pesan($datainsert3);

        $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
        SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('" . $kdrasio . "'),CONCAT('rasio'),CONCAT('Analisis rasio baru untuk tahun ajaran " . $datainsert['Tahun_ajaran'] . "/" . (1 + $datainsert['Tahun_ajaran']) . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
        CONCAT(1) From pegawai_guru WHERE level > 1");

        for ($i = 1; $i <= count($_POST['Kode_jurusan']); $i++) {
            echo "a";
            $datainsert2['Kd_rasio'] = $kdrasio;
            $datainsert2['Kode_jurusan'] = $_POST['Kode_jurusan'][$i];
            $datainsert2['Rasio'] = $_POST['kebutuhan'][$i];
            $this->Analisis_model->insert_detailrasio($datainsert2);
        }


        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data ' . $kdrasio . ' berhasil ditambahkan!</div>');
        redirect('Analisis/hasilanalisis/b');
    }

    public function hasilanalisis($ab = 'a')
    {
        $data['ab'] = $ab;
        $data['title'] = 'Hasil Analisis';
        $data['hasilpangsaperu'] = $this->Analisis_model->get_pangsaperusahaan();
        $data['hasilrasio'] = $this->Analisis_model->get_rasiokebutuhan();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('analisis/hasil.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function pangsaperudetail($kode)
    {
        $data['title'] = 'Detail Hasil Analisis';
        $data['detailpangsaperu'] = $this->Analisis_model->get_detailpangsaperusahaan($kode);
        $data['Pesan_obrolan'] = $this->Analisis_model->get_pesanpangsa($kode);
        // var_dump($data['Pesan_obrolan']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('analisis/detailpangsaperu.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function rasiodetail($kode)
    {
        if ($kode == 'Perusahaan') {
            redirect('Perusahaan');
        }
        $data['title'] = 'Detail Hasil Analisis';
        $data['drasio'] = $this->Analisis_model->get_detailrasio($kode);
        $data['Pesan_obrolan'] = $this->Analisis_model->get_pesanrasio($kode);
        // var_dump($data['Pesan_obrolan']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('analisis/detailrasio.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function tabelsimulasi($simulasi, $kode)
    {
        $data['drasio'] = $this->Analisis_model->get_detailrasio($kode);
        echo "<tr>";
        foreach ($data['drasio'] as $peru) {
            if ($peru['Nama_jurusan'] <> '') {
                echo "<td class='text-center col-md-4'>" . $peru['Kode_jurusan'];
            }
        }
        echo "<tr>";
        foreach ($data['drasio'] as $peru) {
            if ($peru['Nama_jurusan'] <> '') {
                echo "<td class='text-center col-md-4'>" . (round($simulasi * $peru['Rasio'] / 100, 0)) . " siswa";
            }
        }
    }

    public function konfirmasipangsaperu($kode)
    {

        if (($this->session->userdata('level') == 3) or ($this->session->userdata('level') == 4)) {
            $datainsert['Konfirmasi'] = $this->input->post('konfirmasi', true);
        }
        if (($this->session->userdata('level') == 2) or ($this->session->userdata('level') == 4)) {
            $datainsert['Status'] = $this->input->post('status', true);
        }
        $datainsert3['Kode_hasil'] = $kode;
        $datainsert3['NIP'] = $this->session->userdata('id');
        $datainsert3['Isi_Pesan'] = htmlspecialchars($this->input->post('pesan', true));
        $datainsert3['Tanggal_pesan'] = date('Y-m-d H:i:s');
        $this->Analisis_model->insert_pesan($datainsert3);

        if (($this->session->userdata('level') == 3) or ($this->session->userdata('level') == 4)) {
            $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
        SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('" . $kode . "'),CONCAT('pangsa'),CONCAT('Status konfirmasi untuk analisis pangsa perusahaan dengan kode " . $kode . " adalah DI" . strtoupper($datainsert['Konfirmasi']) . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
        CONCAT(1) From pegawai_guru WHERE level > 0");
        }

        if (($this->session->userdata('level') == 2) or ($this->session->userdata('level') == 4)) {
            $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
        SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('" . $kode . "'),CONCAT('pangsa'),CONCAT('Status perluasan pangsa pasar perusahaan dengan kode " . $kode . " adalah " . strtoupper($datainsert['Status']) . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
        CONCAT(1) From pegawai_guru WHERE level > 0");
        }

        if ($this->session->userdata('level') > 1) {
            $_SESSION['notif'] = $_SESSION['notif'] + 1;
            $this->Analisis_model->update_pangsaperu($datainsert, $kode);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Konfirmasi data ' . $kode . ' berhasil diubah!</div>');
        }
        redirect('Analisis/hasilanalisis/a');
    }

    public function konfirmasirasio($kode)
    {
        $_SESSION['notif'] = $_SESSION['notif'] + 1;

        if (($this->session->userdata('level') == 3) or ($this->session->userdata('level') == 4)) {
            $datainsert['Status'] = $this->input->post('konfirmasi', true);
        }
        $datainsert3['Kode_hasil'] = $kode;
        $datainsert3['NIP'] = $this->session->userdata('id');
        $datainsert3['Isi_Pesan'] = htmlspecialchars($this->input->post('pesan', true));
        $datainsert3['Tanggal_pesan'] = date('Y-m-d H:i:s');
        $this->Analisis_model->insert_pesan($datainsert3);

        $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
        SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('" . $kode . "'),CONCAT('rasio'),CONCAT('Status konfirmasi untuk analisis rasio dengan kode " . $kode . " adalah DI" . strtoupper($datainsert['Konfirmasi']) . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
        CONCAT(1) From pegawai_guru WHERE level > 1");

        $this->Analisis_model->update_rasio($datainsert, $kode);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Konfirmasi data ' . $kode . ' berhasil diubah!</div>');
        redirect('Analisis/hasilanalisis/b');
    }

    public function simpanpangsa()
    {
        $_SESSION['notif'] = $_SESSION['notif'] + 1;
        $this->form_validation->set_rules('pangsapersen', 'pangsapersen', 'required|trim|greater_than[' . $_POST['pangsapersen2'] . ']', [
            'greater_than' => 'Tidak meningkat dari ' . $_POST['pangsapersen2'] . '% !',
            'required' => 'Field tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('penyerapan', 'penyerapan', 'required|trim|greater_than[0]', [
            'greater_than' => 'Tidak boleh kurang dari 1!',
            'required' => 'Field tidak boleh kosong'
        ]);

        if ($_POST['perusahaan']) {
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Analisis Pangsa Pasar';
                $data['perusahaan'] = $this->Analisis_model->get_perusahaan();
                $tahunajaran = $this->Kelas_model->tahun_ajaran();
                $data['jumlahsiswa'] = $this->Analisis_model->get_jumlahsiswa($tahunajaran);
                $this->load->view('templates/header.php', $data);
                $this->load->view('templates/sidebar.php');
                $this->load->view('analisis/index.php', $data);
                $this->load->view('templates/footer.php', $data);
            } else {

                $kdpangsabaru = $this->Analisis_model->kdpangsabaru();

                $kdpangsa = date('Ymd') * 100 + $kdpangsabaru;


                $datainsert['Kd_pangsaperu'] = "" . $kdpangsa;
                $datainsert['Tanggal'] = date('Y-m-d H:i:s');
                $datainsert['Persentase_awal'] = $this->input->post('pangsapersen2', true);
                $datainsert['Persentase_akhir'] = $this->input->post('pangsapersen', true);
                $datainsert['Konfirmasi'] = 'Belum di konfirmasi';
                $datainsert['Penyerapan'] = htmlspecialchars($this->input->post('penyerapan', true));
                $this->Analisis_model->insert_pangsaperu($datainsert);
                $datainsert3['Kode_hasil'] = $kdpangsa;
                $datainsert3['NIP'] = $this->session->userdata('id');
                $datainsert3['Isi_Pesan'] = htmlspecialchars($this->input->post('pesan', true));
                $datainsert3['Tanggal_pesan'] = date('Y-m-d H:i:s');
                $this->Analisis_model->insert_pesan($datainsert3);

                $this->db->query("INSERT INTO notif(Waktu,Subject, Kategori, Email,Pengirim, Penerima, Baca) 
        SELECT CONCAT('" . date('Y-m-d H:i:s') . "'),CONCAT('" . $kdpangsa . "'),CONCAT('pangsa'),CONCAT('Analisis pangsa pasar perusahaan baru dengan kode " . $kdpangsa . "'),Concat('" . $this->session->userdata('id') . "'),NIP,
        CONCAT(1) From pegawai_guru WHERE level > 1");

                for ($i = 0; $i < count($_POST['perusahaan']); $i++) {
                    $datainsert2['Kd_pangsaperu'] = $kdpangsa;
                    $datainsert2['Kode_jurusan'] = $_POST['kdjurusan'][$i];
                    $datainsert2['Jumlah_peru'] = $_POST['perusahaan'][$i];
                    $this->Analisis_model->insert_detailpangsaperu($datainsert2);
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data ' . $kdpangsa . ' berhasil ditambahkan!</div>');
                redirect('Analisis/hasilanalisis/a');
                // var_dump($datainsert);
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Terjadi kesalahan penyimpanan, silahkan ulangi!</div>');
            redirect('Analisis/pangsapasar');
        }
    }

    public function rasiodelete()
    {
        $data['id'] = $_POST['id'];
        $this->Analisis_model->deleterasio($_POST['id']);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Hasil analisis ' . $data['id'] . ' Berhasil di hapus</div>');
        echo json_encode($_POST['id']);
    }

    public function pangsaperudelete()
    {
        $data['id'] = $_POST['id'];
        $this->Analisis_model->deletepangsaperu($_POST['id']);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Hasil analisis ' . $data['id'] . ' Berhasil di hapus</div>');
        echo json_encode($_POST['id']);
    }
    public function notifdelete($id)
    {
        $this->db->where('id_notif', $id);
        $this->db->delete('notif');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Notifikasi Berhasil di hapus</div>');
        redirect('Dashboard/tampilpesan');
    }
}
