<?php

/**
 * ForgetPasswordModel
 */

class ForgetPasswordModel extends CI_Model
{
	public function check_email_exists($role, $email)
	{
		if($role === 'admin')
		{
			$resp = $this->db->get_where('users', array('email' => $email));
		}
		else
		{
			$resp = $this->db->get_where('staff', array('email' => $email));
		}
		
		if(!empty($resp->row()))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function update_new_password($role, $email, $password)
	{
		$this->db->where('email', $email);
		$this->db->set('password', $password);
		if($role === 'admin')
		{
			$resp = $this->db->update('users');
		}
		else
		{
			$resp = $this->db->update('staff');
		}
		if($resp)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}