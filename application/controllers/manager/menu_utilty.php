<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class menu_utilty extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 5;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		
		
		$this->load->model('notification_log', 'notifications');
		$this->load->model('configruation_model', 'configruation');
		
		

		$this->load->model('staff_model', 'users');
		$this->load->model('table_model', 'table');
		$this->load->model('order_model', 'order');	
	}

	public function index()
	{
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		
		$this->load->view('manager/menu_utilty', $this->data);
	}

	public function mark(){
		$this->load->model('menuitem_model','menuitem');

		if(isset($_POST['status']))
			$status=$_POST['status'];
		if(isset($_POST['restro']))
			$cat=$_POST['restro'];
		if($status){
			$this->menuitem->mark_available($cat);
			echo  "1";
		}
		else{
			$this->menuitem->mark_unavailable($cat);
			echo  "0";
		}

	}
}