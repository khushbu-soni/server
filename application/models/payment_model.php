<?php
class payment_model extends CI_Model{
    //__construct
    //Constructor for payment
    public function __construct() {
        //$this->load->database();
    }
    
    //get_payments
    //Get all payments
    public function get_payments(){
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    function get_all($start_date=null,$end_date=null,$type){
        if($start_date==null){
            $start_date=date('Y-m-d');
             $q="SELECT `order`.customername,payment.id,payment.amount,payment.tax,`order`.`date`
            From payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id 
            where `order`.`date` = '".$start_date."'";
        // 
        }
        if($end_date==null){
            $end_date=date('Y-m-d');
             $q="SELECT `order`.customername,payment.id,payment.amount,payment.tax,`order`.`date`
             From payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id 
                where `order`.`date` = '".$end_date."'";
        // 
        }else{

            $q="SELECT `order`.customername,payment.id,payment.amount,payment.tax,`order`.`date`
                From payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id 
                where `order`.`date` >= '".$start_date."' and `order`.`date` <= '".$end_date."'";
        
        }
          
        if($type!="all"){
            
            if($type=='exclude_tax')
                $q=$q." and payment.tax = 0";
            if($type=='include_tax')
                $q=$q." and payment.tax != 0";
        }        
        $query=$this->db->query($q);
        // echo $this->db->last_query();
        return $query->result_array();
    }

    function get(){
        $query=$this->db->query("SELECT * from payment");
        return $query->result_array();
    }
    function get_all_tax_info($start_date=null,$end_date=null){
        if($start_date==null)
            $start_date=date('Y-m-d');
        if($end_date==null)
            $end_date=date('Y-m-d');
        $q="SELECT * from payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id where `order`.`date` between '".$start_date."' and '".$end_date."' and payment.tax !=0";
       
     
              
        $query=$this->db->query($q);
        
        return $query->result_array();
    }

    function get_total($start_date=null,$end_date=null,$type){
        if($start_date==null)
            $start_date=date('Y-m-d');
        if($end_date==null)
            $end_date=date('Y-m-d');
        $q="SELECT sum(payment.amount) as total_amount from payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id where `order`.`date` between '".$start_date."' and '".$end_date."'";
       
        // exit();
        if($type!="all"){
            
            if($type=='exclude_tax')
                $q=$q." and payment.tax = 0";
            if($type=='include_tax')
                $q=$q." and payment.tax != 0";
        }        
        $query=$this->db->query($q);
     
        return $query->result_array();
    }

    function get_totals($start_date=null,$end_date=null,$type){
        if($start_date==null)
            $start_date=date('Y-m-d');
        if($end_date==null)
            $end_date=date('Y-m-d');
        $q="SELECT sum(payment.amount) as total_amount, `order`.`date` from payment join `order` on payment.`customer_unique_id`=`order`.customer_unique_id where `order`.`date` between '".$start_date."' and '".$end_date."'";
       
        // exit();
        if($type!="all"){
            
            if($type=='exclude_tax')
                $q=$q." and payment.tax = 0";
            if($type=='include_tax')
                $q=$q." and payment.tax != 0";
        }        
        $query=$this->db->query($q);
     
        return $query->row_array();
    }
    //insert_payment
    //add payment

    public function make_payment($post_data){
       
        if($post_data['cal_val']){
                $amount=$post_data['total_with_tax'];
                $tax_amount=$post_data['tax_amount'];
                $tax=$post_data['tax'];
            }
            else{
                $amount=$post_data['total_without_tax'];
                $tax=0;
                $tax_amount=$tax_amount=$post_data['tax_amount_not'];
            }

            if($post_data['tablenumber']=='take away'){

                $customername=$post_data['customername'];
                $tablenumber="";
            }else{
                $tablenumber=$post_data['tablenumber'];
                $customername="";
            }
            $dis=$_POST['dis'];
            $amount=$amount-$dis;
            $cash=$_POST['cash'];
            $change=$amount-$cash;
            $order_id=$post_data['order_id'];
            
            $data = array(
                'order' =>$order_id,
                'customername' =>$customername,
                'amount' =>$amount,
                'tax_amount' =>$tax_amount,
                'tax' =>$tax,
                'tablenumber' =>$tablenumber,
                'cash_tendered'=>$cash,
                'discount'=>$dis,
                'change'=>$change,
            );
            
           $this->db->insert('payment',$data);
            return $this->db->insert_id();
    }

            
    public function insert_payment(){
            //Since Post data changes from null to 0[false] after post
            ///we manually change it back
            
            if($this->input->post('cal')){
                $total_amount=$this->input->post('total_with_tax');
                $tax_amount=$this->input->post('tax_amount');
                $tax=$this->input->post('tax');
            }
            else{
                $total_amount=$this->input->post('total_without_tax');
                $tax=0;
                $tax_amount=$tax_amount=$this->input->post('tax_amount_not');;
            }
            $flag = $this->input->post('couponused');
            $coupon = $this->input->post('couponcode');
            if($flag== '1'){if($coupon == false ){ $coupon = null;}}
            else{$coupon = null;}
            $amount = $total_amount;
            $tipamount = $this->input->post('tipamount');
            $taxamount = $tax;
            $customer_unique_id = $this->input->post('customer_unique_id');
            $data = array(
                'paymenttype' =>0,
                'amount' =>$amount,
                'tipamount' =>$tipamount,
                'couponcode' =>$coupon,
                'tax' =>$taxamount,
                'customer_unique_id' =>$customer_unique_id,
                'tax_amount'=>$tax_amount
            );
            // print_r($data);
            // exit();
            $this->db->insert('payment',$data);
            return $this->db->insert_id();
        }

    //updates the status of the items paid for
    public function insert_payments($paymentid){
        $paymentData = explode(",", $this->input->post('ordereditems'));
            
        foreach($paymentData as $orderitemid){
            //insert_payment($paymenttype,$amount,$tipamount,$order,$orderitem)
            $this->load->model('orderitem_model');

            $this->orderitem_model->update_orderitem_from_payment($paymentid,$orderitemid);            
        }
    }

    //get_payment_information
    //get payment information by id
    public function get_payment_information(){
        $query = $this->db->get_where('payment', array('id' =>$slug));
        return $query->row_array(); 
    }
    //update_menuitem_by_id 
    public function update_payment_amount_by_id(){
        $data = array('amount' => $this->input->post('amount'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
     public function update_payment_status(){
        $data = array('payment_status' => 1);
      
        $condition = array(
            'customer_unique_id' => $this->session->userdata('customer_unique_id'),
             'waiter_id' => $this->session->userdata('waiter_id')
             );
        $this->db->where($condition);
        $this->db->update('order', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function update_payment_tipamount_by_id(){
        $data = array('tipamount' => $this->input->post('tipamount'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    public function remove_payment_by_id(){
        $query = $this->db->delete('payment', array('id' =>$this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }  

    /* get the items paid for, in a particular payment */
    public function getPaymentItems($paymentid)
    {
        $this->db->select('menuitem.name AS name, orderitem.price AS price');
        $this->db->from('orderitem');
        $this->db->join('menuitem', 'orderitem.menuid = menuitem.id');
        $this->db->where('orderitem.paymentid', $paymentid);
        $query = $this->db->get();
        return $query->result();
    }

    /* gets the amount paid as tax for a particular payment */
    public function getAmounts($paymentid)
    {
        $this->db->select('tax, amount');
        $this->db->from('payment');
        $this->db->where('id', $paymentid);
        $query = $this->db->get();
        return $query->row();
    }

    /* gets outstanding payment amount for a particular device */
    public function getOutstanding()
    {

        $customer_unique_id = $this->session->userdata('customername');
       

        $this->db->select('sum(orderitem.price) AS outstanding');
        $this->db->from('orderitem');
        $this->db->join('order', 'orderitem.orderid = order.id');
        $this->db->where('paymentid', null);
        $this->db->where('orderitem.cust_name', $customer_unique_id);
         $query = $this->db->get();
          return $query->row()->outstanding;
       
       
       
    }
     public function getOutstanding_new()
    {

        $customer_unique_id = $this->session->userdata('customer_unique_id');
       

        $this->db->select('sum(orderitem.price) AS outstanding');
        $this->db->from('orderitem');
       
        $this->db->where('orderitem.cust_name', $customer_unique_id);
         $query = $this->db->get();
         //print_r($query->row()->outstanding);

        // echo$this->db->last_query();
        //exit()
          return $query->row()->outstanding;
       
       
       
    }

     public function payment_status_new()
    {

        $customer_unique_id = $this->session->userdata('customer_unique_id');
       
        //echo $customer_unique_id;
       // exit();
        $this->db->select('payment_status as paymentstatus');
        $this->db->from('order');
       
        $this->db->where('customer_unique_id', $customer_unique_id);
         $query = $this->db->get();
         //print_r($this->db->last_query());
         //print_r($query->row()->paymentstatus);
         //exit();
          return $query->row()->paymentstatus;
       
       
       
    }
     public function check_order_payment_status()
    {
        
        $customer_unique_id = $this->session->userdata('customer_unique_id');
       
        //echo $customer_unique_id;
       // exit();
        $this->db->select('payment_status as paymentstatus');
        $this->db->from('order');
       
        $this->db->where('customername', $customer_unique_id);
         $query = $this->db->get();
         //print_r($this->db->last_query());
         //echo $this->db->affected_rows(); 
          if ($this->db->affected_rows() > 0)
            return 0;
        return 1; 
    }

    public function delete_by_id($id){
        $query=$this->db->query("Delete From payment where customer_unique_id='".$id."'");
         if ($this->db->affected_rows() > 0)
            return 0;
        return 1; 
    }


   


    public function make_cash_payment()
    {
        $orderid = $this->input->post('orderid');
        $tax = $this->input->post('tax');
        $amount = $this->input->post('amount');
        $tip = $this->input->post('tip');
        $paymenttype = 1; //cash

        $data = array(
            'paymenttype' => $paymenttype,
            'amount' => $amount,
            'tipamount' => $tip,
            'tax' => $tax
        );

        $this->db->insert('payment', $data);
        $paymentid = $this->db->insert_id();

        //update the ordered items
        $data = array('paymentid'=>$paymentid);
        $this->db->where('orderid', $orderid);
        $this->db->update('orderitem', $data);
    }

      public function get_by_id($id){
        $query=$this->db->query("Select * from payment where id=$id");
         return $query->result_array();
        // echo $this->db->last_query();
    }
      public function get_by_date($start_date,$end_date){
        $query=$this->db->query("Select * from payment  join `order` on payment.customer_unique_id=`order`.customer_unique_id where `order`.`date` between '".$start_date."' and '".$end_date."'");
         return $query->result_array();
        // echo $this->db->last_query();
    }
}
?>
