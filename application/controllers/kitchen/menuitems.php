<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class MenuItems extends CI_Controller {
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
		$this->data['active'] = 11;

		$this->data['sidebar'] = $this->load->view('kitchen/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('kitchen/header', '', TRUE);

		$this->load->model('menuitem_model', 'menuitems');
	}

	public function index()
	{
		$menu_data['menuitems'] = $this->menuitems->get_menuitems(7);
		 $this->data['menutypes'] = $this->menuitems->get_menuitem_type();
		$this->data['menucontent'] = $this->load->view('kitchen/menucontent', $menu_data, TRUE);
		$this->load->view('kitchen/menu', $this->data);
	}

	public function get_menu_items()
	{
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}
		$active="";

		$type = $this->input->post('type');

		if($type == 0)
		{
			$menuitems =  $this->menuitems->get_all_menuitems();
		}else
		{
			$menuitems = $this->menuitems->get_menuitems($type);
		}
		
		//$menuitems = $this->menuitems->get_menuitems($type);
		$menuitems_html = '';

		if (empty($menuitems)) 
		{
		$menuitems_html .= "<div class='kitchenorder'>
		<div class='orderitems pull-center' style='background-color:#F7819F; height:50px;'>
		<center><p style=color:white;><b>No Items</b></p></center>
		</div><div class='orderaction pull-right'>";
		}
		foreach ($menuitems as $menuitem){
			$menuitems_html .= "<div class='kitchenorder'><div class='orderitems pull-left' style=''><p><b>" . $menuitem->name . "</b></p>
								</div><div class='orderaction pull-right'>";
			if ($menuitem->available == 1){
				$menuitems_html .= "<a href='#' onclick='makeUnavailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-info btn-large'><i class='icon-minus'></i> Make Unavailable</a></div></div>";
			} else {
				$menuitems_html .= "<a href='#' onclick='makeAvailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-info btn-large btn-inverse'><i class='icon-plus icon-white'></i> Make Available</a></div></div>";
			}
			
		}

		echo $menuitems_html;
	}

	public function make_unavailable(){
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}
		
		$this->menuitems->set_availability();
		echo 1;
	}

	public function make_available(){
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}

		$this->menuitems->set_availability();
		echo 1;
	}

}