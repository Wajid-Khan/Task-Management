<?php

/**
 * Clients controller
 */

class Clients extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->load->model('clientmodel');
	}

	public function index()
	{
		$data['title'] = 'Clients';
        $data['clients'] = $this->clientmodel->getAllClients();
		$this->load->view('clients', $data);
	}

	public function create()
	{
        $this->form_validation->set_rules('cli_name','Client name', 'required|is_unique[clients.cli_name]');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('is_unique', '%s is already exists');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE)
        {
            $array = array(
                'error'   => true,
                'name_error' => form_error('cli_name'),
                'message' => ''
            );
        }
        else
        {
            $data = array(
                'cli_id' => 'cli_'.time(),
                'cli_name' => $this->input->post('cli_name'),
            );
            $resp = $this->clientmodel->create($data);
            if($resp)
            {
                $array = array(
                    'error'   => false,
                    'name_error' => '',
                    'message' => '<div class="alert alert-success pad_65_font_13">Client has been saved, <br><strong>page will be refreshed in <span id="countdowntimer">5 </span> seconds<strong></div>'
                );
            }
            else
            {
                $array = array(
                    'error'   => true,
                    'name_error' => '',
                    'message' => '<div class="alert alert-danger pad_65_font_13">something went wrong, please try again...!</div>'
                );
            }
        }
        echo json_encode($array);
	}

	public function delete($id) 
	{
		$resp = $this->clientmodel->delete(base64_decode($id));
		if($resp === 'deleted')
		{
			$this->session->set_flashdata('succ', 'Client has been deleted...!');
			return redirect('clients');
		}
		else if($resp === 'exists')
		{
			$this->session->set_flashdata('warn', 'Client is already associated with task, You cannot delete this client...!');
			return redirect('clients');
		}
        else
        {
            $this->session->set_flashdata('fail', 'something went wrong, please try again...!');
            return redirect('clients');
        }
	}

	public function update()
	{
		$this->form_validation->set_rules('cli_name','Client name', 'required');
		$this->form_validation->set_rules('cli_status','Client status', 'required');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE)
        {
            $array = array(
                'error'   => true,
                'name_error' => form_error('cli_name'),
                'status_error' => form_error('cli_status'),
                'message' => ''
            );
        }
        else
        {
            $data = array(
                'cli_id' => $this->input->post('cli_id'),
                'cli_name' => $this->input->post('cli_name'),
                'cli_status' => $this->input->post('cli_status'),
            );
            $resp = $this->clientmodel->update($data);
            if($resp)
            {
                $array = array(
                    'error'   => false,
                    'name_error' => '',
                    'status_error' => '',
                    'message' => '<div class="alert alert-success pad_65_font_13">Client has been updated, <br><strong>page will be refreshed in <span id="countdowntimer">5 </span> seconds</strong></div>'
                );
            }
            else
            {
                $array = array(
                    'error'   => true,
                    'name_error' => '',
                    'status_error' => '',
                    'message' => '<div class="alert alert-danger pad_65_font_13">something went wrong, please try again...!</div>'
                );
            }
        }
        echo json_encode($array);
	}

}