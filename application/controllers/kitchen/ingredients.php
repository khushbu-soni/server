<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class ingredients extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->chekKitchenLogin();

		$this->data['dependencies'] = $this->load->view('kitchen/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus("Kitchen");

		
		//$this->data['sidebar'] = $this->load->view('waiter/sidebar',$this->data['sidemenu']);
		$this->data['active'] = 9;
		$this->data['header'] = $this->load->view('kitchen/header', '', TRUE);
		$this->data['sidebar'] = $this->load->view('kitchen/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('kitchen/deleteconfirmation', '', TRUE);
		$this->data['activeconfirm'] = $this->load->view('kitchen/activeconfirmation', '', TRUE);
		$this->load->model('ingredient_model', 'ingredients');
	}

	public function index()
	{
		$this->data['ingr_name'] = $this->ingredients->get_ingr();
		$this->data['ingredients'] = $this->ingredients->get_ingredients();
		$this->load->view('kitchen/list_ingredients',$this->data);
	}
	public function notification()
	{
	$this->data['notification_limit'] = $this->ingredients->notification_limit();
	$this->load->view('kitchen/notification_div',$this->data);
	}

	public function get_ingredients()
	{

		$this->data['ingredients'] = $this->ingredients->get_ingredients();
		$this->load->view('kitchen/ingredients',$this->data);
	}
	public function get_available_ingredients()
	{
		$search_key=$this->input->post('search_key');
		
		 
		$query=$this->db->query("select * from ingredients where name LIKE '$search_key%'");

		$ingredients =  $query->result_array();
		/*print_r($ingredients);
		exit();*/
		$html = '<b>Available Ingredients => '.$this->input->post('search_key').'</b><br>---------------------<br>';
		if(empty($ingredients))
		{
			$html = '<b>Ingredients Not Available </b>';
		}
		foreach ($ingredients as $ing){
			$html .= "";
			
				$html .= "".$ing['name']."";
			
			
				
				$html .= "<br>";
			}
		
		echo $html;
	

	}

	public function search()
	{
		if (!$this->input->is_ajax_request()){
			redirect('kitchen/ingredients', 'refresh');
		}

		$ingredients = $this->ingredients->search_by_title();
		
		
		$ingredients_html = "";
		if (empty($ingredients)){
			$ingredients_html .= "<tr class='alert alert-danger'><td><strong>No search results found.</strong><td><td>Null</td><td>Null</td><td>Null</td><td>Null</td></tr>";
		} else {
			
			       foreach ($ingredients as $ingr){

                          $ingredients_html .= 
                           '
                               <tr class="odd gradeX">
                                            <td>
                                            	'.$ingr->name.'
                                            </td>
                                            <td class="odd gradeX" width="150px;">
                                            '.$ingr->quantity.'
                                            </td>
                                            <td>
                                            	'.$ingr->min_ingr.'
                                            </td>
                                             <td>
                                            <a href="'.site_url('kitchen/ingredients/add/' . base64_encode($ingr->id)).'" class="btn btn-success">Quantity</a>
                                            </td>
                                            <td>
                                            <a href="'.site_url('kitchen/ingredients/edit/' . base64_encode($ingr->id)).'" class="btn btn-info transition">Edit</a>
                                            </td>
                                            <td>
											<a href="#confirm-modal" accountid="'.$ingr->id.'" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a>
                                            </td>
                                            
                                        </tr>
                           ';
                      }
				
			
		}
		echo $ingredients_html;
	}




	function name_exist_check($value, $str)
{
   //var_dump($value);
   //var_dump($str);
   $parts = explode('.', $str);
   $this->db->from($parts[0]);
   $this->db->where($parts[1], $value);
   $result = $this->db->get();

   //echo $this->db->last_query();
   //echo $result->num_rows();
   //exit();
   if($result->num_rows() > 0) {
   	 $this->session->set_flashdata('allready', "Ingredient Already In kitchen.");
    return FALSE;
   } else {
      return TRUE;
   }
} 
	public function addIngName()
	{

				
		if(isset($_POST) && !empty($_POST))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'ID', 'trim');
			$this->form_validation->set_rules('name', 'name', 'required|trim|callback_name_exist_check[ingredients.name]');
			$this->form_validation->set_rules('min_ingr', 'min_ingr', 'required|trim');
			$this->form_validation->set_rules('ing_type', 'ing_type', 'required|trim');
			

			if ($this->form_validation->run() == FALSE)
			{
				
			 $this->session->set_flashdata('allready', "Ingredient Already In kitchen.");
			redirect('kitchen/ingredients/edit/'.base64_encode($_POST['id']));
			}
			 else
			 {
				if(isset($_POST['id']) && !empty($_POST['id']))
				{
				$this->ingredients->update_ingredient_name(base64_decode($_POST['id']));
				
				$this->session->set_flashdata('successmsg', "Update ingredient successfully.");
				redirect('kitchen/ingredients');
				}
				else
				{
				
				$this->ingredients->insert_ingredient_name();
				$this->session->set_flashdata('successmsg', "New menu ingredient successfully created.");
				redirect('kitchen/ingredients');
				}

				
			}
		}else{
			
		if(isset($id) && !empty($id)){
			$this->data['ing_info'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
			}

			$this->load->view('kitchen/ingredients_name', $this->data);
		}

	}


	public function EditIngName()
	{

				
		if(isset($_POST) && !empty($_POST))
		{

			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'ID', 'trim');
			$this->form_validation->set_rules('name', 'name', 'required|trim');
			$this->form_validation->set_rules('min_limit', 'min_limit', 'required|trim');
			$this->form_validation->set_rules('ing_type', 'ing type', 'required|trim');
			

			if ($this->form_validation->run() == FALSE)
			{
				
			 $this->session->set_flashdata('errormsg', "Ingredient Already In kitchen.");
			redirect('kitchen/ingredients/edit/'.base64_encode($_POST['id']));
			}
			 else
			 {
				if(isset($_POST['id']) && !empty($_POST['id']))
				{
				$this->ingredients->update_ingredient_name($_POST['id']);
				
				$this->session->set_flashdata('successmsg', "Update ingredient successfully.");
				redirect('kitchen/ingredients');
				}
				

				
			}
		}
		
			
		

	}


	
	public function add($id='')
	{


		$this->data['ingr_name'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
		
		if(isset($_POST) && !empty($_POST))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'id', 'trim');
			
			$this->form_validation->set_rules('quantity', 'quantity', 'required|trim');

			if ($this->form_validation->run() == FALSE)
			{

				 $this->session->set_flashdata('errormsg', "Ingredient Already In kitchen.");
				$this->load->view('kitchen/ingredients', $this->data);
			}
			 else
			 {
				if(isset($_POST['id']) && !empty($_POST['id']))
				{
					
				$this->ingredients->update_ingredient(base64_decode($id));
				$this->session->set_flashdata('successmsg', "Update Quantity successfully.");
				$this->load->view('kitchen/ingredients_list', $this->data);
				
				}
				else
				{
				
				
				return redirect('kitchen/ingredients','refresh');
				}

				
			}
		}else{
			
		if(isset($id) && !empty($id)){
			$this->data['ing_info'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
			}
			
			
			$this->load->view('kitchen/ingredients', $this->data);
		}

	}


