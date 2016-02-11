<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class ingredients extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation_model');

		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 2;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);
		
$this->data['header'] = $this->load->view('manager/header',$this->data);
		$this->load->model('ingredient_model', 'ingredients');
	}

	public function index()
	{
		$this->data['ingredients'] = $this->ingredients->get_ingredients();
		// $this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->load->view('manager/ingredientslist',$this->data);
	}
	
	public function add(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('manager/addingredient', $this->data);
		} else {
			//insert the  ingredient into the database
			if($this->ingredients->alreadyExit($this->input->post('name'))){
				$this->session->set_flashdata('successmsg', "Already added, Please Edit.");
				redirect('manager/ingredients');
			}
			$this->ingredients->insert_ingredient();
			$this->session->set_flashdata('successmsg', "New menu ingredient successfully created.");
			redirect('manager/ingredients');
			

		}
	}


	public function edit($ingredientid)
	{
		$ingredientid=base64_decode($ingredientid);
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->data['ingredients'] = $this->ingredients->get_ingredients_by_id($ingredientid);
			$this->load->view('manager/editingredient', $this->data);
		} else {
			//insert the ingredient into the database
			$this->ingredients->edit_ingredient($ingredientid);
			
			$this->session->set_flashdata('successmsg', "Menu ingredient successfully updated.");
			redirect('manager/ingredient');
		}
	}

	function delete($ingredientid)
	{
		$this->ingredients->delete_ingredient($ingredientid);
		$this->session->set_flashdata('successmsg', 'ingredient successfully deleted.');
		redirect('manager/ingredient');

	}
}