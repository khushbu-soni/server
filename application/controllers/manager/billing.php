<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Billing extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus('Manager');
		$this->data['active'] = 3;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		
		// $this->data['order'] = $this->load->view('manager/deliverOrder', '', TRUE);
		$this->load->model('order_model','orders');
		$this->load->model('payment_model','payments');
		$this->load->model('orderitem_model','orderitems');
		$this->load->model('configruation_model','configruations');
		$this->load->model('payment_model');
		$this->load->model('transaction_model','transaction');
		$this->load->model('table_model','table');


		//$this->data['orders']=$this->orders->get_detail();
		//$this->data['orderList'] = $this->load->view('manager/deliverOrder',$this->data);
                
                // $this->data['cpd']=$this->load->view('manager/statTabs/cpd','',true);
                // $this->data['icpw'] =$this->load->view('manager/statTabs/icpw','',true);
                
                // $this->data['fh'] =$this->load->view('manager/statTabs/fh','',true);

	}

	public function index()
	{
		// print_r($_GET);
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		
		$this->session->set_userdata(array('customer_unique_id',1));
		// $this->data['payments']=$this->payments->get_payments();
		// $this->data['orderList'] = $this->load->view('manager/orderList',$this->data);
			$this->data['orders']=$this->orders->get_detail();
			// $this->data['orders_details']=$this->orderitems->get_orderitems($customer_unique_id);
		// $this->data['gr'] =$this->load->view('manager/statTabs/gr','',true);
		$this->load->view('manager/billing', $this->data);

	}

	public function payment($order_id){
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		// $order_id=base64_decode($order_id);

		$this->data['orders']=$this->orders->get_detail();
		$this->data['customername']=$this->orders->get_customername_by_id($order_id);
		$this->data['all_orders']=$this->orders->get_table_orders($order_id);
		$this->data['qty']=$this->orderitems->getQty($order_id);
		$this->data['tablenumber']=$order_id;
		$this->data['orders_details']=$this->orderitems->get_orderitems($order_id);
		
		$this->data['basic_info']=$this->configruations->get_all();
		
		$tax=$this->orderitems->get_total_with_tax($order_id);
		//print_r($tax);
	
		$cal=$this->data['totals_without_tax']=$this->orderitems->get_total_without_tax($order_id);
		//print_r($cal);
	
		// echo $tax['total'];

		// echo "<br/>";
		// echo $cal['total'];
		//$totals_with_tax=$tax['total']+$cal['total'];
		$totals_with_tax=$tax['total'];
		//print_r($totals_with_tax);
		//exit();

		$this->data['totals_with_tax']= round($totals_with_tax,2);
		$this->data['tax_amount']= round($tax['total'],2);
		
		// $this->data['orderList'] = $this->load->view('manager/orderList',$this->data);
		 $this->data['basic_info']=$this->configruations->get_all();
		 // $this->session->set_userdata(array('customer_unique_id',$customer_unique_id));
		// print_r($this->session->userdata);
		// exit();
		// $this->data['gr'] =$this->load->view('manager/statTabs/gr','',true);
		$this->load->view('manager/billing', $this->data);
	}

