<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class RefillRequests extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->chekWaiterLogin();

		$this->data['dependencies'] = $this->load->view('waiter/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus("Waiter");

		
		//$this->data['sidebar'] = $this->load->view('waiter/sidebar',$this->data['sidemenu']);
		$this->data['active'] = 22;
		$this->data['sidebar'] = $this->load->view('waiter/sidebar', '', TRUE);
	$this->data['header'] = $this->load->view('waiter/header', '', TRUE);

		$this->load->model('tabletnotification_model', 'tabletnotifications');
	}

	public function index()
	{
		$this->data['unacceptedrefills'] = $this->tabletnotifications->get_unaccepted_refills();
		$this->data['acceptedrefills'] = $this->tabletnotifications->get_accepted_refills();
		$this->load->view('waiter/refillrequests', $this->data);
	}

	public function accept()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->accept_notification();

		echo '1';
	}


	public function resolve()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->resolve_notification();

		echo '1';
	}
}