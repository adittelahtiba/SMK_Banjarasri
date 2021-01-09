<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Siswa_model');
    $this->load->model('Situasialumni_model');
    // sementara
    $this->load->model('Pegawai_model');
    $this->load->model('Kelas_model');
    $this->load->model('Analisis_model');
    $this->load->helper('email');
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['perusahaan'] = $this->Analisis_model->get_perusahaan();
    $tahunajaran = $this->Kelas_model->tahun_ajaran();
    $data['jumlahsiswa2'] = $this->Analisis_model->get_jumlahsiswa($tahunajaran);

    $data['situasiperu'] = $this->Situasialumni_model->get_perusahaan("'TAV','TKJ','TKR'");

    $_SESSION['notif'] = $this->Analisis_model->notif($this->session->userdata('id'));


    $this->load->view('templates/header.php', $data);
    $this->load->view('templates/sidebar.php');
    $this->load->view('dashboard/index.php', $data);
    $this->load->view('templates/footer.php', $data);
  }

  public function info()
  {
    $data['title'] = 'Dashboard';
    $tahunajaran = $this->Kelas_model->tahun_ajaran();
    $data['jumlah'] = $this->Siswa_model->get_jumlah($tahunajaran);
    $data['jumlahsiswa'] = $this->Siswa_model->get_jumlahsiswa($tahunajaran);
    $data['situasi'] = $this->Situasialumni_model->get_persensituasi();
    $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun();
    $data['tahunajaran'] = $tahunajaran;


    $this->load->view('templates/header.php', $data);
    $this->load->view('templates/sidebar.php');
    $this->load->view('dashboard/dashboard.php', $data);
    $this->load->view('templates/footer.php', $data);
  }

  public function tampilpesan()
  {
    $data['title'] = 'Pesan Notifikasi';
    $data['notif'] = $this->Analisis_model->get_notif($this->session->userdata('id'));

    $this->load->view('templates/header.php', $data);
    $this->load->view('templates/sidebar.php');
    $this->load->view('dashboard/pesan.php', $data);
    $this->load->view('templates/footer.php', $data);
  }

  public function tabelpersen($a)
  {
    $tahunajaran = $this->Kelas_model->tahun_ajaran();
    $tahun = 1 + $tahunajaran;
    $anytahun = $tahunajaran;
    for ($i = $a; $i > 1; $i--) {
      $anytahun = $anytahun . "," . ($tahun - $i);
    }

    $data['title'] = 'Dashboard';
    $data['jumlah'] = $this->Siswa_model->get_jumlah($tahunajaran);
    $data['situasi'] = $this->Situasialumni_model->get_persensituasi2($anytahun);
    $data['jumlah_tahun'] = $this->Situasialumni_model->get_jumlahtahun2($anytahun);

    $this->load->view('dashboard/tabelpersen.php', $data);
  }

  public function formsitusi()
  {
    $data['penerimaemail'] = $this->db->query('Select Email from siswa where Nomor_induk in (select Nomor_induk from situasi_alumni) group by Email')->result_array();

    $cc = 'sipangasa.smkbanjarasri@gmail.com';
    foreach ($data['penerimaemail'] as $key) {
      if (valid_email($key['Email'])) {
        $cc = $cc . "," . $key['Email'];
      }
    }

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
                  <td>Pemberitahuan</td>
                </tr>
              </tbody>
            </table>
            <div style='padding: 40px; background: #fff;'>
              <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                <tbody>
                  <tr>
                    <td style='border-bottom:1px solid #f6f6f6;'><h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Kepada Alumni,</h1>
                      <p style='margin-top:0px; color:#bbbbbb;'>Berikut merupakan pemberitahuan dari SMK Banjar Asri Cimaung.</p></td>
                  </tr>
                  <tr>
                    <td style='padding:10px 0 30px 0;'><p>Kepada seluruh alumni SMK Banjar Asri Cimaung diharapkan untuk mengisi data pekerjaan anda, klik tombol dibawah ini untuk mengisi. Guanakan NIS anda sebagai ID dan Password untuk login</p>
                      
                 </tr>
                <tr>
                <td ><center>
                        <a href='" . base_url() . "' style='display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #00c0c8; border-radius: 60px; text-decoration:none;'>Login</a>
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

    $this->email->to('pangestuaditya.solihin@gmail.com');

    $this->email->cc($cc);
    $this->email->subject('Pembaritahuan Kepada Alumni');

    $this->email->message($message);

    if ($this->email->send()) {
    } else {
      echo $this->email->print_debugger();
      die;
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pesan telah disampaikan kepada alumni melalui email</div>');
    redirect('Dashboard');
  }

  public function tespost()
  {
    var_dump($_POST);
  }
}
