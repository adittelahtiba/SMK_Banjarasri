<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get('pegawai_guru')->result_array();
    }

    function get_pegawai($pg)
    {
        return $this->db->query("SELECT * from pegawai_guru where Nama='" . $pg . "'")->result_array();
    }

    function get_by_id($id_peg)
    {
        $this->db->where('Id_peg', $id_peg);
        return $this->db->get('pegawai_guru')->row_array();
    }

    function get_by_nip($NIP)
    {
        $this->db->where('NIP', $NIP);
        return $this->db->get('pegawai_guru')->row_array();
    }

    function nipbaru()
    {
        $nipbaru = $this->db->query('SELECT max(Id_peg) as NIP FROM pegawai_guru')->row();
        $nipbaru = intval($nipbaru->NIP) + 1;
        return $nipbaru;
    }

    function insert_pegawai($data)
    {
        $this->db->insert('Pegawai_guru', $data);
    }

    function update_pegawai($data, $id)
    {
        $this->db->where('Id_peg', $id);
        $this->db->update('pegawai_guru', $data);
    }

    function update_pegawai2($data, $NIP)
    {
        $this->db->where('NIP', $NIP);
        $this->db->update('pegawai_guru', $data);
    }

    function delete($NIP)
    {
        $this->db->where('NIP', $NIP);
        $this->db->delete('pegawai_guru');
    }
}
