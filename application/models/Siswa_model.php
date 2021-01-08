<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get('siswa')->result_array();
    }

    function get_tahunmasuk()
    {
        return $this->db->query('SELECT Tahun_masuk FROM siswa GROUP by Tahun_masuk DESC')->result_array();
    }

    function get_jumlah($tahun_ajaran)
    {
        return $this->db->query("SELECT * FROM detail_kelas,siswa WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk and Tahun_ajaran=" . $tahun_ajaran)->result_array();
    }

    function get_jumlahsiswa($tahun_ajaran)
    {
        return $this->db->query("select Kode_kelas,siswa.Nomor_induk,Jenis_kelamin,count(siswa.Nomor_induk) as jmls from siswa,detail_kelas WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk and Tahun_ajaran=" . $tahun_ajaran . " and RIGHT(Kode_kelas,2)<>'13' GROUP by Jenis_kelamin,Kode_kelas ORDER BY right(Kode_kelas,2),LEFT(Kode_kelas,3)")->result_array();
    }

    function insert_siswabaru($data)
    {
        $this->db->insert('Siswa', $data);
    }
    function insert_situasialumni($tahunajaran)
    {
        $this->db->query("INSERT INTO situasi_alumni( Nomor_induk,Linear_kompetensi, Kepuasan_kerja,password)
        SELECT Nomor_induk,CONCAT(''),CONCAT(''),Nomor_induk FROM detail_kelas WHERE tahun_ajaran=" . $tahunajaran . " and RIGHT(Kode_kelas,2)='12'");
    }

    function get_siswatahunajaran()
    {
        return $this->db->query("SELECT Tahun_ajaran,COUNT(*) As 'Jumlah_siswa' FROM detail_kelas JOIN siswa on detail_kelas.Nomor_induk=siswa.Nomor_induk WHERE right(Kode_kelas,2)<>'13' GROUP BY Tahun_ajaran ORDER BY Tahun_ajaran DESC")->result_array();
    }

    function hapus_situasialumni($tahunajaran)
    {
        $this->db->query("DELETE FROM situasi_alumni WHERE Nomor_induk in (SELECT Nomor_induk FROM `detail_kelas` WHERE Tahun_ajaran=" . $tahunajaran . " AND Right(Kode_kelas,2)='13')");
    }
    function hapus_tahunajaran($tahunajaran)
    {
        $this->db->where('Tahun_ajaran', $tahunajaran);
        $this->db->delete('Detail_kelas');
    }

    function hapus_siswa($id)
    {
        $this->db->where('Nomor_induk', $id);
        $this->db->delete('Siswa');
    }

    function get_siswabyid($id)
    {
        $this->db->where('Id', $id);
        return $this->db->get('Siswa')->row_array();
    }


    function update_siswa($data,  $id)
    {
        $this->db->where('id', $id);
        $this->db->update('Siswa', $data);
    }
}
