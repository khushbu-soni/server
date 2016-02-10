<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Stock extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->chekKitchenLogin();

		$this->data['dependencies'] = $this->load->view('waiter/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus("Kitchen");

		
		//$this->data['sidebar'] = $this->load->view('waiter/sidebar',$this->data['sidemenu']);
		$this->data['active'] = 8;

		$this->data['sidebar'] = $this->load->view('kitchen/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('kitchen/header', '', TRUE);
		$this->load->model('stock_model', 'stockmodel');
		$this->load->model('menuitem_model', 'menuitems');
	}

	public function index()
	{
		
		$this->load->view('kitchen/inventory', $this->data);
	}


	

	public function add(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('item', 'item', 'required');
		$this->form_validation->set_rules('quantity', 'quantity', 'required');
		//$this->form_validation->set_rules('supplier', 'supplier', 'required');
		$this->form_validation->set_rules('available', 'available', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('kitchen/addstock', $this->data);
		} else {
			//insert the  ingredient into the database
			$this->stockmodel->insert_stock();
			$this->session->set_flashdata('successmsg', "New menu ingredient successfully created.");
			redirect('kitchen/inventory');
		
		}
		
	}

}