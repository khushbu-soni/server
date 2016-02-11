<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class changetable extends CI_Controller {
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
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['notification_info']=$this->notifications->get_notifications();
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		$this->load->model('order_model','order');
		
		$this->data['active_customers']=$this->order->get_all_active_customers();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/changetable', $this->data);
	}

	function show_free_tables(){

		$customer_unique_id=$_POST['customer_unique_id'];
		$customername=$_POST['customername'];
		$old_tablenumber=$_POST['old_tablenumber'];

		$this->data['customer_unique_id']=$customer_unique_id;
		$this->data['customername']=$customername;
		$this->data['old_tablenumber']=$old_tablenumber;

		$this->data['total_tables']=$this->configruation->get_all();

		$this->data['all_tables']=$this->table->get_all();
		$this->data['used_tables']=$this->table->get_used_tables();
		$this->data['free_waiters']=$this->users->get_free_waiter();
		$this->data['busy_waiters']=$this->users->get_busy_waiter();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/tables_list',$this->data);
	}

	public function shift_table(){
		

		$customer_unique_id= $_POST['customer_unique_id'];
		$new_tablenumber= $_POST['new_tablenumber'];
		$old_tablenumber= $_POST['old_tablenumber'];
		$shift_path_info=$this->order->get_shift_path($customer_unique_id);
		$shift_path=$shift_path_info['shift_path'];

		if($shift_path)
			$shift_path=$shift_path."-".$new_tablenumber;
		else
			$shift_path=$old_tablenumber."-".$new_tablenumber."-";
		$shift_path=trim($shift_path,'-');
		
		$this->order->shiftTable($old_tablenumber,$new_tablenumber,$customer_unique_id,$shift_path);
		
		// echo "1";
	}

	public function load_active_customers(){
		
		$this->data['active_customers']=$this->order->get_all_active_customers();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/changetable_inner_part',$this->data);
		
	}
	
}