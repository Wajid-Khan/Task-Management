<?php  

class Loginmodel extends CI_Model
{

	public function signin($data)
	{
		if($data['role'] === 'admin') {
			$query = $this->db->get_where('users', array('email' => $data['email']));
		} else {
			$query = $this->db->get_where('staff', array('email' => $data['email']));
		}
		
		$data = $query->row();
		if(!empty($data))
		{
			return $data;
		}
	}

	public function check_user_exist()
	{
		$data = $this->db->count_all_results('users');
		if($data == 0)
		{
			return $data;
		}
		else
		{
			return 1;
		}
	}

	public function signup($data)
	{
		$data = $this->db->insert('users', $data);
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}