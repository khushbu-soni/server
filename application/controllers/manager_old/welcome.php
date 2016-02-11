<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Welcome extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);

		$this->load->model('abstract_userlogin_model', 'users');
	}

	public function index()
	{
		$this->load->view('manager/login', $this->data);
	}

	public function logout()
	{
		$this->users->logout();
		redirect('manager');
	}
}