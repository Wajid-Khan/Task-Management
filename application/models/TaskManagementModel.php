<?php

class TaskManagementModel extends CI_Model
{
	public function save_task($data)
	{
		$resp = $this->db->insert('task', $data);
		if($resp)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		$count = $this->db->get_where('task', array('task_id' => $id))->num_rows();
		if($count == 0)
		{
			$this->db->where('task_id', $id);
			$resp = $this->db->delete('task');
			if($resp)
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

	public function getTasks()
	{
		$this->db->order_by('created_at', 'desc');
		$resp = $this->db->get('task');
		if(!empty($resp->result()))
		{
			return $resp->result();
		}
		else
		{
			return 0;
		}
	}

	public function getTaskById($id)
	{
		$this->db->where('task_id', $id);
		$resp = $this->db->get('task');
		if(!empty($resp->row()))
		{
			return $resp->row();
		}
		else
		{
			return FALSE;
		}
	}

	public function getTaskId()
	{
		$this->db->select('task_id');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$resp = $this->db->get('task');
		if(!empty($resp->row()))
		{
			return $resp->row()->task_id;
		}
		else
		{
			return 0;
		}
	}

	public function getTodayTask($data)
	{
		if($data->role === 'user') {
			$this->db->where('staff_id', $data->staff_id);
		}
		$this->db->order_by('id', 'desc');
		$this->db->where('date_only', date('Y-m-d'));
		$resp = $this->db->get('task');
        // echo $this->db->last_query();die;
		if(!empty($resp->result_array()))
		{
			return $resp->result();
		}
		else
		{
			return 0;
		}
	}

	public function getYesterdayTask($data)
	{
		if($data->role === 'user') {
			$this->db->where('staff_id', $data->staff_id);
		}
		$this->db->order_by('id', 'desc');
		$this->db->where('date_only', date("Y-m-d", strtotime("yesterday")));
		$resp = $this->db->get('task');
		if(!empty($resp->result_array()))
		{
			return $resp->result();
		}
		else
		{
			return 0;
		}
	}

	public function getLastWeekTask($data, $from, $to)
	{
		if($data->role === 'user') {
			$this->db->where('staff_id', $data->staff_id);
		}

		$this->db->order_by('id', 'desc');
		$this->db->where('created_at BETWEEN "'. $from. '" and "'. $to.'"');
		$resp = $this->db->get('task');
		// echo $this->db->last_query();die;
		if(!empty($resp->result_array()))
		{
			return $resp->result();
		}
		else
		{
			return 0;
		}
	}

	public function searchTasks($client_id, $staff_id, $priority) 
	{
        $this->db->select('*');
        $this->db->from('task');
        $this->db->where('cli_id', $client_id);

        if (!empty($staff_id)) {
            $this->db->where('staff_id', $staff_id);
        }

        if (!empty($priority)) {
            $this->db->where('priority', $priority);
        }

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }

	public function task_start($id, $staff_id) 
	{
        $this->db->where('task_id', $id);
        $this->db->set('task_status', 'In progress');
        $this->db->set('task_start_time', date('Y-m-d H:i:s'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->set('updated_by', $staff_id);
        $query = $this->db->update('task');
        if($query) {
        	return TRUE;
        } else {
        	return FALSE;
        }
    }

	public function task_end($id, $staff_id, $comment) 
	{
        $this->db->where('task_id', $id);
        $this->db->set('comment', $comment);
        $this->db->set('task_status', 'Completed');
        $this->db->set('task_close_time', date('Y-m-d H:i:s'));
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->set('updated_by', $staff_id);
        $query = $this->db->update('task');
        if($query) {
        	return TRUE;
        } else {
        	return FALSE;
        }
    }

	
}