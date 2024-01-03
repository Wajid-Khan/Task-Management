<?php

class Clientmodel extends CI_Model
{
    public function create($data)
	{
		$resp = $this->db->insert('clients', $data);
		if($resp)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getAllClients()
	{
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('clients');
		if($res->result())
		{
			return $res->result();
		}
		else
		{
			return false;
		}
	}

	public function getActiveClients()
	{
		$this->db->where('cli_status','Active');
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('clients');
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
		$count = $this->db->get_where('task', array('cli_id' => $id))->num_rows();
		if($count == 0)
		{
			$this->db->where('cli_id', $id);
			$del = $this->db->delete('clients');
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
		$this->db->where('cli_id', $data['cli_id']);
		$upd = $this->db->update('clients', $data);
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
		$count = $this->db->count_all_results('clients');
		return $count;
	}

	public function getClientName($cli_id)
	{
		$this->db->select('cli_name');
		$this->db->where('cli_id', $cli_id);
		$res = $this->db->get('clients');
		$resp = $res->row();
		if(!empty($res->row()))
		{
			return $resp->cli_name;
		}
		else
		{
			return false;
		}
	}
}