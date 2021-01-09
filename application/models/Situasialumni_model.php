<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Situasialumni_model extends CI_Model
{
    function get_persensituasi()
    {
        return $this->db->query("select * from situasi_alumni, detail_kelas, siswa where situasi_alumni.Nomor_induk=detail_kelas.nomor_induk
         and situasi_alumni.Nomor_induk=siswa.nomor_induk and Right(Kode_kelas,2)='13' ORDER BY Tahun_ajaran,Kode_jurusan,Linear_kompetensi asc")->result_array();
    }

    function get_persensituasi2($anytahun)
    {
        return $this->db->query("select * from situasi_alumni, detail_kelas, siswa where situasi_alumni.Nomor_induk=detail_kelas.nomor_induk
         and situasi_alumni.Nomor_induk=siswa.nomor_induk and Right(Kode_kelas,2)='13' and Tahun_ajaran in(" . $anytahun . ") ORDER BY Tahun_ajaran,Kode_jurusan,Linear_kompetensi asc ")->result_array();
    }

    function get_jumlahalumni($anytahun)
    {
        return $this->db->query("select count(*) as Jumlahna,Kode_jurusan from situasi_alumni, detail_kelas, siswa where situasi_alumni.Nomor_induk=detail_kelas.nomor_induk
        and situasi_alumni.Nomor_induk=siswa.nomor_induk and Right(Kode_kelas,2)='13' and Tahun_ajaran in(" . $anytahun . ") GROUP BY Kode_jurusan ORDER BY Tahun_ajaran,Kode_jurusan,Linear_kompetensi asc")->result_array();
    }

    function get_alumnijurusan($jurusan, $tahun)
    {
        return $this->db->query("select * from situasi_alumni,siswa,detail_kelas where situasi_alumni.Nomor_induk=siswa.Nomor_induk and detail_kelas.Nomor_induk=situasi_alumni.nomor_induk and  siswa.Kode_jurusan in(" . $jurusan . ") and Detail_kelas.Tahun_ajaran=" . $tahun . " and RIGHT(Kode_kelas,2)='13'")->result_array();
    }

    function get_jumlahtahun()
    {
        return $this->db->query("SELECT COUNT(DISTINCT(tahun_ajaran)) as Jumlah_tahun FROM situasi_alumni,detail_kelas WHERE situasi_alumni.Nomor_induk=detail_kelas.Nomor_induk AND RIGHT(Kode_kelas,2)='13'")->row_array();
    }

    function get_jumlahtahun2($anytahun)
    {
        return $this->db->query("SELECT COUNT(DISTINCT(tahun_ajaran)) as Jumlah_tahun FROM situasi_alumni,detail_kelas WHERE situasi_alumni.Nomor_induk=detail_kelas.Nomor_induk AND RIGHT(Kode_kelas,2)='13' AND Tahun_ajaran in(" . $anytahun . ")")->row_array();
    }

    function get_alumni($nis)
    {
        return $this->db->query("SELECT * FROM situasi_alumni,siswa,detail_kelas where situasi_alumni.Nomor_induk=siswa.Nomor_induk and detail_kelas.Nomor_induk=situasi_alumni.Nomor_induk and situasi_alumni.Nomor_induk='" . $nis . "'")->row_array();
    }

    function get_perusahaan($kodejurusan)
    {
        return $this->db->query("SELECT Bekerja, COUNT(*) as Jumlah, sum(if(Linear_kompetensi='Y',1,0)) AS LinearY, sum(if(Linear_kompetensi<>'Y',1,0)) AS LinearT, sum(if(Kepuasan_kerja='Y',1,0)) AS PuasY, sum(if(Kepuasan_kerja<>'Y',1,0)) AS PuasT FROM situasi_alumni JOIN siswa ON situasi_alumni.Nomor_induk=siswa.Nomor_induk WHERE Bekerja <> '' and Kode_jurusan in (" . $kodejurusan . ") GROUP BY Bekerja ORDER BY sum(if(Linear_kompetensi='Y',1,0)) DESC")->result_array();
    }

    function update_situasi($data, $id)
    {
        $this->db->where('Nomor_induk', $id);
        $this->db->update('situasi_alumni', $data);
    }

    function tahun_ajaran()
    {
        $tahun_ajaran = $this->db->query('SELECT max(Tahun_ajaran) as Tahun_ajaran FROM Detail_kelas')->row();
        $tahun_ajaran = intval($tahun_ajaran->Tahun_ajaran);
        return $tahun_ajaran;
    }

    function insert_situasialumni($data)
    {
        return $this->db->insert('Situasi_alumni', $data);
    }
}
