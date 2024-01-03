<?php

/**
 *  Dashboard controller
**/
class Dashboard extends CI_Controller
{
	private $user_data;
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->user_data = $this->session->user_info;
		$this->load->model('categorymodel');
		$this->load->model('clientmodel');
		$this->load->model('staffmodel');
		$this->load->model('rolesmodel');
	}

	public function index()
	{
		$data['category_count'] = $this->categorymodel->getCount();
		$data['client_count'] = $this->clientmodel->getCount();
		$data['staff_count'] = $this->staffmodel->getCount();
		$data['role_count'] = $this->rolesmodel->getCount();
		$data['task_count'] = $this->staffmodel->getTasks();
		$data['single_staff_task'] = $this->staffmodel->getStaffTaskCount($this->user_data->email);
		$data['role'] = $this->user_data->role;
		$this->load->view('dashboard', $data);
	}

}