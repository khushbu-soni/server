<?php
class table_model extends CI_Model{
    //__construct
    //Constructor for table
    public function __construct() {
        //$this->load->database();
        require_once('application/models/vo/TableVO.php');
    }
     public function insert_orderitem_uniq_customer(){
       //echo  $this->session->userdata('customer_unique_id');
       //exit();
        $data = array(
            'menuid'=> 0,
            'orderid'=> 0,
            'price'=> 0,
            'table_no' =>  $this->session->userdata('tablenumber'),
            'cust_name' => $this->session->userdata('customer_unique_id')
            );

        //Entry in log
        $this->load->model('notification_log', 'notifications');
        $this->notifications->customer_logged($this->session->userdata('customer_unique_id'),$this->session->userdata['tablenumber']);
        //Entry in log
        
       $this->db->insert('orderitem',$data); 
    }

    //get_tables
    //Get information on all tables
    public function get_tables(){
        $query_str = "SELECT DISTINCT tablenumber FROM `table`";
        $query = $this->db->query($query_str);
        return $query->result('TableVO');
    }

    public function mark_used($tablenumber){
        $data = array('inuse' => '1');
        $this->db->update
        (
             'table', $data,array(
            'tablenumber'     =>   $tablenumber,
            'tabletnumber'     =>   $tablenumber
            )
        ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }


    public function mark_Unused($tablenumber){

        $data = array('inuse' => '0');
        $this->db->update
        (
             'table', $data,array(
            'tablenumber'     =>   $tablenumber,
            'tabletnumber'     =>   $tablenumber
            )
        ); 
        
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
    }

    public function is_table_assign($tablenumber){

        
        $query=$this->db->query("Select count(*) as assign_count from `table` where tablenumber=".$tablenumber);
        return $query->row();
    }

    public function assign($tablenumber,$waiter_id){

        $data = array(
            'tablenumber' => $tablenumber,
            'tabletnumber' => $tablenumber,
            'inuse' =>1,
            'waiter_id' => $waiter_id
        );
        $this->db->insert('table', $data);
    }
         public function inuse_table(){
          $query=$this->db->query("SELECT
                         `table`.tablenumber AS used_table
                            
                        FROM
                         `table`
                        
                where inuse=1");
          return $query->result_array();
        }

    //insert_table
    //insert table
    public function insert_table(){
        $data = array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tabletnumber')) 
            );
        $check = $this->db->get_where('table', array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tabletnumber'))
        ));
        if($check->num_rows() <= 0){
            $this->db->insert('table',$data); 
            $information = $this->db->get_where('table',$data)->row();
            return $information;   
        }
        $this->db->insert();
        //$this->insert_notification_table();
        return false;
    }

    public function insert_notification_table(){
        $waiter = $this->session->userdata('assign_waiter');
        $tablenumber = $this->session->userdata('tablenumber');
        $data = array(
            'tablenumber'=>$tablenumber,
            'notifications'=> 'Customer LoggedIn',

            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            
            'waiter' => $waiter,
            'staff'=>'N/A',
            
            'type_id'=>4,
            'is_watch'=>0,

              "text"=>"<div style='color:black;'> Customer: <span  class='label label-success label-as-badge'>sit On Table </span> on Table: <span class='label label-info label-as-badge'> $tablenumber</span> call Waiter: <span class='label label-primary label-as-badge'>$waiter</span></div>"            
        
            );
        
       
            $this->db->insert('notification_log',$data); 
            
        return false;
    }

    public function get_waiter_id($tablenumber){
        $query=$this->db->query("SELECT waiter_id from `table` where tablenumber=".$tablenumber." and waiter_id is not null");
        return $query->row();
       } 
    public function get_table($waiter_id){
        $query=$this->db->query("SELECT tablenumber from `table` where  waiter_id =$waiter_id");
        return $query->row();
       } 

