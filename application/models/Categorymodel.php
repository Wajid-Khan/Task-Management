<?php

/**
 * Category model
 */
class Categorymodel extends CI_Model
{
	public function save($data)
	{
		$resp = $this->db->insert('category', $data);
		if($resp)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get()
	{
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('category');
		if($res->result())
		{
			return $res->result();
		}
		else
		{
			return false;
		}
	}

	public function getActiveCategory()
	{
		$this->db->where('cat_status','Active');
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('category');
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
		$count = $this->db->get_where('task', array('cat_id' => $id))->num_rows();
		if($count == 0)
		{
			$this->db->where('cat_id', $id);
			$del = $this->db->delete('category');
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
		$this->db->where('cat_id', $id);
		$upd = $this->db->update('category', $data);
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
		$count = $this->db->count_all_results('category');
		return $count;
	}
}