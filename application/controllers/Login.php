<?php

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == TRUE)
		{
			return redirect('dashboard');
		}
		$this->load->model('Loginmodel');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function signin()
	{
		$this->form_validation->set_rules('role','Role','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('login');
		}
		else 
		{
			// print_r($_POST);die;
			$data['role'] 	  = $this->input->post('role');
			$data['email'] 	  = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$result = $this->Loginmodel->signin($data);
			if(empty($result))
			{
				$this->session->set_flashdata('email', 'Email not exist...');
				$this->load->view('login');
			}
			else 
			{
				if(password_verify($data['password'], $result->password))
				{
					$this->session->set_userdata('user_info', $result);
					return redirect('dashboard');
				}
				else
				{
					$this->session->set_flashdata('pwd', 'Password does not match...');
					$this->load->view('login');
				}
			}
		}
	}

	public function check_user_exist()
	{
		$resp = $this->Loginmodel->check_user_exist();
		echo $resp;
	}

	public function signup()
	{
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[20]');
		$this->form_validation->set_message('required','%s is required');
		$this->form_validation->set_message('valid_email','%s is invalid');
		$this->form_validation->set_message('is_unique','%s is already exists');
		$this->form_validation->set_message('min_length','%s should be more than 6 characters');
		$this->form_validation->set_message('max_length','%s length exceeds the limit');
		$this->form_validation->set_error_delimiters('<span class="error">','</span>');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('login');
		}
		else
		{
			$data['name'] 	  = $this->input->post('name');
			$data['email'] 	  = $this->input->post('email');
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$res = $this->Loginmodel->signup($data);
			if($res)
			{
				$this->session->set_flashdata('succ', 'You have successfully sign up, kindly login with given credentials');
				return redirect('login');
			}
			else
			{
				$this->session->set_flashdata('fail', 'Something went wrong, please try again');
				return redirect('login');
			}
		}
	}
}
