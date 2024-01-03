<?php

/**
 * Task controller
 */
class Task extends CI_Controller
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
		$this->load->model('TaskManagementModel');
		$this->load->model('staffmodel');
		$this->load->model('clientmodel');
		$this->load->model('categorymodel');
	}

	// public function index()
	// {
	// 	$data['title'] = 'Quick Find';
	// 	$data['tasks'] = $this->TaskManagementModel->getTasks();
	// 	$data['task_cat'] = $this->categorymodel->getActiveCategory();
	// 	$data['staff'] = $this->staffmodel->getActiveStaff();
	// 	$data['clients'] = $this->clientmodel->getActiveClients();
	// 	$data['user'] = $this->user_data;
	// 	$this->load->view('task/task_list', $data);
	// }

	public function search()
	{
		$data['title'] = 'Quick Search';
		$data['tasks'] = $this->TaskManagementModel->getTasks();
		$data['task_cat'] = $this->categorymodel->getActiveCategory();
		$data['staff'] = $this->staffmodel->getActiveStaff();
		$data['clients'] = $this->clientmodel->getActiveClients();
		$data['user'] = $this->user_data;
		$this->load->view('task/staff_task_search', $data);
	}

	public function create()
	{
		$data['title'] = 'Create Task';
		$data['task_cat'] = $this->categorymodel->getActiveCategory();
		$data['staff'] = $this->staffmodel->getActiveStaff();
		$data['clients'] = $this->clientmodel->getActiveClients();
		$this->load->view('task/task_create', $data);
	}

	public function save_task()
	{
		$this->form_validation->set_rules('cat_id','Category', 'required');
		$this->form_validation->set_rules('staff_id','Staff', 'required');
		$this->form_validation->set_rules('cli_id','Client', 'required');
		$this->form_validation->set_rules('priority','Priority', 'required');
		$this->form_validation->set_rules('task_title','Title', 'required|max_length[250]');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('max_length', '%s exceeded 250 characters');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Create Task';
			$data['task_cat'] = $this->categorymodel->getActiveCategory();
			$data['staff'] = $this->staffmodel->getActiveStaff();
			$data['clients'] = $this->clientmodel->getActiveClients();
			$this->load->view('task/task_create', $data);
		}
		else
		{
			$data = array(
				'task_id'    => $this->getTaskId(),
				'cat_id'     => $this->input->post('cat_id'),
				'staff_id'   => $this->input->post('staff_id'),
				'cli_id' 	 => $this->input->post('cli_id'),
				'priority' 	 => $this->input->post('priority'),
				'task_title' => $this->input->post('task_title'),
				'task_desc'  => $this->input->post('task_desc'),
				'date_only'  => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->user_data->user_id,
			);

			$resp = $this->TaskManagementModel->save_task($data);
			if($resp == true)
			{
				$this->session->set_flashdata('succ', 'Task has been created...!');
				return redirect('task/today');
			}
			else
			{
				$this->session->set_flashdata('fail', 'something went wrong, please try again...!');
				return redirect('task/create');
			}
		}
	}

	public function getTaskId()
	{
		$resp = $this->TaskManagementModel->getTaskId();
		$id = '';
		if($resp != 0)
		{
			$arr = explode('_', $resp);
			$i = $arr[1];
			$i = $i + 1;
			$id = 'task_'.$i;
		}
		else
		{
			$id = "task_101";
		}
		return $id;
	}

	// Email notiication after every task assigned
	public function send_task_email($array)
	{
		$this->load->library("phpmailer_library");
        $objMail = $this->phpmailer_library->load();

        try {
	        //Server settings
	        $mail->SMTPDebug = SMTP::DEBUG_OFF;
	        $mail->isSMTP();                   
	        $mail->Host       = 'mail.aioaconhyd2023.com';
	        $mail->SMTPAuth   = true;                     
	        $mail->Username   = 'info@aioaconhyd2023.com';
	        $mail->Password   = 'LI1CuRtjgdVA';           
	        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	        $mail->Port       = 465;                        
	    
	        //Recipients
	        $mail->setFrom($email, $name);
	        $mail->addAddress($array['email'], $array['name']);
	        // $mail->addReplyTo($array[''], $array['']);
	        $mail->addCC('wajid.developer1@gmail.com');
	    
	        //Content
	        $mail->isHTML(true);
	        $mail->Subject = 'Your New Task';
	        $mail->Body    = '<h4>Hello <b>'.$array['name'].'</b>, </h4>
	        <p>New task assigned, kindly login to your account and completed it.</p>
	        <br><br>
	        <p>From Admin</p>
	        ';
	    
	        $mail->send();
	        return true;
	    } catch (Exception $e) {
	        return false;
	        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    }
	}

	public function edit($id)
	{
		$data['task'] = $this->TaskManagementModel->getTaskById($id);
		print_r($data['task']);die;
		$this->load->view('task/task_edit', $data);
	}

	public function update()
	{

	}

	public function delete($id)
	{
		$resp = $this->TaskManagementModel->delete($id);
		if ($resp === 'deleted') 
		{
			echo 'Task has been deleted...';
		}
		else if($resp === 'exists')
		{
			echo 'Task is already started by staff, You cannot delete this task...!';
		}
		else 
		{
			echo 'Something went wrong, try again...';
		}
	}

	public function today()
	{
		$data['title'] = "Today's Task";
		$data['tasks'] = $this->TaskManagementModel->getTodayTask($this->session->user_info);
		$data['user'] = $this->user_data;
		// print_r($data['tasks']);die;
		$this->load->view('task/task_today', $data);
	}


	public function yesterday()
	{
		$data['title'] = "Yesterday's Task";
		$data['tasks'] = $this->TaskManagementModel->getYesterdayTask($this->session->user_info);
		$data['user'] = $this->user_data;
		$this->load->view('task/task_yesterday', $data);
	}

	public function last_week()
	{
		$data['title'] = "Last Week Task";
		$lastWeekFirstDay = date('Y-m-d', strtotime('last week monday'));
		$lastWeekLastDay = date('Y-m-d', strtotime('last week sunday'));
		$data['user'] = $this->user_data;
		$data['tasks'] = $this->TaskManagementModel->getLastWeekTask($this->session->user_info, $lastWeekFirstDay, $lastWeekLastDay);
		$this->load->view('task/task_last_week', $data);
	}

	public function this_week()
	{
		$data['title'] = "This Week Task"; 

		// Get the current day of the week (0 = Monday, 1 = Tuesday, ..., 6 = Sunday)
		$currentDayOfWeek = date('w');

		// Calculate the date for the start of the week (Monday)
		$weekStartDate = date("Y-m-d", strtotime(date('o-\\WW')));

		// Calculate the date for the end of the week (Sunday)
		$weekEndDate = date("Y-m-d", strtotime("next sunday"));

		$data['user'] = $this->user_data;
		$data['tasks'] = $this->TaskManagementModel->getLastWeekTask($this->session->user_info, $weekStartDate, $weekEndDate);
		$this->load->view('task/task_last_week', $data);
	}

	public function this_month()
	{
		$data['title'] = "This Month Task";

		// Get the current month and year
		$currentMonth = date('m');
		$currentYear = date('Y');

		// Calculate the start and end dates for the current month
		$currentMonthStartDate = $currentYear . '-' . $currentMonth . '-01';
		$currentMonthEndDate = date('Y-m-t', strtotime($currentMonthStartDate));

		$data['user'] = $this->user_data;
		$data['tasks'] = $this->TaskManagementModel->getLastWeekTask($this->session->user_info, $currentMonthStartDate, $currentMonthEndDate);
		$this->load->view('task/task_last_week', $data);
	}

	public function last_month()
	{
		$data['title'] = "Last Month Task";

		// Get the current month and year
		$currentMonth = date('m');
		$currentYear = date('Y');

		$currentMonthStartDate = $currentYear . '-' . $currentMonth . '-01';

		// Calculate the start and end dates for the last month
		$lastMonthStartDate = date('Y-m-d', strtotime('-1 month', strtotime($currentMonthStartDate)));
		$lastMonthEndDate = date('Y-m-t', strtotime($lastMonthStartDate));

		$data['user'] = $this->user_data;
		$data['tasks'] = $this->TaskManagementModel->getLastWeekTask($this->session->user_info, $lastMonthStartDate, $lastMonthEndDate);
		$this->load->view('task/task_last_week', $data);
	}

	public function search_tasks()
	{
		$client_id = $this->input->post('cli_id');
		$staff_id = $this->input->post('staff_id');
        $priority = $this->input->post('priority');

        // Perform search in the model
        $tasks = $this->TaskManagementModel->searchTasks($client_id, $staff_id, $priority);
        // echo 'asd';print_r($tasks);die;
        $table = '';
        if (!empty($tasks)): foreach ($tasks as $task):
        	$table .= '
	                <tr class="fw-normal">
	                  <th>
	                    <span class="">'.$this->getClientName($task->cli_id).'</span>
	                  </th>
	                  <th>
	                    <span class="">'.$this->getStaffName($task->staff_id).'</span>
	                  </th>
	                  <td class="align-middle">
	                    <span>'.$task->task_title.'</span>
	                  </td>
	                  <td class="align-middle">
	                    <h6 class="mb-0"><span class="badge '.$this->getBackground($task->priority).'">'.$task->priority.'</span></h6>
	                  </td>
	                  <td class="align-middle">
	                    <span>'.$task->task_status.'</span>
	                  </td>
	                  <td class="align-middle">
	                    <span>'.$this->timeAgo($task->created_at).'</span>
	                  </td>
	                  <td class="align-middle">
	                    <a href="#!" data-mdb-toggle="tooltip" title="View"><i
	                        class="fas fa-eye text-success me-2"></i></a>
	                    <a href="#!" data-mdb-toggle="tooltip" title="Edit"><i
	                        class="fas fa-edit text-warning me-2"></i></a>
	                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
	                        class="fas fa-trash-alt text-danger"></i></a>
	                  </td>
	                </tr>
	              ';
        endforeach; else:
        	$table .= '<tr class="fw-normal"><td class="align-middle text-center" colspan="7">No data found...</td></tr>';
    	endif;

		echo json_encode($table);

	}

	public function search_staff_tasks()
	{
		$client_id = $this->input->post('cli_id');
		$staff_id = $this->session->user_info->staff_id;
        $priority = $this->input->post('priority');

        // Perform search in the model
        $tasks = $this->TaskManagementModel->searchTasks($client_id, $staff_id, $priority);
        // echo 'asd';print_r($tasks);die;
        $table = '';
        if (!empty($tasks)): foreach ($tasks as $task):
        	$table .= '
	                <tr class="fw-normal">
	                  <th>
	                    <span class="">'.$this->getClientName($task->cli_id).'</span>
	                  </th>
	                  <td class="align-middle">
	                    <span>'.$task->task_title.'</span>
	                  </td>
	                  <td class="align-middle">
	                    <h6 class="mb-0"><span class="badge '.$this->getBackground($task->priority).'">'.$task->priority.'</span></h6>
	                  </td>
	                  <td class="align-middle">
	                    <span>'.$task->task_status.'</span>
	                  </td>
	                  <td class="align-middle">
	                    <span>'.$this->timeAgo($task->created_at).'</span>
	                  </td>
	                  <td class="align-middle">
	                    <a href="#!" data-mdb-toggle="tooltip" title="View"><i
	                        class="fas fa-eye text-success me-2"></i></a>
	                    <a href="#!" data-mdb-toggle="tooltip" title="Edit"><i
	                        class="fas fa-edit text-warning me-2"></i></a>
	                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
	                        class="fas fa-trash-alt text-danger"></i></a>
	                  </td>
	                </tr>
	              ';
        endforeach; else:
        	$table .= '<tr class="fw-normal"><td class="align-middle text-center" colspan="7">No data found...</td></tr>';
    	endif;

		echo json_encode($table);

	}

	public function getClientName($cli_id)
	{
		return $this->clientmodel->getClientName($cli_id);
	}

	public function getStaffName($staff_id)
	{
		return $this->staffmodel->getStaffName($staff_id);
	}

	public function getBackground($p)
	{
		if($p === 'High'){
			return 'bg-danger';
		} else if($p === 'Medium') {
			return 'bg-warning';
		} else {
			return 'bg-info';
		}
	}

	public function timeAgo($created_at)
	{
		$time_ago = strtotime($created_at);
	    $cur_time   = time();
	    $time_elapsed   = $cur_time - $time_ago;
	    $seconds    = $time_elapsed ;
	    $minutes    = round($time_elapsed / 60 );
	    $hours      = round($time_elapsed / 3600);
	    $days       = round($time_elapsed / 86400 );
	    $weeks      = round($time_elapsed / 604800);
	    $months     = round($time_elapsed / 2600640 );
	    $years      = round($time_elapsed / 31207680 );
	    // Seconds
	    if($seconds <= 60){
	        return "Just now";
	    }
	    //Minutes
	    else if($minutes <=60){
	        if($minutes==1){
	            return "1 min ago";
	        }
	        else{
	            return "$minutes mins ago";
	        }
	    }
	    //Hours
	    else if($hours <=24){
	        if($hours==1){
	            return "1 hour ago";
	        }else{
	            return "$hours hrs ago";
	        }
	    }
	    //Days
	    else if($days <= 7){
	        if($days==1){
	            return "yesterday";
	        }else{
	            return "$days days ago";
	        }
	    }
	    //Weeks
	    else if($weeks <= 4.3){
	        if($weeks==1){
	            return "1 week ago";
	        }else{
	            return "$weeks weeks ago";
	        }
	    }
	    //Months
	    else if($months <=12){
	        if($months==1){
	            return "1 month ago";
	        }else{
	            return "$months months ago";
	        }
	    }
	    //Years
	    else {
	        if ($years==1) {
	            return "1 year ago";
	        } else {
	            return "$years years ago";
	        }
	    }
	}

	public function detail($id)
	{
		$data['title'] = "Task Detail";
		$data['role'] = $this->session->user_info->role;
		$data['task'] = $this->TaskManagementModel->getTaskById($id);
		$task = $data['task'];
		$data['created_on'] = $this->timeAgo($task->created_at);
		
		if(!empty($task->task_start_time && $task->task_close_time))
		{
			$data['complete_time'] = $this->calculateWorkCompleteTime($task->task_start_time, $task->task_close_time);
		}
		else
		{
			$data['complete_time'] = '';
		}
		// print_r($data);die;
		$this->load->view('task/task_detail', $data);
	}

	public function calculateWorkCompleteTime($s, $e)
	{
		$date1 = new DateTime($s);
		$date2 = new DateTime($e);
		$interval = $date1->diff($date2);
		$hours = $interval->h + $interval->days * 24; // Total hours
		$minutes = $interval->i; // Minutes
		$seconds = $interval->s; // Seconds
		return "$hours hrs, $minutes min, $seconds sec";
	}

	public function task_start($id)
	{
		$resp = $this->TaskManagementModel->task_start($id, $this->user_data->staff_id);
		if($resp) 
		{
			echo 'Task has been started...';
		}
	}

	public function task_end()
	{
		if(isset($_POST['task_id']))
		{
			$comment = $this->input->post('comment');
			$tas_id = $this->input->post('task_id');
			$resp = $this->TaskManagementModel->task_end($tas_id, $this->user_data->staff_id, $comment);
			if($resp)
			{
				$this->session->set_flashdata('succ', 'Task has been closed');
				return redirect('task/detail/'.$_POST['task_id']);
			}
			else
			{
				$this->session->set_flashdata('fail', 'Something went wrong, please try again...');
				return redirect('task/detail/'.$_POST['task_id']);
			}
		}
	}

	public function __destruct()
	{
		
	}


}