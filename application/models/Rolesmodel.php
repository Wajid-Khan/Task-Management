<?php

class Rolesmodel extends CI_Model
{
    public function create($data)
	{
		$resp = $this->db->insert('roles', $data);
		if($resp)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAllRoles()
	{
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('roles');
		if($res->result())
		{
			return $res->result();
		}
		else
		{
			return false;
		}
	}

	public function getActiveMembers()
	{
		$this->db->where('role_status','Active');
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('roles');
		if($res->result())
		{
			return $res->result();
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		$count = $this->db->get_where('staff', array('role_id' => $id))->num_rows();
		if($count == 0)
		{
			$this->db->where('role_id', $id);
			$del = $this->db->delete('roles');
			if($del)
			{
				return 'deleted';
			}
			else
			{
				return false;
			}
		}
		else
		{
			return 'exists';
		}
			
	}

	public function update($data)
	{
		$this->db->where('role_id', $data['role_id']);
		$upd = $this->db->update('roles', $data);
		if($upd)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getCount()
	{
		$count = $this->db->count_all_results('roles');
		return $count;
	}
}