<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Unsetsession extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		
	}

	/**
	* checks the login code and role and determines whether to grant the user access
	*/
	public function index()
	{
		unset($this->session->userdata);
		echo "all session destroy";
		exit();
	}


	
}
