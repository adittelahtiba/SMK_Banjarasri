<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detailkelas_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get('detail_kelas')->result_array();
    }

    function get_siswakelas($kelas, $jurusan, $tahun)
    {
        return $this->db->query("select * from detail_kelas,siswa where detail_kelas.nomor_induk=siswa.nomor_induk and siswa.Kode_jurusan in(" . $jurusan . ") and Detail_kelas.Tahun_ajaran=" . $tahun . " and right(Kode_kelas,2)='" . $kelas . "'")->result_array();
    }

    function get_sepuluh()
    {
        return $this->db->query("SELECT * FROM siswa,detail_kelas WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk AND RIGHT(Kode_kelas,2)='10'AND Tahun_ajaran=(SELECT max(Tahun_ajaran) from detail_kelas WHERE RIGHT(Kode_kelas,2)='12')")->result_array();
    }
    function get_sebelas()
    {
        return $this->db->query("SELECT * FROM siswa,detail_kelas WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk AND RIGHT(Kode_kelas,2)='11'AND Tahun_ajaran=(SELECT max(Tahun_ajaran) from detail_kelas WHERE RIGHT(Kode_kelas,2)='12')")->result_array();
    }
    function get_duabelas()
    {
        return $this->db->query("SELECT * FROM siswa,detail_kelas WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk AND RIGHT(Kode_kelas,2)='12'AND Tahun_ajaran=(SELECT max(Tahun_ajaran) from detail_kelas WHERE RIGHT(Kode_kelas,2)='12')")->result_array();
    }

    function get_sembilan()
    {
        return $this->db->query("SELECT * FROM siswa WHERE Tahun_masuk=(1+(SELECT max(Tahun_ajaran) from detail_kelas))")->result_array();
    }

    function select_insert($tahunajaran)
    {
        return $this->db->query("INSERT INTO detail_kelas(Kode_kelas, Nomor_induk, Tahun_ajaran, Status) 
        SELECT CONCAT(Siswa.Kode_jurusan,(Right(Kode_kelas,2)+1)),Siswa.Nomor_induk,(Tahun_ajaran+1),CONCAT('Naik') 
        FROM Siswa JOIN Detail_kelas ON Siswa.Nomor_induk=Detail_kelas.Nomor_induk where Tahun_ajaran=" . $tahunajaran . " and right(Kode_kelas,2)<>'13' and Detail_kelas.Status='Naik'");
    }

    function selins_tidaknaik($tahunajaran)
    {
        return $this->db->query("INSERT INTO detail_kelas(Kode_kelas, Nomor_induk, Tahun_ajaran, Status) 
        SELECT CONCAT(Siswa.Kode_jurusan,Right(Kode_kelas,2)),Siswa.Nomor_induk,(Tahun_ajaran+1),CONCAT('Naik') 
        FROM Siswa JOIN Detail_kelas ON Siswa.Nomor_induk=Detail_kelas.Nomor_induk where Tahun_ajaran=" . $tahunajaran . " and right(Kode_kelas,2)<>'13' and Detail_kelas.Status='Tinggal'");
    }

    function selectinsert_sisbar($tahunajaran)
    {
        return $this->db->query("INSERT INTO detail_kelas(Kode_kelas, Nomor_induk, Tahun_ajaran, Status) 
        SELECT CONCAT(Siswa.Kode_jurusan,'10'),Siswa.Nomor_induk,Tahun_masuk,CONCAT('Naik') FROM Siswa WHERE Tahun_masuk=" . ($tahunajaran + 1) . "");
    }

    function update_statussiswa($data, $kdk, $id)
    {
        $this->db->where('Kode_kelas', $kdk);
        $this->db->where('Nomor_induk', $id);
        $this->db->update('Detail_kelas', $data);
    }

    function insert_detailkelas($data)
    {
        $this->db->insert('Detail_kelas', $data);
    }
}
