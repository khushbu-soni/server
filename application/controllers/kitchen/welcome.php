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
			 $array_items = array('tablenumber' => '', 
		 	'tabletnumber' => '',
		 	'assign_waiter' => '',
		 	 'inuse' => '',
		 	 'customername' => '',
		 	  'customer_unique_id' => '',
		 	   'key' => '',
		 	   'waiter_id' => '',
		 	 'order_id' => '',
		 	  'orderid' => '',
		 	   'post_customer_unique_id' => '',
		 	   'userid' => '',
		 	   'role' => '',
		 	   'mobile' => ''
		 	);
 		 $this->session->unset_userdata($array_items);
		$this->load->view('kitchen/login.php', $this->data);
	}

	
	/**
	* logs a user out and removes session variables
	*/
	public function logout()
	{
		
		$this->users->logout();

		redirect('kitchen');
	}
}