<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class email extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		
		$this->load->model('notification_log', 'notifications');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		
	}

	public function index()
	{
		$this->data['info']=$this->configruation_model->get_all();
		$this->load->view('manager/email', $this->data);
	}
	public function emailconfig()
	{

		$query = $this->db->query("select * from email");
		$email_data = $query->row();
		
		
		if ($email_data > 0) {

			$data = array(
			'name' => $this->input->post('name'),
			'from' => $this->input->post('from'),
			'to' => $this->input->post('to'),
			'cc' => $this->input->post('cc'),
			'bcc' => $this->input->post('bcc'),
			'host' => $this->input->post('host'),
			'port' => $this->input->post('port'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'type' => $this->input->post('type'),
			'available' => $this->input->post('available')

			);

			$this->db->update('email',$data);
			//print_r($this->db->last_query());
			
		}else
		{

		$data = array(
			'name' => $this->input->post('name'),
			'from' => $this->input->post('from'),
			'to' => $this->input->post('to'),
			'cc' => $this->input->post('cc'),
			'bcc' => $this->input->post('bcc'),
			'host' => $this->input->post('host'),
			'port' => $this->input->post('port'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'type' => $this->input->post('type'),
			'available' => $this->input->post('available')

			);
			$this->db->insert('email',$data);

		}
	$data_config = array(
            'email_id' => $email_data->id
            
        );

	$condition=
	array(
            'manager_id' => $this->session->userdata('userid')
            
        );

         $this->db->update('configraution',$data_config,$condition);

     


         $this->session->set_flashdata('email_config', "Insert Success.");

			redirect('manager/email');

		
	}


	

	
	
}
