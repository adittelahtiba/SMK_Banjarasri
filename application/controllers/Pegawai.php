<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Pegawai_model');
    }

    public function index()
    {
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_all();
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('pegawai/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function cari()
    {
        // var_dump($_POST);
        // die;
        $data['title'] = 'Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_pegawai($_POST['kodejurusan']);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('pegawai/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function profile()
    {
        $NIP = $this->session->userdata('id');

        $data['title'] = 'Profil';
        $data['active'] = '1';
        $data['pegawai'] = $this->Pegawai_model->get_by_nip($NIP);
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('pegawai/profil.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function add()
    {
        $data['title'] = 'Tambah Pegawai';
        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('pegawai/add.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function edit($id_peg)
    {
        $data['title'] = 'Edit Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_by_id($id_peg);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/sidebar.php');
        $this->load->view('pegawai/edit.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function addsave()
    {
        $data['nip'] = $this->Pegawai_model->nipbaru();
        $this->form_validation->set_rules('Nama', 'Nama', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tempatlahir', 'Tempatlahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tanggalahir', 'Tanggalahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pendidikan', 'Pendidikan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jk', 'Jk', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jurusan', 'Jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jabatan', 'Jabatan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Status', 'Status', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email', ['required' => '*Field Tidak Boleh Kosong', 'valid_email' => 'Alamat Email Tidak Valid']);
        $this->form_validation->set_rules('NoHp', 'NoHp', 'trim|is_natural', ['is_natural' => 'Hanya terdiri dari angka']);
        $this->form_validation->set_rules('NUPTK', 'NUPTK', 'trim|is_natural', ['is_natural' => 'Karakter hanya terdiri dari angka']);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Pegawai';
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/add.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {

            $tgl = $this->input->post('Tanggalahir', true);

            function generateRandomString($length)
            {
                return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyz', ceil($length / strlen($x)))), 1, $length);
            }

            $pass = generateRandomString(6);

            //insert data
            $datainsert['Id_peg'] =  $data['nip'];
            $datainsert['NIP'] =  substr($tgl, 8, 2) . substr($tgl, 5, 2) . substr($tgl, 0, 4) .  $data['nip'];
            $datainsert['Password'] = password_hash($pass, PASSWORD_DEFAULT);
            $datainsert['Nama'] = htmlspecialchars($this->input->post('Nama', true));
            $datainsert['Tempat_lahir'] = htmlspecialchars($this->input->post('Tempatlahir', true));
            $datainsert['Tanggal_lahir'] = htmlspecialchars($this->input->post('Tanggalahir', true));
            $datainsert['Jenis_kelamin'] = htmlspecialchars($this->input->post('Jk', true));
            $datainsert['Pendidikan'] = htmlspecialchars($this->input->post('Pendidikan', true));
            $datainsert['Jurusan'] = htmlspecialchars($this->input->post('Jurusan', true));
            $datainsert['NUPTK'] = htmlspecialchars($this->input->post('NUPTK', true));
            $datainsert['Jabatan'] = htmlspecialchars($this->input->post('Jabatan', true));
            $datainsert['Tugas_tambah'] = htmlspecialchars($this->input->post('Tugastambah', true));
            $datainsert['Status'] = htmlspecialchars($this->input->post('Status', true));
            $datainsert['Email'] = htmlspecialchars($this->input->post('Email', true));
            $datainsert['Nomor_telp'] = htmlspecialchars($this->input->post('NoHp', true));
            $datainsert['Level'] = htmlspecialchars($this->input->post('Level', true));
            $datainsert['Foto'] = 'Default.jpg';

            $this->Pegawai_model->insert_pegawai($datainsert);

            //email nip dan password
            // $email = array(
            //     'Subject' => $datainsert['NIP'],
            //     'Email' => $pass
            // );

            // $this->db->insert('Notif', $email);


            $namaemail = $datainsert['Nama'];
            $email = $datainsert['Email'];
            $subject = "Akun Baru Pegawai/Guru SMK Banjar Asri Cimaung";
            $message = "
        <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta name='viewport' content='width=device-width' />
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Akun Baru Pegawai</title>
        </head>
        <body style='margin:0px; background: #f8f8f8; '>
        <div width='100%' style='background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;'>
          <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
            <table border='0' cellpadding='0' cellspacing='0' style='width: 100%; margin-bottom: 20px'>
              <tbody>
                <tr>
                  <td>Akun Baru Pegawai/Guru SMK Banjar Asri Cimaung</td>
                </tr>
              </tbody>
            </table>
            <div style='padding: 40px; background: #fff;'>
              <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                <tbody>
                  <tr>
                    <td style='border-bottom:1px solid #f6f6f6;'><h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Kepada " . $namaemail . ",</h1>
                      <p style='margin-top:0px; color:#bbbbbb;'>Berikut merupakan informasi dari akun pegawai anda.</p></td>
                  </tr>
                  <tr>
                    <td style='padding:10px 0 30px 0;'><p>Anda telah terdaftar di Aplikasi SIPANGSA SMK Banjar Asri, berikut merupakan ID?NIP dan Passsword akun anda:</p>
                      
                 </tr>
                 <tr><td>ID/NIP     : <u>" . $datainsert['NIP'] . "</u></td></tr>
                 <tr><td>Password   : <u>" . $pass . "</u></td></tr>
                <tr>
                <td ><center>
                        <a href='https://smkbanjarasri.uxorbitdesign.com/' style='display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;'>Login</a>
                      </center>
                      <b>- Thanks (SMK Banjar Asri Cimaung)</b> </td>
                  </tr>
                  <tr>
                    <td  style='border-top:1px solid #f6f6f6; padding-top:20px; color:#777'>If the button above does not work, try copying and pasting the URL into your browser. If you continue to have problems, please feel free to contact us at sipangasa.smkbanjarasri@gmail.com</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style='text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px'>
              <p> Powered by Themedesigner.in <br>
                <a href='https://smkbanjarasri.uxorbitdesign.com/' style='color: #b2b2b5; text-decoration: underline;'>https://smkbanjarasri.uxorbitdesign.com/</a> </p>
            </div>
          </div>
        </div>
        </body>
        </html>
        ";


            $config = [
                'mailtype' => 'html',
                'charset' => 'utf8',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'sipangasa.smkbanjarasri@gmail.com',
                'smtp_pass' => '10116256',
                'smtp_port' => 465,
                'crlf' => "\r\n",
                'newline' => "\r\n"
            ];

            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from("sipangasa.smkbanjarasri@gmail.com", 'sipangsa.smkbanjarasri');

            $this->email->to($email);

            $this->email->cc("pangestuaditya.solihin@gmail.com");

            $this->email->subject($subject);

            $this->email->message($message);

            // if ($this->email->send()) {
            // } else {
            //     echo $this->email->print_debugger();
            //     die;
            // }

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Pegawai ' . $datainsert['NIP'] . " - " . $datainsert['Nama'] . ' Berhasil di simpan</div>');

            redirect('Pegawai');
        }
    }

    public function editsave($id_peg)
    {
        $data['pegawai'] = $this->Pegawai_model->get_by_id($id_peg);
        if ($data['pegawai']['NIP'] <> $this->input->post('NIP', true)) {
            $this->form_validation->set_rules('NIP', 'NIP', 'trim|required|is_unique[pegawai_guru.NIP]|is_natural|min_length[6]', ['required' => '*Field Tidak Boleh Kosong', 'is_unique' => 'NIP sudah digunakan', 'is_natural' => 'Hanya terdiri dari angka', 'min_length' => 'Minimal terdiri dari 10 karakter']);
        }
        $this->form_validation->set_rules('Nama', 'Nama', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tempatlahir', 'Tempatlahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tanggalahir', 'Tanggalahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pendidikan', 'Pendidikan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jk', 'Jk', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jurusan', 'Jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jabatan', 'Jabatan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Status', 'Status', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email', ['required' => '*Field Tidak Boleh Kosong', 'valid_email' => 'Alamat Email Tidak Valid']);
        $this->form_validation->set_rules('NoHp', 'NoHp', 'trim|is_natural', ['is_natural' => 'Karakter hanya terdiri dari angka']);
        $this->form_validation->set_rules('NUPTK', 'NUPTK', 'trim|is_natural', ['is_natural' => 'Karakter hanya terdiri dari angka']);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Pegawai';
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/edit.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            $dataupdate['NIP'] =  htmlspecialchars($this->input->post('NIP', true));
            $dataupdate['Nama'] = htmlspecialchars($this->input->post('Nama', true));
            $dataupdate['Tempat_lahir'] = htmlspecialchars($this->input->post('Tempatlahir', true));
            $dataupdate['Tanggal_lahir'] = htmlspecialchars($this->input->post('Tanggalahir', true));
            $dataupdate['Jenis_kelamin'] = htmlspecialchars($this->input->post('Jk', true));
            $dataupdate['Pendidikan'] = htmlspecialchars($this->input->post('Pendidikan', true));
            $dataupdate['Jurusan'] = htmlspecialchars($this->input->post('Jurusan', true));
            $dataupdate['NUPTK'] = htmlspecialchars($this->input->post('NUPTK', true));
            $dataupdate['Jabatan'] = htmlspecialchars($this->input->post('Jabatan', true));
            $dataupdate['Tugas_tambah'] = htmlspecialchars($this->input->post('Tugastambah', true));
            $dataupdate['Status'] = htmlspecialchars($this->input->post('Status', true));
            $dataupdate['Email'] = htmlspecialchars($this->input->post('Email', true));
            $dataupdate['Nomor_telp'] = htmlspecialchars($this->input->post('NoHp', true));
            $dataupdate['Level'] = htmlspecialchars($this->input->post('Level', true));



            $this->Pegawai_model->update_pegawai($dataupdate, $id_peg);

            //email nip dan password
            $email = array(
                'Subject' => $dataupdate['NIP'],
                'Email' => 'Update Data'
            );

            $this->db->insert('Notif', $email);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Pegawai ' . $dataupdate['NIP'] . " - " . $dataupdate['Nama'] . ' Berhasil di ubah</div>');

            redirect('Pegawai');
        }
    }

    public function ubahpass()
    {

        $NIP = $this->session->userdata('id');
        $data['pegawai'] = $this->Pegawai_model->get_by_nip($NIP);
        $data['title'] = 'Profil';
        $data['active'] = '3';

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
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/profil.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            if (password_verify($_POST['passlama'], $data['pegawai']['Password'])) {
                $passbaru = password_hash($_POST['password1'], PASSWORD_DEFAULT);
                $this->db->set('Password', $passbaru);
                $this->db->where('NIP', $NIP);
                $this->db->update('Pegawai_guru');
                $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Password berhasil diubah!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Password salah, silahkan ulangi!</div>');
            }
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/profil.php', $data);
            $this->load->view('templates/footer.php', $data);
        }
    }

    public function editprofile()
    {
        $NIP = $this->session->userdata('id');
        $data['pegawai'] = $this->Pegawai_model->get_by_nip($NIP);
        $data['title'] = 'Profil';
        $data['active'] = '2';
        $this->form_validation->set_rules('Nama', 'Nama', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tempatlahir', 'Tempatlahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Tanggalahir', 'Tanggalahir', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Pendidikan', 'Pendidikan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jk', 'Jk', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jurusan', 'Jurusan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Jabatan', 'Jabatan', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Status', 'Status', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email', ['required' => '*Field Tidak Boleh Kosong', 'valid_email' => 'Alamat Email Tidak Valid']);
        $this->form_validation->set_rules('NoHp', 'NoHp', 'trim|is_natural', ['is_natural' => 'Karakter hanya terdiri dari angka']);
        $this->form_validation->set_rules('NUPTK', 'NUPTK', 'trim|is_natural', ['is_natural' => 'Karakter hanya terdiri dari angka']);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/profil.php', $data);
            $this->load->view('templates/footer.php', $data);
        } else {
            $upload_image = $_FILES['Foto']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/BackEnd/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('Foto')) {
                    $old_image = $data['pegawai']['Foto'];
                    if ($old_image != 'Default.jpg') {
                        unlink(FCPATH .  'assets/BackEnd/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $dataupdate['Foto'] = $new_image;
                    //nononon
                    $this->session->unset_userdata('foto');
                    $_SESSION['foto'] = $new_image;
                    //nenene
                } else {
                    echo $this->upload->display_errors();
                    echo "Foto gagal di upload, <a href='" . base_url('pegawai/Profile') . "'>Klik disini untuk kembali</a>";
                    die;
                }
            }


            $dataupdate['Nama'] = htmlspecialchars($this->input->post('Nama', true));
            $dataupdate['Tempat_lahir'] = htmlspecialchars($this->input->post('Tempatlahir', true));
            $dataupdate['Tanggal_lahir'] = htmlspecialchars($this->input->post('Tanggalahir', true));
            $dataupdate['Jenis_kelamin'] = htmlspecialchars($this->input->post('Jk', true));
            $dataupdate['Pendidikan'] = htmlspecialchars($this->input->post('Pendidikan', true));
            $dataupdate['Jurusan'] = htmlspecialchars($this->input->post('Jurusan', true));
            $dataupdate['NUPTK'] = htmlspecialchars($this->input->post('NUPTK', true));
            $dataupdate['Jabatan'] = htmlspecialchars($this->input->post('Jabatan', true));
            $dataupdate['Tugas_tambah'] = htmlspecialchars($this->input->post('Tugastambah', true));
            $dataupdate['Status'] = htmlspecialchars($this->input->post('Status', true));
            $dataupdate['Email'] = htmlspecialchars($this->input->post('Email', true));
            $dataupdate['Nomor_telp'] = htmlspecialchars($this->input->post('NoHp', true));


            $this->Pegawai_model->update_pegawai2($dataupdate, $NIP);

            //email nip dan password
            $email = array(
                'Subject' => $NIP,
                'Email' => 'Update Data'
            );

            $this->db->insert('Notif', $email);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profil berhasil di perbaharui</div>');

            $this->load->view('templates/header.php', $data);
            $this->load->view('templates/sidebar.php');
            $this->load->view('pegawai/profil.php', $data);
            $this->load->view('templates/footer.php', $data);
        }
    }

    public function delete()
    {
        $data['id'] = $_POST['id'];
        $this->Pegawai_model->delete($_POST['id']);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Pegawai ' . $data['id'] . ' Berhasil di hapus</div>');
        echo json_encode($_POST['id']);
    }
}
