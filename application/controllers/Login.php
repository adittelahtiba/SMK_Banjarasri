<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('id', 'id', 'trim|required|is_natural', ['required' => '*Field Tidak Boleh Kosong', 'is_natural' => 'Karakter hanya terdiri dari angka']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => '*Field Tidak Boleh Kosong']);
        if ($this->form_validation->run() == false) {
            $this->load->view('login/index');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $id = htmlspecialchars($this->input->post('id', true));
        $password = $this->input->post('password');

        $user_pg = $this->db->query("select * from pegawai_guru where NIP='" . $id . "'")->row_array();
        $alumni = $this->db->query("select * from Situasi_alumni,siswa where Situasi_alumni.Nomor_induk=Siswa.Nomor_induk and Situasi_alumni.Nomor_induk='" . $id . "'")->row_array();
        if ($user_pg) {
            if (password_verify($password, $user_pg['Password'])) {
                $data = [
                    'id' => $user_pg['NIP'],
                    'name' => $user_pg['Nama'],
                    'foto' => $user_pg['Foto'],
                    'email' => $user_pg['Email'],
                    'level' => $user_pg['Level']
                ];
                $this->session->set_userdata($data);
                if ($user_pg['Level'] == 1) {
                    redirect('Dashboard/tampilpesan');
                } else {
                    redirect('Dashboard');
                }
            } else {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert">
                    Password salah, silahkan ulangi!</div>');
                redirect('login/index');
            }
        } elseif ($alumni) {
            // var_dump($alumni);
            // echo "<hr>";
            // echo $password;
            if ($alumni['password'] == $password) {
                $data = [
                    'nis' => $alumni['Nomor_induk'],
                    'name' => $alumni['Nama_siswa'],
                    'foto' => $alumni['Foto'],
                    'email' => $alumni['Email'],
                ];
                $this->session->set_userdata($data);
                redirect('Situasialumni');
            } else {
                $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert">
                    Password salah, silahkan ulangi!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class=" alert alert-danger" role="alert">
            ID tidak ditemukan, silahkan cek kembali!</div>');
            redirect('login/index');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nis');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('foto');
        $this->session->set_flashdata('message', '<div class=" alert alert-success" role="alert">
		Anda Berhasil Logout</div>');
        redirect('login');
    }

    public function blocked()
    {
        $this->load->view('Templates/blocked');
    }
}
