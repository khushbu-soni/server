<?php
class order_model extends CI_Model{
    //__construct
    //constructor for order
    public function __construct(){
       // $this->load->database();
        require_once('application/models/vo/OrderVO.php');
    }
    //get_orders
    //get all pending orders - orders that are not delivered or ready for delivery
    public function get_pending_orders(){
        //$query = $this->db->get_where('order', 'order.status NOT IN (2, 3)');
        
        //$query = $this->db->get_where('order', 'order.status NOT IN (2, 3)');
        
         $query = $this->db->query("SELECT * FROM `orderitem` JOIN `order` on `order`.id = `orderitem`.orderid ANd `order`.status NOT IN (2, 3) GROUP BY customer_unique_id");

        return $query->result('OrderVO');
    }
     public function get($customer_unique_id){
        $query = $this->db->get_where('order', "customer_unique_id ='".$customer_unique_id."'");
        return $query->row_array();

    }



	public function get_all(){
		$query=$this->db->query("SELECT
		`order`.id AS orderID,
		`order`.customername,
		`order`.tablenumber,
		`status`.`status` AS status_name,
		`status`.bgcolor, `status`.color,
		payment.amount,
		`order`.status,
		`order`.customer_unique_id
		FROM
		`order`
		JOIN `status` ON `status`.id = `order`.`status`
		JOIN orderitem ON orderitem.orderid = `order`.id
		left JOIN payment ON `order`.customer_unique_id = payment.customer_unique_id
		group by customer_unique_id
		ORDER BY
		`order`.id ASC");
		return $query->result();
		}
		public function filter_by_status($status){
		$query=$this->db->query("SELECT
		`order`.id AS orderID,
		`order`.customername,
		`order`.tablenumber,
		`status`.`status` AS status_name,
		`status`.bgcolor, `status`.color,
		payment.amount,
		`order`.status,
		`order`.customer_unique_id
		FROM
		`order`
		JOIN `status` ON `status`.id = `order`.`status`
		JOIN orderitem ON orderitem.orderid = `order`.id
		left JOIN payment ON `order`.customer_unique_id = payment.customer_unique_id
		where `order`.status=$status
		ORDER BY
		`order`.id ASC");
		return $query->result();
		} 

   /* public function get_order_item_process(){
        
	        $query= $this->db->query("SELECT DISTINCT
	    O1.menuid,
	    O1.STATUS,
	    menuitem.`name`,
        sum(O1.quantity) AS qty
	FROM
	    orderitem AS O1
	JOIN menuitem ON menuitem.id = O1.menuid
	 where O1.`status` IN (0, 1)");
           
	        return $query->result();
        
    } */

     public function get_order_item_process(){
        
        if(!$this->session->userdata('orderid'))
        {
            $query= $this->db->query("SELECT DISTINCT
            O1.menuid,
        O1.STATUS,
        menuitem.`name`,
        count(O1.quantity) AS qty
    FROM
        orderitem AS O1
    JOIN menuitem ON menuitem.id = O1.menuid
     where O1.`status` IN (0, 1) ");
        
        }
        else
        {

            $query= $this->db->query("SELECT DISTINCT
            O1.menuid,
        O1.STATUS,
        menuitem.`name`,
        count(O1.quantity) AS qty
    FROM
        orderitem AS O1
    JOIN menuitem ON menuitem.id = O1.menuid
     where O1.`status` IN (0, 1) AND O1.orderid=".$this->session->userdata('orderid'));
           /* print_r($this->db->last_query());
            exit();*/

        }
            return $query->result();
        
    }



    public function get_pending_screen_orders(){
        $query = $this->db->get_where('order', 'order.status NOT IN (2, 3)')->order_by("timestamp", "desc");
        return $query->result('OrderVO');
    }

    public function total_view(){
        $query =  $this->db->query('select min_order_per_page from configraution');
    
        return $query->result();
    }

    public function get_orders(){
        $query = $this->db->get_where('order', 'order.status != 3');
        return $query->result('OrderVO');
    }

     /*public function get_myorders($w_id){
        $query =  $this->db
          ->query('select * from `order` where order.status != 3 AND order.waiter_id = '. $w_id);
    
        return $query->result('OrderVO');
    }*/
    public function get_myorders($w_id){
      
        if(empty($w_id))
        {
            
             $query =  $this->db
          ->query('select * from `order` where order.status != 3 AND order.waiter_id = 0');

        }
        else
        {
             $query =  $this->db
          ->query('select * from `order` where order.status != 3 AND order.waiter_id = '. $w_id);
    
        }

       
        return $query->result('OrderVO');
    }


    public function get_detail(){
       $this->db->select('`order`.*,status.status,status.`order`');    
            $this->db->from('`order`');
            $this->db->join('status', 'order.status =status.id');
            $this->db->where('`order`.status',3);
            $this->db->where('`order`.payment_status',0);
            $this->db->where('`order`.status !=4 group by `order`.customer_unique_id order by status.`order` asc');
            // $this->db->where('status_id in (3,4) order by status.`order` asc');
            $query = $this->db->get();
        return $query->result();
            // echo $this->db->last_query();
            // exit();
    }

    public function get_table_orders($customer_unique_id){
       $this->db->select('`order`.*,status.status,status.`order`');    
            $this->db->from('`order`');
            $this->db->join('status', 'order.status =status.id');
            $this->db->where('`order`.status',3);
            $this->db->where('`order`.customer_unique_id',$customer_unique_id);
            $this->db->where('`order`.payment_status',0);
            $this->db->where('`order`.status !=4 order by status.`order` asc');
            // $this->db->where('status_id in (3,4) order by status.`order` asc');
            $query = $this->db->get();
        return $query->result();
            // echo $this->db->last_query();
            // exit();
    }
     
     public function paid($customer_unique_id){

      $query=$this->db->query("update `order` SET `status` = 4 , payment_status=1
                        where customer_unique_id='".$customer_unique_id."' 
                        ");
        // $query = $this->db->get();
            //         echo $this->db->last_query();
            // exit();
      if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
        
     }     

     public function table_customer_count($tablenumber){
       $query=$this->db->query("SELECT COUNT(*) table_customer_count from `order` where payment_status=0 and tablenumber=$tablenumber GROUP BY customer_unique_id"); 
        return $query->result();
     }  

    
    
    //insert_order
    //add order
    /*public function insert_order(){
        $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tabletnumber'),
            'customername' => $this->session->userdata('customername'),
            'waiter_id' => $this->session->userdata('userid'),
            
        );
        $this->db->insert('order', $data);
        
        return $this->db->insert_id();
    }*/
    // public function insert_order($waiter_id){
    //         // print_r($waiter_id);
    //         // exit();

    //      $customer_unique_id=$this->session->userdata('customer_unique_id');
         
    //       $this->session->set_userdata(array('waiter_id'=>$waiter_id));
    //     if($this->session->userdata('order_id')){
    //         $query=$this->db->query("select * from `order` where `status` IN (2, 3) AND id=".$this->session->userdata('order_id'));

    //        if($query->num_rows()>0)
    //        {

    //         $data = array(
    //         'status' => 0 
    //         );

    //         $condition = array(
    //         'id' => $this->session->userdata('order_id') 
    //         );



    //     $this->db->update('order', $data,$condition); 
    //     $order_id =$this->session->userdata('order_id');
       
    //     return $order_id;

    //     }else
    //     {
    //         return $this->session->userdata('order_id');
    //     }

    //     //return $this->session->userdata('order_id');
    //     } else{
    //         $data = array(
    //         'tablenumber' => $this->session->userdata('tablenumber'),
    //         'tabletnumber' => $this->session->userdata('tabletnumber'),
    //         'customername' => $this->session->userdata('customername'),
    //         'waiter_id' => $waiter_id,
    //         'customer_unique_id' => $customer_unique_id

            
    //     );

    //     $this->db->insert('order', $data); 
    //     $order_id =$this->db->insert_id();
    //     $this->session->set_userdata(array('order_id'=>$order_id));
    //     return $order_id;
    //     }
        
    // }

    public function insert_order($waiter_id){
           
      
         $customer_unique_id=$this->session->userdata('customer_unique_id');
         $this->session->set_userdata(array('customer_unique_id'=>$customer_unique_id));
        $this->session->set_userdata(array('waiter_id'=>$waiter_id));
         $key=$this->session->userdata('key');

        
            $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tabletnumber'),
            'customername' => $this->session->userdata('customername'),
            'waiter_id' => $waiter_id,
            'customer_unique_id' => $customer_unique_id,
            'key' => $key,
            
        );

        $this->db->insert('order', $data); 
        $order_id =$this->db->insert_id();
        $this->session->set_userdata(array('order_id'=>$order_id));
        return $order_id;
        
        
    }
     public function insert_temp_order($waiter_id){
            // print_r($waiter_id);
            // exit();
         $customer_unique_id=$this->session->userdata('customername')."_".$this->session->userdata('tablenumber');
         $this->session->set_userdata(array('customer_unique_id'=>$customer_unique_id));
          $this->session->set_userdata(array('waiter_id'=>$waiter_id));
        $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tabletnumber'),
            'customername' => $this->session->userdata('customername'),
            'waiter_id' => $waiter_id,
            'customer_unique_id' => $customer_unique_id
            
        );
        $this->db->insert('order', $data);
        
        return $this->db->insert_id();
    }
    
    //get_order_information
    //get order information base on id
    public function get_order_information_by_id(){
        $this->db->select('menuitem.name AS itemname, orderitem.ingredients AS ingredients');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.orderid', $this->input->post('id'));
        $query = $this->db->get();
        return $query->result();
    }
     public function get_order_information_by_id_item(){
        $this->db->select('menuitem.name AS itemname, orderitem.ingredients AS ingredients');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.menuid', $this->input->post('id'));
        $query = $this->db->get();
        return $query->result();
    }
     public function get_order_information_by_id2(){
        //$this-> get_myorders($w_id);
        $this->db->select('menuitem.name AS itemname, orderitem.ingredients AS ingredients');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->join('order', 'order.id = orderitem.orderid');
        //  $this->db->where('orderitem.orderid', 26);
        $query = $this->db->get();
        return $query->result_array();
    }
    //get_order_information_by_pickuptime
    //get order information base on id
    public function get_order_information_by_pickuptime(){
        $query = $this->db->get_where('order', array('pickuptime' =>$this->input->post('pickuptime')));
        return $query->result();
    }
    //get_order_information_by_status
    //get order information base on status
    public function get_order_information_by_status(){
        $query = $this->db->get_where('order', array('status' =>$this->input->post('status')));
        return $query->result(); 
    }
    
    //update the status of an order
    public function update_order_status(){
      /*  $data = array(
            'tablenumber'=>   $this->input->post('tablenumber'),
            'tabletnumber'=>   $this->input->post('tabletnumber'),
            'inuse'=>0,
            'notes'=>'Edit info'
            //'waiter_id'=>$this->input->post('waiter_id')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('table', $data); */

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
       

         $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('id'));
        $this->db->where('status', 0);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }

    public function update_compete_order_status(){
      

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
       

         $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('id'));
        $this->db->where('status', 1);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }  

    public function update_order_status_deliverd() 
    {

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
       

         $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('id'));
        $this->db->where('status', 2);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }

    public function update_order_statusitem(){
     

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);

        $this->db->where('menuid', $this->input->post('id'));
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }
    

    
    //debug_remove_order_by_id
    //this method shouldn't be called
    public function remove_order_by_id(){
        $query = $this->db->delete('order', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }    

    public function get_tablenumber_by($customer_unique_id){
       $query=$this->db->query("SELECT tablenumber from `order` where customer_unique_id='".$customer_unique_id."'");
        return $query->row_array();
        

    }

  function get_current_order(){
	$query=$this->db->query("SELECT customername, customer_unique_id FROM `order` where `status` != 4 and payment_status=0 and tablenumber=".$this->session->userdata['tablenumber']." group by customer_unique_id");
       return $query->result_array();
   }
 function checkAvailbilty($key,$customer_unique_id){
    $query=$this->db->query("SELECT count(*) as record from `order` where `key`=$key and customer_unique_id='".$customer_unique_id ."'");
    return $query->row_array();
   }
}

?>
