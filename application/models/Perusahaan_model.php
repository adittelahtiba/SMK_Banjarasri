<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{
    function get_all()
    {
        return $this->db->get('perusahaan')->result_array();
    }

    function get_byid($id)
    {
        $this->db->where('Id_perusahaan', $id);
        return $this->db->get('perusahaan')->row_array();
    }

    function Insert_perusahaan($data)
    {
        $this->db->insert('Perusahaan', $data);
    }

    function delete($id)
    {
        $this->db->where('Id_perusahaan', $id);
        $this->db->delete('perusahaan');
    }

    function update_perusahaan($data, $id)
    {
        $this->db->where('Id_perusahaan', $id);
        $this->db->update('perusahaan', $data);
    }
}
