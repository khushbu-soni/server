<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Configruation extends CI_Controller {
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
		$this->load->model('configruation_model');
	}

	public function index()
	{
		$this->data['info']=$this->configruation_model->get_all();
		$this->load->view('manager/configruation', $this->data);
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

	
	public function setOrderPerPage(){


		$this->load->library('form_validation');

		$this->form_validation->set_rules('min_order_per_page', 'min_order_per_page', 'required');
		$this->form_validation->set_rules('tax', 'tax', 'required');
		
		if ($this->form_validation->run() == FALSE){

			$this->load->view('manager/configruation', $this->data);
		} else {
			$user_data=$this->session->userdata;
			$file=explode('.', $_FILES['userfile']['name']);
			$file1=explode('.', $_FILES['userfile1']['name']);
			
			if ($this->do_upload($file[0]) and $this->do_upload($file1[0]) ){
				$this->configruation_model->update_image($file,$file1);
								
			} else {
				//file upload failed

				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}
			

			if($this->configruation_model->alreadySet($user_data['userid'])){

				$this->configruation_model->edit($file);
				$this->configruation_model->update_order($user_data['userid'],$file,$file1);
				// throw new Exception("Error Processing Request", 1);
				$this->session->set_flashdata('successmsg', "Configruation successfully Updated.");
			}else
				$this->configruation_model->create();
				$this->session->set_flashdata('successmsg', "Configruation successfully Updated.");
			}
			redirect('manager/configruation');
	}

}
