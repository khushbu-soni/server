<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Status extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['header'] = $this->load->view('manager/header',$this->data);

		$this->load->model('status_model', 'status');
	}

	public function index()
	{
		$this->data['status'] = $this->status->get_all();
		$this->data['status_name'] = $this->status->get_all();
		$this->load->view('manager/status', $this->data);
	}

	public function filter($id)
	{
		if($id!='All'){
			$this->data['status_name'] = $this->status->get_all();
			$this->data['status'] = $this->status->get_status_by_id($id);
			$this->load->view('manager/status', $this->data);
		}else
		redirect('manager/status');
			
	}

	public function orderBy($arrange){
		$this->data['status'] = $this->status->get_all_orderBy($arrange);
		$this->data['status_name'] = $this->status->get_all();
		$this->load->view('manager/status', $this->data);
		

	}
	public function add()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('order', 'order', 'required');
		$this->form_validation->set_rules('bgcolor', 'bgcolor', 'required');
		$this->form_validation->set_rules('color', 'color', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/addstatus', $this->data);
		} else {
			//insert the  menutype into the database
			$menutypeid = $this->status->insert_status();
			$this->session->set_flashdata('successmsg', "New Status menutype successfully created.");
			redirect('manager/status');
			

			

		}
	}

	public function edit($statusid)
	{
		// $statusid=base64_decode($statusid);
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('order', 'order', 'required');
		$this->form_validation->set_rules('bgcolor', 'bgcolor', 'required');
		$this->form_validation->set_rules('color', 'color', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['status'] = $this->status->get_status_by_id($statusid);
		// 	print_r($this->data['status']);
		// exit();
			$this->load->view('manager/editstatus', $this->data);
		} else {
			//insert the menutype into the database
			$this->status->edit_status($statusid);
			
			$this->session->set_flashdata('successmsg', "Status successfully updated.");
			redirect('manager/status');
		}
	}

	function delete($statusid)
	{
		$this->status->delete_status($statusid);
		$this->session->set_flashdata('successmsg', 'status successfully deleted.');
		redirect('manager/status');

	}
}