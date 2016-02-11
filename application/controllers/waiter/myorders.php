<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Myorders extends CI_Controller {
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
		$this->data['active'] = 19;
		$this->data['sidebar'] = $this->load->view('waiter/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);
		$this->data['comporder'] = $this->load->view('waiter/comporder', '', TRUE);
		$this->data['makepayment'] = $this->load->view('waiter/makepayment', '', TRUE);

		$this->load->model('order_model', 'orders');
		$this->load->model('orderitem_model', 'ordereditems');
		$this->load->model('payment_model', 'payments');
	}

	public function index()
	{

		$this->data['userid'] = $this->session->userdata('userid');
		$userdata = $this->session->all_userdata();
		
		 /* $sub_merchents = $this->db
		  ->query('select * from `order` where order.status != 3 AND order.waiter_id = '. $userdata['userid']);*/
		

		
		  	$this->data['orders'] = $this->orders->get_myorders($this->session->userdata('waiter_id'));
		  	$this->data['customers'] = $this->orders->get_customername($this->session->userdata('waiter_id'));
		 
		

		//$this->data['orderedcustom'] = $this->orders->get_order_information_by_id2();
		
		$this->load->view('waiter/myorders', $this->data);
	}

	public function setasdelivered()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->orders->update_order_status();
		echo 1;
	}

	public function makePayment()
	{
		//call model and make payment
		$this->payments->make_cash_payment();
		$this->session->set_flashdata('successmsg', 'Payment successful');
		redirect('waiter/orders');
	}

	public function getorderitems()
	{
		$ordereditems = $this->ordereditems->get_orderitems_by_orderid();

		$comp_html = '<table class="form">';
		foreach ($ordereditems as $ordereditem){
			$comp_html .= "<tr><td class='formlabel'>" . $ordereditem->name . "</td><td>$ <input type='text' id='price_" . $ordereditem->id . "' class='span1' value='" . $ordereditem->price . "' /></td>
						<td style='vertical-align:top;'><a href='#' onclick='compItem(event)' itemid='" . $ordereditem->id . "' class='btn'>Comp</a></td></tr>";
		}
		$comp_html .= '</table>';

		echo $comp_html;
	}

	public function compitem()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->ordereditems->comp_item();

		echo 1;
	}

}