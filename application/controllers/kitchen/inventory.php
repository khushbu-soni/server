<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Inventory extends CI_Controller {
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

		$this->load->model('stock_model', 'allstock');
	}

	public function index()
	{
		$this->data['today_stock'] = $this->allstock->get_today_stock();
		$this->data['all_stock'] = $this->allstock->get_all_stock();
		
		$this->load->view('kitchen/inventory', $this->data);
	}

	public function get_all_stock()
	{
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}

		$type = $this->input->post('type');
		$menuitems = $this->allstock->get_all_stock();
		$menuitems_html = '';
		
		foreach ($menuitems as $menuitem){
			$menuitems_html .= "<div class='kitchenorder'><div class='orderitems pull-left' style=''><p><b>" . $menuitem->name . "</b></p>
								</div><div class='orderaction pull-right'>";
			if ($menuitem->available == 1){
				$menuitems_html .= "<a href='#' onclick='makeUnavailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-large'><i class='icon-minus'></i> Make Unavailable</a></div></div>";
			} else {
				$menuitems_html .= "<a href='#' onclick='makeAvailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-large btn-inverse'><i class='icon-plus icon-white'></i> Make Available</a></div></div>";
			}
			
		}

		echo $menuitems_html;
	}

	public function filter($id)
	{
		
		if($id!='All'){

			
			$query = $this->db->query("select * from ingredients where id = ". $id);
			$f_data = $query->result();
			

			
				$this->data['today_stock'] = $f_data;
				$this->data['all_stock'] = $this->allstock->get_all_stock();
			
			 $this->load->view('kitchen/inventory', $this->data);
							

			}else
			redirect('kitchen/inventory');		
                             
			
	}

	public function make_unavailable(){
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}
		
		$this->allstock->set_availability();
		echo 1;
	}

	public function make_available(){
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/orders', 'refresh');
		}

		$this->allstock->set_availability();
		echo 1;
	}

}