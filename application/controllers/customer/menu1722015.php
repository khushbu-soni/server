<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author David Adamo Jr.
*/
class Menu extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('abstract_userlogin_model', 'usermodel');
		$this->usermodel->checkTableIdentity();
		$this->data['w_id']=$this->session->userdata('userid');
		$this->data['menuheader'] = $this->load->view('customer/menuheader', '', TRUE);
		$this->data['dependencies'] = $this->load->view('general/dependencies', '', TRUE);
		$this->data['yourorder'] = $this->load->view('customer/yourorder', '', TRUE);
		$this->data['callwaiter'] = $this->load->view('customer/callwaiter', '', TRUE);
		$this->data['drinkrefill'] = $this->load->view('customer/drinkrefill', '', TRUE);
		$this->data['profile'] = $this->load->view('customer/profile', '', TRUE);
		$this->data['moreinfo'] = $this->load->view('customer/moreinfo', '', TRUE);
		$this->data['customize'] = $this->load->view('customer/customize', '', TRUE);


		$this->load->model('menuitem_model', 'menuitems');
		$this->load->model('ingredient_model', 'ingredients');
		$this->load->model('table_model', 'table');
		$this->load->model('orderitem_model', 'orderitems');
		$this->load->model('order_model', 'order');
		$this->load->model('payment_model', 'payments');
		$this->load->model('customer_details_model', 'customer_details');
	}

	public function index()
	{
			 $this->data['menutypes'] = $this->menuitems->get_menuitem_type();
		$content_data['menuitems'] = $this->menuitems->get_menuitem_by_type(7);
		$content_data['img_path'] = $this->config->item('img_path');
		$this->data['menucontent'] = $this->load->view('customer/menucontent', $content_data, TRUE);
		$this->data['featureditem'] = $this->menuitems->get_leastOrderItem();
		$this->data['get_profile'] = $this->customer_details->get_profile();

		//$this->load->model('news_model');
		//$this->data['news'] = $this->news_model->get_news();
		$this->load->view('customer/menu', $this->data);
	}
	public function set_profile(){
		
		$query = $this->customer_details->get_profile();
		
	if (empty($query)) {

		$data= array(
			'customer_name' => $this->input->post('user_name'),
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('user_email'),
			'birth_date' => $this->input->post('birth_date')

			);
		if($this->session->userdata('customername') =='Guest')
		 {
			$this->session->set_userdata(array('customername'=> $this->input->post('user_name')));
		}
		$this->db->insert('customer_data',$data);

		$this->session->set_flashdata('successmsg', "Update Profile successfully.");

		redirect('customer/menu');
	
	} else
	{
		if($this->input->post('mobile') != ''){

			$this->session->set_userdata(array('mobile'=> $this->input->post('mobile')));
		}
		$data= array(
			
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('user_email'),
			'birth_date' => $this->input->post('birth_date')

			);
		$condition = array(

		'id' => $this->input->post('id')
		);

		$this->db->update('customer_data',$data,$condition);

	/*	print_r($query);
		print_r($this->db->last_query());
		exit();*/

		$this->session->set_flashdata('successmsg', "Update Profile successfully.");

		redirect('customer/menu');
		
		
	}

		/*$data= array(
			'customer_name' => $this->input->post('user_name'),
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('user_email'),
			'birth_date' => $this->input->post('birth_date')

			);

		$this->db->insert('customer_data',$data);

		$this->session->set_flashdata('successmsg', "Update Profile successfully.");

		redirect('customer/menu');*/

	}
	
	public function notification(){

		//echo "sadasd";
		
		$this->db->select('sum(orderitem.quantity) AS quantity,orderitem.id AS id, orderitem.quantity AS quantity1,sum(orderitem.price) AS price, menuitem.name AS name');
        $this->db->from('orderitem');
        $this->db->join('menuitem','orderitem.menuid = menuitem.id');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('order.tabletnumber',$this->session->userdata('tabletnumber'));
        $this->db->where('order.tablenumber',$this->session->userdata('tablenumber'));
        $this->db->where('orderitem.paymentid',null);
        $this->db->group_by('orderitem.menuid');
        $unpaid_items=$this->db->get()->result();


        $this->db->select('sum(orderitem.price) AS price');
        $this->db->from('orderitem');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('orderitem.orderid',$this->session->userdata('order_id'));
       
        $price_items_sum=$this->db->get()->row();

      
      /*	echo "<pre>";
        print_r($this->db->last_query());
        print_r($price_items_sum);
        echo "</pre>";
        exit();*/

        $tempitems_html = '';
         $tempitems_html .= "<div class=paymentordercontent>";
			echo "<center><b>* Your Bill *</b></center><hr>";				
		foreach ($unpaid_items as $unpaid_item):
		$tempitems_html .= "<div class=ordereditem><div class='ordered pull-left'>";
			echo "<b>$ $unpaid_item->price</b>";						
			 echo "&nbsp;&nbsp;&nbsp;"."$unpaid_item->name"; 
			 echo "&nbsp;&nbsp;&nbsp; $unpaid_item->quantity<br/>";
			
			 echo "</div></div></div>";
			
			endforeach;

		echo "<hr style='width:200px;'>$ $price_items_sum->price &nbsp;&nbsp; Total";
			echo $tempitems_html;

	}


	public function temp_your_order(){
	 	
            $this->load->model('orderitem_model');
            
          	$tempitems = $this->orderitem_model->get_tempitem_custname();
	          	/*echo "<pre>";
	          	print_r($tempitems);
	          	echo "</pre>";
	          	exit();*/
          	
			$tempitems_html = '';
			$total= 0;
	foreach ($tempitems as $tempitem){

		$price_og = $this->db->query("select * from menuitem where id=$tempitem->itemid");
		$temp_data=$price_og->row();	

			$quantitys = $this->db->query("select * from temp_your_order where itemid=$tempitem->itemid");
		$temp_data_q=$quantitys->row();	

			
				 $tempitems_html .= " <div style=max-height:700px; overflow-y: scroll;>";
			  $tempitems_html .= "<div quantity='$tempitem->quantity' ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'>";
           //$tempitems_html .= "<b> $tempitem->itemname</b>";
            $tempitems_html .= "<img src=$tempitem->item_img width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>$tempitem->itemname <br/><b>$: $tempitem->price </b>
            <br>Quantity: <b> <input style='color:red; width:20px;' id=demo3 value=$tempitem->quantity type=text name=demo_vertical2 readonly></b>        
			<br/>
		 <button price='$temp_data->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid' onclick='quantityAdd(event)' class=bootstrap-touchspin-down type=button>+</button>";
             
  		if($tempitem->quantity != 1)
       			{
             $tempitems_html .= "<button price='$temp_data_q->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid'onclick='quantityMinus(event)' class=bootstrap-touchspin-down type=button>-</button>";
            }
             $tempitems_html .= "</b></span><br/><br/>
            <a href='#' itemprice='$tempitem->price' itemid='$tempitem->itemid' onclick='removeFromOrder(event)' class='btn btn-remove btn-remove-icon'><i class='icon-remove'></i> Remove</a></div>";
            
           // $tempitems_html .= "<div ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'><img src='" + $tempitem->item_img + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + $tempitem->itemname + "<br/><b>$" + $tempitem->price + "</b></span><br/><br/><a href='#' itemprice='" + $tempitem->price + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		//$tempitems_html .=$('div.items').append($tempitems_html);
            $total = $total + $tempitem->price;
	}
	$tempitems_html .= "</div>";
	$tempitems_html .= "<div style='background: none repeat scroll 0 0 #f3f3f3;
    font-weight: 700;'>
			<span >Total (to be rounded off)  </span>
			<span class='pull-right' id=ordertotal>$ $total .00</span></div>";

	echo $tempitems_html;
        }


	 public function yourorder(){
	 	
	 		/*$itemid=$this->input->post('itemid');
	 		$itemname=$this->input->post('itemname');

	 		$itemimg=$this->input->post('itemimg');
	 		$ingredients=$this->input->post('ingredients');
	 		$itemprice=$this->input->post('itemprice');
	 		echo "<pre>";
	 		print_r($_POST);
	 		echo "</pre>";*/
	 		
            $this->load->model('orderitem_model');
            $this->orderitem_model->insert_temp_orderitem();
          	$tempitems = $this->orderitem_model->get_tempitem_custname();
	          	/*echo "<pre>";
	          	print_r($tempitems);
	          	echo "</pre>";
	          	exit();*/
          	
			$tempitems_html = '';
			$total= 0;
	foreach ($tempitems as $tempitem){

		$price_og = $this->db->query("select * from menuitem where id=$tempitem->itemid");
		$temp_data=$price_og->row();	

			$quantitys = $this->db->query("select * from temp_your_order where itemid=$tempitem->itemid");
		$temp_data_q=$quantitys->row();	

			
				 $tempitems_html .= " <div style=max-height:700px; overflow-y: scroll;>";
			  $tempitems_html .= "<div quantity='$tempitem->quantity' ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'>";
           //$tempitems_html .= "<b> $tempitem->itemname</b>";
            $tempitems_html .= "<img src=$tempitem->item_img width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>$tempitem->itemname <br/><b>$: $tempitem->price </b>
            <br>Quantity: <b> <input style='color:red; width:20px;' id=demo3 value=$tempitem->quantity type=text name=demo_vertical2 readonly></b>        
			<br/>
		 <button price='$temp_data->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid' onclick='quantityAdd(event)' class=bootstrap-touchspin-down type=button>+</button>";
             
  		if($tempitem->quantity != 1)
       			{
             $tempitems_html .= "<button price='$temp_data_q->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid'onclick='quantityMinus(event)' class=bootstrap-touchspin-down type=button>-</button>";
            }
             $tempitems_html .= "</b></span><br/><br/>
            <a href='#' itemprice='$tempitem->price' itemid='$tempitem->itemid' onclick='removeFromOrder(event)' class='btn btn-remove btn-remove-icon'><i class='icon-remove'></i> Remove</a></div>";
            
           // $tempitems_html .= "<div ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'><img src='" + $tempitem->item_img + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + $tempitem->itemname + "<br/><b>$" + $tempitem->price + "</b></span><br/><br/><a href='#' itemprice='" + $tempitem->price + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		//$tempitems_html .=$('div.items').append($tempitems_html);
              $total = $total + $tempitem->price;
	}
	$tempitems_html .= "</div>";
	$tempitems_html .= "<div style='background: none repeat scroll 0 0 #f3f3f3;
    font-weight: 700;'>
			<span >Total (to be rounded off)  </span>
			<span class='pull-right' id=ordertotal>$ $total .00</span></div>";

	echo $tempitems_html;
        }
      
       public function quantityAdd(){


       	$itemid=$this->input->post('itemid');
       	$quantity=$this->input->post('quantity')+1;
       
       	$price=$this->input->post('price') * $quantity;

       	$add=	$quantity;
     // $quantitys = $this->db->query("select itemid,quantity from temp_your_order where itemid=$itemid");
       	 //foreach ($quantitys as $quantity){


       	 $data = array(
            'quantity'=>$add,
            'price' => $price
        );
       //	}
       	
       	$this->db->where('itemid', $itemid);
        
         $this->db->update('temp_your_order', $data);

          $this->load->model('orderitem_model');
            //$this->orderitem_model->insert_temp_orderitem();
          	$tempitems = $this->orderitem_model->get_tempitem_custname();
          /*	echo "<pre>";
          	print_r($tempitems);
          	echo "</pre>";
          	exit();*/
          	
			$tempitems_html = '';
			$total = 0;
	foreach ($tempitems as $tempitem){
		$price_og = $this->db->query("select * from menuitem where id=$tempitem->itemid");
		$menuid=$price_og->row();	

			 	$quantitys = $this->db->query("select * from temp_your_order where itemid=$tempitem->itemid");
		$temp_data=$quantitys->row();	

				 $tempitems_html .= "	";
			  $tempitems_html .= "<div quantity='$tempitem->quantity' ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'>";
          // $tempitems_html .= "<b> $tempitem->itemname</b>";
            $tempitems_html .= "<img src=$tempitem->item_img width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>$tempitem->itemname <br/><b>$: $temp_data->price </b>
            <br>Quantity: <b> <input style='color:red; width:20px;' id=demo3 value=$tempitem->quantity type=text name=demo_vertical2>
            
             <button price='$menuid->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid' onclick='quantityAdd(event)' class=bootstrap-touchspin-down type=button>+</button>";
            if ($tempitem->quantity != 1) {
             $tempitems_html .= "<button price_og='$menuid->price' price='$temp_data->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid'onclick='quantityMinus(event)' class=bootstrap-touchspin-down type=button>-</button>";
            }
            $tempitems_html .= "</b></span><br/><br/>
            <a href='#' itemprice='$tempitem->price' itemid='$tempitem->itemid' onclick='removeFromOrder(event)' class='btn btn-remove btn-remove-icon'><i class='icon-remove'></i> Remove</a></div>";
            $total = $total + $tempitem->price; 
         }
       	
       //	print_r($this->db->last_query());
       	//exit();
        
        $tempitems_html .= "</div>";
	$tempitems_html .= "<div style='background: none repeat scroll 0 0 #f3f3f3;
    font-weight: 700;'>
			<span >Total (to be rounded off)  </span>
			<span class='pull-right' id=ordertotal>$ $total .00</span></div>";

	echo $tempitems_html;
       }


        public function quantityMinus(){
       	$itemid=$this->input->post('itemid');

       	$quantity=$this->input->post('quantity');

       	

     	$price_og = $this->db->query("select * from menuitem where id=$itemid");
		$menuid=$price_og->row();	
       
       	$price=$this->input->post('price') - $menuid->price;

       	//echo $quantity;
       	$add=	$quantity - 1;
     // $quantitys = $this->db->query("select itemid,quantity from temp_your_order where itemid=$itemid");
       	 //foreach ($quantitys as $quantity){
       	//echo $add;
      

       	 $data = array(
            'quantity'=>$add,
            'price' => $price
            
        );
       //	}
       	
       	$this->db->where('itemid', $itemid);
        
        $this->db->update('temp_your_order', $data);
       	
       //	print_r($this->db->last_query());
       	//exit();
          $this->load->model('orderitem_model');
            //$this->orderitem_model->insert_temp_orderitem();
          	$tempitems = $this->orderitem_model->get_tempitem_custname();
          /*	echo "<pre>";
          	print_r($tempitems);
          	echo "</pre>";
          	exit();*/
          	
			$tempitems_html = '';

			$total= 0;

	foreach ($tempitems as $tempitem){



		$price_og = $this->db->query("select * from menuitem where id=$tempitem->itemid");
		$menuid=$price_og->row();	
		
       	$quantitys = $this->db->query("select * from temp_your_order where itemid=$tempitem->itemid");
		$temp_data=$quantitys->row();	
		//print_r($temp_data);
		//print_r($this->db->last_query());

				 $tempitems_html .= "	";
			  $tempitems_html .= "<div quantity='$tempitem->quantity' ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'>";
           // $tempitems_html .= "<b> $tempitem->itemname</b>";
            $tempitems_html .= "<img src=$tempitem->item_img width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>$tempitem->itemname <br/><b>$: $temp_data->price </b>
            <br>Quantity: <b>
             <input style='color:red; width:20px;' id=demo3 value=$tempitem->quantity type=text name=demo_vertical2>
             <button price='$menuid->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid' onclick='quantityAdd(event)' class=bootstrap-touchspin-down type=button>+</button>
              ";

           if ($tempitem->quantity != 1) {
             $tempitems_html .= "<button price_og='$menuid->price' price='$temp_data->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid'onclick='quantityMinus(event)' class=bootstrap-touchspin-down type=button>-</button>";
           
       		}
             $tempitems_html .= "</b></span><br/><br/>
            <a href='#' itemprice='$tempitem->price' itemid='$tempitem->itemid' onclick='removeFromOrder(event)' class='btn btn-remove btn-remove-icon'><i class='icon-remove'></i> Remove</a></div>";
            
             $total = $total + $tempitem->price; 
         }
       	
       //	print_r($this->db->last_query());
       	//exit();

        $tempitems_html .= "</div>";
	$tempitems_html .= "<div style='background: none repeat scroll 0 0 #f3f3f3;
    font-weight: 700;'>
			<span >Total (to be rounded off) </span>
			<span class='pull-right' id=ordertotal>$ $total .00</span></div>";

	echo $tempitems_html;

       }

     public function deletefromtemp()
	{


	   $itemid=$this->input->post('itemid');
	$this->db->delete('temp_your_order', array('itemid' => $itemid)); 


	$this->load->model('orderitem_model');
            
          	$tempitems = $this->orderitem_model->get_tempitem_custname();
	          	/*echo "<pre>";
	          	print_r($tempitems);
	          	echo "</pre>";
	          	exit();*/
          	
			$tempitems_html = '';
			$total= 0;
	foreach ($tempitems as $tempitem){

		$price_og = $this->db->query("select * from menuitem where id=$tempitem->itemid");
		$temp_data=$price_og->row();	

			$quantitys = $this->db->query("select * from temp_your_order where itemid=$tempitem->itemid");
		$temp_data_q=$quantitys->row();	

			
				 $tempitems_html .= " ";
			  $tempitems_html .= "<div quantity='$tempitem->quantity' ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'>";
           //$tempitems_html .= "<b> $tempitem->itemname</b>";
            $tempitems_html .= "<img src=$tempitem->item_img width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>$tempitem->itemname <br/><b>$: $tempitem->price </b>
            <br>Quantity: <b> <input style='color:red; width:20px;' id=demo3 value=$tempitem->quantity type=text name=demo_vertical2 readonly></b>        
			<br/>
		 <button price='$temp_data->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid' onclick='quantityAdd(event)' class=bootstrap-touchspin-down type=button>+</button>";
             
  		if($tempitem->quantity != 1)
       			{
             $tempitems_html .= "<button price='$temp_data_q->price' quantity='$tempitem->quantity' itemid='$tempitem->itemid'onclick='quantityMinus(event)' class=bootstrap-touchspin-down type=button>-</button>";
            }
             $tempitems_html .= "</b></span><br/><br/>
            <a href='#' itemprice='$tempitem->price' itemid='$tempitem->itemid' onclick='removeFromOrder(event)' class='btn btn-remove btn-remove-icon'><i class='icon-remove'></i> Remove</a></div>";
            
           // $tempitems_html .= "<div ingredients='$tempitem->ingredients' price='$tempitem->price' itemid='$tempitem->itemid' class='ordereditem'><img src='" + $tempitem->item_img + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + $tempitem->itemname + "<br/><b>$" + $tempitem->price + "</b></span><br/><br/><a href='#' itemprice='" + $tempitem->price + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		//$tempitems_html .=$('div.items').append($tempitems_html);
            $total = $total + $tempitem->price;

	}

	$tempitems_html .= "</div>";
	$tempitems_html .= "<div style='background: none repeat scroll 0 0 #f3f3f3;
    font-weight: 700;'>
			<span >Total (to be rounded off) </span>
			<span class='pull-right' id=ordertotal>$ $total .00</span></div>";

	echo $tempitems_html;



	}
    public function get_menu_items_all()
    {

			if (!$this->input->is_ajax_request()){
			redirect('customer/menu', 'refresh');


		}
		$type = $this->input->post('type');
		$menuitems = $this->menuitems->get_all_menuitems();
		$menuitems_html = '';
		$img_path = $this->config->item('img_path');
		$index = 0;
		//print_r($menuitems);
		foreach ($menuitems as $menuitem){


	/*$quantitys = $this->db->query("select * from temp_your_order where itemid=$menuitem->id");
		$temp_data=array('price'=>0);
		print_r($temp_data);
		
		if($quantitys->num_rows() > 0)
		{
		$temp_data=$quantitys->row();
		}*/

			if ($index % 2 == 0){
				$menuitems_html .= "<div class='span6 menuitem' style='margin-left:0'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}			
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/><a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			} else {
				$menuitems_html .= "<div class='span6 menuitem'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}		
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
				<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			}
			$index = $index + 1;
		}
		echo $menuitems_html;
	}


	public function get_menu_items()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu', 'refresh');
		}

		$type = $this->input->post('type');
		$menuitems = $this->menuitems->get_menuitem_by_type($type);
		$menuitems_html = '';
		$img_path = $this->config->item('img_path');
		$index = 0;
		foreach ($menuitems as $menuitem){


	/*$quantitys = $this->db->query("select * from temp_your_order where itemid=$menuitem->id");
		$temp_data=array('price'=>0);
		print_r($temp_data);
		
		if($quantitys->num_rows() > 0)
		{
		$temp_data=$quantitys->row();
		}*/

			if ($index % 2 == 0){
				$menuitems_html .= "<div class='span6 menuitem' style='margin-left:0'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}			
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/><a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			} else {
				$menuitems_html .= "<div class='span6 menuitem'>";
				if ($menuitem->picturepath == '' || $menuitem->picturepath == null){
					$menuitems_html .= "<img src='" . base_url() . "assets/img/140x140.gif" . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				} else {
					$menuitems_html .= "<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />";
				}		
				$menuitems_html .= "<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
				<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
				
				if ($menuitem->calories < 1000) 
					$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
				else
					$menuitems_html .= "More Info</a>";
				
				$menuitems_html .= "<br/><br/>
				<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
				</div>";
			}
			$index = $index + 1;
		}
		echo $menuitems_html;
	}

	public function search()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu', 'refresh');
		}

		$menuitems = $this->menuitems->search_by_title();
		$img_path = $this->config->item('img_path');
		$menuitems_html = "<h4>Search results for '" . $this->input->post('search') . "'</h4>";
		if (empty($menuitems)){
			$menuitems_html .= "<div class='alert alert-danger'><strong>No search results found.</strong></div>";
		} else {
			$index = 0;
			foreach ($menuitems as $menuitem){
				if ($index % 2 == 0){
					$menuitems_html .= "<div class='span6 menuitem' style='margin-left:0'>
					<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />
					<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
					<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
					
					if ($menuitem->calories < 1000) 
						$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
					else
						$menuitems_html .= "More Info</a>";
					
					$menuitems_html .= "<br/><br/>
					<a  href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
					&nbsp;&nbsp;
					<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
					</div>";
				} else {
					$menuitems_html .= "<div class='span6 menuitem'>
					<img src='" . $img_path . $menuitem->picturepath . "' class='menuimg pull-left img-polaroid' alt='" . $menuitem->name . "' />
					<span>" . $menuitem->name . "</span>&nbsp;&nbsp;<br/><span><b>$" . $menuitem->price . "</b></span><br/><br/>
					<a href='#moreinfo-modal' itemid='" . $menuitem->id . "' onclick='getMoreInfo(event)' class='btn btn-moreinfo btn-moreinfo' data-toggle='modal'>"; 
					
					if ($menuitem->calories < 1000) 
						$menuitems_html .= "<i class='icon-heart'></i> More Info</a>";
					else
						$menuitems_html .= "More Info</a>";
					
					$menuitems_html .= "<br/><br/>
					<a href='#' itemid='" . $menuitem->id . "' ingredients='All' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='addToOrder(event)' class='btn btn-primary btn-plus' itemname='" . $menuitem->name . "' price='" . $menuitem->price . "'><i class='icon-plus'></i> Add to Order</a>
					&nbsp;&nbsp;
					<a href='#customize-modal' itemimg='" . $img_path . $menuitem->picturepath . "' onclick='getIngredients(event)' itemprice='" . $menuitem->price . "' itemname='" . $menuitem->name . "' itemid='" . $menuitem->id . "' class='btn btn-custom btn-customize' data-toggle='modal'><i class='icon-wrench'></i> Customize</a>
					</div>";
				}
				$index = $index + 1;	
			}
		}
		echo $menuitems_html;
	}

	public function moreinfo()
	{
		if (!$this->input->is_ajax_request()){
			redirect('customer/menu');
		}

		$img_path = $this->config->item('img_path');
		$id=$this->input->post('id');
		$iteminfo = $this->menuitems->get_menuitem_by_id($id);
		/*print_r($img_path);

		print_r($iteminfo);*/
		$html = "<p><img src='" . $img_path . $iteminfo->picturepath ."' class='img-polaroid menuimg pull-left' />
				<p>" . $iteminfo->description . "</p><p><b>Calories:</b> " . $iteminfo->calories . "</p></p>";

		echo $html;
	}

	public function placeorder()
	{

		if (!$this->input->is_ajax_request()){
			redirect('customer');
		}

		$this->orderitems->create_order();
		$this->db->query("DELETE FROM temp_your_order where cust_name= '".$this->session->userdata('customer_unique_id')."'");
		//print_r($this->db->last_query());
		//exit();
		//$this->db->last_query();
		echo '1';//success
	}

	public function getingredients()
	{
		$ingredients = $this->ingredients->get_ingredients_by_menuitem();
		if (empty($ingredients)){
			$ingredients_html = "<p class='contentbox rounded-4px'>There are no optional ingredients for this menu item.</p>";
		} else {
			$ingredients_html = "<p class='contentbox rounded-4px'>Please indicate the items you do not want by deselecting the appropriate checkeboxes.
							</p>";
			foreach ($ingredients as $ingredient){
				$ingredients_html .= "<div class='ingredientbox'><input class='ingr_box' onclick='selectIngredient(event)' ingrname='" . $ingredient->name . "' type='checkbox' checked/> " . $ingredient->name . "</div>";
			}
		}

		echo $ingredients_html;
	}

	/**
	* Remove the customer's name from the session variable
	* Set the status of the table to unoccupied
	*/
	public function customer_exit()
	{
		
		
		/*$table_use= count($this->order->table_customer_count($this->session->userdata('tablenumber')));
		//echo $table_use;
		//print_r($this->session->all_userdata());
		//exit();
		//$this->session->set_userdata('inuse',0);
		//$outstanding_amount = $this->payments->getOutstanding();
		$outstanding_amount = $this->payments->getOutstanding_new();
		$payment_status_amount = $this->payments->check_order_payment_status();
		//echo $outstanding_amount;
		$payment_status1=0;

		if($payment_status_amount == 1)
		{
			$payment_status1 = $this->payments->payment_status_new();
			//echo $payment_status1;
			
		
		
		}


		if(isset($this->session->userdata('customer_unique_id')) && !empty($this->session->userdata('customername')))
		{
		$payment_status1 = $this->payments->payment_status_new();
		}
		//$payment_status1=0;
		//echo $outstanding_amount.$payment_status1;exit();
		if($table_use > 0)
		{

			//echo "update_table_unavailable";
			$this->table->update_table_unavailable();
			$this->session->set_userdata('inuse',1);
			//print_r($this->db->last_query());
			//exit();
		}
		else
		{
			//echo "update_table_available";
			$this->table->update_table_available();
			$this->session->set_userdata('inuse',0);
			
		}
		//echo $outstanding_amount;
		//echo $payment_status1;
		//exit();
		//echo $table_use;
		//exit();
		if ($outstanding_amount == 0  || $payment_status1 == 1){
			$this->session->unset_userdata('customername');
			$this->session->unset_userdata('customer_unique_id');
			$this->session->unset_userdata('order_id');
			$this->session->unset_userdata('playedgame');
			$this->session->unset_userdata('playedtimes');
			redirect('customer', 'refresh');
		} else {
			//user still has orders to pay for
			$this->session->set_flashdata('outstanding_msg', "You still have outstanding orders to pay for. Please touch or click the 'Make Payments' button to make payments.");	
			//redirect('customer/menu', 'refresh');
		} */
	
			$this->session->unset_userdata();
			$this->session->unset_userdata('customer_unique_id');
			$this->session->unset_userdata('order_id');
			$this->session->unset_userdata('orderid');
			$this->session->unset_userdata('waiter_id');			
			$this->session->unset_userdata('customername');
			$this->session->unset_userdata('key');
			$this->session->unset_userdata('post_customer_unique_id');
			$this->session->unset_userdata('customermobile');

		

		redirect('customer', 'refresh');
	}
}