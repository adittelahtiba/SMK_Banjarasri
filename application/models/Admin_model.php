<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	function get_all()
	{	
		$this->db->where('role <> 1');
    	return $this->db->get('admin')->result_array();
	}

	function insert($data)
	{	
		$this->db->insert('Admin', $data);
	}

	function get_by_id($id)
	{	
		$this->db->where('id', $id);
    	return $this->db->get('Admin')->row_array();
	}

	function get_by_id_noarray($id)
	{	
		$this->db->where('id', $id);
    	return $this->db->get('Admin')->row();
	}

	function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('Admin', $data);
    }

	function delete($id)
    {
    	$this->db->where('id', $id);
        $this->db->delete('Admin');
    }
}