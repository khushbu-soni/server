<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Menutype extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
			$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active-sub']=12;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);

		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['header'] = $this->load->view('manager/header',$this->data);

		$this->load->model('menutype_model', 'menutypes');
	}

	public function index()
	{
		$this->data['menutypes'] = $this->menutypes->get_all_menutypes();
		$this->data['menutypes_name'] = $this->menutypes->get_all_menutypes();
		$this->load->view('manager/menutypes', $this->data);
	}

	public function filter($id)
	{
		if($id!='All'){
			$this->data['menutypes_name'] = $this->menutypes->get_all_menutypes();
			$this->data['menutypes'] = $this->menutypes->get_menutype_by_id($id);
			$this->load->view('manager/menutypes', $this->data);
		}else
		redirect('manager/menutype');
			
	}
	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('menutype_name', 'menutype_name', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/addmenutype', $this->data);
		} else {
			//insert the  menutype into the database
			$menutypeid = $this->menutypes->insert_menutype();
			$this->session->set_flashdata('successmsg', "New  Menu Type successfully created.");
			redirect('manager/menutype');
			

			

		}
	}


	public function edit($menutypeid)
	{
		$menutypeid=base64_decode($menutypeid);
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('menutype_name', 'name', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['menutype'] = $this->menutypes->get_menutype($menutypeid);
			$this->load->view('manager/editmenutype', $this->data);
		} else {
			//insert the menutype into the database
			$this->menutypes->edit_menutype($menutypeid);
			
			$this->session->set_flashdata('successmsg', "Menu Type successfully updated.");
			redirect('manager/menutype');
		}
	}

	function delete($menutypeid)
	{
		$this->menutypes->delete_menutype($menutypeid);
		$this->session->set_flashdata('successmsg', 'menutype successfully deleted.');
		redirect('manager/menutype','refresh');

	}
}