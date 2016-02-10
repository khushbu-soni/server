<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class UserAccounts extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 5;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		
		
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['notification_info']=$this->notifications->get_notifications();
		$this->data['header'] = $this->load->view('manager/header',$this->data);

		
		// $this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('staff_model', 'users');
	}

	public function index()
	{
		$this->data['useraccounts'] = $this->users->get_staff_members();
		$this->data['users_name'] = $this->users->get_staff_members();
		$this->load->view('manager/useraccounts', $this->data);
	}

	public function filter($id)
	{
		if($id!='All'){
			$this->data['users_name'] = $this->users->get_staff_members();
			$this->data['useraccounts'] = $this->users->get_staff_by_id($id);
			$this->load->view('manager/useraccounts', $this->data);
		}else
		redirect('manager/useraccounts');
			
	}

	public function filter_by_role($role)
	{
		if($role!='All'){
			$this->data['users_name'] = $this->users->get_staff_members();
			$this->data['useraccounts'] = $this->users->get_staff_by_role($role);
			$this->load->view('manager/useraccounts', $this->data);
		}else
		redirect('manager/useraccounts');
			
	}

	public function do_upload($file)
	{
		
		$config['upload_path'] = $this->config->item('img_upload');	
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['file_name'] = $file . '.jpg';

		$this->load->library('upload', $config);

		return $this->upload->do_upload();
	}
	
	public function create()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');
		$this->form_validation->set_rules('role', 'account type', 'required');
		$this->form_validation->set_rules('uname', 'username', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/createaccount', $this->data);
			
		} else {
			$file=explode('.', $_FILES['userfile']['name']);
			if($file){
				
			if(!$this->do_upload($file[0]))
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}
			// if ($this->do_upload($file[0])){
			// 	//file upload was successful
			// 	//update the image field of the menuitem
			// 	$this->users->update_image($file);
				
			// } else {
			// 	//file upload failed
			// 	$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			// }

			//add the account to the database
			$this->users->insert_new_staff_member($file[0]);

			$this->session->set_flashdata('successmsg', "New user account successfully created.");
			redirect('manager/useraccounts');
		}
	}

	public function edit($userid)
	{
		$userid=base64_decode($userid);

		$this->load->library('form_validation');

		$this->form_validation->set_rules('fname', 'first name', 'required');
		$this->form_validation->set_rules('lname', 'last name', 'required');
		$this->form_validation->set_rules('role', 'account type', 'required');
		$this->form_validation->set_rules('uname', 'username', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['useraccounts'] = $this->users->get_staff_by_id($userid);

			$this->load->view('manager/editaccount', $this->data);
		} else {
			//update the account
			$file=explode('.', $_FILES['userfile']['name']);
			
			if(!$this->do_upload($file[0]))
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
				
			$this->users->edit_account($userid,$file[0]);
			$this->session->set_flashdata('successmsg', "User account successfully updated.");

			redirect('manager/useraccounts');
		}
	}

	public function delete($userid)
	{
		$var=$this->users->table_assign($userid);
		
		// if($this->staff_model->is_table_assign())
		// 	$this->session->set_flashdata('successmsg', "Can't delete, Tables assign to this waiter.");
		if($var->count){
			$this->session->set_flashdata('successmsg', 'Waiter Can not delete, Kindly Remove Assign Tables  .');
			redirect('manager/useraccounts','refresh');
		}else{
			$this->users->delete_account($userid);
			$this->session->set_flashdata('successmsg', 'User account successfully deleted.');
			redirect('manager/useraccounts','refresh');
		}

	}
}