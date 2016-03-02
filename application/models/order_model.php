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
        
        $query = $this->db->query("SELECT * FROM `orderitem` JOIN `order` on `order`.id = `orderitem`.orderid ANd `order`.status NOT IN (2, 3, 4) GROUP BY orderid");

        return $query->result('OrderVO');
    }

    function get_paid_bill($orderID){
        $query=$this->db->query("SELECT
                                `order`.id ,
                                `order`.`date`,
                                menuitem.name menu_name,
                                orderitem.quantity,
                                menuitem.price,
                                payment.tax,
                                payment.amount
                            FROM
                                `order`
                            JOIN orderitem ON `order`.id = orderitem.orderid
                            JOIN menuitem ON menuitem.id = orderitem.menuid
                            JOIN payment on payment.`order`=`order`.id
                            where `order`.id=".$orderID);
        return $query->result_array();
    }
    public function get($customer_unique_id){
        $query = $this->db->get_where('order', "customer_unique_id ='".$customer_unique_id."'");
        return $query->row_array();

    }
     public function get_orders_manager(){
        $query = $this->db->order_by("invoice_print","asc")->get_where('order', 'order.status IN (0)');
        
        return $query->result('OrderVO');
    }
     public function insert_order_by_manager(){
        $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tablenumber'),
            'customername' => $this->session->userdata('customername'),
            'customer_unique_id' => $this->session->userdata('customer_unique_id'),
            'key' => $this->session->userdata('key'),
            'waiter_id' => $this->session->userdata('userid'),
            
        );
        $this->db->insert('order', $data);
        
        return $this->db->insert_id();
    }

	 public function filter_by_date($start_date=null,$end_date=null){
        if(!$start_date)
            $start_date=date('Y-m-d');
        if(!$end_date)
            $end_date=date('Y-m-d');

        $query=$this->db->query("SELECT
        `order`.id AS orderID,
        `order`.customername,
        `order`.tablenumber,
        `order`.date,
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
        where `order`.`date` >= '".$start_date."' and `order`.date<= '".$end_date."'
        group by `order`.customer_unique_id
        ORDER BY
        `order`.id ASC
        ");
        return $query->result();
        // echo $this->db->last_query();
    }

    public function filter_by_month(){
        $query=$this->db->query("SELECT
                        `order`.id AS orderID,
                        `order`.customername,
                        `order`.tablenumber,
                        `order`.date,
                        `status`.`status` AS status_name,
                        `status`.bgcolor,
                        `status`.color,
                        payment.amount,
                        `order`. `status`,
                        `order`.customer_unique_id
                            
                    FROM
                        `order`
                    JOIN `status` ON `status`.id = `order`.`status`
                    JOIN orderitem ON orderitem.orderid = `order`.id
                    LEFT JOIN payment ON `order`.customer_unique_id = payment.customer_unique_id
                    WHERE
                        MONTH(`order`.`date`) = MONTH(NOW())
                    and 
                        YEAR(`order`.`date`)=YEAR(NOW())
                    GROUP BY
                        `order`.customer_unique_id
                    ORDER BY
                        `order`.id ASC");
            return $query->result();
    }

    public function get_all(){
        $query=$this->db->query("SELECT
        `order`.id AS orderID,
        `order`.customername,
        `order`.tablenumber,
        `order`.`date`,
        `status`.`status` AS status_name,
        `status`.bgcolor, `status`.color,
        payment.amount,
        `order`.status,
        `order`.id
        FROM
        `order`
        JOIN `status` ON `status`.id = `order`.`status`
        JOIN orderitem ON orderitem.orderid = `order`.id
        left JOIN payment ON `order`.id = payment.`order`
        
        group by `order`.id
        ORDER BY
        `order`.id ASC");
        return $query->result();
        }

        // public function get_order_details(){
        //     $query=$this->db->query("SELECT 
        //                             `order`.id,
        //                             `order`.date,
        //                             `order`.tablenumber,
        //                             `order`.customername
        //                             FROM `order` JOIN `table`  on `table`.tablenumber=`order`.tablenumber
        //                             WHERE `order`.`status`!=4 AND `order`.payment_status=0 
        //                             AND `table`.inuse=1
        //             ");
        //     return $query->result_array();
        // }

        public function get_order_details(){
            $query=$this->db->query(" SELECT `order`.id, `order`.date, `order`.tablenumber, `order`.customername FROM `order` where `order`.date=CURRENT_DATE()
                    ");
            return $query->result_array();
        }

        public function get_customername_by_id($id){
            $query=$this->db->query("SELECT customername from `order` where id=".$id);
            return $query->row_array();
        }

         public function last_id(){
            $query=$this->db->query("SELECT id from `order` where status!=4 and payment_status=0 order by id asc");
            return $query->row();
        }

        public function is_already_placed_order(){
            $query=$this->db->query("SELECT id from `order` where tablenumber=".$tablenumber." and payment_status=0 ");
            return $query->row(); 
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
            group by `order`.customer_unique_id
            ORDER BY
            `order`.id ASC");
            return $query->result();
        }  

    public function get_order_item_process(){
        
        

            $query= $this->db->query("SELECT DISTINCT
            O1.menuid,
             O1.orderid,
        O1.STATUS,
        menuitem.`name`,picturepath AS image,`order`.customername AS customername,
        `order`.tablenumber AS tablenumber,
       sum(O1.quantity)AS qty
    FROM
        orderitem AS O1
    JOIN menuitem ON menuitem.id = O1.menuid
    JOIN `order` ON `order`.id = O1.orderid
    where O1.`status` NOT IN (2,3) AND `order`.`status` IN (0,1) group by  menuitem.`id`
    ");
       // echo "<pre>";
       // print_r($query->result());
       //    echo "</pre>";

       // exit();
 
        

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
        $query = $this->db->order_by("invoice_print","asc")->get_where('order', 'order.status NOT IN (3,4)');
        
        return $query->result('OrderVO');
    }

    
     public function get_orders_by_order_id($id=''){

        $query = $this->db->get_where('order', 'id = '.$id);
        return $query->result('OrderVO');
        
    }
     public function get_order_item_process_by_order_id($id=''){

        $query = $this->db->get_where('orderitem', 'orderid = '.$id);
        return $query->result('OrderVO');
    }
    

     public function get_myorders($w_id){
      
      
           $query =  $this->db
          ->query('select * from `order` where order.status IN (2) AND order.waiter_id = '. $w_id);
    
       

       //echo $this->db->last_query();
       
        return $query->result('OrderVO');
    }

      public function get_customername($w_id){
      
            
          $status = array('0');
        $this->db->select('order.customername AS cust_name');
        $this->db->from('orderitem');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->like('orderitem.timestamp',date('Y-m-d'));
        $this->db->where_in('orderitem.status', $status);


        $this->db->group_by('cust_name');
    
         $query = $this->db->get();
        //echo $this->db->last_query();
        //exit();
       
        return $query->result();
       

       
       
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
     
     public function paid($order_id){

      $query=$this->db->query("update `order` SET `status` = 4 , payment_status=1
                        where id=".$order_id);
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
    public function insert_order($waiter_id){
           



          $this->session->set_userdata(array('waiter_id'=>$waiter_id));
        
        if($this->session->userdata('order_id')){
            
            $query=$this->db->query("select * from `order` where `status` IN (0,1,2) AND id=".$this->session->userdata('order_id'));

           if($query->num_rows()>0)
           {

            $data = array(
            
            'date' => date('Y-m-d') 

            );

            $condition = array(
            'id' => $this->session->userdata('order_id') 
            );



        $this->db->update('order', $data,$condition); 
        $order_id =$this->session->userdata('order_id');
       
        return $order_id;

        }else
        {
            return $this->session->userdata('order_id');
        }

        //return $this->session->userdata('order_id');
        } else{

             

            $data = array(
            'tablenumber' => $this->session->userdata('tablenumber'),
            'tabletnumber' => $this->session->userdata('tabletnumber'),
           
            'waiter_id' => $waiter_id,
            
         
            'date' => date('Y-m-d') 

            
        );

        $this->db->insert('order', $data); 
        $order_id =$this->db->insert_id();
        $this->session->set_userdata(array('order_id'=>$order_id));
        return $order_id;
        }
        
    }

    public function add_order($tablenumber=null,$waiter_id=null,$customer_name=null,$mobile_no=null,$el,$sl){

       
        $data = array(
            'tablenumber' => $tablenumber,
            'tabletnumber' => $tablenumber,
            'customername' => $customer_name,
            'waiter_id' => $waiter_id,
            'status'=>0,
            'payment_status'=>0,
            'date'=> date('Y-m-d'),
            'el'=>$el,
            'sl'=>$sl           
        );
       
       
        $this->db->insert('order', $data);

        return $this->db->insert_id();
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

       
       
         $status = array('0','1');
         $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('id'));
        $this->db->where_in('status', $status);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    } 

    public function update_takeaway_order_status(){
      

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
         $status = array('0','1');

         $this->db->where('id', $this->input->post('id'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('id'));
        $this->db->where('status', $status);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }   

    public function update_compete_order_status_item(){
        
        print_r($_POST);
        EXIT();
      
         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
    

       // $this->db->where('id', $this->input->post('ogorderid'));
       // $this->db->update('order', $data1);
         //echo $this->input->post('numrow');
        // exit();
          if($this->input->post('numrow') == 1)
         {
        $this->db->where('id', $this->input->post('ogorderid'));
        $this->db->update('order', $data1);
       }
        
       $status_in = array('0','1');
        $this->db->where('menuid', $this->input->post('id'));
        $this->db->where_in('status', $status_in);
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
    public function update_compete_order_deliver_status()
      {

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       
       

         $this->db->where('id', $this->input->post('ogorderid'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('ogorderid'));
        $this->db->where('status', 2);
        $this->db->update('orderitem', $data1);  

        //print_r($this->db->last_query());exit();
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }

     public function update_order_status_deliverd_item() 
    {

         $data1 = array(            
            'status'=> $this->input->post('status')
        );

       //echo $this->input->post('id');
       
    
        $this->db->where('id', $this->input->post('orderid'));
        $this->db->update('order', $data1);
      

       
        
         $this->db->where('orderid', $this->input->post('orderid'));
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

       
        $this->db->where('id', $this->input->post('orderid'));
        $this->db->update('order', $data1);
       
        $this->db->where('orderid', $this->input->post('orderid'));
        $this->db->where('status', 0);
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

     public function get_tablenumber_by_order($orderid){
       $query=$this->db->query("SELECT tablenumber,waiter_id from `order` where id='".$orderid."'");
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
function checkOrderExist($key,$customer_unique_id){
  
$query = $this->db->query("SELECT * from `order` where `key` = $key AND customer_unique_id = '".$customer_unique_id."' AND  `date` = CURDATE()");

 return $query->row_array();
   }

    function get_shift_path($customer_unique_id){

         $query=$this->db->query("SELECT shift_path from `order` where customer_unique_id='".$customer_unique_id."'");
            return $query->row_array();

    }

   function shiftTable($old_tablenumber,$new_tablenumber,$customer_unique_id,$shift_path){
       
        $query=$this->db->query("update `order` set shift_path='".$shift_path."' , tablenumber='".$new_tablenumber."' where customer_unique_id='".$customer_unique_id."'");
            $this->markUsed($new_tablenumber);
         if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
   }

   function markUsed($new_tablenumber){
         $query=$this->db->query("update `table` set inuse='1' where tablenumber='".$new_tablenumber."'");
            if ($this->db->affected_rows() > 0)
                return TRUE;
            return FALSE; 
   }

   public function get_all_active_customers(){
        $query=$this->db->query("SELECT customername,customer_unique_id,tablenumber from `order` WHERE `date`=CURRENT_DATE() and `status`!=4");
        return $query->result_array();
    }

     public function get_by_id($id){
        $query=$this->db->query("Select * from `order` where customer_unique_id='".$id."'");
         return $query->result_array();
        // echo $this->db->last_query();
    }

    public function get_by_orderId($id){
        $query=$this->db->query("Select * from `order` where id='".$id."'");
         return $query->result_array();
        // echo $this->db->last_query();
    }


    public function delete_by_id($id){
        
        $query=$this->db->query("Delete From `order` where id=$id");
         if ($this->db->affected_rows() > 0)
            return 1;
        return 0; 
    }
}

?>
