<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Orders extends CI_Controller {
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
		$this->data['active'] = 20;
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
		$this->data['orders'] = $this->orders->get_orders();


		$this->data['ordereditems'] = $this->orders->get_order_item_process();

		$this->load->view('waiter/orders', $this->data);
	}

	public function setasdelivered()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->orders->update_order_status_deliverd();
		echo 1;
	}
	public function setasdelivered_item()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/orders');
		}

		$this->orders->update_order_status_deliverd_item();
		echo 1;
	}
	public function getHelp()
	{
		//$table=$this->session->userdata('assign_waiter');
		$waiter=$this->session->userdata('waiter_id');
		
		$this->db->select('*');
		$this->db->from('tabletnotification AS tbn');
		$this->db->join('order', 'order.id = tbn.orderid');
		$this->db->where('tbn.waiter_id', $waiter);

		$query = $this->db->get();
		$rows=$query->result();
		/*print_r($this->db->last_query());
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
		exit();*/
	
		foreach ($rows as $row) {
			if($row->orderid==0)
			{

				echo "Customer Just Sit On Table and call For Help. Click For View All Help";	
			   
			}
			else
			{

					if($query->num_rows()>0){
			$html= '';
			
        $html .="<div> Customer : <b style=color:black;>$row->customername</b>";
        $html .=" Table  : <b style=color:black;>$row->tablenumber</b>";
        
         $html .="<br>Call For <b>$row->description</b></div>";
        
          //$html .=" <div class="popup-close js-popup-close modal-close">X</div>";
        echo $html;
			}
		
			else
		{

			echo "No Notification Yet!";
		}
	}
		
			
     }
   
	}

	public function notification()
	{
		$waiter=$this->session->userdata('waiter_id');
		//echo $table;
		//echo "bhumin";
		$query= $this->db->query("select * from `tabletnotification` where `waiter_id` = '$waiter' AND datetime LIKE '".date('Y-m-d')."%'");
		$row=$query->row();
		$result=$query->result();
		
		 //print_r($this->db->last_query());
		if($query->num_rows()>0){
			
        $html= '';
        $html .="<center>Total : <b style=color:red;>$query->num_rows<br></b></center>";
        foreach ($result as  $value) {
        	 $html .="<a href='".site_url()."waiter/helprequests/filter/$value->tablenumber'><b style=color:black;>Table No : $value->tablenumber</b><br></a>";
        }
       
        
        /* $html .="<p>$row->description</p>";*/
        
          //$html .="<div class='block'> <a href='#mainVideoMsg' class='button modal-popup-type2'>Popup</a> </div>";
        echo $html;

		}
		else
		{
			echo "No Notification";
			
		}
       // print_r($this->db->last_query());
       
        
        // exit();
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