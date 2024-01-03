<?php

/**
 * Profile controller
 */

class Profile extends CI_Controller
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
		$this->load->model('profilemodel');
	}

	public function index()
	{
		$data['title'] = 'Admin Profile';
		$data['profile'] = $this->user_data;
		$this->load->view('profile', $data);
	}

	public function display_profile_picture()
	{
		$data['profile'] = $this->user_data->profile_picture;
		echo json_encode($data);
	}

	public function user()
	{
		$data['title'] = 'Staff Profile';
		$data['profile'] = $this->user_data;
		$this->load->view('user_profile', $data);
	}

	public function upload_image()
	{
		$config['upload_path'] = './uploads/profile/'; // Set your upload path
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024; // 1 MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_picture')) {
            $data = $this->upload->data();
            $filename = $data['file_name'];
            $id = $this->user_data->id;
            $resp = $this->profilemodel->upload_image($id, $filename);
            if($resp) 
            {
            	$array = array(
            		'noti_title' => 'Changed Profile Picture', 
            		'noti_para' => 'User has been updated a new profile picture.', 
            		'noti_user_id' => $id, 
            	);
            	$this->notification($array);
            	$this->session->set_userdata('user_info', $resp);
            	echo json_encode(['status' => 'success', 'message' => 'Image uploaded successfully']);
            }
            else
            {
            	echo json_encode(['status' => 'error', 'message' => 'Image not uploaded, please try again...!']);
            }
            
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
        }
	}

	public function upload_user_image()
	{
		$config['upload_path'] = './uploads/profile/'; // Set your upload path
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024; // 1 MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_picture')) {
            $data = $this->upload->data();
            $filename = $data['file_name'];
            $id = $this->user_data->id;
            $resp = $this->profilemodel->upload_user_image($id, $filename);
            if($resp) 
            {
            	$array = array(
            		'noti_title' => 'Changed Profile Picture', 
            		'noti_para' => 'User has been updated a new profile picture.', 
            		'noti_user_id' => $id, 
            	);
            	$this->notification($array);
            	$this->session->set_userdata('user_info', $resp);
            	echo json_encode(['status' => 'success', 'message' => 'Image uploaded successfully']);
            }
            else
            {
            	echo json_encode(['status' => 'error', 'message' => 'Image not uploaded, please try again...!']);
            }
            
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
        }
	}

	public function update()
	{
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if($this->input->post('password'))
        {
        	$this->form_validation->set_rules('password', 'New Password', 'min_length[5]');
        }
        
        if ($this->form_validation->run() === FALSE) 
        {
            $data['title'] = 'Admin Profile';
			$data['profile'] = $this->user_data;
			$this->load->view('profile', $data);
        } 
        else 
        {
            $id = $this->user_data->id;
            
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
            );

            $new_password = $this->input->post('password');
            if (!empty($new_password)) {
                $data['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            }

            // Update user data in the database
            $resp = $this->profilemodel->update_admin_profile($id, $data);
            if($resp) 
            {
            	$array = array(
            		'noti_title' => 'Updated Profile', 
            		'noti_para' => 'User has been updated a profile detail.', 
            		'noti_user_id' => $id, 
            	);
            	$this->notification($array);
            	$this->session->set_userdata('user_info', $resp);
            	$this->session->set_flashdata('succ', 'User profile has been updated...!');
            	redirect('profile');
            }
            else
            {
            	$this->session->set_flashdata('fail', 'Something went wrong, please try again...!');
            	redirect('profile');
            }
        }
	}

	public function update_user()
	{
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|integer');
        $this->form_validation->set_rules('about', 'About', 'required|max_length[1000]');
        if($this->input->post('password'))
        {
        	$this->form_validation->set_rules('password', 'New Password', 'min_length[5]');
        }
        if ($this->form_validation->run() === FALSE) 
        {
            $data['title'] = 'Staff Profile';
			$data['profile'] = $this->user_data;
			$this->load->view('user_profile', $data);
        } 
        else 
        {
            $id = $this->user_data->id;
            
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'about' => $this->input->post('about'),
            );

            $new_password = $this->input->post('password');
            if (!empty($new_password)) {
                $data['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            }

            // Update user data in the database
            $resp = $this->profilemodel->update_user_profile($id, $data);
            if($resp) 
            {
            	$array = array(
            		'noti_title' => 'Updated Profile', 
            		'noti_para' => 'User has been updated a profile detail.', 
            		'noti_user_id' => $id, 
            	);
            	$this->notification($array);
            	$this->session->set_userdata('user_info', $resp);
            	$this->session->set_flashdata('succ', 'User profile has been updated...!');
            	redirect('profile/user');
            }
            else
            {
            	$this->session->set_flashdata('fail', 'Something went wrong, please try again...!');
            	redirect('profile/user');
            }
        }
	}

	public function notification($data)
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
}