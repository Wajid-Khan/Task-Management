<?php

/**
 * Category controller
 */
class Category extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->user_data = $this->session->user_info;
		$this->load->model('categorymodel');
	}

	public function index()
	{
		$data['title'] = 'Task Category';
		$data['category'] = $this->categorymodel->get();
		$this->load->view('category/category', $data);
	}

	public function create()
	{
		if(isset($_POST['addTaskCat']))
		{
			$this->form_validation->set_rules('cat_name','Task category', 'required|is_unique[category.cat_name]');
			$this->form_validation->set_message('required', 'Task category is required');
			$this->form_validation->set_message('is_unique', '%s is already exists');
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
			if ($this->form_validation->run() == FALSE)
            {
                $data['title'] = 'Task Category';
				$this->load->view('category', $data);
            }
            else
            {
                $data = array(
                	'cat_id' => 'cat_'.time(),
                	'cat_name' => $this->input->post('cat_name'),
                );
                $resp = $this->categorymodel->save($data);
                if($resp)
                {
                	$this->session->set_flashdata('succ', 'Task category has been saved...!');
                	return redirect('category');
                }
                else
                {
                	$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
                	return redirect('category');
                }
            }
		}
	}

	public function delete($id) 
	{
		$resp = $this->categorymodel->delete(base64_decode($id));
		if($resp === 'deleted')
		{
			$this->session->set_flashdata('succ', 'Task category has been deleted...!');
			return redirect('category');
		}
		else if($resp === 'exists')
		{
			$this->session->set_flashdata('warn', 'Category is already associated with task, You cannot delete this category...!');
			return redirect('category');
		}
		else
		{
			$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
			return redirect('category');
		}
	}

	public function update()
	{
		if(isset($_POST['editTaskCat']))
		{
			$this->form_validation->set_rules('cat_name_1','Task category', 'required');
			$this->form_validation->set_message('required', 'Task category is required');
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
			if ($this->form_validation->run() == FALSE)
            {
                $data['title'] = 'Task Category';
				$this->load->view('category/category', $data);
            }
            else
            {
                $data = array(
                	'cat_name' => $this->input->post('cat_name_1'),
                	'cat_status' => $this->input->post('cat_status_1'),
                );
				$id = $this->input->post('cat_id');
                $resp = $this->TaskManagementModel->tast_category_update($data, $id);
                if($resp)
                {
                	$this->session->set_flashdata('succ', 'Task category has been updated...!');
                	return redirect('category');
                }
                else
                {
                	$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
                	return redirect('category');
                }
            }
		}
	}
}