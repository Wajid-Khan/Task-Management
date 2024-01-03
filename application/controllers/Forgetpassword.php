<?php

/**
 * Forgetpassword controller
**/

class Forgetpassword extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ForgetPasswordModel');
	}

	public function index()
	{
		$data['title'] = 'Forget Password';
		$this->load->view('forgetpassword', $data);
	}

	public function check_email_exists()
	{	
		$this->form_validation->set_rules('role','Role', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Forget Password';
			$this->load->view('forgetpassword', $data);
		}
		else
		{
			$role = $this->input->post('role');
			$email   = $this->input->post('email');
			$resp = $this->ForgetPasswordModel->check_email_exists($role, $email);
			$id = $this->getUserIdByRoleAndEmail($role, $email);
			if($resp == true)
			{
				$array = array(
            		'noti_title' => 'Forget password request',
            		'noti_para' => 'Authencating user email and role.',
            		'noti_user_id' => $id,
            	);
            	$this->save_notifications($array);
				return redirect("forgetpassword/new_password?role=".base64_encode($role)."&email=".base64_encode($email));
			}
			else
			{
				$this->session->set_flashdata('fail', 'Email address doesnot exists, please check email and role...!');
				return redirect('forgetpassword');
			}
		}
	}

	public function new_password()
	{
		$data['title'] = 'New Password';
		$this->load->view('new_password', $data);
	}

	public function update_new_password()
	{	
		$this->form_validation->set_rules('newPassword','New password', 'required');
		$this->form_validation->set_rules('confirmPassword','Confirm password', 'required|matches[newPassword]');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = 'fail';
			$data['message'] = validation_errors();
			echo json_encode($data);
		}
		else
		{
			$role = $this->input->post('role');
			$email   = $this->input->post('email');
			$password   = password_hash($this->input->post('newPassword'), PASSWORD_DEFAULT);
			$resp = $this->ForgetPasswordModel->update_new_password($role, $email, $password);
			$id = $this->getUserIdByRoleAndEmail($role, $email);

			if($resp == TRUE)
			{
				$array = array(
            		'noti_title' => 'Set new password', 
            		'noti_para' => 'User has been reste his password.', 
            		'noti_user_id' => $id, 
            	);
            	$this->save_notifications($array);
				$data['status'] = 'success';
				$data['message'] = null;
				echo json_encode($data);
			}
			else
			{
				$data['status'] = 'fail';
				$data['message'] = 'Something went wrong, please try again with correct values';
				echo json_encode($data);
			}
		}
	}

	public function save_notifications($data)
	{
		$notification = array(
			'noti_title' => $data['noti_title'],
			'noti_para' => $data['noti_para'],
			'noti_user_id' => $data['noti_user_id'],
			'created_at' => date('Y-m-d H:i:s'),
		);
		$this->load->model('notificationmodel');
		$this->notificationmodel->save_notification($notification);
	}

	public function getUserIdByRoleAndEmail($role, $email)
	{
		$this->load->model('StaffModel');
		return $this->StaffModel->getUserIdByRoleAndEmail($role, $email);
	}
}