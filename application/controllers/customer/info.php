	<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class info extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();

		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['cashpayment'] = $this->load->view('customer/cashpayment', '', TRUE);
		$this->data['game'] = $this->load->view('customer/game', '', TRUE);

		$this->data['paymentheader'] = $this->load->view('customer/headeronly', '', TRUE);
		$this->load->model('order_model', 'order');
	}

	
	function index(){
		$this->data['info']=$this->order->get_current_order();
		
		/*$this->session->unset_userdata('orderid');
		$this->session->unset_userdata('order_id');*/
		$this->load->view('customer/list',$this->data);
	}
	
}