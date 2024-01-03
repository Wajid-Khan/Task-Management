<?php

/**
 * 
 */
class Settingmodel extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
	}

	public function save_area($data)
	{
		$insert = $this->db->insert('areas',$data);
		if($insert)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAreas()
	{
		$res = $this->db->select('ar.area_id, ar.area_name, ar.area_status, ar.dist_id, dt.dist_name')
			     ->from('areas as ar')
			     ->join('districts as dt', 'ar.dist_id = dt.dist_id', 'INNER')
			     ->order_by('ar.area_name', 'ASC')
			     ->get();
		if($res->result())
		{
			return $res->result();
		}
	}

	public function getActiveAreas()
	{
		$this->db->where('area_status', 1);
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('areas');
		if($data->result())
		{
			return $data->result();
		}
	}

	public function getDistrict()
	{
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('districts');
		if($data->result())
		{
			return $data->result();
		}
	}
}