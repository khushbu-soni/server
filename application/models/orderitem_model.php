<?php
class orderitem_model extends CI_Model{
    //__construct
    //Constructor for orderitem
    public function __construct() {
       // $this->load->database();
    }
    //get_orderitems
    //get all order items
    public function get_orderitems($order_id){
        $query=$this->db->query("SELECT 
                    staff.fname as waiter_name,
                    `order`.*,orderitem.*,SUM(orderitem.quantity) as quantity, menuitem.name,menuitem.price as actual_price FROM `order` 
                    left JOIN staff on `order`.waiter_id=staff.id
                    JOIN
                    orderitem
                    on 
                    `order`.id=orderitem.orderid
                    JOIN
                    menuitem
                    on 
                    menuitem.id=orderitem.menuid
                    WHERE
                    `order`.id='".$order_id."'
                    GROUP BY orderitem.menuid");
                            // echo $this->db->last_query();
                            // exit();
                            return $query->result();

            }
    //insert_orderitem
    //add order item

    // public function get_id()

    public function get_items($id){
        $query=$this->db->query("SELECT menuitem.item_no,menuitem.name,orderitem.quantity,orderitem.id,orderitem.notes,orderitem.orderid FROM
                `order` JOIN orderitem ON `order`.id=orderitem.orderid
                join menuitem on menuitem.id=orderitem.menuid
                WHERE orderitem.orderid=$id
                GROUP BY menuitem.name");
        return $query->result_array();
        // echo $this->db->last_query();
    }
    public function add($order_id,$menu_id,$tablenumber=null,$qty=null,$price,$notes=null,$sl,$el,$res_category){
        // throw new Exception("Error Processing Request", 1);
        
         $data = array(
            'menuid' =>$menu_id,
            'orderid' =>$order_id,
            'ingredients' =>'All',
            'price'=>$price,
            'table_no' => $tablenumber,
            'quantity' => $qty,
            'status'=>0,
            'notes'=>$notes,
            'el'=>$el,
            'sl'=>$sl,
            'res_category'=>$res_category
        );
            

         
        
        return $this->db->insert('orderitem',$data);

    }

     public function update_order($order_id,$menu_id,$tablenumber=null,$qty=null,$price,$res_category){
        // throw new Exception("Error Processing Request", 1);
        
         $data = array(
            'menuid' =>$menu_id,
            'orderid' =>$order_id,
            'ingredients' =>'All',
            'price'=>$price,
            'table_no' => $tablenumber,
            'quantity' => $qty,
            'status'=>0,
            'notes'=>'',
            'el'=>'',
            'sl'=>'',
            'res_category'=>$res_category
        );
            

         
        
        return $this->db->insert('orderitem',$data);

    }

    public function insert_orderitem($menuid,$orderid,$ingredients,$price,$quantity,$notes){
        $this->load->helper('url');
        
        $data = array(
            'menuid' =>$menuid,
            'orderid' =>$orderid,
            'ingredients' =>$ingredients,
            'price'=>$price,
            
            'table_no' => $this->session->userdata('tablenumber'),
            'quantity' => $quantity,
            'notes' => $notes
            
        );
        return $this->db->insert('orderitem',$data);
    }
     public function insert_orderitem_by_manager($menuid,$orderid,$ingredients,$price,$quantity){
        $this->load->helper('url');
        
        $data = array(
            'menuid' =>$menuid,
            'orderid' =>$orderid,
            'ingredients' =>$ingredients,
            'price'=>$price,
            'cust_name' => $this->session->userdata('customer_unique_id'),
            'table_no' => $this->session->userdata('tablenumber'),
            'quantity' => $quantity
            
        );
        return $this->db->insert('orderitem',$data);
    }
    
    public function update_status($order_id){
        $query=$this->db->query("update `orderitem` SET `status` = 4 
                        where orderid=".$order_id);
        // $query = $this->db->get();
            //         echo $this->db->last_query();
            // exit();
      if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }

    public function update_qty($id,$qty){
    $query=$this->db->query("update `orderitem` SET `quantity` =".$qty." 
                        where id=".$id);
        // $query = $this->db->get();
            //         echo $this->db->last_query();
            // exit();
      if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;  
    }

     public function update_notes($id,$notes){
    $query=$this->db->query("update `orderitem` SET `notes` ='".$notes."'  
                        where id=".$id);
        // $query = $this->db->get();
            //         echo $this->db->last_query();
            // exit();
      if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;  
    }


    public function insert_temp_orderitem()
    {
        //echo $this->input->post('itemname');

        //$this->load->helper('url');

         $count=1;
        $price=$this->input->post('itemprice');
        $notes=$this->input->post('notes');
        $this->load->model('orderitem_model');
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $assign_waiter = $this->session->userdata('assign_waiter');
        $tempitems = $this->orderitem_model->get_tempitem();
        foreach ($tempitems as $tempitem){
           
            if($tempitem->itemid==$this->input->post('itemid') )
            {
                 $count = $tempitem->quantity;
                 $count++;
                    $price = $count*$this->input->post('itemprice');

                     $data = array(
            'itemid' =>$this->input->post('itemid'),
            'itemname' =>$this->input->post('itemname'),
            'ingredients' =>$this->input->post('ingredients'),
            'price'=>$price,
            /*'cust_name' => $this->session->userdata('customer_unique_id'),*/
            'item_img' => $this->input->post('itemimg'),
             'quantity' => $count,
             'table_no' => $tablenumber,
           
             'waiter_id' => $assign_waiter,
             'notes' => $notes

        );
                     $condition = array(
            'itemid' => $this->input->post('itemid'),
            'table_no' => $tablenumber,
            'waiter_id' => $assign_waiter
           
        );

            return $this->db->update('temp_your_order',$data,$condition);

            }
        }
           
                 $data = array(
            'itemid' =>$this->input->post('itemid'),
            'itemname' =>$this->input->post('itemname'),
            'ingredients' =>$this->input->post('ingredients'),
            'price'=>$price,
           /* 'cust_name' => $this->session->userdata('customer_unique_id'),*/
            'item_img' => $this->input->post('itemimg'),
            'quantity' => $count,
             'table_no' => $tablenumber,           
             'waiter_id' => $assign_waiter,
              'notes' => $notes

        );
        return $this->db->insert('temp_your_order',$data);

           

        }
       
    

    public function get_tempitem(){
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $assign_waiter = $this->session->userdata('assign_waiter');

        $query=$this->db->query('select * from temp_your_order'); 
        return $query->result();
    }
 
    public function table_bill_amount($tablenumber){

        // $query=$this->db->query("SELECT (SUM(price)*quantity) as bill_amount FROM `table` join orderitem on orderitem.table_no=`table`.tablenumber WHERE orderitem.table_no='".$tablenumber."' AND `table`.inuse=1"); 
        $query=$this->db->query("SELECT
    SUM(orderitem.price)*orderitem.quantity as bill_amount
FROM
    `table`
JOIN `order` ON `order`.tablenumber= `table`.tablenumber
JOIN orderitem ON orderitem.table_no = `table`.tablenumber

WHERE
     orderitem.table_no='".$tablenumber."'
AND `table`.inuse = 1
AND orderitem.`status`=0

AND `order`.date=CURRENT_DATE()
"); 
        return $query->row_array();
    }

     public function total_bill_amount(){

        // $query=$this->db->query("SELECT SUM(price) as bill_amount FROM `table` join orderitem on orderitem.table_no=`table`.tablenumber WHERE  `table`.inuse=1"); 
        $query=$this->db->query("SELECT SUM(orderitem.price)*orderitem.quantity as bill_amount FROM `table`
 join 
`order` ON `order`.tablenumber=`table`.tablenumber
JOIN
orderitem on orderitem.table_no=`table`.tablenumber WHERE `table`.inuse=1 AND orderitem.status=0"); 
        return $query->row_array();
    }

      public function total_bill_pay(){

        $query=$this->db->query("SELECT
SUM(payment.amount) as bill_amount
FROM `order` 
JOIN `table` on `table`.tablenumber=`order`.tablenumber
JOIN payment on payment.tablenumber=`order`.tablenumber
where `order`.payment_status=1 and `table`.inuse=0 AND order.status=0
AND `order`.date=CURRENT_DATE()"); 
        return $query->row_array();
    }
 
     public function get_tempitem_custname(){

       $tablenumber = $this->session->userdata('tablenumber');
       $assign_waiter = $this->session->userdata('assign_waiter');
        $query=$this->db->query("select * from temp_your_order where table_no = '$tablenumber' AND waiter_id = '$assign_waiter'"); 
       // print_r($this->db->last_query());
        return $query->result();
    }

    

    public function getQty($order_id){
        $query=$this->db->query("SELECT
                    count(*) AS qty
                FROM
                    orderitem
                JOIN
                `order`
                on 
                `order`.id=orderitem.orderid
                WHERE
                    `order`.id='".$order_id
                ."'GROUP BY
                    menuid"
                );
        return $query->row();
        // echo $this->db->last_query();
        // exit();

    }

 
    

   public function get_total_with_tax($order_id){
        $this->load->model('configruation_model','configruations');
        $tax_info=$this->configruations->getTax();
        $tax=$tax_info->tax;
        
        $query=$this->db->query("SELECT
            ((SUM(orderitem.`price`)* orderitem.`quantity`)*$tax)/100 AS total FROM orderitem 
                    JOIN `order` ON `order`.id = orderitem.orderid
                    WHERE
                     `order`.payment_status=0 and
                        `order`.id ='".$order_id."'");
        return $query->row_array();
        // echo $this->db->last_query();
        // exit();
    }

     public function get_total_without_tax($order_id){
        $this->load->model('configruation_model','configruations');
        $tax_info=$this->configruations->getTax();
        $tax=$tax_info->tax;
        // echo $tax;
        // print_r($tax_info);
        // exit();
        $query=$this->db->query("SELECT
            (SUM(orderitem.`price`)*orderitem.`quantity`) AS total FROM orderitem 
                    JOIN `order` ON `order`.id = orderitem.orderid
                    WHERE
                     `order`.payment_status=0 and
                        `order`.id ='".$order_id."'");
        // echo $this->db->last_query();
        // exit();
        return $query->row_array();
        
    }
    public function get_sub_Total($orderid){
        $query=$this->db->query("SELECT  FORMAT(SUM(orderitem.price),2) AS subtotalamount from orderitem join payment on payment.`order`=orderitem.orderid where orderid=$orderid");
        return $query->row_array();
    }
    //get_orderitem_by_id
    //ger order item by id
    public function get_orderitem_information(){
        $query = $this->db->get_where('orderitem', array('id' =>$this->input->post('id')));
        return $query->row(); 
    }
    
    public function get_order_ingredients(){
        $query = $this->db->get_where('ingredient', array('menuItemid' =>$this->input->post('menuItemid')));
        return $query->result();
    }
    public function comp_item(){
        $data = array('comp' => $this->session->userdata('userid'), 'price'=>$this->input->post('price'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('orderitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    public function update_orderitem_from_payment($paymentid,$orderid){
        $data = array('paymentid' => $paymentid);
        $this->db->where('id', $orderid);
        $this->db->where('paymentid', null);
        $this->db->update('orderitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }    
    public function get_price_by_id(){
        $this->db->select('*');
        $this->db->from('menuitem');
        $this->db->join('orderitem', 'menuitem.id = orderitem.menuid');
        $this->db->where('orderitem.id',$this->input->post('id'));
        return $this->db->get()->row()->price;
        
    }
    //debug_remove_orderitem_by_id
    //this method shouldn't be called
    public function remove_orderitem_by_id(){
        $query = $this->db->delete('orderitem', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }   

    public function get_orderitems_info($order_id){
        $query=$this->db->query("SELECT
    menuitem.`name` AS name,
    orderitem.orderid,
    sum(orderitem.quantity) AS quantity,
    `order`.customername,
    `order`.tablenumber,
    `order`.el,
    `order`.sl,
    staff.fname AS waiter_name
FROM
    orderitem
JOIN `order` ON `order`.id = orderitem.orderid
LEFT JOIN staff ON staff.id = `order`.waiter_id
JOIN menuitem ON orderitem.menuid = menuitem.id
WHERE
    orderitem.orderid = ".$order_id."
GROUP BY orderitem.menuid");
        return $query->result_array();
    }
    
    public function get_orderitems_by_orderid(){
        $this->db->select('orderitem.price AS price, orderitem.id AS id, menuitem.name AS name');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.orderid', $this->input->post('orderid'));
        $query = $this->db->get();
        return $query->result(); 
    }
    
     public function get_comp_orders(){
        $query = $this->db->get_where('orderitem', array('comp' =>$this->input->post('comp')));
        return $query->result(); 
    }   
    
    /*public function create_order(){
        //Get json
        $data = $this->input->post('ordereditems');
        $productsArr = json_decode($data); 
        //Get session data
        $this->load->model('order_model');
            
        //Create order
        $order = $this->order_model->insert_order();
        $tempData = array('orderid'=>$order);
        $this->session->set_userdata($tempData);
        //Create order items
        foreach($productsArr as $product){
            $this->load->model('orderitem_model');
            $this->orderitem_model->insert_orderitem($product->menuid, $order, $product->ingredients,$product->price);            
        }
        
    }*/
    public function create_order(){



        //Get json
        $data = $this->input->post('ordereditems');
        $productsArr = json_decode($data); 
        //Get session data
        $this->load->model('order_model');
        $this->load->model('table_model','table');


       
            
        //Create order
        //Lets do some check for waiter
        //$table_actual_waiter
        // $total_tables_of_aw
        // $total_used_table_of_aw
        //$aw_busy_per



        $tablenumber=$this->session->userdata('tablenumber');
        $waiterid=$this->session->userdata('assign_waiter');
        


      
        $order = $this->order_model->insert_order($waiterid);
       // $customer_unique_id=$this->session->userdata('customer_unique_id');
        //Entry in log
        $this->load->model('staff_model', 'staff');
     $waiter=$this->staff->get_name($waiterid);
        
        $waiter_name=$waiter->fname." ".$waiter->lname;
        $this->load->model('notification_log', 'notifications');
        $this->notifications->order_placed($tablenumber,$waiter_name,$order);
        //Entry in log
        

        $tempData = array('orderid'=>$order);
        $this->session->set_userdata($tempData);
        //Create order items
       /* echo "<pre>";
        print_r($productsArr);
        echo "</pre>";
        exit();*/
        foreach($productsArr as $product){
            $this->load->model('orderitem_model');
            $this->orderitem_model->insert_orderitem($product->menuid, $order, $product->ingredients,$product->price,$product->quantity,$product->notes);            

        }
        
        
    }
    public function get_unpaid_items(){
        $this->db->select('menuitem.picturepath AS picturepath,menuitem.price AS ogprice,orderitem.total_votes AS total_votes,orderitem.comment_date AS comment_date,orderitem.comment_status AS comment_status,orderitem.comment AS comment,orderitem.orderid AS orderid,orderitem.id AS id,sum(orderitem.quantity) AS quantity, sum(orderitem.price) AS price, menuitem.name AS name, menuitem.id AS menuid');
        $this->db->from('orderitem');
        $this->db->join('menuitem','orderitem.menuid = menuitem.id');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('order.tabletnumber',$this->session->userdata('tabletnumber'));
        $this->db->where('order.tablenumber',$this->session->userdata('tablenumber'));
        $this->db->where('orderitem.paymentid',null);
        
        if($this->session->userdata('order_id'))
        {
             $this->db->where('orderitem.orderid',$this->session->userdata('order_id'));
        }
       
           
             $this->db->group_by('orderitem.menuid');
      
        return $this->db->get()->result();


    }


    public function get_prewvius_item(){

        $cust_name = strtolower(trim($this->session->userdata('customername')));
        $this->db->select('orderitem.total_votes AS total_votes,menuitem.picturepath AS pic,orderitem.cust_name AS cust_name,orderitem.comment_date AS comment_date,orderitem.comment_status AS comment_status,orderitem.comment AS comment,orderitem.orderid AS orderid,orderitem.id AS id,orderitem.quantity AS quantity, orderitem.price AS price, menuitem.name AS name, menuitem.id AS menuid');
        $this->db->from('orderitem');
        $this->db->join('menuitem','orderitem.menuid = menuitem.id');
        $this->db->join('order', 'orderitem.orderid = order.id');
        
         $this->db->like('orderitem.cust_name',$cust_name,'_');
        $this->db->where('orderitem.paymentid',null);
         $this->db->group_by('orderitem.menuid');
    
        return $this->db->get()->result();
/*
            echo "ddksdk";
        echo $this->db->last_query();
        exit();
*/

    }

   public function delete_by_id($id){
   
        $query=$this->db->query("Delete  From `orderitem` where orderid=$id");
         if ($this->db->affected_rows() > 0)
            return 1;
        return 0; 
    } 

   public function delete_by_item_id($id){
   
        $query=$this->db->query("Delete  From `orderitem` where id=$id");
         if ($this->db->affected_rows() > 0)
            return 1;
        return 0; 
    } 

}
?>
