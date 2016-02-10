<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class MenuItems extends CI_Controller {
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

		$this->load->model('menuitem_model', 'menuitems');
		$this->load->model('menutype_model', 'menutype');
		$this->load->model('ingredient_model', 'ingredients');
	}

	public function index()
	{
		$this->data['biryani_menuitems'] = $this->menuitems->get_all_biryani_house_menuitems();
		$this->data['biryani_menuitems_name'] = $this->menuitems->get_all_biryani_house_menuitems();
		
		$this->data['cafe_one_six_menuitems'] = $this->menuitems->get_all_cafe_one_six_menuitems();
		$this->data['cafe_one_six_menuitems_menuitems_name'] = $this->menuitems->get_all_cafe_one_six_menuitems();
		
		$this->data['bar_menuitems'] = $this->menuitems->get_all_bar_menuitems();
		$this->data['bar_menuitems_name'] = $this->menuitems->get_all_bar_menuitems();

		$this->load->view('manager/menuitems', $this->data);
	}

	public function filter($id)
	{
		if($id!='All'){
			
			$this->data['menuitems_name'] = $this->menuitems->get_all_menuitems();
			$this->data['menuitems'] = $this->menuitems->get_menuitem_by_id($id);
			// print_r($this->data['menuitems']); 
			// echo $this->db->last_query();
			// exit();
			$this->load->view('manager/menuitems', $this->data);
		}else
		redirect('manager/menuitems');
			
	}
	
	public function restro_add()
	{
		// print_r($_POST);
		// exit();
		if(isset($_POST['ingredients']))
			$ingredients = implode(',',$_POST['ingredients']);
		else
			$ingredients = "";

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('calories', 'calories', 'required');
		$this->form_validation->set_rules('type', 'item type', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		// $this->form_validation->set_rules('ingredients', 'ingredients', 'required');
		$this->form_validation->set_rules('item_no', 'item_no', 'required');
		// $this->form_validation->set_rules('res_category', 'res_category', 'required');

		
		if ($this->form_validation->run() == FALSE){
			$this->data['menutypes']=$this->menutype->get_all_menutypes();
			$this->data['ingredients'] = $this->ingredients->get_ingredients();
			$this->load->view('manager/addmenuitem', $this->data);
		} else {
			//insert the menu item into the database
			$menuitemid = $this->menuitems->insert_menuitem($ingredients,'restro');
			//insert ingredients
			if (trim($this->input->post('ingredients')) != ''){
				//there are optional ingredients
				$ingredients = explode(',', $this->input->post('ingredients'));
				foreach ($ingredients as $ingredient){
					$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
					$this->db->insert('ingredient', $data);
				}
			}

			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}

			$this->session->set_flashdata('successmsg_restro', "New menu item successfully created.");
			redirect('manager/menuitems');
		}
	}


	public function bar_add()
	{

		// print_r($_POST);
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('item_no', 'item_no', 'required');
		// $this->form_validation->set_rules('userfile', 'userfile', 'required');
		// $this->form_validation->set_rules('available', 'available', 'required');

		
		if ($this->form_validation->run() == FALSE){

			$this->data['menutypes']=$this->menutype->get_all_menutypes();
			$this->data['ingredients'] = $this->ingredients->get_ingredients();
			$this->load->view('manager/addbarmenuitem', $this->data);
		} else {
			//insert the menu item into the database
			// print_r($this->input->post('name'));
			// exit();
			$menuitemid = $this->menuitems->insert_menuitem(null,'bar');
			 $this->ingredients->insert_ingredient('bar');

			//insert ingredients
			// if (trim($this->input->post('ingredients')) != ''){
			// 	//there are optional ingredients
			// 	$ingredients = explode(',', $this->input->post('ingredients'));
			// 	foreach ($ingredients as $ingredient){
			// 		$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
			// 	}
			// }

			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}

			$this->session->set_flashdata('successmsg', "New menu item successfully created.");
			redirect('manager/menuitems');
		}
	}
	//uploads the image for the menu item
	public function do_upload($menuitemid)
	{
		$config['upload_path'] = $this->config->item('img_upload');	
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		$config['overwrite'] = true;
		$config['file_name'] = $menuitemid . '.jpg';

		$this->load->library('upload', $config);

		return $this->upload->do_upload();
	}

	public function edit_bar($menuitemid)
	{
		// print_r($_POST);
		// exit();
		$menuitemid=base64_decode($menuitemid);
		if(isset($_POST['ingredients']))
			$ingredients = implode(',',$_POST['ingredients']);
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('item_no', 'item_no', 'required');
		

		if ($this->form_validation->run() == FALSE){
			$this->data['menuitem'] = $this->menuitems->get_menuitem($menuitemid);
			$this->data['menutypes']=$this->menutype->get_all_menutypes();
			$this->data['ingredients'] = $this->ingredients->get_ingredients();
			$this->load->view('manager/editmenuitem_bar', $this->data);
		} else {
			
			//insert the menu item into the database
			$this->menuitems->edit_menuitem($menuitemid,$ingredients,"bar");
			
			//update ingredients - delete first
			// $this->load->model('ingredient_model', 'ingredients');
			// $this->ingredients->remove_ingredient_by_id($menuitemid);

			// if (trim($this->input->post('ingredients')) != ''){
			// 	//there are optional ingredients
			// 	$ingredients = explode(',', $this->input->post('ingredients'));
			// 	foreach ($ingredients as $ingredient){
			// 		$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
			// 		$this->db->insert('ingredient', $data);
			// 	}
			// }

			//update image
			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}
			$this->session->set_flashdata('successmsg', "Menu item successfully updated.");

			redirect('manager/menuitems');
		}
	}

	public function edit_res($menuitemid)
	{
		// print_r($_POST);
		// exit();
		$menuitemid=base64_decode($menuitemid);
		if(isset($_POST['ingredients']))
			$ingredients = implode(',',$_POST['ingredients']);
		else
			$ingredients = "";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('item_no', 'item_no', 'required');
		$this->form_validation->set_rules('res_category', 'res_category', 'required');
		
		// print_r($_POST);
		// exit();
		if ($this->form_validation->run() == FALSE){
			$this->data['menuitem'] = $this->menuitems->get_menuitem($menuitemid);
			$this->data['menutypes']=$this->menutype->get_all_menutypes();
			$this->data['ingredients'] = $this->ingredients->get_ingredients();
			$this->load->view('manager/editmenuitem_res', $this->data);
		} else {
			
			//insert the menu item into the database
			$this->menuitems->edit_menuitem($menuitemid,$ingredients,'restro');
			
			//update ingredients - delete first
			// $this->load->model('ingredient_model', 'ingredients');
			// $this->ingredients->remove_ingredient_by_id($menuitemid);

			// if (trim($this->input->post('ingredients')) != ''){
			// 	//there are optional ingredients
			// 	$ingredients = explode(',', $this->input->post('ingredients'));
			// 	foreach ($ingredients as $ingredient){
			// 		$data = array('menuItemid'=>$menuitemid, 'name'=>ucfirst(trim($ingredient)));
			// 		$this->db->insert('ingredient', $data);
			// 	}
			// }

			//update image
			if ($this->do_upload($menuitemid)){
				//file upload was successful
				//update the image field of the menuitem
				$this->menuitems->update_image($menuitemid);
			} else {
				//file upload failed
				$this->session->set_flashdata('fileuploaderror', $this->upload->display_errors());
			}
			$this->session->set_flashdata('successmsg', "Menu item successfully updated.");

			redirect('manager/menuitems');
		}
	}

	function delete($menuitemid)
	{
		$this->menuitems->delete_menuitem($menuitemid);

		$this->session->set_flashdata('successmsg', 'Menu item successfully deleted.');
		redirect('manager/menuitems','refresh');
	}
	function featured_item($menuitemid)
	{
		echo $menuitemid;


		$this->menuitems->set_featured_item($menuitemid);

		$this->session->set_flashdata('successmsg', 'featured Menu item successfully .');
		
		redirect('manager/menuitems','refresh');
	}
		

	public function search_res()
	{
		if (!$this->input->is_ajax_request()){
			redirect('manager/menuitems', 'refresh');
		}

		$menuitems = $this->menuitems->search_by_title();
		
		
		$menuitems_html = "";
		if (empty($menuitems)){
			$menuitems_html .= "<tr class='alert alert-danger'><td><strong>No search results found.</strong><td><td>Null</td><td>Null</td><td>Null</td><td>Null</td></tr>";
		} else {
			
			       foreach ($menuitems as $menu){

                          $menuitems_html .= 
                           '
                               <tr class="odd gradeX">
                                            <td>
                                            	'.$menu->name.'
                                            </td>
                                             <td>
                                            <a href="'.site_url('manager/menuitems/restro_add/' . base64_encode($menu->id)).'" class="btn btn-success">Quantity</a>
                                            </td>
                                            <td>
                                            <a href="'.site_url('manager/menuitems/edit_res/' . base64_encode($menu->id)).'" class="btn btn-info transition">Edit</a>
                                            </td>
                                            <td>
											<a href="#confirm-modal" accountid="'.$menu->id.'" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a>
                                            </td>
                                            
                                        </tr>
                           ';
                      }
				
			
		}
		echo $menuitems_html;
	}

	public function search_bar()
	{
		if (!$this->input->is_ajax_request()){
			redirect('manager/menuitems', 'refresh');
		}

		$menuitems = $this->menuitems->search_bar_by_title();
		
		
		$menuitems_html = "";
		if (empty($menuitems)){
			$menuitems_html .= "<tr class='alert alert-danger'><td><strong>No search results found.</strong><td><td>Null</td><td>Null</td><td>Null</td><td>Null</td></tr>";
		} else {
			
			       foreach ($menuitems as $menu){

			       		
                                         if ($menu->featured_item == 1) {
                                           
                                          $td='<td><a href="#confirm-modal" accountid="<?php echo $menu->id; ?>" onclick="unfeatured_item(event)" data-toggle="modal" class="btn btn-success">Un featured</a></td>';

                                           }
                                           else {

                                            $td='<td><a href="#confirm-modal" accountid="<?php echo $menu->id; ?>" onclick="featured_item(event)" data-toggle="modal" class="btn btn-danger">featured</a></td>';
                                           }

                          $menuitems_html .= 
                           '
                               <tr class="odd gradeX">
                                            <td>
                                            	'.$menu->name.'
                                            </td>
                                             
                                            <td>
                                            <a href="'.site_url('manager/menuitems/edit_bar/' . base64_encode($menu->id)).'" class="btn btn-info transition">Edit</a>
                                            </td>'.$td.'

                                            <td>
											<a href="#confirm-modal" accountid="'.$menu->id.'" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a>
                                            </td>
                                            
                                        </tr>
                           ';
                      }
				
			
		}
		echo $menuitems_html;
	}

	function unfeatured_item($menuitemid)
	{
		$menuitemid;


		$this->menuitems->unset_featured_item($menuitemid);

		$this->session->set_flashdata('successmsg', 'Un featured Menu item successfully .');
		//redirect('manager/menuitems','refresh');
	}
}