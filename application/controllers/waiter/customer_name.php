<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Customer_name extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');

		//$this->usermodel->SetTable($id);
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		
			$this->data['menuheader'] = $this->load->view('waiter/customer_name_header', '', TRUE);

		$this->load->model('table_model', 'tables');
		$this->load->model('order_model', 'order');
		$this->load->model('customer_details_model', 'customer_details');

		$get_profile = $this->customer_details->get_profile();
	
	}

	public function index()
	{
		
		$this->load->view('waiter/customer_name', $this->data);
	}

	/**
	* Sets the name of the customer in a session variable and sets the status of the table to in use
	*/
	public function setname()
	{
		
	
		$temp_name=$this->input->post('customername');
	
		$name=$this->db->query("select * from `order` where payment_status = 0 AND customer_unique_id LIKE '".$temp_name."_%' AND `date` = '".date('Y-m-d')."'")->result_array();
		$mobile=$this->db->query("select * from `customer_data` where customer_name = '".$temp_name."'")->result();
	
		

		$count=0;
		$this->session->set_userdata(array('count'=>$count));


		if(empty($name) && empty($mobile))
		{
				

			/*echo "error";
			print_r($this->db->last_query());
			exit();*/
		$new_name= $this->input->post('customername');
		$new_name_str = str_replace(" ","_",$new_name);

		$new_uniq_name= $new_name_str."_".$this->session->userdata('tablenumber');
	$customername = $new_name;
		$this->session->set_userdata(array('customername'=>$customername));
		$this->session->set_userdata(array('mobile'=>''));
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id'=>$new_uniq_name));
		$this->session->set_userdata(array('key'=>$this->input->post('key')));

	


		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);
		redirect('waiter/menu', 'refresh');
			//$this->session->set_flashdata('sameuser', "This Table Allready Assign to Same Name , Please Set Another Name.");
				
		
		}elseif(!empty($name))
		{
		$this->session->set_flashdata('sameuser', "This Table Allready Assign to Same Name , Please Set Another Name.");
		redirect('waiter/customer_name', 'refresh');
			
		}elseif(!empty($name) && !empty($mobile))
		{
		
		foreach ($mobile as $value) {
				$customer_name = $value->customer_name;
				$mobile = $value->mobile;
			}

		$new_name= $this->input->post('customername');
		$new_name_str = str_replace(" ","_",$new_name);

		$new_uniq_name= $new_name_str."_".$this->session->userdata('tablenumber');
		$customername = $mobile;
		$cust_name = $customer_name;
		
		$this->session->set_userdata(array('customermobile'=>$customername));
		//$this->session->set_userdata(array('customername'=>$customername));
		$this->session->set_userdata(array('customername'=>$cust_name));
		
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id'=>$new_uniq_name));
		$this->session->set_userdata(array('key'=>$this->input->post('key')));

		




		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);
		redirect('waiter/menu', 'refresh');
			
		}elseif(!empty($mobile))
		{
			/*echo $temp_name;
		print_r($mobile);
		print_r($name);
		exit();*/
			foreach ($mobile as $value) {
				$customer_name = $value->customer_name;
				$mobile = $value->mobile;
			}

		$new_name= $this->input->post('customername');
		$new_name_str = str_replace(" ","_",$new_name);

		$new_uniq_name= $new_name_str."_".$this->session->userdata('tablenumber');
		$customername = $mobile;
		$cust_name = $customer_name;
		
		$this->session->set_userdata(array('customermobile'=>$customername));
		//$this->session->set_userdata(array('customername'=>$customername));
		$this->session->set_userdata(array('customername'=>$cust_name));
		
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id'=>$new_uniq_name));
		$this->session->set_userdata(array('key'=>$this->input->post('key')));

		




		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);
		redirect('waiter/menu', 'refresh');

			

		
	}else
	{
		$this->session->set_flashdata('sameuser', "This Table Allready Assign to Same Name , Please Set Another Name.");
		redirect('waiter/customer_name', 'refresh');
	}
		
	}



	public function setmobile()
	{
		
	


			$temp_name=$this->input->post('customermobile');	
			
					

		

		$mobile=$this->db->query("select * from `customer_data` where mobile = '".$temp_name."'")->result();

		

		$count=0;
		$this->session->set_userdata(array('count'=>$count));


		if(empty($mobile) ){

			/*echo $temp_name;
		print_r($mobile);
		print_r($name);
		exit();*/

		$new_name= $this->input->post('customermobile');
		$new_uniq_name= $this->input->post('customermobile')."_".$this->session->userdata('tablenumber');
		$customermobile = $new_name;
		$this->session->set_userdata(array('customername'=>'Guest'));
		$this->session->set_userdata(array('customermobile'=>$customermobile));
		$this->session->set_userdata(array('mobile'=>$customermobile));
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id'=>$new_uniq_name));
		$this->session->set_userdata(array('key'=>$this->input->post('key')));

	


		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);
		redirect('waiter/menu', 'refresh');
		
			

		
	}
		else
		{
			

			foreach ($mobile as $value) {
				$customer_name = $value->customer_name;
				$mobile = $value->mobile;
			}

			$new_name= $this->input->post('customermobile');
		
		$new_uniq_name= $this->input->post('customermobile')."_".$this->session->userdata('tablenumber');
		//$customername = $customer_name;
		$customername = $mobile;
		$cust_name = $customer_name;
		$this->session->set_userdata(array('customermobile'=>$customername));
		//$this->session->set_userdata(array('customername'=>$customername));
		$this->session->set_userdata(array('customername'=>$cust_name));
		
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id'=>$new_uniq_name));
		$this->session->set_userdata(array('key'=>$this->input->post('key')));

		

		
		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);

		
		redirect('waiter/menu', 'refresh');
		
		}
		
		
		
	}




	function placeorder(){

		$key=$this->input->post('key');
		
		

		$customer_unique_id=$_POST['customer_unique_id'];
		$customername=$_POST['customername'];
		$val=$this->order->checkAvailbilty($key,$customer_unique_id,$customername);
		$orderExist =$this->order->checkOrderExist($key,$customer_unique_id,$customername);
		
	
	
		if(!empty($orderExist))
		{
			
		$this->session->set_userdata('order_id',$orderExist['id']);
		$this->session->set_userdata('orderid',$orderExist['id']);
		
		}
		
		if($val['record']){
			$this->session->set_userdata('customer_unique_id',$customer_unique_id);
			$this->session->set_userdata('post_customer_unique_id',$customer_unique_id);
			$this->session->set_userdata('key',$key);
			$this->session->set_userdata('customername',$customername);

			redirect('waiter/menu','refresh');

		}
		else
			$this->session->set_flashdata('sameuser', "Please Enter Correct Key");
			redirect('waiter/info','refresh');

	}


}