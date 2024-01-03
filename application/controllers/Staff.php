<?php

/**
 * Staff controller
 */

class Staff extends CI_Controller
{
	private $user_data = [];
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->user_data = $this->session->user_info;
		$this->load->model('staffmodel');
		$this->load->model('rolesmodel');
	}

	public function index()
	{
		$data['title'] = 'Staff';
        $data['staff'] = $this->staffmodel->getAllStaff();
		$this->load->view('staff/Staff_list', $data);
	}

    public function create()
    {
        $data['title'] = 'Create';
		$data['roles'] = $this->rolesmodel->getActiveMembers();
        $this->load->view('staff/create', $data);
    }

	public function save_staff()
	{
		$this->form_validation->set_rules('fullname','Full name', 'required|is_unique[staff.fullname]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[staff.email]|max_length[50]');
		$this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[staff.phone]|exact_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('role_id', 'Role', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('is_unique', '%s is already exists');
		$this->form_validation->set_message('valid_email', '%s is invalid');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Create';
			$data['roles'] = $this->rolesmodel->getActiveMembers();
			$this->load->view('staff/create', $data);
		}
		else
		{

			$data = array(
				'staff_id' => 'staff_'.time(),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone' => $this->input->post('phone'),
				'status' => $this->input->post('status'),
				'about' => $this->input->post('about'),
				'role_id' => $this->input->post('role_id'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->user_data->email,
			);
			$resp = $this->staffmodel->create($data);
			if($resp)
			{
				$this->session->set_flashdata('succ', 'Staff has been saved...!');
				return redirect('staff');
			}
			else
			{
				$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
				return redirect('staff');
			}
		}
	}

	public function delete($id) 
	{
		$resp = $this->staffmodel->delete(base64_decode($id));
		if($resp === 'deleted')
		{
			$this->session->set_flashdata('succ', 'Staff has been deleted...!');
			return redirect('staff');
		}
		else if($resp === 'exists')
		{
			$this->session->set_flashdata('warn', 'Staff is already associated with task, You cannot delete this staff...!');
			return redirect('staff');
		}
		else
		{
			$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
			return redirect('staff');
		}
	}

	public function edit($id)
	{
		echo base64_decode($id);
	}

	public function randomPassword() 
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$&*();_';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		echo implode($pass); 
	}
}