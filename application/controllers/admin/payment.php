<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class payment extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('admin/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');

		// $this->data['sidemenu']=$this->configruation_model->sidebar_menus('Admin');
		// $this->data['active'] = 28;
		// $this->data['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
		
		$this->load->model('stock_transaction_model', 'stock_transaction');
		$this->load->model('payment_model', 'payment');
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
		$this->load->view('admin/stock', $this->data);
	}

	public function get(){
		
		$this->data['payment_info'] = $this->payment->get_all(null,null,'all');
		$this->data['total_info'] = $this->payment->get_total(null,null,'all');
		$this->data['tax_info'] = $this->payment->get_all_tax_info(null,null,'all');

		// $this->data['stock_info_inward'] = $this->payment->get_all("Inward");
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('admin/payment', $this->data);
	}

	 public function filter_by_date(){
    	


    	if(isset($_POST['start_date']))
	    	$start_date= date('Y-m-d',strtotime($_POST['start_date']));
    	if(isset($_POST['end_date']))
	    	$end_date= date('Y-m-d',strtotime($_POST['end_date']));
    	if(isset($_POST['type']))
    		$type=$_POST['type'];

		$this->data['filter_stock_info'] = $this->payment->get_all($start_date,$end_date,$type);
		$this->data['total_info'] = $this->payment->get_total($start_date,$end_date,'all');

		$this->load->view('admin/paymenttable',$this->data);
    }

    


    public function filter_tax_by_date(){
    	


    	if(isset($_POST['start_date']))
	    	$start_date= date('Y-m-d',strtotime($_POST['start_date']));
    	if(isset($_POST['end_date']))
	    	$end_date= date('Y-m-d',strtotime($_POST['end_date']));
    	if(isset($_POST['type']))
    		$type=$_POST['type'];

		$this->data['filter_tax_info'] = $this->payment->get_all_tax_info($start_date,$end_date);
		$this->data['total_info'] = $this->payment->get_total($start_date,$end_date,'all');

		$this->load->view('admin/taxtable',$this->data);

    }

	
	
}