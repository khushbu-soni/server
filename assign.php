<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Assign extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 4;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['header'] = $this->load->view('manager/header',$this->data);

		$this->load->model('assign_model','assign_table');
		$this->load->model('staff_model', 'staffs');
		$this->load->model('configruation_model','configruation_model');
	}

	public function index()
	{
		$this->data['waiters'] = $this->staffs->waiters();
		$this->data['tablenumbers'] = $this->configruation_model->get_all();
		$this->data['used_table'] = $this->assign_table->get_all();
		$this->load->view('manager/assign_table',$this->data);
	}
	public function filter($id)
	{

		if($id!='All'){
			$this->data['waiters_name'] = $this->staffs->waiters();
			$this->data['assign_info'] = $this->assign_table->get_staff_by_waiterid($id);
			// $this->data['assign_info'] = $this->assign_table->get_staff_by_waiterid($id);
			$this->load->view('manager/assign_info', $this->data);
		}else
		redirect('manager/assign/assign_info');
			
	}
	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('waiter_id', 'waiter_id', 'required');
		$this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		// $this->form_validation->set_rules('tabletnumber', 'tabletnumber', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['tablenumbers'] = $this->configruation_model->get_all();
			$this->load->view('assign', $this->data);
		} else {
			//insert the  item into the database
			//Check dupliacte Table Number
			if($this->assign_table->alreadyExit($this->input->post('tablenumber'))){
				$this->session->set_flashdata('successmsg', "This Table Allready Assign, Please Choose another.");
				redirect('manager/assign');
			}
			// Waiter Assign Limit form config TODO
			
			 $this->assign_table->create();

			$this->session->set_flashdata('successmsg', "Assign successfully .");
				redirect('manager/assign/assign_info');
		}
	}


	public function assign_info(){
		$this->data['assign_info'] = $this->assign_table->get_all();
		$this->data['waiters_name'] = $this->staffs->waiters();
		$this->load->view('manager/assign_info', $this->data);
	}

	public function edit($assignid)
	{
		$assignid=base64_decode($assignid);
		$this->load->library('form_validation');

		$this->form_validation->set_rules('waiter_id', 'waiter_id', 'required');
		$this->form_validation->set_rules('tablenumber', 'tablenumber', 'required');
		// $this->form_validation->set_rules('tabletnumber', 'tabletnumber', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['records'] = $this->assign_table->get_record($assignid);
			$this->data['waiters'] = $this->staffs->waiters();
			$this->data['tablenumbers'] = $this->configruation_model->get_all();
			$this->data['used_table'] = $this->assign_table->get_all();
			$this->load->view('manager/editassign', $this->data);
		} else {
			//update the  record into the database
			//Check dupliacte Table Number
			if($this->assign_table->alreadyExit($this->input->post('tablenumber'),$assignid)){
				$this->session->set_flashdata('successmsg', "Can't Change Table Number, This Table Allready Assign, Please Choose Another.");
				redirect('manager/assign/assign_info');
			}

			// Waiter Assign Limit form config TODO

			$this->assign_table->edit($assignid);
			
			$this->session->set_flashdata('successmsg', "Record successfully updated.");
			redirect('manager/assign/assign_info');
		}
	}

	function delete($assignid)
	{
		$this->assign_table->delete($assignid);

		$this->session->set_flashdata('successmsg', 'delete successfully deleted.');
		redirect('manager/assign/assign_info','refresh');
	}
}