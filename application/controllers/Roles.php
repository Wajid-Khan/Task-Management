<?php

/**
 * Roles controller
 */

class Roles extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->load->model('rolesmodel');
	}

	public function index()
	{
		$data['title'] = 'Roles';
        $data['roles'] = $this->rolesmodel->getAllRoles();
		$this->load->view('role_list', $data);
	}

	public function create()
	{
        $this->form_validation->set_rules('role_name','Role name', 'required|is_unique[roles.role_name]');
        $this->form_validation->set_message('required', 'Role name is required');
        $this->form_validation->set_message('is_unique', '%s is already exists');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE)
        {
            $array = array(
                'error'   => true,
                'name_error' => form_error('role_name'),
                'message' => ''
            );
        }
        else
        {
            $data = array(
                'role_id' => 'role_'.time(),
                'role_name' => $this->input->post('role_name'),
            );
            $resp = $this->rolesmodel->create($data);
            if($resp)
            {
                $array = array(
                    'error'   => false,
                    'name_error' => '',
                    'message' => '<div class="alert alert-success pad_65_font_13">Role has been saved, <br><strong>page will be refreshed in <span id="countdowntimer">5 </span> seconds</strong></div>'
                );
            }
            else
            {
                $array = array(
                    'error'   => true,
                    'name_error' => '',
                    'message' => '<div class="alert alert-danger">something went wrong, please try again...!</div>'
                );
            }
        }
        echo json_encode($array);
	}

	public function delete($id) 
	{
		$resp = $this->rolesmodel->delete(base64_decode($id));
		if($resp === 'deleted')
		{
			$this->session->set_flashdata('succ', 'Role has been deleted...!');
			return redirect('roles');
		}
		else if($resp === 'exists')
		{
			$this->session->set_flashdata('warn', 'Role is already associated with staff, You cannot delete this role...!');
			return redirect('roles');
		}
        else
        {
            $this->session->set_flashdata('fail', 'something went wrong, please try again...!');
            return redirect('roles');
        }
	}

	public function update()
	{
		$this->form_validation->set_rules('role_name','Role name', 'required');
		$this->form_validation->set_rules('role_status','Role status', 'required');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE)
        {
            $array = array(
                'error'   => true,
                'name_error' => form_error('role_name'),
                'status_error' => form_error('role_status'),
                'message' => ''
            );
        }
        else
        {
            $data = array(
                'role_id' => $this->input->post('role_id'),
                'role_name' => $this->input->post('role_name'),
                'role_status' => $this->input->post('role_status'),
            );
            $resp = $this->rolesmodel->update($data);
            if($resp)
            {
                $array = array(
                    'error'   => false,
                    'name_error' => '',
                    'status_error' => '',
                    'message' => '<div class="alert alert-success pad_65_font_13">Role has been updated, <br><strong>page will be refreshed in <span id="countdowntimer">5 </span> seconds</strong></div>'
                );
            }
            else
            {
                $array = array(
                    'error'   => true,
                    'name_error' => '',
                    'status_error' => '',
                    'message' => '<div class="alert alert-danger">something went wrong, please try again...!</div>'
                );
            }
        }
        echo json_encode($array);
	}

}