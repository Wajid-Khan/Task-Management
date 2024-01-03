<?php

class StaffModel extends CI_Model
{
	public function create($data)
	{
		$resp = $this->db->insert('staff', $data);
		if($resp)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAllStaff()
	{
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('staff');
		if($res->result())
		{
			return $res->result();
		}
		else
		{
			return false;
		}
	}

	public function getActiveStaff()
	{
		$this->db->where('status','Active');
		$this->db->order_by('staff_id', 'desc');
		$res = $this->db->get('staff');
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
		$count = $this->db->get_where('task', array('staff_id' => $id))->num_rows();
		if($count == 0)
		{
			$this->db->where('staff_id', $id);
			$del = $this->db->delete('staff');
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

	public function update($data, $id)
	{
		$this->db->where('staff_id', $id);
		$upd = $this->db->update('staff', $data);
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
		$count = $this->db->count_all_results('staff');
		return $count;
	}

	public function getTasks()
	{
		$count = $this->db->count_all_results('task');
		return $count;
	}

	public function getStaffName($staff_id)
	{
		$this->db->select('fullname');
		$this->db->where('staff_id', $staff_id);
		$res = $this->db->get('staff');
		$resp = $res->row();
		if(!empty($res->row()))
		{
			return $resp->fullname;
		}
		else
		{
			return false;
		}
	}

	public function getStaffTaskCount($email)
	{
		$email = 'waj@gmail.com';
		$this->db->where('email', $email);
		$result = $this->db->get_where('staff', array('email' => $email))->row();
		if(!empty($result))
		{
			return count($result);
		}
		else
		{
			return 0;
		}
	}

	public function getUserIdByRoleAndEmail($role, $email)
	{
		$this->db->where('email', $email);
		if($role === 'user')
		{
			$result = $this->db->get_where('staff', array('role' => $role, 'email' => $email))->row();
		}
		else
		{
			$result = $this->db->get_where('users', array('role' => $role, 'email' => $email))->row();
		}
		if(!empty($result))
		{
			return $result->id;
		}
		else
		{
			return FALSE;
		}
	}

}