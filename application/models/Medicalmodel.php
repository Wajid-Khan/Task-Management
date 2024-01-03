<?php

class Medicalmodel extends CI_Model
{
	public function store_medical($data)
	{
		$insert = $this->db->insert('medical_store',$data);
		if($insert)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getStores()
	{
		$this->db->where('is_deleted', '0');
		$this->db->order_by('ms_id', 'desc');
		$data = $this->db->get('medical_store');
		if($data->result())
		{
			return $data->result();
		}
	}

	
}