<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->model('Detailkelas_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Situasialumni_model');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
    }

    public function index()
    {
        redirect('Kelas/kelas/10');
    }

    public function kelas($kelas = '10')
    {
        if ($kelas == '13') {
            $data['title'] = 'Lulusan ';
        } else {
            $data['title'] = 'Siswa Kelas ' . $kelas;
        }

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
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('kelas/index.php', $data);
        $data['title'] = 'ok';
        $this->load->view('templates/footer.php', $data);
    }

    public function kelolasiswa($ab = 'a')
    {
        $data['title'] = 'Kelola Siswa';
        $data['ab'] = $ab;

        $data['sembilan'] = $this->Detailkelas_model->get_sembilan();
        $data['sepuluh'] = $this->Detailkelas_model->get_sepuluh();
        $data['sebelas'] = $this->Detailkelas_model->get_sebelas();
        $data['duabelas'] = $this->Detailkelas_model->get_duabelas();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('kelas/kenaikankelas.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function update($ab)
    {
        $n = 0;
        $jml = count($_POST['status']);
        for ($i = 0; $i < $jml; $i++) {
            if ($_POST['status'][$i] <> $_POST['status2'][$i]) {
                $n++;
                $dataupdate['Status'] = $_POST['status'][$i];
                $this->Detailkelas_model->update_statussiswa($dataupdate, $_POST['Kode_kelas'][$i], $_POST['Nomor_induk'][$i]);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data berhasil di ubah, Jumlah data di ubah : ' . $n . '</div>');
        redirect('Kelas/kelolasiswa/' . $ab);
    }

    public function siswabaru($ab = 'a')
    {
        if (!$_FILES['inexcel']['name']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                File tidak ditemukan</div>');
            redirect('Kelas/kelolasiswa/a');
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
            if ($sheet[5]['H']) {
                $tahun = $sheet[5]['H'];
                $nisanyar = 0 + $sheet[5]['H'];
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Format data pada excel tidak benar</div>');
                redirect('Kelas/kelolasiswa/a');
                die;
            }

            $nisanyar = $this->Kelas_model->nisbaru($nisanyar);

            foreach ($sheet as $key) {
                if ($i > 15) {
                    $data['Nomor_induk'] = (substr($tahun, 2, 2) . (1 + substr($tahun, 2, 2) . '10') * 1000 + $nisanyar);
                    $data['NISN'] = htmlspecialchars($key['C']);
                    $data['Nama_siswa'] = htmlspecialchars($key['D']);
                    $data['Kode_jurusan'] = htmlspecialchars($key['E']);
                    $data['Jenis_kelamin'] = htmlspecialchars($key['F']);
                    $data['Tempat_lahir'] = htmlspecialchars($key['G']);
                    $data['Tanggal_lahir'] = htmlspecialchars($key['H']);
                    $data['Agama'] = htmlspecialchars($key['I']);
                    $data['Nama_ayah'] = htmlspecialchars($key['J']);
                    $data['Nama_ibu'] = htmlspecialchars($key['K']);
                    $data['Pekerjaan_ortu'] = htmlspecialchars($key['L']);
                    $data['Alamat'] = htmlspecialchars($key['M']);
                    $data['Asal_sekolah'] = htmlspecialchars($key['N']);
                    $data['Status_keuangan'] = htmlspecialchars($key['O']);
                    $data['Nomor_ijazah'] = htmlspecialchars($key['P']);
                    $data['Nomor_skhun'] = htmlspecialchars($key['Q']);
                    $data['Nomor_peserta'] = htmlspecialchars($key['R']);
                    $data['keterangan'] = htmlspecialchars($key['A']);
                    $data['Nomor_telp'] = htmlspecialchars($key['T']);
                    $data['Email'] = htmlspecialchars($key['U']);
                    $data['Foto'] = 'Default.jpg';
                    $data['Tahun_masuk'] = $tahun;
                    if ($key['D']) {
                        $this->Siswa_model->insert_siswabaru($data);
                        $nisanyar++;
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
        redirect('Kelas/kelolasiswa/' . $ab);
    }

    public function siswabaruform($ab = 'e')
    {
        $this->form_validation->set_rules('Kode_jurusan', 'Kode_jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Kode_kelas', 'Kode_kelas', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Nomor_induk', 'Nomor_induk', 'trim|required|is_unique[Siswa.Nomor_induk]', ['required' => '*Field Tidak Boleh Kosong', 'is_unique' => 'Nomor Induk Telah Digunakan']);
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
            $data['title'] = 'Kelola Siswa';
            $data['ab'] = $ab;

            $data['sembilan'] = $this->Detailkelas_model->get_sembilan();
            $data['sepuluh'] = $this->Detailkelas_model->get_sepuluh();
            $data['sebelas'] = $this->Detailkelas_model->get_sebelas();
            $data['duabelas'] = $this->Detailkelas_model->get_duabelas();

            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('kelas/kenaikankelas.php', $data);
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

            $datainsert2['Kode_kelas'] = htmlspecialchars($this->input->post('Kode_jurusan', true)) . htmlspecialchars($this->input->post('Kode_kelas', true));
            $datainsert2['Nomor_induk'] = htmlspecialchars($this->input->post('Nomor_induk', true));
            $datainsert2['Tahun_ajaran'] = htmlspecialchars($this->input->post('Tahun_ajaran', true));
            $datainsert2['Status'] = 'Naik';

            if ($this->input->post('Kode_kelas', true) == '09') {
                $this->Siswa_model->insert_siswabaru($datainsert);
                $ab = 'a';
            } else {
                $this->Siswa_model->insert_siswabaru($datainsert);
                $this->Detailkelas_model->insert_detailkelas($datainsert2);

                if ($this->input->post('Kode_kelas', true) == '10') {
                    $ab = 'b';
                } elseif ($this->input->post('Kode_kelas', true) == '11') {
                    $ab = 'c';
                } elseif ($this->input->post('Kode_kelas', true) == '12') {
                    $ab = 'd';
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Data siswa berhasil di simpan</div>');

            redirect('Kelas/kelolasiswa/' . $ab);
        }
    }

    public function tahunajaranbaru()
    {
        $tahunajaran = $this->Kelas_model->tahun_ajaran();


        $aya = $this->db->query("select * from siswa where Tahun_masuk=" . ($tahunajaran + 1))->result_array();

        if (count($aya) == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Anda harus menambahkan siswa baru untuk data kelas 10 tahun ajaran baru</div>');
            redirect('Kelas/kelolasiswa/a');
            die;
        }
        // $this->db->query("INSERT INTO detail_kelas(Kode_kelas, Nomor_induk, Tahun_ajaran, Status) 
        // SELECT Kode_jurusan,Nomor_induk," . ($tahunajaran + 1) . ",CONCAT('Naik') FROM Siswad");

        $this->Detailkelas_model->select_insert($tahunajaran);
        $this->Detailkelas_model->selectinsert_sisbar($tahunajaran);
        $this->Detailkelas_model->selins_tidaknaik($tahunajaran);
        $this->Siswa_model->insert_situasialumni($tahunajaran);

        // $data['sembilan'] = $this->Detailkelas_model->get_sembilan();
        // $data['sepuluh'] = $this->Detailkelas_model->get_sepuluh();
        // $data['sebelas'] = $this->Detailkelas_model->get_sebelas();
        // $data['duabelas'] = $this->Detailkelas_model->get_duabelas();



        // foreach ($data['sembilan'] as $sembilan) {
        //     $datainsert2['Kode_kelas'] = $sembilan['Kode_jurusan'] . '10';
        //     $datainsert2['Nomor_induk'] = $sembilan['Nomor_induk'];
        //     $datainsert2['Tahun_ajaran'] = $sembilan['Tahun_masuk'];
        //     $datainsert2['Status'] = 'Naik';
        //     $this->Detailkelas_model->insert_detailkelas($datainsert2);
        // }

        // foreach ($data['sepuluh'] as $sepuluh) {
        //     if ($sepuluh['Status'] == 'Naik') {
        //         $datainsert2['Kode_kelas'] = $sepuluh['Kode_jurusan'] . '11';
        //         $datainsert2['Nomor_induk'] = $sepuluh['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($sepuluh['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     } elseif ($sepuluh['Status'] == 'Tinggal') {
        //         $datainsert2['Kode_kelas'] = $sepuluh['Kode_jurusan'] . '10';
        //         $datainsert2['Nomor_induk'] = $sepuluh['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($sepuluh['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     }
        // }

        // foreach ($data['sebelas'] as $sebelas) {
        //     if ($sebelas['Status'] == 'Naik') {
        //         $datainsert2['Kode_kelas'] = $sebelas['Kode_jurusan'] . '12';
        //         $datainsert2['Nomor_induk'] = $sebelas['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($sebelas['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     } elseif ($sebelas['Status'] == 'Tinggal') {
        //         $datainsert2['Kode_kelas'] = $sebelas['Kode_jurusan'] . '11';
        //         $datainsert2['Nomor_induk'] = $sebelas['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($sebelas['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     }
        // }

        // foreach ($data['duabelas'] as $duabelas) {
        //     if ($duabelas['Status'] == 'Naik') {
        //         $datainsert2['Kode_kelas'] = $duabelas['Kode_jurusan'] . '13';
        //         $datainsert2['Nomor_induk'] = $duabelas['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($duabelas['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     } elseif ($duabelas['Status'] == 'Tinggal') {
        //         $datainsert2['Kode_kelas'] = $duabelas['Kode_jurusan'] . '12';
        //         $datainsert2['Nomor_induk'] = $duabelas['Nomor_induk'];
        //         $datainsert2['Tahun_ajaran'] = ($duabelas['Tahun_ajaran'] + 1);
        //         $datainsert2['Status'] = 'Naik';
        //         $this->Detailkelas_model->insert_detailkelas($datainsert2);
        //     }
        // }

        $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Tahun ajaran ' . ($tahunajaran + 1) . '/' . ($tahunajaran + 2) . ' telah dimulai</div>');
        redirect('Dashboard');
    }

    public function deletesiswa($nis, $kelas)
    {
        $this->db->query("DELETE FROM Detail_kelas WHERE Nomor_induk='" . $nis . "' and RIGHT(Kode_kelas,2)='" . $kelas . "'");
        $this->session->set_flashdata('message', '<div class="alert alert-success  alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Siswa ' . $nis . ' telah berhasil di hapus dari kelas ' . $kelas . '</div>');
        redirect('Kelas/kelas/' . $kelas);
    }

    public function edit($id, $no)
    {
        $data['title'] = 'Edit Siswa';
        $data['no'] = $no;

        $data['siswa'] = $this->Siswa_model->get_siswabyid($id);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('kelas/edit.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function editsimpan($id, $no)
    {
        $data['title'] = 'Edit Siswa';
        $data['no'] = $no;
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
            $this->load->view('kelas/edit.php', $data);
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
                $kdkelas = htmlspecialchars($this->input->post('Kode_jurusan', true)) . $no;
                $datainsert2['Nomor_induk'] = htmlspecialchars($this->input->post('Nomor_induk', true));

                $this->Kelas_model->update_kelas($datainsert2, $kdkelas, $_POST['Nomor_induk2']);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data siswa ' . $id . ' Berhasil di ubah</div>');
            redirect('Kelas/kelas/' . $no);
        }
    }
}
