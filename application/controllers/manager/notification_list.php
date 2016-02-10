<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class notification_list extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->load->model('notification_log', 'notifications');
		$this->load->model('notification_master');
		// $this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		// $this->data['notifications_info'] = $this->notifications->get_notifications();
		// $this->data['notifications']=$this->notifications->get_all_unwatched();

		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 5;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['header'] = $this->load->view('manager/header','',TRUE);
	}

	public function index()
	{
		$this->data['notifications_info'] = $this->notification_master->get_all();
		
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('manager/notifications_master', $this->data);
		// $this->load->view('manager/header', $this->data);
	}

	public function display($id){
		$this->data['notifications_info'] = $this->notification_master->get_all();
		
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('manager/notifications_master', $this->data);
		// $this->load->view('manager/header', $this->data);
	}

	public function status($id){
		// $id=base64_decode($id);
		$status_info=$this->notification_master->get($id);
		// print_r($status_info);
		// exit();
		if($status_info->is_active){
				$this->notification_master->mark_deactive($id);
				$this->session->set_flashdata('successmsg', "Notification DeActive Now.");
				redirect('manager/notification_list');	
		}else{
				$this->notification_master->mark_active($id);
				$this->session->set_flashdata('successmsg', "Notification Active Now.");
				redirect('manager/notification_list');	
			} 
		}
	
	
}