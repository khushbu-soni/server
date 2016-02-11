<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class profile extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('admin/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');

		// $this->data['sidemenu']=$this->configruation_model->sidebar_menus('Admin');
		// $this->data['active'] = 28;
		// $this->data['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
		
		$this->load->model('stock_transaction_model', 'stock_transaction');
		$this->load->model('payment_model', 'payment');
		$this->load->model('staff_model', 'owner');
	}

	public function index()
	{
		$this->data['owner_info']=$this->owner->get_staff_by_id($this->session->userdata['userid']);
		$this->load->view('admin/profile', $this->data);
	}

	public function get(){
		
		$this->data['owner_info']=$this->owner->get_staff_by_id($this->session->userdata['userid']);
		// $this->data['stock_info_inward'] = $this->payment->get_all("Inward");
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('admin/profile', $this->data);
	}

	public function update(){

	$this->owner->update_profile($_POST);
	$this->load->view('admin/msg');
		
		
	}

	
}