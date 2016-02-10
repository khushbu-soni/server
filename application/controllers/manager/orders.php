<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Orders extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 2;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);




		$this->load->model('assign_model', 'assign_table');
		$this->load->model('staff_model', 'staffs');
		$this->load->model('status_model', 'status');
		$this->load->model('order_model', 'orders');
		$this->load->model('configruation_model','configruation_model');
	}

	public function index()
	{
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		if(isset($_GET['month'])){
			$this->data['orders'] = $this->orders->filter_by_month();
		}
		else{
			$this->data['orders'] = $this->orders->get_all();
		}
		$this->data['all_status'] = $this->status->get_all();
		// $this->data['tablenumbers'] = $this->configruation_model->get_all();
		$this->load->view('manager/orders',$this->data);
	}

	public function order_info(){
		$this->load->model('orderitem_model','orderitems');
		
		// $this->data['orders_details']=$this->orderitems->get_orderitems($_POST['id']);
		// $cat=$this->orderitems->get_orderitems($_POST['id']);
		$this->data['order_details']=$this->orderitems->get_orderitems($_POST['id']);

		$this->load->view('manager/table',$this->data);
    }
    public function filter_by_date(){
    	$start_date= date('Y-m-d',strtotime($_POST['start_date']));
    	$end_date= date('Y-m-d',strtotime($_POST['end_date']));
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['orders'] = $this->orders->filter_by_date($start_date,$end_date);		
		$this->data['all_status'] = $this->status->get_all();
		$this->load->view('manager/orderTable',$this->data);

    }

	public function filter($status)
	{

		// echo $status;
		// exit();
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		// $status=base64_decode($status);
		if($status!='All'){
			$this->data['all_status'] = $this->status->get_all();
			$this->data['orders'] = $this->orders->filter_by_status($status);
			// $this->data['assign_info'] = $this->assign_table->get_staff_by_waiterid($id);
			$this->load->view('manager/orders', $this->data);
		}else
		redirect('manager/orders');
			
	}
	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('waiter_id', 'waiter_id', 'required');
		$this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		$this->form_validation->set_rules('tabletnumber', 'tabletnumber', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('assign', $this->data);
		} else {
			//insert the  item into the database
			//Check dupliacte Table Number
			if($this->assign_table->alreadyExit($this->input->post('tabletnumber'))){
				$this->session->set_flashdata('successmsg', "This Table Allready Assign, Please Edit.");
				redirect('manager/assign');
			}
			// Waiter Assign Limit form config TODO
			
			 $this->assign_table->create();
				redirect('manager/assign');
		}
	}


	public function assign_info(){
		$this->data['assign_info'] = $this->assign_table->get_all();
		$this->data['waiters_name'] = $this->staffs->waiters();
		$this->load->view('manager/assign_info', $this->data);
	}

	public function delete_order(){
			$this->load->model('orderitem_model','orderitem');
			$this->load->model('order_model','order');
			$this->load->model('table_model','table');

			$orderitem=$this->orderitem->delete_by_id($_GET['order']);
			$tablenumber=$this->order->get_tablenumber_by_order($_GET['order']);
			
			if($tablenumber['tablenumber']){
				if($this->table->mark_Unused($tablenumber['tablenumber']))
					$this->order->delete_by_id($_GET['order']);
					else
						echo "string";	
			}			
			else
				$this->order->delete_by_id($_GET['order']);
			
			// print_r($orderitem);


	}

	public function edit($assignid)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('waiter_id', 'waiter_id', 'required');
		$this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		$this->form_validation->set_rules('tabletnumber', 'tabletnumber', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['records'] = $this->assign_table->get_record($assignid);
			$this->data['waiters'] = $this->staffs->waiters();
			$this->load->view('manager/editassign', $this->data);
		} else {
			//update the  record into the database
			//Check dupliacte Table Number
			if($this->assign_table->alreadyExit($this->input->post('tabletnumber'),$assignid)){
				$this->session->set_flashdata('successmsg', "This Table Allready Assign, Please Choose Another.");
				redirect('manager/assign');
			}

			// Waiter Assign Limit form config TODO

			$this->assign_table->edit($assignid);
			
			$this->session->set_flashdata('successmsg', "Record successfully updated.");
			redirect('manager/assign/assign_info');
		}
	}

	function delete($assignid)
	{
		$this->assign_table->delete($assignid);

		$this->session->set_flashdata('successmsg', 'item successfully deleted.');
		redirect('manager/assign/assign_info');
	}
}