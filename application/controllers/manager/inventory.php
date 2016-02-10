<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Inventory extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->load->model('ingredient_model', 'ingredients');
		$this->load->model('configruation_model','configruation_model');
		$this->data['sidemenu']=$this->configruation_model->sidebar_menus('Manager');
		$this->data['active'] = 17;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);

		$this->load->model('stock_model', 'allstock');
	}

	// public function index()
	// {
	// 	$this->data['res_today_stock'] = $this->allstock->get_res_today_stock();
	// 	$this->data['res_all_stock'] = $this->allstock->get_res_all_stock();
		
	// 	$this->data['bar_today_stock'] = $this->allstock->get_bar_today_stock();
	// 	$this->data['bar_all_stock'] = $this->allstock->get_bar_all_stock();

	// 	$this->load->view('manager/stock', $this->data);
	// }

	public function index()
	{
		$this->data['res_today_stock'] = $this->allstock->get_res_today_stock();
		$this->data['res_all_stock'] = $this->allstock->get_res_all_stock();
		
		$this->data['bar_today_stock'] = $this->allstock->get_bar_today_stock();
		$this->data['bar_all_stock'] = $this->allstock->get_bar_all_stock();
		$this->data['ingredients']=$this->ingredients->get_ingredients_name();
		$this->data['inward_ingredients']=$this->ingredients->get_inward_ingredients_name();
		$this->load->view('manager/stock', $this->data);
	}
// public function edit_inward($value=''){
// 	echo  "<div class='form-group'>
//             <div class='input-group date'>
//                 <input type='text' class='form-control datepicker' id='inward_edit_date' data-date-format='mm/dd/yyyy' value=".date('Y-m-d')." required />
//                 <span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span>
//                 </span>
//             </div>
//         </div>";