        public function inuse_table_count(){
          $query=$this->db->query("SELECT
                         COUNT(*) AS used_table,
                            `table`.waiter_id
                        FROM
                         `table`
                        JOIN `order` ON `table`.tablenumber = `order`.tablenumber
    where `table`.inuse=1 and `table`.waiter_id is NOT NULL GROUP BY `table`.waiter_id");
          return $query->row();
        }


         public function waiter_inuse_table($waiter_id){
           $query=$this->db->query("SELECT count(*) as tables from `table` join `order` on `order`.tablenumber=`table`.tablenumber where `table`.inuse=1 and `table`.waiter_id is NOT NULL and `table`.waiter_id=$waiter_id");  
        //  $query=$this->db->query("SELECT count(*) as tables from `table` where inuse=1 and waiter_id=".$waiter_id);
          return $query->row();

        }

        public function get_free_waiters(){
          $query=$this->db->query("SELECT waiter_id  from `table` where inuse=0 and waiter_id is not null");
          return $query->row();
        }

        public function total_table($waiter_id){
          $query=$this->db->query("SELECT count(*)  as tables from `table` where  waiter_id=".$waiter_id);
          return $query->row();
        }

        public function get_all_waiter($waiter_id){
            $query=$this->db->query("SELECT * from `table` where waiter_id is not null and waiter_id != $waiter_id");
            return $query->result_array();
        }
    //remove_table_by_id
    // remove table by id
    public function remove_table_by_id(){
	$this->db->delete('table', array('id' => $this->input->post('id')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;       
    }
    //remove_table_by_set
    //remove table by set
    public function remove_table_by_set(){
	$this->db->delete('table', array(
            'tablenumber'     =>   $this->input->post('tablenumber'),
            'tabletnumber'     =>   $this->input->post('tabletnumber')
         ));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
   
    
     //update_table
    //update table to available

    public function update_table_available(){
        $data = array('inuse' => '0');
        $this->db->update
        (
             'table', $data,array(
            'tablenumber'     =>   $this->session->userdata('tablenumber'),
            'tabletnumber'     =>   $this->session->userdata('tabletnumber')
            )
        ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    //update_table
    //update table to unavailable
    public function update_table_unavailable(){
        $data = array('inuse' => '1');
        $this->db->update('table', $data,array(
            'tablenumber'     =>   $this->session->userdata('tablenumber'),
            'tabletnumber'     =>   $this->session->userdata('tabletnumber')
        )
                ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }
    
    public function get_tables_by_inuse(){
        $query = $this->db->get_where('table', array('inuse' =>$this->input->post('inuse')));
        return $query->result(); 
    }
    
    
    //insert_table
    //add table
    public function set_identity(){
        $query = $this->db->get_where('staff', array('logincode' => trim($this->input->post('logincode'))));
        if($query->num_rows == 0 ){
            return FALSE;
        }
        else{
            $data = array(
                'tablenumber'     =>   trim($this->input->post('tablenumber')),
                'tabletnumber'     =>   trim($this->input->post('tabletnumber'))


            );
            $this->insert_table();
            $this->session->set_userdata($data);
            return TRUE;
            //return $this->db->insert('table', $data);
        }
    }
    
    // table_status_update
    // Updated inuse field
    // 0 -> noone
    // 1 -> someone
    

    public function table_status_update($inuse){   
        $data = array('inuse' => trim($inuse));
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $conditions = array(
            'tablenumber'     =>   $tablenumber,
            'tabletnumber'     =>   $tabletnumber
        );
        return  $this->db->update('table',$data,$conditions );
    }

    public function get_free_waiter_count(){
        $query=$this->db->query("SELECT COUNT(*) as count from `staff` where role =0 and id not IN 
                                (SELECT `staff`.id FROM staff JOIN `table` on staff.id=`table`.waiter_id WHERE staff.role=0 and staff.`delete`=0)
                                ");
        return $query->row_array();
    }

     public function today_payment(){
        
        $query=$this->db->query("SELECT round(SUM(payment.amount)) as today_pay FROM `order` join payment on `order`.customer_unique_id=payment.customer_unique_id WHERE DATE(`order`.`timestamp`)=CURDATE()
                                and `order`.payment_status=1 and `order`.`status`=4 ");
        return $query->row_array();
    }

    public function monthly_payment(){
        $query=$this->db->query("SELECT round(SUM(payment.amount)) as month_pay FROM `order` join payment on `order`.customer_unique_id=payment.customer_unique_id WHERE DATE(`order`.`timestamp`) BETWEEN
                                DATE_SUB(NOW(),INTERVAL DAY(NOW())-1 DAY)
                                and
                                LAST_DAY(DATE_ADD(DATE(`order`.`timestamp`), INTERVAL 1 MONTH)) 
                                and `order`.payment_status=1 and `order`.`status`=4");
        return $query->row_array();
    }

    public function pending_order(){
        $query=$this->db->query("SELECT COUNT(*) `count` FROM `order` where `status`=0");
        return $query->row_array();
    }
    
    public function pending_order_info(){
        $query=$this->db->query("SELECT id,customername,tablenumber  FROM `order` where `status`=0 order by id asc");
        return $query->result_array();
    }

    public function get_used_tables(){
        // $query=$this->db->query("SELECT DISTINCT(`table`.tablenumber),`staff`.fname as waiter_name
        // FROM 
        //     `table`
        //     JOIN staff on staff.id=`table`.waiter_id
        //     JOIN orderitem on `table`.tablenumber=orderitem.table_no WHERE `table`.inuse=1");
        $query=$this->db->query("SELECT DISTINCT
    (`table`.tablenumber),
    `staff`.fname AS waiter_name
FROM
    `table`
JOIN `order` on `order`.tablenumber=`table`.tablenumber
JOIN staff ON staff.id = `table`.waiter_id
JOIN orderitem ON `table`.tablenumber = orderitem.table_no
WHERE
    `table`.inuse = 1");
        return $query->result_array();
    }
    public function get_all(){
        $query=$this->db->query("SELECT distinct(tablenumber) as tablenumber,inuse from `table`");
        return $query->result_array();
    }
    
}
?>
