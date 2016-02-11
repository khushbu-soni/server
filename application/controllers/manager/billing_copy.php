<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Billing extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);

		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->load->model('order_model','orders');
		$this->load->model('payment_model','payments');
		$this->load->model('orderitem_model','orderitems');
		$this->load->model('configruation_model','configruations');
		$this->load->model('payment_model');
		
                
                // $this->data['cpd']=$this->load->view('manager/statTabs/cpd','',true);
                // $this->data['icpw'] =$this->load->view('manager/statTabs/icpw','',true);
                
                // $this->data['fh'] =$this->load->view('manager/statTabs/fh','',true);

	}

	public function index()
	{
		// print_r($_GET);
		$this->data['orders']=$this->orders->get_detail();
		// $this->data['payments']=$this->payments->get_payments();
		$this->data['orderList'] = $this->load->view('manager/orderList',$this->data);
		// $this->data['gr'] =$this->load->view('manager/statTabs/gr','',true);
		$this->load->view('manager/billing', $this->data);
	}

	public function payment($customer_unique_id){
		$customer_unique_id=base64_decode($customer_unique_id);
		$this->data['orders']=$this->orders->get_detail();
		$this->data['all_orders']=$this->orders->get_table_orders($customer_unique_id);
		$this->data['qty']=$this->orderitems->getQty($customer_unique_id);
		$this->data['tablenumber']=$this->orders->get($customer_unique_id);
		$this->data['orders_details']=$this->orderitems->get_orderitems($customer_unique_id);
		$this->data['tax_info']=$this->configruations->get_all();
		$this->data['totals']=$this->orderitems->get_total($customer_unique_id);
		$this->data['orderList'] = $this->load->view('manager/orderList',$this->data);
		// $this->data['gr'] =$this->load->view('manager/statTabs/gr','',true);
		$this->load->view('manager/billing', $this->data);
	}

	public function makepayment(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('total', 'total', 'required');
		$this->form_validation->set_rules('tax', 'tax', 'required');
		$this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		$this->form_validation->set_rules('customer_unique_id', 'customer_unique_id', 'required');
		// $this->data['orderList'] = $this->load->view('manager/orderList',$this->data);
		// print_r($_POST);
		// exit();
		if ($this->form_validation->run() == FALSE){
			redirect('manager/billing');
			// $this->load->view('manager/billing', $this->data);
		} else {
			$user_data=$this->session->userdata;
			
			$this->payment_model->insert_payment();
			$this->orders->paid($this->input->post('customer_unique_id'));
			$this->session->set_flashdata('successmsg', "Configruation successfully Updated.");
			redirect('manager/billing');
			
	}

}
}