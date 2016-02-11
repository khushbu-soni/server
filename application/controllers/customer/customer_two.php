<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class customer_two extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();
		
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);

		$this->load->model('table_model', 'tables');
	}

	public function index()
	{
		$this->load->view('customer/customer_two', $this->data);
	}

	/**
	* Sets the name of the customer in a session variable and sets the status of the table to in use
	*/
	public function setname_two()
	{
		$temp_name=$this->input->post('customername');
		//set the user's name in the session
		$name=$this->db->query("select * from `order` where payment_status = 0 AND customername='".$temp_name."'")->result_array();
		$count=0;
		$this->session->set_userdata(array('count'=>$count));


		if(!empty($name))
		{
		
			/*echo "error";
			print_r($this->db->last_query());
			exit();*/
			$this->session->set_flashdata('sameuser', "This Table Allready Assign to Same Name , Please Set Another Name.");
				
		/*$customername = $this->input->post('customername');
		$this->session->set_userdata(array('customername'=>$customername));
		$this->tables->table_status_update(1);

		$this->tables->insert_orderitem_uniq_customer();*/

		


		?>
			

		<?php redirect('customer', 'refresh'); }
		else
		{
			
	/*	if($count == $this->session->userdata('count'))
		{
		$count++;
		$new_name= $this->input->post('customername')."_two".$count;
		}else
		{
			$new_name= $this->input->post('customername')."_two";
		}*/
		$count++;
		$new_name= $this->input->post('customername');
		$new_uniq_name= $this->input->post('customername')."_".$this->session->userdata('tablenumber');
		$customername = $new_name;
		$this->session->set_userdata(array('customername_two'=>$customername));
		$this->session->set_userdata(array('count'=>$count));
		$this->session->set_userdata(array('customer_unique_id_two'=>$new_uniq_name));
		$this->session->set_userdata(array('total_customer'=>2));
		$this->tables->insert_orderitem_uniq_customer();
		$this->tables->table_status_update(1);
		redirect('customer/menu', 'refresh');

		}
		
		
	}
}