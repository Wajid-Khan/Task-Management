<?php

class Setting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->user_info == FALSE)
		{
			return redirect('login');
		}
		$this->load->model('Settingmodel');
	}

	public function index()
	{
		echo 'Setting module will be start soon...';
	}

	public function areas()
	{
		$data['title'] = "Areas";
		$data['districts'] = $this->Settingmodel->getDistrict();
		$data['areas'] = $this->Settingmodel->getAreas();
		$this->load->view('setting/area', $data);
	}

	public function create_area()
	{
		if(isset($_POST['addArea']))
		{

			$this->form_validation->set_rules('dist_id','District name', 'required');
			$this->form_validation->set_rules('area_name','Area name', 'required|is_unique[areas.area_name]');
			$this->form_validation->set_message('required', 'Area name is required');
			$this->form_validation->set_message('is_unique', '%s is already exists');
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
			if ($this->form_validation->run() == FALSE)
            {
                $data['title'] = "Areas";
				$data['areas'] = $this->Settingmodel->getAreas();
				$this->load->view('setting/area', $data);
            }
            else
            {
            	$area_name = filter_var($this->input->post('area_name'), FILTER_SANITIZE_SPECIAL_CHARS);
                $data = array(
                	'area_id' => 'area_'.time(),
                	'dist_id' => $this->input->post('dist_id'),
                	'area_name' => $area_name,
                );
                $resp = $this->Settingmodel->save_area($data);
                if($resp)
                {
                	$this->session->set_flashdata('succ', 'Area name has been saved...!');
                	return redirect('setting/areas');
                }
                else
                {
                	$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
                	return redirect('setting/areas');
                }
            }
		}
	}

	public function districts()
	{
		$data['title'] = "Districts";
		$data['districts'] = $this->Settingmodel->getDistrict();
		$this->load->view('setting/district', $data);
	}

}