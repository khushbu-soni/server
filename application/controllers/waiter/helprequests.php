<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class HelpRequests extends CI_Controller {
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
		$this->data['active'] = 21;
		$this->data['sidebar'] = $this->load->view('waiter/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('waiter/header', '', TRUE);

		$this->load->model('tabletnotification_model', 'tabletnotifications');
	}

	public function index()
	{
		$this->data['unacceptedrequests'] = $this->tabletnotifications->get_unaccepted_help_requests();
		$this->data['acceptedrequests'] = $this->tabletnotifications->get_accepted_help_requests();
		$this->load->view('waiter/helprequests', $this->data);
	}

	public function accept()
	{
		$id=$_POST['id'];
		
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->accept_notification($id);

		echo '1';
	}

	public function filter($id='')
	{
		$waiter=$this->session->userdata('waiter_id');
		//echo $table;
		//echo "bhumin";
		$query= $this->db->query("select * from `tabletnotification` where `waiter_id` = '$waiter' AND tablenumber= '$id' AND datetime LIKE '".date('Y-m-d')."%'")->result();
		
      
        $this->data['unacceptedrequests'] =$query;
		$this->data['acceptedrequests'] = $this->tabletnotifications->get_accepted_help_requests();
		$this->load->view('waiter/helprequests', $this->data);
		
		
       // print_r($this->db->last_query());
       
		

		
	}


	public function resolve()
	{
		if (!$this->input->is_ajax_request()){
			redirect('waiter/helprequests');
		}

		$this->tabletnotifications->resolve_notification();

		echo '1';
	}
}