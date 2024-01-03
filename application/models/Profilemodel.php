<?php

class Profilemodel extends CI_Model
{
	public function upload_image($id, $filename)
	{
		$this->db->where('id', $id);
		$this->db->set('profile_picture', $filename);
		$res = $this->db->update('users');
		if($res) 
		{
			$res = $this->db->get_where('users', array('id' => $id))->row();
			return $res;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function update_admin_profile($id, $data)
	{
		$this->db->where('id', $id);
		$res = $this->db->update('users', $data);
		if($res) 
		{
			$res = $this->db->get_where('users', array('id' => $id))->row();
			return $res;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function update_user_profile($id, $data)
	{
		$this->db->where('id', $id);
		$res = $this->db->update('staff', $data);
		if($res) 
		{
			$res = $this->db->get_where('staff', array('id' => $id))->row();
			return $res;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function upload_user_image($id, $filename)
	{
		$this->db->where('id', $id);
		$this->db->set('profile_picture', $filename);
		$res = $this->db->update('staff');
		// echo $this->db->last_query();die;
		if($res) 
		{
			$res = $this->db->get_where('staff', array('id' => $id))->row();
			return $res;
		} 
		else 
		{
			return FALSE;
		}
	}
}