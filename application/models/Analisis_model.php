<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Analisis_model extends CI_Model
{
    function get_perusahaan()
    {
        return $this->db->query("SELECT jurusan.Kode_jurusan,jurusan.Nama_jurusan,(SELECT sum(Jumlah_penyerapan) from perusahaan WHERE jurusan.Kode_jurusan=perusahaan.Kode_jurusan and Aktif='Aktif') AS Penyerapan,(SELECT COUNT(Jumlah_penyerapan) from perusahaan WHERE jurusan.Kode_jurusan=perusahaan.Kode_jurusan  and Aktif='Aktif') AS Jumlah FROM jurusan ORDER BY Kode_jurusan DESC")->result_array();
    }

    function get_pangsaperusahaan()
    {
        return $this->db->query("SELECT * FROM pangsa_perusahaan ORDER BY tanggal DESC")->result_array();
    }

    function get_rasiokebutuhan()
    {
        return $this->db->query("SELECT * FROM Rasio_kebutuhan ORDER BY tanggal DESC")->result_array();
    }

    function get_detailpangsaperusahaan($kode)
    {
        return $this->db->query("SELECT * FROM detail_pangsaperu,pangsa_perusahaan,jurusan WHERE jurusan.Kode_jurusan=detail_pangsaperu.Kode_jurusan and detail_pangsaperu.Kd_pangsaperu = pangsa_perusahaan.Kd_pangsaperu and pangsa_perusahaan.Kd_pangsaperu='" . $kode . "'")->result_array();
    }

    function get_detailrasio($kode)
    {
        return $this->db->query("SELECT * FROM detail_rasio,rasio_kebutuhan,jurusan WHERE jurusan.Kode_jurusan=detail_rasio.Kode_jurusan and detail_rasio.Kd_rasio = rasio_kebutuhan.Kd_rasio and rasio_kebutuhan.Kd_rasio='" . $kode . "'")->result_array();
    }

    function get_jumlahsiswa($tahunajaran)
    {
        return $this->db->query("SELECT siswa.Kode_jurusan,Nama_jurusan,count(*) as Jumlah_siswa FROM siswa,detail_kelas,jurusan WHERE siswa.Nomor_induk=detail_kelas.Nomor_induk and jurusan.Kode_jurusan=siswa.Kode_jurusan and RIGHT(Kode_kelas,2)='12' and Tahun_ajaran=" . $tahunajaran . " GROUP BY Kode_jurusan ORDER BY jurusan.Kode_jurusan DESC")->result_array();
    }

    function get_pesanpangsa($kode)
    {
        return $this->db->query("SELECT * FROM Pegawai_guru,Pesan_obrolan,Pangsa_perusahaan WHERE Pegawai_guru.NIP=Pesan_obrolan.NIP and Pesan_obrolan.Kode_hasil=Pangsa_perusahaan.Kd_pangsaperu and Kode_hasil='" . $kode . "' ORDER BY Tanggal_pesan")->result_array();
    }

    function get_pesanrasio($kode)
    {
        return $this->db->query("SELECT * FROM Pegawai_guru,Pesan_obrolan,Rasio_kebutuhan WHERE Pegawai_guru.NIP=Pesan_obrolan.NIP and Pesan_obrolan.Kode_hasil=Rasio_kebutuhan.Kd_rasio and Kode_hasil='" . $kode . "' ORDER BY Tanggal_pesan")->result_array();
    }

    function kdpangsabaru()
    {
        $kdpangsabaru = $this->db->query('SELECT max(RIGHT(Kd_pangsaperu,2)) as Kd_pangsaperu FROM pangsa_perusahaan')->row();
        $kdpangsabaru = intval($kdpangsabaru->Kd_pangsaperu) + 1;
        return $kdpangsabaru;
    }

    function kdrasiobaru()
    {
        $kdrasiobaru = $this->db->query('SELECT max(RIGHT(Kd_rasio,2)) as Kd_rasio FROM Rasio_kebutuhan')->row();
        $kdrasiobaru = intval($kdrasiobaru->Kd_rasio) + 1;
        return $kdrasiobaru;
    }

    function notif($NIP)
    {
        $notif = $this->db->query("SELECT SUM(Baca)  as notif FROM notif WHERE Penerima='" . $NIP . "'")->row();
        $notif = intval($notif->notif) + 0;
        return $notif;
    }

    function get_notif($NIP)
    {
        $this->db->query("UPDATE notif SET Baca=0 WHERE Penerima='" . $NIP . "'");
        return  $this->db->query("SELECT id_notif,Nama,Tugas_tambah,Foto,Waktu,Subject,Kategori,notif.Email,Pengirim,Penerima,Baca FROM notif,pegawai_guru WHERE Penerima='" . $NIP . "' and pengirim=NIP ORDER BY Waktu DESC")->result_array();
    }

    function insert_pesan($data)
    {
        $this->db->insert('pesan_obrolan', $data);
    }

    function insert_detailpangsaperu($data)
    {
        $this->db->insert('Detail_pangsaperu', $data);
    }

    function insert_pangsaperu($data)
    {
        $this->db->insert('Pangsa_perusahaan', $data);
    }

    function insert_detailrasio($data)
    {
        $this->db->insert('Detail_rasio', $data);
    }

    function insert_rasio($data)
    {
        $this->db->insert('Rasio_kebutuhan', $data);
    }

    function update_pangsaperu($data, $id)
    {
        $this->db->where('Kd_pangsaperu', $id);
        $this->db->update('Pangsa_perusahaan', $data);
    }

    function update_rasio($data, $id)
    {
        $this->db->where('Kd_rasio', $id);
        $this->db->update('Rasio_kebutuhan', $data);
    }

    function deleterasio($id)
    {
        $this->db->where('Subject', $id);
        $this->db->delete('notif');
        $this->db->where('Kode_hasil', $id);
        $this->db->delete('Pesan_obrolan');
        $this->db->where('Kd_rasio', $id);
        $this->db->delete('Rasio_kebutuhan');
        $this->db->where('Kd_rasio', $id);
        $this->db->delete('Detail_rasio');
    }

    function deletepangsaperu($id)
    {
        $this->db->where('Subject', $id);
        $this->db->delete('notif');
        $this->db->where('Kode_hasil', $id);
        $this->db->delete('Pesan_obrolan');
        $this->db->where('Kd_pangsaperu', $id);
        $this->db->delete('Pangsa_perusahaan');
        $this->db->where('Kd_pangsaperu', $id);
        $this->db->delete('Detail_pangsaperu');
    }
}
