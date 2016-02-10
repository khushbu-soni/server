<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Orders extends CI_Controller {
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
		$this->data['active'] = 7;

		$this->data['sidebar'] = $this->load->view('kitchen/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('kitchen/header', '', TRUE);
		$this->data['orderdetails'] = $this->load->view('kitchen/orderdetails', '', TRUE);
		$this->data['img_path'] = $this->config->item('img_path');
		$this->data['orderprocessitem'] = $this->load->view('kitchen/orderprocessitem', '', TRUE);

		$this->load->model('order_model', 'orders');
		$this->load->model('notification_model', 'notifications');
	}

	public function index()
	{
		
		$this->data['orders'] = $this->orders->get_pending_orders();
		
		$this->data['orders_item_process'] = $this->orders->get_order_item_process();
		
		//$this->data['orders_item_process'] = $this->orders->get_order_item_process();
		//echo "Working2";
		//print_r($this->data['orders_item_process']);
		//exit();
		
		//$this->load->view('kitchen/orders', $this->data);

		$this->data['manager_id'] = $this->db->get_where("staff",'role = 2')->row_array();
		$this->load->view('kitchen/order_item_process', $this->data);
	}
	public function cancelOrder()
	{
		$orderid = $this->input->post('orderid');
			$query=$this->db->query("DELETE from orderitem Where orderid=$orderid AND status =0");
			
	}
	public function completeorder()
	{

		
		$this->orders->update_compete_order_status();


		$this->notifications->insert_notification();
	}

	public function takeAway()
	{
		//update status of order to ready for delivery
		//insert a notification for the waiter
		//$this->orders->update_order_status();


		$this->orders->update_takeaway_order_status();


		$this->notifications->insert_notification();
	}

	public function completeorderdeliver()
	{
		//update status of order to ready for delivery
		//insert a notification for the waiter
		//$this->orders->update_order_status();


		$this->orders->update_compete_order_deliver_status();


		$this->notifications->insert_notification();
	}
	

	public function completeorder_item()
	{
		//update status of order to ready for delivery
		//insert a notification for the waiter
		//$this->orders->update_order_status();
		//exit();

		$this->orders->update_compete_order_status_item();


		$this->notifications->insert_notification();
	}



	public function process()
	{
		//update status of order to ready for delivery
		//insert a notification for the waiter
		$this->orders->update_order_status();
		$this->notifications->insert_notification();
	}

	public function getorderdetails()
	{
		//first change the status of the order to "being prepared"
		$this->orders->update_order_status();
		$ordereditems = $this->orders->get_order_information_by_id();
		$items_html = '';
		
		foreach ($ordereditems as $ordereditem){
			$items_html .= "<div class='kitchenorder'><p><b>{$ordereditem->itemname}</b></p>";
			if (trim($ordereditem->ingredients) == ''){
				$items_html .= "<ul><li>No extra ingredients.</li></ul></div>";
			} else if ($ordereditem->ingredients == 'All'){
				$items_html .= "<ul><li>All available ingredients.</li></ul></div>";
			} else {
				$ingredients = explode(',', $ordereditem->ingredients);
				$items_html .= "<ul>";
				foreach ($ingredients as $ingredient){
					$items_html .= "<li>" . ucfirst($ingredient) . "</li>";

				}
				$items_html .= "</ul></div>";
			}
		}
		echo $items_html;
	}

	public function getorderdetails_item()
	{
		//first change the status of the order to "being prepared"
		$this->orders->update_order_statusitem();


		$ordereditems = $this->orders->get_order_information_by_id_item();
		/*print_r($this->db->last_query());
		print_r($ordereditems);
		exit();*/
		$items_html = '';
		
		foreach ($ordereditems as $ordereditem){
			$items_html .= "<div class='kitchenorder'><p><b>{$ordereditem->itemname}</b></p>";
			if (trim($ordereditem->ingredients) == ''){
				$items_html .= "<ul><li>No extra ingredients.</li></ul></div>";
			} else if ($ordereditem->ingredients == 'All'){
				$items_html .= "<ul><li>All available ingredients.</li></ul></div>";
			} else {
				$ingredients = explode(',', $ordereditem->ingredients);
				$items_html .= "<ul>";
				foreach ($ingredients as $ingredient){
					$items_html .= "<li>" . ucfirst($ingredient) . "</li>";

				}
				$items_html .= "</ul></div>";
			}
		}
		echo $items_html;
	}


}