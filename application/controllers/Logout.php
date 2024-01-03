<?php
class Logout extends CI_Controller
{
	public function index()
	{
		$this->session->sess_destroy();
		return redirect('login');
	}

	public function signout()
	{
		$this->session->sess_destroy();
		return redirect('login');
	}
}