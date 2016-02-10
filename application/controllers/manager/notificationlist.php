<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Notificationlist extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
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
		// $this->notifications->mark_watched();
		// $this->data['notifications'] = $this->notifications->get_all_unwatched();
		$this->data['notification_type'] = $this->notification_master->get_all();
		$this->data['notifications_info'] = $this->notifications->get_all();
		
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('manager/notifications', $this->data);
		// $this->load->view('manager/header', $this->data);
	}
	public function mark_watch(){
		$this->notifications->mark_watched($_POST['id']);
	}
	public function count(){
		
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['last_id_info']=$this->notifications->get_last_id();

		$this->load->view('manager/notify',$this->data);
	}

	public function last_id(){
		$last_id_info=$this->notifications->get_last_id();
		echo $last_id_info['last_id'];
		
	}
	public function get_notifications(){
		$last_id_info=$this->data['last_id_info']=$this->notifications->get_last_id();
		if(!empty($last_id_info))
			 $last_id=$last_id_info['last_id'];
		 $last_id=0;
		// $this->session->set_userdata('new_last_id',$last_id);
		$this->data['notifications_info'] = $this->notifications->get_notifications();
		$this->load->view('manager/notify_li_part',$this->data);

	}


	public function checklist(){
		$last_id_info=$this->data['last_id_info']=$this->notifications->get_last_id();
		 $last_id=$last_id_info['last_id'];
		 $id_from_session=$this->session->userdata['new_last_id'];
			$this->data['notifications_info'] = $this->notifications->load_notifications_by_id($last_id);
	
		if($last_id!=$id_from_session){
			$this->session->set_userdata('new_last_id',$last_id);
			$this->load->view('manager/checklist',$this->data);
		}else{	
		
			
			$this->load->view('manager/checklist1');
		
			
		}

	}
	public function filter($id)
	{
		if($id!='All'){
			$this->data['notification_type'] = $this->notification_master->get_all();
			$this->data['notifications_info'] = $this->notifications->get_notifications_by_id($id);
			$this->load->view('manager/notifications', $this->data);
		}else
		redirect('manager/notificationlist');
			
	}

	public function display($id){
		$id= base64_decode($id);
		$this->data['notifications'] = $this->notifications->get_all_unwatched();
		$this->data['notification_type'] = $this->notification_master->get_all();
		$this->data['notifications_info'] = $this->notifications->get_all();
		$this->data['id']=$id;
		
		// $this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('manager/notifications', $this->data);
	}
}