public function edit($id='')
	{
		$this->data['ingr_name'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
		
		if(isset($_POST) && !empty($_POST))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'ID', 'trim');
			
			$this->form_validation->set_rules('min_limit', 'min_limit', 'required|trim');
			$this->form_validation->set_rules('name', 'name', 'required|trim');
			$this->form_validation->set_rules('ing_type', 'ing_type', 'required|trim');

			if ($this->form_validation->run() == FALSE)
			{
				
			$this->load->view('kitchen/edit_ingredients', $this->data);
			}
			 else
			 {
				if(isset($_POST['id']) && !empty($_POST['id']))
				{

				$this->ingredients->update_ingredient_name(base64_decode($id));
				
				$this->session->set_flashdata('successmsg', "Update Ingredients successfully.");
				redirect('kitchen/ingredients');
				}
				else
				{
				
				
				redirect('kitchen/ingredients');
				}

				
			}
		}else{
			
		if(isset($id) && !empty($id)){
			$id=base64_decode($id);
			$this->data['ing_info'] = $this->ingredients->get_ingr_by_id($id);
			}

			$this->load->view('kitchen/edit_ingredients', $this->data);
		}

	}




	public function minus($id='')
	{
		$this->data['ingr_name'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
		$this->data['minus']=4;
		if(isset($_POST) && !empty($_POST))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('id', 'ID', 'trim');
			$this->form_validation->set_rules('quantity', 'quantity', 'required|trim');

			if ($this->form_validation->run() == FALSE)
			{
			$this->load->view('kitchen/ingredients', $this->data);
			}
			 else
			 {
				if(isset($_POST['id']) && !empty($_POST['id']))
				{
				$this->ingredients->update_ingredient_minus(base64_decode($_POST['id']));
				
				$this->session->set_flashdata('successmsg', "Update ingredient successfully.");
				redirect('kitchen/ingredients');
				}
				else
				{
				
			
				redirect('kitchen/ingredients');
				}

				
			}
		}else{
			
		if(isset($id) && !empty($id)){
			$this->data['ing_info'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
			}

			$this->load->view('kitchen/ingredients', $this->data);
		}

	}

public function filter($id)
	{
		if($id!='All'){
			$this->data['ingr_name'] = $this->ingredients->get_ingr();
			$this->data['ingredients'] = $this->ingredients->get_ingr_by_id($id);
			$this->load->view('kitchen/list_ingredients', $this->data);
		}else
		redirect('kitchen/ingredients');
			
	}
	// public function edit($ingredientid)
	// {
	// 	$this->load->library('form_validation');

	// 	$this->form_validation->set_rules('name', 'name', 'required');

	// 	if ($this->form_validation->run() == FALSE){
	// 		$this->data['ingredients'] = $this->ingredients->get_ingredients($ingredientid);
	// 		$this->load->view('manager/editingredient', $this->data);
	// 	} else {
	// 		//insert the ingredient into the database
	// 		$this->ingredients->edit_ingredient($ingredientid);
			
	// 		$this->session->set_flashdata('successmsg', "Menu ingredient successfully updated.");
	// 		redirect('manager/ingredient');
	// 	}
	// }

	function delete($id)
	 {

 	$this->ingredients->delete_ingredient($id);
	 	$this->session->set_flashdata('successmsg', 'ingredient successfully deleted.');
	redirect('kitchen/ingredients');

 }
 function active($id)
	 {

 	$this->ingredients->active_ingredient($id);
	 	$this->session->set_flashdata('successmsg', 'ingredient successfully deleted.');
	redirect('kitchen/ingredients');

 }
 
}