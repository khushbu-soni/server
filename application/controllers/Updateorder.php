<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Update extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');
		$this->load->model('orderitem_model','orderitems');
		$this->load->model('menuitem_model','menuitem');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 5;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		
		
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['notification_info']=$this->notifications->get_notifications();
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		$this->data['biryani_menuitems']=$this->menuitem->get_all_available_menu_item_from_biryani();
		//echo $this->db->last_query;
		$this->data['cafe_menuitems']=$this->menuitem->get_all_available_menu_item_from_cafe();
		$this->data['bar_menuitems']=$this->menuitem->get_all_available_menu_item_from_bar();
		
		// $this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('staff_model', 'users');
	}

	public function index()
	{
		print_r($_GET);
	}

	public function add_in_kot_print(){

		print_r($_GET);
	}
	
}