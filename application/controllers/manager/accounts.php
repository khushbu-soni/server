<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Accounts extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus('Manager');
		$this->data['active'] = 3;
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		
		// $this->data['order'] = $this->load->view('manager/deliverOrder', '', TRUE);
		$this->load->model('order_model','orders');
		$this->load->model('payment_model','payments');
		$this->load->model('orderitem_model','orderitems');
		$this->load->model('configruation_model','configruations');
		$this->load->model('transaction_model','transaction');
		$this->load->model('payment_model');
		$this->load->model('table_model','table');
		
                

	}

	public function index(){
		$this->data['header'] = $this->load->view('manager/header',$this->data);
		$this->load->model('notification_log', 'notifications');
		$this->load->model('staff_model', 'staff');
		$this->data['notifications']=$this->notifications->get_all_unwatched();
		$this->data['received_info']=$this->transaction->get_all('Received');		
		$this->data['all_active_staff']=$this->staff->get_staff_members();		
	
		$this->load->view('manager/accounts', $this->data);
	}

	public function received(){

		if(isset($_GET['payment_against']))
			$payment_against=$_GET['payment_against'];
		if(isset($_GET['mode']))
			$mode=$_GET['mode'];
		if(isset($_GET['amount']))
				echo $amount=$_GET['amount'];
		if(isset($_GET['date']))
				$date=date('Y-m-d');
		if(isset($_GET['narration']))
				$narration=$_GET['narration'];
		$transaction_id=$this->transaction->insert_transaction(null,$amount,null,'Received',$narration,$payment_against,$mode);
		echo $transaction_id;

	}

	public function paid(){

		if(isset($_GET['supplier']))
			$supplier=$_GET['supplier'];
		if(isset($_GET['staff']))
			$staff=$_GET['staff'];
		if(isset($_GET['amount']))
				echo $amount=$_GET['amount'];
		if(isset($_GET['date']))
				$date=$_GET['date'];
			else
				$date=date('Y-m-d');
		if(isset($_GET['payment_against']))
			$payment_against=$_GET['payment_against'];
		if(isset($_GET['mode']))
				$mode=$_GET['mode'];
		if(isset($_GET['narration']))
				$narration=$_GET['narration'];
		$transaction_id=$this->transaction->insert_transaction(null,$amount,$date,'Paid',$narration,$payment_against,$mode,$supplier,$staff);
		echo $transaction_id;

	}
	public function received_data(){
		$received_info=$this->data['received_info']=$this->transaction->get_all('Received');
				$tbody="";
				foreach ($received_info as $received){
					$tbody.="<tr>
						    <td>". $received['order_id']."</td>
						    <td>".round($received['amount'],2)."</td>
						    <td>".$received['transaction_date']."</td>
						    <td>".$received['narration']."</td>
						    <td>";
						 if($received['order_id']==0){

						 	$tbody.="<p data-placement='top' data-toggle='tooltip' title='Edit'>
						    <button class='btn btn-primary btn-xs'  data-title='Edit' atrr=".$received['id']." id='received_edit' onclick=set_received_id(".$received['id'].") data-toggle='modal' data-target=#"."edit ><span class='glyphicon glyphicon-pencil'></span>
						    </button>
						    </p>
						    </td>
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
						    
				}

				echo $tbody;
		    
	}

	public function paid_data(){
		$paid_info=$this->data['paid_info']=$this->transaction->get_all('Paid');
				$tbody="";
				if(empty($paid_info))
					$tbody.="No Records Found";
				foreach ($paid_info as $paid){
					$tbody.="<tr>
						    <td>".round($paid['amount'],2)."</td>
						    <td>".$paid['transaction_date']."</td>
						    <td>".$paid['narration']."</td>
						    <td>".$paid['staff_name']."</td>
						    <td>".$paid['supp_name']."</td>
						    <td>";
					 

						 	$tbody.=
						 	"<p data-placement='top' data-toggle='tooltip' title='Edit'>
						    <button class='btn btn-primary btn-xs'  data-title='Edit' atrr=".$paid['id']." id='received_edit' onclick=set_paid_id(".$paid['id'].") data-toggle='modal' data-target=#"."mypaidModal ><span class='glyphicon glyphicon-pencil'></span>
						    </button>
						    </p>
						    </td>
						    <td>
						    <p data-placement='top' data-toggle='tooltip' title='Delete'>
						    <button class='btn btn-danger btn-xs' data-title='Delete' atrr=".$paid['id']." onclick=delete_paid_record(".$paid['id'].") data-toggle='modal' data-target=#"."myModalX>
						    <span class='glyphicon glyphicon-trash'>
						    </span>
						    </button>
						    </p>
						    </td>
						    </tr>"	;
						 
						    
				}

				echo $tbody;
		    
	}

	public function add_supplier(){
		$this->load->model('supplier_model','supplier');
		$supplier=$_GET['supplier'];

		if($this->supplier->is_exist($supplier))
				echo 'yes';
			else{
				$this->supplier->add($supplier);
				echo "no";
				
			}
		 
	}

	public function supplier(){
		$this->load->model('supplier_model','supplier');
		$supplier_info=$this->supplier->get();
		// print_r($supplier_info);
		$option="<option value=''>Select Supplier</option>";
		foreach ($supplier_info as $supplier) {
			$option.="<option value=".$supplier->id.">".$supplier->name."</option>";
		}
		echo $option;
	}


	public function edit_data(){
		$this->load->model('staff_model','staff');
		$this->load->model('supplier_model','supplier');
		if(isset($_GET['id']))
			$id=$_GET['id'];
		else
			header('Location:index.php');
		$edit_data=$this->transaction->get_by_id($id);
		$form="";
		
		$all_active_staff=$this->staff->get_staff_members();	
		$all_active_supplier=$this->supplier->get();	
		foreach ($edit_data as $data) {

			if($data['transaction_type']=="Paid"){
				if($data['staff_id']){
					$form.="<div class='form-group'><div>
							<lable>Satff</lable>
							<div class='form-group'> 
							<select class='form-control' id='edit_staff'>";
							foreach ($all_active_staff as $value){
								$form.="<option value=".$value->id;
								if($value->id==$data['staff_id'])
										$form.=" selected";
									$form.=">".$value->fname."</option>";
							}	

							$form.="</select></div></div></div>";
				}


				if($data['supplier_id']){
					$form.="<div class='form-group'><div>
							<lable>Supplier</lable>
							<div class='form-group'> 
							<select class='form-control' id='edit_supplier'>";
							foreach ($all_active_supplier as $value){
								$form.="<option value=".$value->id;
								if($value->id==$data['supplier_id'])
										$form.=" selected";
									$form.=">".$value->name."</option>";
							}	

							$form.="</select></div></div></div>";
				}

			}


				if($data['payment_against']){
					$form.="<div class='form-group'><div>
							<lable>Payment Against</lable>
							<div class='form-group'> 
							<select class='form-control' id='edit_payment_against'>";
							$all_payment_against=array('directors'=>'From Directors','opening_bal'=>'Opening Balance','other'=>'Other');
							foreach ($all_payment_against as $key => $value){
								$form.="<option value=".$key;
								if($key==$data['payment_against'])
										$form.=" selected";
									$form.=">".$value."</option>";
							}	
							$form.="</select></div></div></div>";

				}


				if($data['mode']){
					$form.="<div class='form-group'><div>
							<lable>Mode</lable>
							<div class='form-group'> 
							<select class='form-control' id='edit_mode'>";
							$modes=array('cash'=>'Cash','credit_card'=>'Credit Card','debit_card'=>'Debit Card','voucher'=>'Voucher');
							foreach ($modes as $key => $value){
								$form.="<option value=".$key;
								if($key==$data['mode'])
										$form.=" selected";
									$form.=">".$value."</option>";
							}	

							$form.="</select></div></div></div>";
				}
				

			$form.="<div class='form-group'>
			        <input class='form-control' id='tr_id' value=".$id." type='hidden' >
			        <input class='form-control' id='amount' value=".round($data['amount'],2)." type='text' >
			        </div><div class='form-group'><input class='form-control'  type='text'  id='narration' value='".$data['narration']."'></div>";
			
		}
		echo $form;
	}
		   
	public function update_data(){
		
		$data=$_GET;
		if($this->transaction->update_data($data))
			echo "Yes";
		else
			echo "no";
	}
	
	public function get_report(){
		
		if(isset($_POST['start_date'])){
			$date = new DateTime($_POST['start_date']);
			$start_date= $date->format('Y-m-d');
		}
		if(isset($_POST['end_date'])){
			$date = new DateTime($_POST['end_date']);
			$end_date= $date->format('Y-m-d');	
		}
		if(isset($_POST['type']))
			$type=$_POST['type'];

		// get recievd payment according to date
		// get paid paymet according to date filter
			// if type is salary 
					// staff_id is not null
			// if type supplier
				// supplier id is not null
		// merge both array
		// generate a html table

		$this->load->model('transaction_model','transaction');
		$total_received_payment=0;
		$total_paid_amount=0;
		// $paid_payment=array();
		if($type=='salary'){
			$payment=$this->transaction->get_paid_salary($start_date,$end_date);
			$total_paid_amount=$this->transaction->total_paid_salary($start_date,$end_date);
			

			if($total_paid_amount[0]['amount'])
				$total_paid_amount=$total_paid_amount[0]['amount'];
			else
				$total_paid_amount=0;
		}elseif($type=='bank'){
			$payment=$this->transaction->get_paid_to_bank($start_date,$end_date);
			$total_paid_amount=$this->transaction->total_paid_to_bank($start_date,$end_date);
			$total_received_payment=$this->transaction->total_received_from_bank($start_date,$end_date);
			

			if($total_paid_amount[0]['amount'])
				$total_paid_amount=$total_paid_amount[0]['amount'];
			else
				$total_paid_amount=0;

			if($total_received_payment[0]['amount'])
				$total_received_payment=$total_received_payment[0]['amount'];
			else
				$total_received_payment=0;


		}elseif($type=='directors'){
			$payment=$this->transaction->get_payment_by_directors($start_date,$end_date);
			$total_paid_amount=$this->transaction->total_paid_to_directors($start_date,$end_date);
			$total_received_payment=$this->transaction->total_received_from_directors($start_date,$end_date);
			

			if($total_paid_amount[0]['amount'])
				$total_paid_amount=$total_paid_amount[0]['amount'];
			else
				$total_paid_amount=0;

			if($total_received_payment[0]['amount'])
				$total_received_payment=$total_received_payment[0]['amount'];
			else
				$total_received_payment=0;
		}elseif($type=='supplier'){
			$payment=$this->transaction->get_supplier_payment($start_date,$end_date);
			$total_paid_amount=$this->transaction->total_paid_to_supplier($start_date,$end_date);
			if($total_paid_amount[0]['amount'])
				$total_paid_amount=$total_paid_amount[0]['amount'];
			else
				$total_paid_amount=0;

		}
		else{

			$payment=$this->transaction->get_received_payment($start_date,$end_date);
			$total_received_payment=$this->transaction->total_received_payment($start_date,$end_date);
			$total_paid_amount=$this->transaction->total_paid($start_date,$end_date);

			if($total_paid_amount[0]['amount'])
				$total_paid_amount=$total_paid_amount[0]['amount'];
			else
				$total_paid_amount=0;

			// print_r($total_received_payment);
			if($total_received_payment[0]['amount'])
				$total_received_payment=$total_received_payment[0]['amount'];
			else
				$total_received_payment=0;
		}

		$tr="";
		$paid_amount="";
		$received_amount="";
		foreach ($payment as $values) {
			if($values['transaction_type']=='Paid'){
				$paid_amount=$values['amount'];
			}
			if($values['transaction_type']=='Received'){
				
				$recievd_amount=$values['amount'];

			}
			$tr.="<tr>
				  <td>".$values['order_id']."</td><td>";
				 if($values['transaction_type']=='Received' or $values['order_id'])
							$tr.=$values['amount']."</td>";
						else
							$tr.="0</td>";
			$tr.="<td>".$values['transaction_date']."</td><td>";
			if($values['transaction_type']=='Received' or $values['order_id'])
				$tr.=$values['narration']."</td><td>";
						else
							$tr.="N/A</td><td>";
			if($values['transaction_type']=='Paid')
				$tr.=$values['amount']."</td><td>";
						else
							$tr.="N/A</td><td>";
			
				$tr.=$values['transaction_date']."</td><td>";

				if($values['transaction_type']=='Paid')
				$tr.=$values['narration']."</td><td>";
						else
							$tr.="N/A</td><td>";
				if($values['name'])
					$tr.=$values['name']."</td><td>";
					else
					$tr.="N/A</td><td>";
				if($values['fname'])
					$tr.=$values['fname']."</td>";
					else
					$tr.="N/A</td>";

		}

		$tr.="<tr>
				<td>Total Received AMount</td>
				<td>".$total_received_payment."</td>
				<td></td>
				<td>Total Paid Amount</td>
				<td>".$total_paid_amount."</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td></tr>
			 ";

			 $total_cash_in_hand=$total_received_payment-$total_paid_amount;
			 if($total_cash_in_hand<0)
			 	$total_cash_in_hand="Amount Goes Nagetive ( ".$total_cash_in_hand." )";
		 $tr.="<tr>
		 		<td colspan='3' style='text-align:right'>Total Cash In Hand On Selected Date</td>
		 		<td>".$total_cash_in_hand."</td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 		<td></td>
		 	  </tr>
		 	  ";
			
		echo $tr;
	}

	public  function get_day_report(){
	
			if(isset($_POST['start_date'])){
				$date = new DateTime($_POST['start_date']);
				$start_date= $date->format('Y-m-d');
			}
			else
				$start_date=date('Y-m-d');
			if(isset($_POST['end_date'])){
				$date = new DateTime($_POST['end_date']);
				$end_date= $date->format('Y-m-d');
			}
			else
				$end_date=date('Y-m-d');
			if(isset($_POST['restro'])){
				$restro=$_POST['restro'];
			}

			$records=$this->transaction->get_item_info($start_date,$end_date,$restro);
			$total_take_away=$this->transaction->total_take_away($start_date,$end_date,$restro);
			$total_table_order=$this->transaction->total_table_order($start_date,$end_date,$restro);
			
			$tr="";
			foreach ($records as $res) {
				$tr.="<tr>
					<td>".$res['item_no']."</td>
					<td>".$res['name']."</td>
					<td>".$res['quantity']."</td>
					<td>".$res['res_category']."</td>
					<td>".$res['amount']."</td>
					
					";
			}
			$tr.="<tr>
					<td class='alert alert-danger' colspan='6'>Total No of Take Away Order ::".$total_take_away['total_take_away']." </td>
					<td colspan='2'></td>
				 </tr>";
				 $tr.="<tr>
					<td class='alert alert-info' colspan='6'>Total No of Table  Order ::".$total_table_order['table_order']."  </td>
					<td colspan='2'></td>
				 </tr>";
			echo $tr;
			
	}
	public function delete_record(){
		$id=$_GET['id'];
		if($this->transaction->delete_by_id($id))
			echo "Yes";
		else
			echo "no";
	}
}