<?php

class Doctormodel extends CI_Model
{
	public function store_doctor($data)
	{
		$insert = $this->db->insert('doctors',$data);
		if($insert)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getDoctors()
	{
		$this->db->where('doc_is_deleted', '0');
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('doctors');
		if($data->result())
		{
			return $data->result();
		}
	}

	
}