<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Dashboard extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->chekWaiterLogin();

		$this->data['dependencies'] = $this->load->view('waiter/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus("Waiter");

		
		//$this->data['sidebar'] = $this->load->view('waiter/sidebar',$this->data['sidemenu']);
		$this->data['active'] = 23;
		$this->data['sidebar'] = $this->load->view('waiter/sidebar', '', TRUE);
	
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);
		
		// $this->data['deleteconfirm'] = $this->load->view('waiter/deleteconfirmation', '', TRUE);

		$this->load->model('menuitem_model', 'menuitems');
		$this->load->model('ingredient_model', 'ingredients');
		$this->load->model('table_model', 'table');

		$this->load->model('payment_model', 'payments');
		$this->load->model('customer_details_model', 'customer_details');

		$this->load->model('staff_model','staff');
		$this->load->model('table_model','table');
		$this->load->model('notification_log','notification');
		$this->load->model('staff_model','staff');
		$this->load->model('configruation_model','configruation');
		$this->load->model('assign_model','assign_table');
		$this->load->model('orderitem_model','orderitem');
		$this->load->model('order_model','orders');
		$orders=$this->data['pending_order_info']=$this->table->pending_order_info();
		
		$this->data['notifications']=$this->notification->get_all_unwatched();
		$this->data['notifications_info'] = $this->notification->get_notifications();
		// $this->data['header'] = $this->load->view('waiter/header',$this->data['notifications']);

		$orderitems=array();
		foreach ($orders as $order) {
			$orderitems[$order['id']]=$this->orderitem->get_items($order['id']);
		}
		$this->data['orderitems']=$orderitems;
		$this->data['configruation']=$this->configruation->get_all();
	}

	public function index()
	{
			
		
		$this->data['notifications']=$this->notification->get_all_unwatched();
		$this->data['notifications_info'] = $this->notification->get_notifications();
		$this->data['header'] = $this->load->view('waiter/header',$this->data);

		$this->data['username']=$this->staff->get_name($this->session->userdata['waiter_id']);
		//$this->data['username']=$this->staff->get_name($this->session->userdata['waiter_id']);
		$this->data['today_payment']=$this->table->today_payment();
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$orders=$this->data['pending_order']=$this->table->pending_order();

		$this->data['notifications']=$this->notification->get_customer_login_notification();
		$this->data['free_waiters']=$this->staff->get_free_waiter_by_id($this->session->userdata('waiter_id'));
		$this->load->view('waiter/dashboard',$this->data);
	}

	public function ajax_handler(){
		$this->data['username']=$this->staff->get_name($this->session->userdata['userid']);
		
		$this->data['today_payment']=$this->table->today_payment();
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$this->data['pending_order']=$this->table->pending_order();
		$this->data['notifications']=$this->notification->get_customer_login_notification();
		$this->data['free_waiters']=$this->staff->get_free_waiter_by_id($this->session->userdata('waiter_id'));
		
		//s$this->data['orderList'] = 
		$this->load->view('waiter/dashinfo',$this->data);
        // redirect('waiter/billing');
	}

	function waiter_count(){
		$this->data['free_waiters']=$this->table->get_free_waiter_count();
		$this->data['waiters']=$this->staff->get_waiter_count();
		$this->load->view('waiter/waiter_count',$this->data);
	}

	function today_payment(){
		$this->data['today_payment']=$this->table->today_payment();
		$this->load->view('waiter/today_payment',$this->data);
	}

	function monthly_payment(){
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$this->load->view('waiter/monthly_payment',$this->data);
	}

	function pending_order(){
		$this->data['pending_order']=$this->table->pending_order();
		$this->load->view('waiter/pending_order',$this->data);
	}

	function order_notification()
	{
		// $this->data['notifications']=$this->notification->get_customer_login_notification();
		// $this->data['order']=$this->order->get_all();
		$this->data['orders'] = $this->orders->get_myorders($this->session->userdata('waiter_id'));
		$this->data['customers'] = $this->orders->get_customername($this->session->userdata('waiter_id'));
		$this->load->view('waiter/order_notifications',$this->data);
	}


	

	

	function free_tables(){
		$this->data['total_tables']=$this->configruation->get_config();
		$this->data['used_tables']=$this->table->get_used_tables();
		// $this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->data['free_waiters']=$this->staff->get_free_waiter_by_id($this->session->userdata('waiter_id'));
		$this->data['configruation']=$this->configruation->get_config();
		$this->load->view('waiter/free_tables',$this->data);
	}

	function takeorder($cust_uniq='',$table_no='',$customer_unique_id='',$id='')
	{
		
		if(!empty($id) && !empty($cust_uniq) && !empty($cust_uniq) && !empty($customer_unique_id))
		{
			$order_id = base64_decode($id);
		$cust_uniq = base64_decode($cust_uniq);
		$table_no = base64_decode($table_no);
		$customer_unique = base64_decode($customer_unique_id);
		
		
		//$arr=explode("_",$cust_uniq);
		
		//$new_cust_name = str_replace(" ","_",$arr[0]);
		
		//$name_len = explode(" ",$arr[0]);
			



		}

		$this->session->set_userdata(array('customername'=>$cust_uniq));
	
		$this->session->set_userdata(array('customer_unique_id'=>$customer_unique));
		$this->session->set_userdata(array('tablenumber'=>$table_no));
		$this->session->set_userdata(array('tabletnumber'=>$table_no));
		$this->session->set_userdata(array('order_id'=>$order_id));
		$this->session->set_userdata(array('orderid'=>$order_id));
		

		//$this->load->model('news_model');
		//$this->data['news'] = $this->news_model->get_news();
		
		redirect('waiter/menu','refresh');
	}


	public function show_table_customer()
	{

		$table = $this->input->post('tablenumber');
		$query = $this->db->query("Select * from orderitem where table_no = '".$table."' AND status='0' AND timestamp LIKE '".date('Y-m-d')."_________'")->result();
		//print_r($this->db->last_query());
		//exit();
		if (!empty($query)) {
			
			$this->data['total_tables_customer'] = $this->db->query("Select * from `order` where tablenumber = '".$table."' group by customer_unique_id")->result();
		}
		
		$this->data['table_no'] = $this->input->post('tablenumber');
		
		$this->load->view('waiter/customer_list',$this->data);


	}
	public function customer_order_call($id)
	{

		$this->usermodel->SetTable($id);

		redirect('waiter/customer_name');
	}

	public function reserve_table($id)
	{
		
		

		$name = $this->input->post('r_txt');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		
		if(empty($id))
		{
			redirect('waiter/dashboard');
		}else
		{
			$data=array(
				'reserved'=>'1',
				'res_cust_name'=>$name,
				
				'res_time_from' => $time_from,
				'res_time_to' => $time_to
				);

			$condition=array('tablenumber'=> $id);
			$this->db->update('table',$data,$condition);

			redirect('waiter/dashboard');
		}


		
	}

	function customer_notifications(){

		$this->data['orders'] = $this->orders->get_pending_orders();
		
		$this->data['orders_item_process'] = $this->orders->get_order_item_process();
		
		$this->load->view('waiter/customer_notifications',$this->data);
	}


	function assign_table(){
		// print_r($_POST);
		// $tablenumber=$_POST['tablenumber'];
		// $waiter=$_POST['waiter_id'];
		 $this->assign_table->create();
		 echo "1";	
	}

	
}