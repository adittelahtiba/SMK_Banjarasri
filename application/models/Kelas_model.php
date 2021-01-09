<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get('kelas')->result_array();
    }

    function tahun_ajaran()
    {
        $tahun_ajaran = $this->db->query('SELECT max(Tahun_ajaran) as Tahun_ajaran FROM Detail_kelas')->row();
        $tahun_ajaran = intval($tahun_ajaran->Tahun_ajaran);
        return $tahun_ajaran;
    }

    function update_kelas($data, $kdkelas, $nis)
    {
        $this->db->where('Kode_kelas', $kdkelas);
        $this->db->where('Nomor_induk', $nis);
        $this->db->update('Detail_kelas', $data);
    }

    function nisbaru($tahun)
    {
        $nipbaru = $this->db->query("SELECT max(right(Nomor_induk,3)) as NIS FROM Siswa where Tahun_masuk=" . $tahun)->row();
        $nisbaru = intval($nipbaru->NIS) + 1;
        return $nisbaru;
    }
}
