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
		$this->load->model('order_model','order');
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
		if(isset($_GET)){
			$id=$_GET['id'];
		$this->data['orderitems']=$this->orderitems->get_items($id);
		$this->data['order_id']=$id;

		$this->load->view('update', $this->data);
		}
	}

	function order(){
		print_r($_GET);
		if(isset($_GET['item'])){
			$item_no=$_GET['item'];
			if(is_array($item_no)){
				foreach ($item_no as $key => $value) {
				$order_info=$this->order->get_by_orderId($_GET['order']);
				$menuitem_info=$this->menuitem->get_item_name($value);
				// $this->orderitems->add($_GET['order'],$menuitem_info->id);
				$this->orderitems->update_order($_GET['order'],$menuitem_info->id,$order_info[0]['tablenumber'],0,$menuitem_info->price,$menuitem_info->res_category);
				echo $this->db->last_query();
				}
			}elseif ($item_no) {
				$order_info=$this->order->get_by_orderId($_GET['order']);
				$menuitem_info=$this->menuitem->get_item_name($item_no);
				// $this->orderitems->add($_GET['order'],$menuitem_info->id);
				$this->orderitems->update_order($_GET['order'],$menuitem_info->id,$order_info[0]['tablenumber'],0,$menuitem_info->price,$menuitem_info->res_category);
				echo $this->db->last_query();
			}



			

		}

	}
	
	function qty(){
		// print_r($_GET);
		if(isset($_GET)){
			$qty=$_GET['qty'];
			$id=$_GET['id'];
			$this->orderitems->update_qty($id,$qty);
		}
	}

	function notes(){
		// print_r($_GET);
		if(isset($_GET)){
			$qty=$_GET['notes'];
			$id=$_GET['id'];
			$this->orderitems->update_notes($id,$qty);
		}
	}

	function delete(){
		// print_r($_GET);
		if(isset($_GET)){
			$id=$_GET['id'];
			$this->orderitems->delete_by_item_id($id);
		}
	}

	public function add_in_kot_print(){

		print_r($_GET);

		if(isset($_GET)){
			$id=$_GET['id'];

			$res=$this->orderitems->addInKotPrint($id);
			// echo $this->db->last_query();
			// print_r($res);
			if($res)
				echo 1;
			else
				echo 0;
		}
		exit();
	}

	function remove_from_kot_print(){
		print_r($_GET);

		if(isset($_GET)){
			$id=$_GET['id'];

			$res=$this->orderitems->removeFromKotPrint($id);
			// echo $this->db->last_query();
			// print_r($res);
			if($res)
				echo 1;
			else
				echo 0;
		}
		exit();
	}
}