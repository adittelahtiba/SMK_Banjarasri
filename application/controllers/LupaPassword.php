<?php

class LupaPassword extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function lupapass($id = 'pass')
  {
    $url = $this->db->query("select Id_peg from pegawai_guru where link='" . $id . "'")->row_array();
    if ($url) {
      $data['hash'] = $id;
      $data['id'] = $url['Id_peg'];
      $this->load->view('login/ubahpassword', $data);
    } else {
      echo "Halaman tidak ditemukan";
    }
  }

  public function ubah()
  {
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
      'matches' => 'Pengulangan password tidak sama!',
      'min_length' => 'Minimal password terdiri dari 6 karakter!',
      'required' => 'Password tidak boleh kosong'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $this->lupapass($_POST['id2']);
    } else {
      // var_dump($_POST);
      // die;
      $this->db->set('Password', password_hash($_POST['password1'], PASSWORD_DEFAULT));
      $this->db->set('Link', '');
      $this->db->where('Id_peg', $_POST['id']);
      $this->db->update('pegawai_guru');
      $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert">
                Silahkan login menggunakan password baru!</div>');
      redirect('login');
    }
  }

  public function kirim_link()
  {

    $id = $this->input->post('id');
    $sqladmin = $this->db->query("select * from pegawai_guru where NIP='" . $id . "'")->row_array();
    $sql = $this->db->query("select * from situasi_alumni join siswa on situasi_alumni.Nomor_induk=siswa.Nomor_induk where situasi_alumni.Nomor_induk='" . $id . "'")->row_array();
    $namap = $sql['Nama_siswa'];
    $namaadmin = $sqladmin['Nama'];
    if (!$sql and !$sqladmin) {
      $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert">
            ID tidak ditemukan, silahkan cek kembali!</div>');
      redirect('login');
    } else {
      function generateRandomString($length = 100)
      {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
      }

      $token = generateRandomString();


      if ($sqladmin) {
        $this->db->set('Link', $token);
        $this->db->where('NIP', $id);
        $this->db->update('Pegawai_guru');

        $namaemail = $namaadmin;
        $email = $sqladmin['Email'];
        $subject = "Layanan Lupa Password SMK Banjar Asri Cimaung";
        $message = "
            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta name='viewport' content='width=device-width' />
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <title>Reset Password Pegawai</title>
            </head>
            <body style='margin:0px; background: #f8f8f8; '>
            <div width='100%' style='background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;'>
              <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
                <table border='0' cellpadding='0' cellspacing='0' style='width: 100%; margin-bottom: 20px'>
                  <tbody>
                    <tr>
                      <td>Layanan Lupa Password</td>
                    </tr>
                  </tbody>
                </table>
                <div style='padding: 40px; background: #fff;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                    <tbody>
                      <tr>
                        <td style='border-bottom:1px solid #f6f6f6;'><h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Kepada " . $namaemail . ",</h1>
                          <p style='margin-top:0px; color:#bbbbbb;'>Berikut merupakan intruksi untuk memulihkan password anda.</p></td>
                      </tr>
                      <tr>
                        <td style='padding:10px 0 30px 0;'><p>Untuk mereset dan memperbaharui password anda, silahkan klik tombol di bawah ini:</p>
                          <center>
                            <a href='" . base_url('LupaPassword/lupapass/') . $token . "' style='display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;'>Reset Password</a>
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
                    <a href='" . base_url() . "' style='color: #b2b2b5; text-decoration: underline;'>" . base_url() . "</a> </p>
                </div>
              </div>
            </div>
            </body>
            </html>
            ";
      } else {
        $namaemail = $namap;
        $email = $sql['Email'];
        $subject = "Layanan Lupa Password SMK Banjar Asri Cimaung";
        $message = "Kepada, " . $namaemail . " <br><br><br> <table><tr><th colspan=2></th>" . $namaemail . "</tr>
                <tr><td>Nomor induk</td><td>:</td><td>" . $sql['Nomor_induk'] . "</td></tr>
                <tr><td>Password</td><td>:</td><td><u>" . $sql['password'] . "</u></td></tr>
                </table>";
      }

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

      $this->email->subject($subject);

      $this->email->message($message);

      if ($this->email->send()) {
        $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert">
                Silahkan buka email untuk melihat intruksi lupa password!</div>');
        redirect('login');
      } else {
        $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert">
                Terjadi kesalahan, silahkan ulangi lupa passswordss!</div>');
        redirect('login');
        die;
      }
    }
  }
}
