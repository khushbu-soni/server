<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Dashboard extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
				$this->data['dependencies'] = $this->load->view('admin/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus('Admin');

		
		//$this->data['sidebar'] = $this->load->view('manager/sidebar',$this->data['sidemenu']);

		$this->data['active'] = 27;
	
		$this->data['header'] = $this->load->view('admin/header', '', TRUE);
		$this->data['sidebar'] = $this->load->view('admin/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		$this->load->model('payment_model','payment');

		
	}

	public function index()
	{
		
		$this->load->view('admin/dashboard',$this->data);
	}

	public function get(){
		$dates=array();
		$payment=array();
		$today=date('Y-m-d');
		for($i=1;$i<=7;$i++){
			$yesterday = date('Y-m-d', strtotime($today . "-".$i." day"));
			$today=$yesterday;
			$payment[$i]=$this->payment->get_totals($yesterday,$today,'all');
			$dates[$i]=$yesterday;

			foreach ($payment as $key => $value) {

				if(is_array($value)){

					foreach ($value as $key => $val) {
						if($value['total_amount'])
							$var=$value['total_amount'];
						else
							$var=0;
						$payment_total[$i]=$var;
						$payment_date[$i]=$value['date'];
						}
					}
				}
		}
			$payment=array_combine($payment_total,$payment_date);
			
		$this->data['dates']=$dates;
		$this->data['payments']=$payment;

		$this->load->view('admin/graph');
	}

	
}