<?php 

/**
 * Notifications controller
 */
class Notifications extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('notificationmodel')
	}

}