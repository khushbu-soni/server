<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Histry extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			
		
	$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();

		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['menuheader'] = $this->load->view('customer/menuheader', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['cashpayment'] = $this->load->view('customer/cashpayment', '', TRUE);
		$this->data['game'] = $this->load->view('customer/game', '', TRUE);
		$this->data['drinkrefill'] = $this->load->view('customer/drinkrefill', '', TRUE);
		$this->data['profile'] = $this->load->view('customer/profile', '', TRUE);


		$this->load->model('orderitem_model', 'orderitems');
		$this->load->model('calculations');
		$this->load->model('coupon_model', 'coupons');
		$this->load->model('payment_model', 'payments');
		$this->load->model('coupon_model', 'coupons');

	
	}

	public function index()
	{
		$this->data['prev_item'] = $this->orderitems->get_prewvius_item();


		$unpaid_ids = "";
		foreach ($this->data['prev_item'] as $unpaid_item){
			if ($unpaid_ids == ""){
				$unpaid_ids = $unpaid_ids . $unpaid_item->id;
			} else {
				$unpaid_ids = $unpaid_ids . ',' . $unpaid_item->id;
			}
		}
		$this->data['unpaid_ids'] = $unpaid_ids;
		$this->data['values'] = $this->calculations->get_values();

		$this->load->view('customer/histry', $this->data);
	}

	public function comment_insert()
	{

		$data= array(	
			
			'comment'=> $this->input->post('comment'),	
			'comment_status' => 1,
			'comment_date' => date('Y-m-d H:i:s')	
			);


		$condition= array(
			'menuid'=> $this->input->post('menuid'),
			'orderid'=> $this->input->post('orderid'),
			
			

			);

		$this->db->update('orderitem',$data,$condition);
		echo 'sucess';
	//	$this->load->view('customer/yourbill', $this->data);
	}


}