// 	Array
// (
//     [cal_val] => 0
//     [order_id] => 743
//     [tablenumber] => 4
//     [hidden] => 
//     [dis] => 500
//     [tax] => 12.36
//     [total_with_tax] => 216854.8
//     [total_without_tax] => 193000
//     [tax_amount] => 23854.8
//     [tax_amount_not] => 0
//     [cash] => 15550
// )

	public function makepayment(){
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('totals_without_tax', 'total', 'required');
		$this->form_validation->set_rules('totals_with_tax', 'total', 'required');
		$this->form_validation->set_rules('tax', 'tax', 'required');
		// $this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		// $this->form_validation->set_rules('customer_unique_id', 'customer_unique_id', 'required');
		

		// if ($this->form_validation->run() == FALSE){
		// 	redirect('manager/billing');
		// 	// $this->load->view('manager/billing', $this->data);
		// } else {

			// $tablenumber=$this->orders->get_tablenumber_by($this->input->post('order_id'));

			if($this->payment_model->make_payment($_POST)){

				if($_POST['cal_val']){
		                $amount=$_POST['total_with_tax'];
		            }
		            else{
		                $amount=$_POST['total_without_tax'];
		            }
					$date=date('Y-m-d');
					$narration="Payment Against OrderID :: ".$_POST['order_id'];
				// exit();
					$this->orders->paid($this->input->post('order_id'));
					$this->orderitems->update_status($this->input->post('order_id'));

					$this->table->mark_Unused($_POST['tablenumber']);
					echo $this->db->last_query();	
					$this->transaction->insert_transaction($this->input->post('order_id'),$amount,$date,'Received',$narration);		
					
				$this->session->set_flashdata('successmsg', "paid successfully Updated.");
				redirect('manager/dashboard');
			}
			
			
			// if($this->orders->table_customer_count($tablenumber['tablenumber'])==0)
			
			
	// }
}

	public function ajax_handler(){
		$this->data['orders']=$this->orders->get_detail();
		//s$this->data['orderList'] = 
		$this->load->view('manager/deliverOrder',$this->data);
        // redirect('manager/billing');
	}

	function pdf($order_id=null) { 
		// print_r($_POST);
		// exit();
		// $cash_t=0;
		if(isset($_POST['cash_t']))
				$cash_t=$_POST['cash_t'];

		if(isset($_POST['discount']))
			$discount=$_POST['discount'];

		if(isset($_POST['id']))
			$customer_unique_id=$_POST['id'];
		// exit();  
			$this->data['basic_info']=$this->configruations->get_all();   
        $this->data['orders_details']=$this->orderitems->get_orderitems($order_id);
		// $this->data['ordreID']=$order_id;
        $this->data['qty']=$this->orderitems->getQty($order_id);
       if($_POST['cal_val_1']){
       	$tax=$this->orderitems->get_total_with_tax($order_id);
		$cal=$this->data['totals_without_tax']=$this->orderitems->get_total_without_tax($order_id);
	
		$totals_with_tax=$tax['total']+$cal['total'];
		$totals_with_tax=$totals_with_tax-$discount;
		$this->data['totals']['total']= round($totals_with_tax,2);
	        $tax_info=$this->configruations->get_all();
       		$this->data['tax']=$tax_info->tax;
       		$this->data['discount']=$discount;
       		if(!$cash_t)
       			$cash_t=round($totals_with_tax,2);
       		$this->data['cash_tendered']=$cash_t;
       		$this->data['change']=abs($cash_t-$this->data['totals']['total']);
       	}else{

			$this->data['totals']=$this->orderitems->get_total_without_tax($order_id);
	   		 $this->data['totals']['total']=$this->data['totals']['total']-$discount;
			// print_r($this->data['totals']);
			// echo $this->data['totals']['total'];
			// exit();
       		$this->data['tax']=0;
       		$this->data['discount']=$discount;
       		if(!$cash_t)
       			$cash_t=$this->data['totals']['total'];
       		$this->data['cash_tendered']=$cash_t;
       		$this->data['change']=abs($cash_t-$this->data['totals']['total']);
       	}
        require_once("MPDF54/mpdf.php");
        $mpdf = new mPDF('R', 'A6', '', '', 0, 0, 0, 0, 0, 0);
        $mpdf->SetDisplayMode('real');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        // $javascript = file_get_contents('MPDF54/pdf_javascript.php');
		// $mpdf->WriteHTML($javascript, 1);
        ob_start();
        $this->load->view('manager/pdf', $this->data);
        $content = ob_get_clean();
       
		// $mpdf->SetJS('this.print();');
        $mpdf->WriteHTML($content);
        $mpdf->Output('assets/pdf/'.$customer_unique_id.'.pdf','F');
		// $mpdf->Output();
        $this->load->view('manager/pdf', $this->data);
        //redirect('manager/billing');

    }


    function bill($order_id) {  
    	$order_id=base64_decode($order_id);
		// exit();  
		$this->data['basic_info']=$this->configruations->get_all();   
		
        $this->data['order_info']=$this->orders->get_paid_bill($order_id);
        require_once("MPDF54/mpdf.php");
        $mpdf = new mPDF('R', 'A6', '', '', 0, 0, 0, 0, 0, 0);
        $mpdf->SetDisplayMode('real');
        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
        // $javascript = file_get_contents('MPDF54/pdf_javascript.php');
		// $mpdf->WriteHTML($javascript, 1);
        ob_start();
        $this->load->view('manager/pdf', $this->data);
        $content = ob_get_clean();
       
		// $mpdf->SetJS('this.print();');
        $mpdf->WriteHTML($content);
        $mpdf->Output('assets/pdf/'.$customer_unique_id.'.pdf','F');
		// $mpdf->Output();
        $this->load->view('manager/bill', $this->data);
        //redirect('manager/billing');

    }

    public function load_inner_part(){
    	
        $this->load->view('manager/inner_part');
    }
}?>