<?php  

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'taskmanagement');
      
    // function __construct()  
    // {  
    // 	/*---- db credentials for local server ---*/
    // 	$this->host = "localhost";
	//     $this->username = "root";
	//     $this->password = "";
	//     $this->db = "taskmanagement";

	//     /*---- db credentials for live server ---*/
	//     // $this->host = "localhost";
	//     // $this->username = "muslimsh_aioa_user";
	//     // $this->password = "MEh,19dkbN}p";
	//     // $this->db = "muslimsh_aioa_db";
	    
    //     $con = mysqli_connect($this->host, $this->username, $this->password,$this->db);
    // }

	function get_role_name($role_id)
	{	
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "SELECT role_name FROM roles WHERE role_id = '$role_id' ";
		$result = mysqli_query($con, $sql);   
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			$row = mysqli_fetch_assoc($result);
			return $row['role_name'];
		}
		else
		{
			return $role_id;
		}
	}

	function getClientName($cli_id)
	{	
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "Select * from clients where cli_id = '$cli_id' ";
		$result = mysqli_query($con, $sql);   
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			$row = mysqli_fetch_assoc($result);
			return $row['cli_name'];
		}
		else
		{
			return $role_id;
		}
	}

	function getStaffName($staff_id)
	{	
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "Select * from staff where staff_id = '$staff_id' ";
		$result = mysqli_query($con, $sql);   
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			$row = mysqli_fetch_assoc($result);
			return $row['fullname'];
		}
		else
		{
			return '';
		}
	}

	function getCatName($cat_id)
	{	
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "Select * from category where cat_id = '$cat_id' ";
		$result = mysqli_query($con, $sql);   
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			$row = mysqli_fetch_assoc($result);
			return $row['cat_name'];
		}
		else
		{
			return $role_id;
		}
	}

	function getNotificationCount($id)
	{
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "Select * from notifications where noti_user_id = '$id' ";
		$result = mysqli_query($con, $sql);   
		return mysqli_num_rows($result);
	}

	function getNotifications($id)
	{
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$sql = "Select * from notifications where noti_user_id = '$id' ";
		$result = mysqli_query($con, $sql);   
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return '';
		}
	}

	function timeAgo($time_ago)
	{
	    $time_ago = strtotime($time_ago);
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
	    else{
	        if($years==1){
	            return "1 year ago";
	        }else{
	            return "$years years ago";
	        }
	    }
	}

	function start_task_button_status($start)
	{
		if(!empty($start)): 
			return 'disabled'; 
		else: 
			return ''; 
		endif;
	}

	function end_task_button_status($start, $end)
	{
		if(!empty($start)): 
			if(empty($end)): 
				echo ''; 
			else: 
				echo 'disabled'; 
			endif; 
		else: 
			echo 'disabled'; 
		endif;
	}