// }


	function addinward(){

		$this->allstock->addInward($_GET);


		$inward_info=$this->data['inward_info']=$this->allstock->get_all('Inward');

				$tbody="";
				foreach ($inward_info as $received){

					$inward_qty=$this->data['inward_qty']=$this->allstock->get_curent_stock($received['item_id'],'Inward');
					
				$consume_qty=$this->data['consume_qty']=$this->allstock->get_curent_stock($received['item_id'],'Consume');
					$total_current_stock= $inward_qty[0]['qty']-$consume_qty[0]['qty'];
					if($total_current_stock<0)
							$total_current_stock=0;
					$tbody.="<tr>
						    <td>". $received['date']."</td>
						    <td>".$received['name']."</td>
						    <td>".$received['qty']." ".$received['unit']."</td>
						    <td>".round($received['price'],2)."</td>
						     <td>".$received['qty']." ".$received['unit']."</td>
						    <td>";
						

						 	$tbody.="
						     <td>
						    <p data-placement='top' data-toggle='tooltip' title='Delete'>
						    <button class='btn btn-danger btn-xs' data-title='Delete' atrr=".$received['id']." onclick=delete_received_record(".$received['id'].") data-toggle='modal' data-target=#"."delete>
						    <span class='glyphicon glyphicon-trash'>
						    </span>
						    </button>
						    </p>
						    </td>
						    </tr>"	;
						 
						    
				}

				echo $tbody;
	}

	function addconsume(){

		$this->allstock->addConsume($_GET);


		$consume_info=$this->data['consume_info']=$this->allstock->get_all('Consume');
		
				$tbody="";
				foreach ($consume_info as $received){
					$inward_qty=$this->data['inward_qty']=$this->allstock->get_curent_stock($received['item_id'],'Inward');
					
				$consume_qty=$this->data['consume_qty']=$this->allstock->get_curent_stock($received['item_id'],'Consume');
					$total_current_stock= $inward_qty[0]['qty']-$consume_qty[0]['qty'];
					if($total_current_stock<0)
							$total_current_stock=0;
					$tbody.="<tr>
						    <td>". $received['date']."</td>
						    <td>".$received['name']."</td>
						    <td>".$received['qty']." ".$received['unit']."</td>
						   
						     <td>".$received['qty']." ".$received['unit']."</td>
						    <td>";
						

						 	$tbody.="
						     <td>
						    <p data-placement='top' data-toggle='tooltip' title='Delete'>
						    <button class='btn btn-danger btn-xs' data-title='Delete' atrr=".$received['id']." onclick=delete_received_record(".$received['id'].") data-toggle='modal' data-target=#"."delete>
						    <span class='glyphicon glyphicon-trash'>
						    </span>
						    </button>
						    </p>
						    </td>
						    </tr>"	;
						 
						    
				}

				echo $tbody;
	}

	function consume_report(){
		$start_date=$_POST['start_date'];
		$end_date=$_POST['end_date'];
		$consume_info=$this->data['consume_info']=$this->allstock->consume_filter_by_date($start_date,$end_date);

				$tbody="";
				$total_current_stock=0;
				foreach ($consume_info as $received){
					
					$tbody.="<tr>
						    <td>".$received['name']."</td>
						    <td>".$received['qty']." ".$received['unit']."</td>
						    <td>".round($received['last_purcahse_price'],2)."</td>
						    <tr/>";
						
						 
						    
				}

				echo $tbody;
	}

	function consume(){


		$consume_info=$this->data['consume_info']=$this->allstock->get_all('Consume');
		// echo "<pre>";
		// print_r($inward_info);
		// echo "</pre>";
		// exit();
				$tbody="";
				$total_current_stock=0;
				foreach ($consume_info as $received){
					$inward_qty=$this->data['inward_qty']=$this->allstock->get_curent_stock($received['item_id'],'Inward');
					
				$consume_qty=$this->data['consume_qty']=$this->allstock->get_curent_stock($received['item_id'],'Consume');
					$total_current_stock= $inward_qty[0]['qty']-$consume_qty[0]['qty'];
					if($total_current_stock<0)
							$total_current_stock=0;
					$tbody.="<tr>
						    <td>". $received['date']."</td>
						    <td>".$received['name']."</td>
						    <td>".$received['qty']." ".$received['unit']."</td>
						    
						     <td>".$received['qty']." ".$received['unit']."</td>
						    <td>";
						

						 	$tbody.="
						     
						   <p data-placement='top' data-toggle='tooltip' title='Delete'>
						    <button class='btn btn-danger btn-xs' data-title='Delete' atrr=".$received['id']." onclick=delete_paid_record(".$received['id'].") data-toggle='modal' data-target=#"."myModalX>
						    <span class='glyphicon glyphicon-trash'>
						    </span>
						    </button>
						    </p>
						    </td>
						    </tr>"	;
						 
						    
				}

				echo $tbody;
	}



	function inward(){
		$inward_info=$this->data['inward_info']=$this->allstock->get_all('Inward');

		// echo "<pre>";
		// print_r($inward_info);
		// echo "</pre>";
		// exit();
				$tbody="";
				foreach ($inward_info as $received){
				$inward_qty=$this->data['inward_qty']=$this->allstock->get_curent_stock($received['item_id'],'Inward');
					
				$consume_qty=$this->data['consume_qty']=$this->allstock->get_curent_stock($received['item_id'],'Consume');
					$total_current_stock= $inward_qty[0]['qty']-$consume_qty[0]['qty'];
					if($total_current_stock<0)
							$total_current_stock=0;
				
					$tbody.="<tr>
						    <td>". $received['date']."</td>
						    <td>".$received['name']."</td>
						      <td>".$received['qty']." ".$received['unit']."</td>
						    <td>".round($received['price'],2)."</td>
						    <td>".$total_current_stock." ".$received['unit']."</td>
						    <td>";
						

						 	$tbody.="
						     
						    <p data-placement='top' data-toggle='tooltip' title='Delete'>
						    <button class='btn btn-danger btn-xs' data-title='Delete' atrr=".$received['id']." onclick=delete_received_record(".$received['id'].") data-toggle='modal' data-target=#"."delete>
						    <span class='glyphicon glyphicon-trash'>
						    </span>
						    </button>
						    </p>
						    </td>
						    </tr>"	;
						 
						    
				}

				echo $tbody;
	}

	public function delete_record()
	{
		$id=$_GET['id'];
		if($this->allstock->delete_by_id($id)){
			echo "Yes";
			echo $this->db->last_query();
		}
		else
			echo "no";
	}
	public function add($id='')
	{

		$this->data['ingr_name'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
		
		
				if(isset($_POST['id']) && !empty($_POST['id']))
				{
					
				$this->ingredients->update_manager_ingredient($_POST['id']);
				$this->session->set_flashdata('successmsg', "Update Quantity successfully.");
				$this->load->view('manager/inventory', $this->data);
				
				}
			
				else{
			
			
					$this->data['ing_info'] = $this->ingredients->get_ingr_by_id(base64_decode($id));
					$this->load->view('manager/editinventory', $this->data);	
					}
			

	}

	public function get_all_stock()
	{
		if (!$this->input->is_ajax_request()){
			redirect('manager/orders', 'refresh');
		}

		$type = $this->input->post('type');
		$menuitems = $this->allstock->get_all_stock();
		$menuitems_html = '';
		
		foreach ($menuitems as $menuitem){
			$menuitems_html .= "<div class='managerorder'><div class='orderitems pull-left' style=''><p><b>" . $menuitem->name . "</b></p>
								</div><div class='orderaction pull-right'>";
			if ($menuitem->available == 1){
				$menuitems_html .= "<a href='#' onclick='makeUnavailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-large'><i class='icon-minus'></i> Make Unavailable</a></div></div>";
			} else {
				$menuitems_html .= "<a href='#' onclick='makeAvailable(event)' menuitemid='" . $menuitem->id . "' 
								data-toggle='modal' class='btn btn-large btn-inverse'><i class='icon-plus icon-white'></i> Make Available</a></div></div>";
			}
			
		}

		echo $menuitems_html;
	}

	public function filter($id)
	{
		
		if($id!='All'){

			
			$query = $this->db->query("select * from ingredients where id = ". $id);
			$f_data = $query->result();
			

			
				$this->data['today_stock'] = $f_data;
				$this->data['all_stock'] = $this->allstock->get_all_stock();
			
			 $this->load->view('manager/inventory', $this->data);
							

			}else
			redirect('manager/inventory');		
                             
			
	}

	public function make_unavailable(){
		if (!$this->input->is_ajax_request()){
			redirect('manager/orders', 'refresh');
		}
		
		$this->allstock->set_availability();
		echo 1;
	}

	public function make_available(){
		if (!$this->input->is_ajax_request()){
			redirect('manager/orders', 'refresh');
		}

		$this->allstock->set_availability();
		echo 1;
	}

}