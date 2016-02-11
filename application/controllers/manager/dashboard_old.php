<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @author David Adamo Jr.
*/
class Dashboard extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['dependencies'] = $this->load->view('manager/dependencies', '', TRUE);
		
		$this->load->model('configruation_model','configruation');

		$this->data['sidemenu']=$this->configruation->sidebar_menus('Manager');


		//$this->data['sidebar'] = $this->load->view('manager/sidebar',$this->data['sidemenu']);

			$this->data['active'] = 1;
	
		$this->data['header'] = $this->load->view('manager/header', '', TRUE);
		$this->data['sidebar'] = $this->load->view('manager/sidebar', '', TRUE);
		$this->data['deleteconfirm'] = $this->load->view('manager/deleteconfirmation', '', TRUE);


		$this->load->model('staff_model','staff');
		$this->load->model('table_model','table');
		$this->load->model('notification_log','notification');
		$this->load->model('staff_model','staff');
		$this->load->model('configruation_model','configruation');
		$this->load->model('assign_model','assign_table');
		$this->load->model('orderitem_model','orderitem');
		$this->load->model('order_model', 'orders');
		$this->load->model('menuitem_model', 'menuitem');

		$this->data['biryani_menuitems']=$this->menuitem->get_all_available_menu_item_from_biryani();
		$this->data['cafe_menuitems']=$this->menuitem->get_all_available_menu_item_from_cafe();
		$this->data['bar_menuitems']=$this->menuitem->get_all_available_menu_item_from_bar();
		
		$orders=$this->data['pending_order_info']=$this->table->pending_order_info();
		
		$this->data['waiters_list']=$this->staff->get_waiters();
		
		$this->data['notifications']=$this->notification->get_all_unwatched();
		$this->data['notifications_info'] = $this->notification->get_notifications();
		// $this->data['header'] = $this->load->view('manager/header',$this->data['notifications']);

		$orderitems=array();
		foreach ($orders as $order) {
			$orderitems[$order['id']]=$this->orderitem->get_items($order['id']);
		}
		$this->data['orderitems']=$orderitems;
		$this->data['configruation']=$this->configruation->get_all();
	}

	public function index()
	{
		$this->data['notifications']=$this->notification->get_all_unwatched();
		$this->data['notifications_info'] = $this->notification->get_notifications();
		$this->data['header'] = $this->load->view('manager/header',$this->data);

		$this->data['username']=$this->staff->get_name($this->session->userdata['userid']);
		$this->data['username']=$this->staff->get_name($this->session->userdata['userid']);
		$this->data['today_payment']=$this->table->today_payment();
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$orders=$this->data['pending_order']=$this->table->pending_order();

		$this->data['notifications']=$this->notification->get_customer_login_notification();
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->load->view('manager/dashboard',$this->data);
	}

	public function dashboard_kot($order_id){

		$order_id=$order_id;
		// echo $order_id;
		// $this->load->vieq

		$this->data['orders']=$this->orderitem->get_orderitems_info($order_id);
		$this->load->view('manager/dashboard_kot',$this->data['orders']);
	}

	public function view_order(){
		// print_r($_GET);
		$id_array=array_keys($_GET);
		$id=$id_array[0];
		$order_info=$this->orderitem->get_orderitems_info($id);
		$table="<table class='table table-bordered'>
				<th>Item Name</th>
				<th>Qty</th>
				";
				// echo count($order_info);
				// echo "<pre>";
				// print_r($order_info);
				// echo "</pre>";
				// exit();
		foreach ($order_info as $junk) {
				$table.="<tr><td>".$junk['name']."</td>
						<td>".$junk['quantity']."</td></tr>";		
		}
		$table.="</table>";
		echo $table;


	}
	public function get_table(){
		$inuse_table=$this->table->inuse_table();
		$config=$this->data['configruation'];
		;
 $drop="<label for='exampleInputName2'>Table No</label>
              <select class='form-control input-lg select2' name='tablenumber' id='tablenumber'>
              <option value='0'>Select Table</option>";
                
                  $used_table=array();
                  foreach ($inuse_table as $junk)
                        $used_table[]=$junk['used_table'];
                                   
                 for($i=1; $i <=$config->no_of_table ; $i++){
                 
                    if(!in_array($i,$used_table))
                      $drop.="<option value=".$i.">Table No ".$i."</option>";
                  }
                  
                  $drop.="</select><div  class='text text-danger text-center' id='table_msg'>Please Provide Table No. </div>";
                  echo $drop;
	}


	public function get_waiter_name(){
		// print_r($_GET);
		$id_array=array_keys($_GET);
		$id=$id_array[0];
		$res=$this->staff->get_name($id);
		echo $res->fname;
		// print_r($res);
	}

	public function placeOrder(){

		if(isset($_POST['el_lavel']))
				$el=$_POST['el_lavel'];
		if(isset($_POST['sl_lavel']))
				$sl=$_POST['sl_lavel'];
		if(isset($_POST['customer_name']))
			$customer_name=$_POST['customer_name'];
		if(isset($_POST['mobile']))
			$mobile_no=$_POST['mobile'];
		if(isset($_POST['tablenumber']))
			$tablenumber=$_POST['tablenumber'];
		// if(isset($_POST['table_no']))
		// 	$tablenumber=$_POST['table_no'];
		if(isset($_POST['waiter'])){
			$waiter_id=$_POST['waiter'];
		}
		if(isset($_POST['total_item']))
			$total_item=$_POST['total_item'];
		
		$this->load->model('order_model', 'order');
		// $old_order_id=$this->order->is_already_placed_order($tablenumber);

		// if($old_order_id)
		// 	$order_id=$old_order_id;

		if(isset($_POST['order_id'])!=''){
		
			$order_id=$_POST['order_id'];
		}
		else{
			
			$order_id=$this->order->add_order($tablenumber,$waiter_id,$customer_name,$mobile_no,$el,$sl);
		}
		
		if(isset($_POST['order_type_check'])=='table_order'){
			
			if($tablenumber){
				$a=$this->table->is_table_assign($tablenumber);
				if(!$a->assign_count){
						$this->table->assign($tablenumber,$waiter_id);
				}
				if($tablenumber and $order_id){
						$this->table->mark_used($tablenumber);
				}
			}
			

		}

		for($i=1;$i<=$total_item;$i++){
			
				if(isset($_POST['menu_id_'.$i])){
					$menu_id=$_POST['menu_id_'.$i];
				}
				if(isset($_POST['qty_'.$i])){

						$qty=$_POST['qty_'.$i];
				}

				if(isset($_POST['price_'.$i]))
						$price=$_POST['price_'.$i];
				if(isset($_POST['notes_'.$i]))
						$notes=$_POST['notes_'.$i];
				if(isset($_POST['el_'.$i]))
						$el=$_POST['el_'.$i];
				if(isset($_POST['sl_'.$i]))
						$sl=$_POST['sl_'.$i];
				if(isset($_POST['res_category_'.$i]))
						$res_category=$_POST['res_category_'.$i];
					if($order_id){

						$this->orderitem->add($order_id,$menu_id,$tablenumber,$qty,$price,$notes,$sl,$el,$res_category);
						echo $order_id;
					}
						
					else{
						echo "string".$order_id."------";
						echo "Plz Order Again, Something Is wrong";
					}
		}
	}

	public function refresh(){
		$this->load->view('ajax_reload');
	}

	public function get_item_list(){
	

		$this->load->model('orderitem_model','orderitems');
		$item_no_str=$_GET['item'];
		$item_no=explode(',', $item_no_str);

		if(isset($_GET['order']))
			$order_id=$_GET['order'];
		else
			$order_id="";
		$item_info_array=array();
		
		 $el=$_GET['el'];
		 $sl=$_GET['sl'];
		
		$str=implode(',',$item_no);
		$html ='<table class="table">
				';

				$i=0;
				$b=1;
				$count=0;
				// print_r($item_no);
		foreach ($item_no as $junk) {
					
				$items=$this->menuitem->get_item_name($junk);
				if(!empty($items)){
				$k=1;
				$count=$count+$k;

			
				// exit();
				$item_name=$items->name;
				$menu_id=$items->id;
				$price=$items->price;
				$res_category=$items->res_category;
				
				$html.=
					"<tr><td >
					<input type='hidden' value=".$count." name='total_item' id='total_item'/>
					<input type='hidden' value='' name='order_type_check' id='order_type_check'/>
					<input type='hidden' value='' name='table_no' id='table_no'/>
					<input type='hidden' value=".$order_id." name='order_id' id='order_id'/>
					<input type='hidden' value=".$str." name='str' id='str'/>
					<input type='hidden' value=".$res_category." name='res_category_".$b."' id='res_category'/>
					<input type='hidden' value=".$el." name='el_lavel' id='el_lavel'/>
					<input type='hidden' value=".$sl." name='sl_lavel' id='sl_lavel'/>
		            <div class='form-group'>
		              <label for='exampleInputName2' style='font-size:13px;' >Item No</label>
		              <input type='text' name='item_no_".$b."' class='form-control' id='exampleInputName2' value=".$junk." readonly>
		              <input type='hidden' name='menu_id_".$b."' class='form-control' id='exampleInputName2' value=".$menu_id." readonly>
		            </div>
		            </td>
		            <td >
		            <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Name</label>
		              <input type='text' name='item_name_".$b."' class='form-control' id='exampleInputName2' value=".$item_name." readonly>
		              <input type='hidden' name='price_".$b."' class='form-control' id='exampleInputEmail2' value=". $price." readonly >
		            </div>
		            </td>
		            <td  >
		             <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Qty</label>
		              <input type='text' name=qty_".$b." id='qty_".$b."' class='form-control' start='1' id='exampleInputEmail2' required >
		            	<small style='color:red;' class='text-right' id='qty_msg_".$b."'>Please Provide Qty</small>
		            </div>
		            </td> 
		            <td >
		             <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Note</label>
		              <input type='text' name='notes_".$b."' class='form-control' id='exampleInputEmail2' placeholder='Type Any Special Request Here'>
		            </div>
            </td>
            
         
            <td>
            	<div class='form-group1'>
             
                 <label for='exampleInputName2'>&nbsp; </label>
              
             <button type='button' class='btn btn-primary btn-lg' id='del_".$b."' onclick='get(event)' data=".$junk."  data-toggle='modal' data-target='#myModal5'>
X
</button>

            </div>
            </td> 
             
            </tr>
            ";
            $k++;
            $i++;
            $b++;
           		}
				}
           // }
		$html.="</table>";
		$this->data['item_info']=$item_info_array;
		echo $html;
	}

	function get_list(){
		
			

		$item_del= $_GET['del_item'];
		$order_id=$_GET['order'];
		$this->load->model('orderitem_model','orderitems');
		// $item_no=$_GET['item_list'];
		$item_no=explode(',',$_GET['item_list']);
		$res=in_array($item_del,$item_no);
		
		$key=array_search($item_del, $item_no);
			
		array_splice($item_no,$key,1);
		$str=implode(',',$item_no);
	
	
		$item_info_array=array();
		
		
		$html ='<table class="table">
				';

				$i=1;
		foreach ($item_no as $junk) {
				
				$items=$this->menuitem->get_item_name($junk);
			
				
				$item_name=$items->name;
				$menu_id=$items->id;
				$price=$items->price;
				
				$html.=
					"<tr><td >
					<input type='hidden' value=".count($item_no)." name='total_item' id='total_item'/>
					<input type='hidden' value=".$str." name='str' id='str'/>
					<input type='hidden' value='' name='order_type_check' id='order_type_check'/>
					<input type='hidden' value='' name='table_no' id='table_no'/>
					<input type='hidden' value=".$order_id." name='order_id' id='order_id'/>
					
		            <div class='form-group'>
		              <label for='exampleInputName2' style='font-size:13px;' >Item No</label>
		              <input type='text' name='item_no_".$i."' class='form-control' id='exampleInputName2' value=".$junk." readonly>
		              <input type='hidden' name='menu_id_".$i."' class='form-control' id='exampleInputName2' value=".$menu_id." readonly>
		            </div>
		            </td>
		            <td >
		            <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Name</label>
		              <input type='text' name='item_name_".$i."' class='form-control' id='exampleInputName2' value=".$item_name." readonly>
		              <input type='hidden' name='price_".$i."' class='form-control' id='exampleInputEmail2' value=". $price." readonly >
		            </div>
		            </td>
		            <td  >
		             <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Qty</label>
		              <input type='text' name=qty_".$i." id='qty_".$i."' class='form-control' start='1' id='exampleInputEmail2' required >
		            	<small style='color:red;' class='text-right' id='qty_msg_".$i."'>Please Provide Qty</small>
		            </div>
		            </td> 
		            <td >
		             <div class='form-group'>
		              <label for='exampleInputEmail2' style='font-size:13px;'>Note</label>
		              <input type='text' name='notes_".$i."' class='form-control' id='exampleInputEmail2' placeholder='Type Any Special Request Here'>
		            </div>
            </td>
            
          <td>
           <div class='form-group1'>
              <label for='exampleInputName2' style='font-size:13px;'>ETHNICITY</label>
              <select class='form-control input-lg1 select2' id='el_".$i."' name='el_".$i."'>
              <option value='indian'>INDIAN</option>
              <option value='ugandian'>UGANDIAN</option>
              <option value='muzungu'>MUZUNGU</option>
                
              </select> 
              
            </div>
            </td>
            <td>
           <div class='form-group1'>
              <label for='exampleInputName2' style='font-size:13px;'>SPICEY </label>
              <select class='form-control input-lg1 select2' id='sl_".$i."' name='sl_".$i."'>
              <option value='mild'>MILD</option>
              <option value='medium'>MEDIUM</option>
              <option value='spicy'>SPICY</option>
                
              </select> 
              
             
            </div>
            </td>
            <td>
            	<div class='form-group1'>
             
                 <label for='exampleInputName2'>&nbsp; </label>
              
             <button type='button' class='btn btn-primary btn-lg' id='del_".$i."' onclick='get(event)' data=".$junk."  data-toggle='modal' data-target='#myModal5'>
X
</button>

            </div>
            </td> 
             
            </tr>
            ";
            $i++;
           		}
           // }
		$html.="</table>";
		$this->data['item_info']=$item_info_array;
		echo $html;
	}

	public function ajax_handler(){
		$this->data['username']=$this->staff->get_name($this->session->userdata['userid']);
		
		$this->data['today_payment']=$this->table->today_payment();
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$this->data['pending_order']=$this->table->pending_order();
		$this->data['notifications']=$this->notification->get_customer_login_notification();
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		
		//s$this->data['orderList'] = 
		$this->load->view('manager/dashinfo',$this->data);
        // redirect('manager/billing');
	}

	// public function load_bill(){
	// 	print_r($_POST);
	// 	exit();


	// }

	public function genrate_kot(){

		// $this->data['kot_info_array']
		$this->load->view('manager/kot',$_POST);
	}
	public function  order_slip()
	{

		$this->data['orders'] = $this->orders->get_order_details();
		$this->data['ordereditems'] = $this->orders->get_order_item_process();	

		$this->load->view('manager/order_slip',$this->data);
	}
	public function customer_order_call($id)
	{

		  $this->session->set_userdata('tablenumber', $id);

		redirect('manager/customer_name');
	}

	 function order_pdf($id) {
        
       $query = $this->db->query('select * from `order` where id = '. base64_decode($id))->row();;
    
        if(isset($query) && !empty($query))
        {

        	 $data= array('invoice_print' => 1);

        	$condition = array('id' => base64_decode($id));

        	$this->db->update('order',$data,$condition);
        
        	$take = 68;
        	
        	if($query->waiter_id == $take)
        	{
        		$this->data['waiter_name'] = 'Take Away Order';
        		
        	}else
        	{
        		$waiter_name = $this->db->query('select * from staff where id = '.$query->waiter_id)->row();
        
        	$this->data['waiter_name'] = $waiter_name->uname;

        	}
        	
	     	$this->data['orders'] = $this->orders->get_orders_by_order_id(base64_decode($id));
			$this->data['ordereditems'] = $this->orders->get_order_item_process_by_order_id(base64_decode($id));	

	       
	        $this->load->view('manager/order_pdf', $this->data);
	        
		}
		else
		{
			redirect('manager/dashboard','refresh');
		}
    }

	function waiter_count(){
		$this->data['free_waiters']=$this->table->get_free_waiter_count();
		$this->data['waiters']=$this->staff->get_waiter_count();
		$this->load->view('manager/waiter_count',$this->data);
	}

	function today_payment(){
		$this->data['today_payment']=$this->table->today_payment();
		$this->load->view('manager/today_payment',$this->data);
	}

	function monthly_payment(){
		$this->data['monthly_payment']=$this->table->monthly_payment();
		$this->load->view('manager/monthly_payment',$this->data);
	}

	function pending_order(){
		$this->data['pending_order']=$this->table->pending_order();
		$this->load->view('manager/pending_order',$this->data);
	}

	function customer_notification(){
		// $this->data['notifications']=$this->notification->get_customer_login_notification();
		// $this->data['order']=$this->order->get_all();
		$this->data['notifications'] = $this->notification->get_notifications();
		$this->load->view('manager/customer_notifications',$this->data);
	}

	function show_free_tables($waiter_id){
		
		$this->data['waiter']=$waiter_id;
		$this->data['total_tables']=$this->configruation->get_all();
		$this->data['used_tables']=$this->table->get_used_tables();
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->data['busy_waiters']=$this->staff->get_busy_waiter();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/free_tables_list',$this->data);
	}

	

	function show_free_waiters($tablenumber){
	
		$this->data['tablenumber']=$tablenumber;
		$this->data['waiter_info']=$this->staff->get_waiter_by_tablenumbar($tablenumber);
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->data['busy_waiters']=$this->staff->get_busy_waiter();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/free_waiters_list',$this->data);
	}

	function free_waiters(){
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->data['busy_waiters']=$this->staff->get_busy_waiter();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/free_waiters',$this->data);
	}

	public function update_order(){
	

			$this->load->view('manager/update_order');
		}
	public function add_order(){
	

			$this->load->view('manager/add_order');
		}

	function free_tables(){
		$this->data['total_tables']=$this->configruation->get_all();
		
		// $this->data['table_bill_amount']=$this->configruation->get_all();
		// $this->data['total_bill_amount_paid']=$this->configruation->get_all();
		// $this->data['total_bill_amount_due']=$this->configruation->get_all();

		$this->data['used_tables']=$this->table->get_used_tables();
		$table_bill_array=array();
		foreach ($this->data['used_tables'] as $used_tables) {
			
			$table_bill_array[$used_tables['tablenumber']]=$this->orderitem->table_bill_amount($used_tables['tablenumber']);
			// $this->data['table_bill_amount']=$this->orderitem->table_bill_amount($used_tables['tablenumber']);
		}
		
		$this->data['total_bill_amount']=$this->orderitem->total_bill_amount();
		$this->data['total_bill_pay']=$this->orderitem->total_bill_pay();
		$this->data['table_bill_amount']=$table_bill_array;
		$this->data['free_waiters']=$this->staff->get_free_waiter();
		$this->data['configruation']=$this->configruation->get_all();
		$this->load->view('manager/free_tables',$this->data);
	}


	function assign_table(){
		// print_r($_POST);
		// $tablenumber=$_POST['tablenumber'];
		// $waiter=$_POST['waiter_id'];
		 $this->assign_table->create();
		 echo "1";	
	}

	
}