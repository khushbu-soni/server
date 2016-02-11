<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class trash extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('admin/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Admin');
		$this->data['active'] = 28;
		$this->data['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
		
		// $this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		$this->load->model('stock_transaction_model', 'stock_transaction');
		$this->load->model('payment_model', 'payment');
		$this->load->model('order_model', 'order');
		$this->load->model('orderitem_model', 'orderitem');
		$this->load->model('notification_log', 'notifications');
		$this->load->model('tabletnotification_model', 'tablet_notifications');
	}

	public function index()
	{
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['notification_info']=$this->notifications->get_notifications();
		$this->data['header'] = $this->load->view('admin/header',$this->data);
		$this->data['stock_info_consume'] = $this->stock_transaction->get_all("Consume");
		$this->data['stock_info_inward'] = $this->stock_transaction->get_all("Inward");
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('admin/trash', $this->data);
	}

	public function get(){
		
		$this->data['payment_info'] = $this->payment->get_all(null,null,'all');
		$this->data['total_info'] = $this->payment->get_total(null,null,'all');
		$this->data['tax_info'] = $this->payment->get_all_tax_info(null,null,'all');

		// $this->data['stock_info_inward'] = $this->payment->get_all("Inward");
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('admin/trash', $this->data);
	}

	  public function filter_by_date(){

    	if(isset($_POST['start_date']))
	    	$start_date= date('Y-m-d',strtotime($_POST['start_date']));
    	if(isset($_POST['end_date']))
	    	$end_date= date('Y-m-d',strtotime($_POST['end_date']));
    	if(isset($_POST['type']))
    		$type=$_POST['type'];

		$this->data['filter_trash_info'] = $this->payment->get_all($start_date,$end_date,$type);
		$this->data['total_info'] = $this->payment->get_total($start_date,$end_date,'all');
		$this->load->view('admin/trashtable',$this->data);
    }

    public function delete(){
    	if(isset($_POST['id'])){
    		$id=$_POST['id'];
    		

    		$payment_info=$this->payment->get_by_id($id);
    		$order_info=$this->order->get_by_id($payment_info[0]['customer_unique_id']);
    		foreach ($order_info[0] as $value) {
	    		$this->orderitem->delete_by_id($order_info[0]['id']);
	    		$this->notifications->delete_by_id($order_info[0]['id']);
	    		$this->tablet_notifications->delete_by_id($order_info[0]['id']);
    		}
    		$this->order->delete_by_id($order_info[0]['id']);
    		$this->payment->delete_by_id($id);
			$this->load->view('admin/trashtable',$this->data);
    		
    	}

    	if(isset($_POST['start_date'])){
    		if(isset($_POST['start_date']))
    			$start_date=$_POST['start_date'];
    		else
    			$start_date=date('Y-m-d');
    		$end_date=date('Y-m-d');
    		$payment_info=$this->payment->get_by_date($start_date,$end_date);
    		if(!empty($payment_info)){
    			foreach ($payment_info[0] as $value) {
    				# code...
	    		$order_info=$this->order->get_by_id($payment_info[0]['customer_unique_id']);
	    		
	    		foreach ($order_info[0] as $value) {
		    		$this->orderitem->delete_by_id($order_info[0]['id']);
		    		$this->notifications->delete_by_id($order_info[0]['id']);
		    		$this->tablet_notifications->delete_by_id($order_info[0]['id']);
	    		}
	    		$this->order->delete_by_id($order_info[0]['id']);
	    		$this->payment->delete_by_id($payment_info[0]['customer_unique_id']);
    			}
				$this->load->view('admin/trashtable',$this->data);
    		}else{
				$this->load->view('admin/msg');

    		}
    	}
    }

	function delete_all(){
				

		$payment_info=$this->payment->get();
		
		foreach ($payment_info as $key => $value) {
			echo $payment_info[$key]['customer_unique_id'];

			$order_info=$this->order->get_by_id($payment_info[$key]['customer_unique_id']);

			// print_r($order_info);
			foreach ($order_info as $key_order => $value) {
				
				 $this->orderitem->delete_by_id($order_info[$key_order]['id']);
	    		$this->notifications->delete_by_id($order_info[$key_order]['id']);
	    		$this->tablet_notifications->delete_by_id($order_info[$key_order]['id']);
				$this->order->delete_by_id($order_info[$key_order]['id']);
			}
    		$this->payment->delete_by_id($payment_info[$key]['customer_unique_id']);
		}
		
		echo "No Records";
	}
	
	
}