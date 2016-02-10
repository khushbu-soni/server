<?php
/*
 * Quentin Mayo
 *
 */
class notification_log extends CI_Model{
    //__construct
    //constructor for notification
    public function __construct(){
        $this->load->database();
        require_once('application/models/vo/DespatchVO.php');
    }

    public function get_all(){
        $query=$this->db->query("SELECT
                                    *
                                FROM
                                    notification_log
                                JOIN notification_master ON notification_log.type_id = notification_master.id
                                    
                                ORDER BY notification_log.created_at DESC");
        return $query->result();
    }

      public function delete_by_id($id){
        $query=$this->db->query("Delete  From `notification_log` where order_id=$id");
         if ($this->db->affected_rows() > 0)
            return 0;
        return 1; 
    }

    //  public function get_notifications(){
    //     $query = $this->db->query("SELECT
    //                                     *
    //                                 FROM
    //                 notification_log
    //             JOIN notification_master ON notification_log.type_id = notification_master.id
    //             WHERE
    //                 notification_log.is_watch = 0
    //             AND notification_master.is_active = 1
    //             ORDER BY
    //                 notification_log.created_at DESC ");
    //     return $query->result();
    // }
    
    //get_notiications
    //return all notifications
    // public function get_all(){
    //     $query=$this->db->query("SELECT
    //         notification_log.id as log_id,
    //         notification_log.notifications,
    //         notification_log.created_at,
    //         notification_log.tablenumber,
    //         notification_log.customer_unique_id,
    //     notification_log.waiter,
    //     notification_log.staff,
    //     notification_log.type_id,
    //     notification_master.is_active,
    //     notification_log.is_watch,
    //     notification_log.type_id,
    //     notification_master.id,
    //     notification_log.order_id
    //     FROM
    //         notification_log
    //     JOIN notification_master ON notification_log.type_id = notification_master.id
    //     ORDER BY
    // notification_log.created_at DESC");
    //     return $query->result();
    // }

     public function get_notifications(){
        $query = $this->db->query("SELECT
                    notification_log.id as log_id,
                    notification_master.notification,
                    notification_log.created_at,
                    notification_log.order_id,
                    notification_log.customer_unique_id,
                    notification_log.waiter,
                    notification_log.tablenumber,
                    notification_log.staff,
                    notification_log.type_id,
                    notification_log.is_watch,
                    notification_log.text,
                    notification_log.notifications,
                    notification_master.is_active
                FROM
                    notification_log
                JOIN notification_master ON notification_log.type_id = notification_master.id
                WHERE
                    notification_log.is_watch = 0
                AND notification_master.is_active = 1
                ORDER BY
                    notification_log.created_at DESC ");
        return $query->result();
    }

    public function get_last_id(){
        $query=$this->db->query("SELECT id as last_id from notification_log ORDER BY id DESC LIMIT 1");
        return $query->row_array();
    }

    public function get_all_unwatched(){
        $query=$this->db->query("SELECT
                                    count(*) as notification
                                FROM
                                    notification_log
                                JOIN notification_master ON notification_log.type_id = notification_master.id
                                WHERE
                                    notification_log.is_watch = 0
                                AND notification_master.is_active = 1
                               
                                ORDER BY
                                notification_log.created_at DESC");
        return $query->row_array();
    }

   public function mark_watched($id=null){
        if(!$id)
            return $this->db->query("UPDATE notification_log set is_watch=1");
        else
            return $this->db->query("UPDATE notification_log set is_watch=1 where id=$id");
        
        
    }
    
    public function get_type(){
        $query=$this->db->query("SELECT distinct(type) from notification_log");
        return $query->result();
    }

    public function waiter_called($tablenumber,$waiter,$customer_unique_id,$customername){

        
        $data = array(
            'notifications' => 'Waiter Called',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => $customer_unique_id,
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>2,
            'is_watch'=>0,

            "text"=>"<div style='color:black;'> Customer: <span  class='label label-success label-as-badge'>".$customername."</span> on Table: <span class='label label-info label-as-badge'> $tablenumber</span> call Waiter: <span class='label label-primary label-as-badge'>$waiter</span></div>"            
        );
        $this->db->insert('notification_log', $data);

    }


    public function drink_refil_req($tablenumber,$waiter,$customer_unique_id,$customername){
       
        $data = array(
            'notifications' => 'Waiter Called',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => $customer_unique_id,
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>2,
            'is_watch'=>0,
            "text"=>"<div style='color:black;'> Customer: <span  class='label label-success label-as-badge'>".$customername."</span> on Table: <span class='label label-info label-as-badge'> $tablenumber</span> Request For Refil Drink</div> "            
        );
        $this->db->insert('notification_log', $data);
    }

    public function waiter_accept_req($tablenumber,$waiter){
        $data = array(
            'notifications' => 'Call Waiter Request Accepted',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => "N/A",
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>2,
            'is_watch'=>0,
            "text"=>"<div style='color:black;'> Waiter : <span  class='label label-primary label-as-badge'>".$waiter."</span> Accepted Request From Table No: <span class='label label-info label-as-badge'> $tablenumber</span></div>"            
        );
        $this->db->insert('notification_log', $data);
    }

    public function call_waiter_req_accepted($tablenumber,$waiter,$customer_unique_id){
        $customer=explode('_',$customer_unique_id);
        $data = array(
            'notifications' => 'Call Waiter Request Accepted',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => $customer_unique_id,
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>2,
            'is_watch'=>0,
            "text"=>"<div> Waiter: <span  class='label label-success label-as-badge'>".$customer[0]."</span> on Table: <span class='label label-info label-as-badge'> $tablenumber</span> Drink Refil Request: <span  class='label label-primery label-as-badge'>$waiter</span></div>"            
        );
        $this->db->insert('notification_log', $data);

    }


     public function order_processed($tablenumber,$waiter,$customer_unique_id){
        $customer=explode('_',$customer_unique_id);
        $data = array(
            'notifications' => 'Call Waiter Request Accepted',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => $customer_unique_id,
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>2,
            'is_watch'=>0,
            "text"=>"<div> Waiter: <span  class='label label-success label-as-badge'>".$customer[0]."</span> on Table: <span class='label label-info label-as-badge'> $tablenumber</span> Drink Refil Request: <span  class='label label-primery label-as-badge'>$waiter</span></div>"            
        );
        $this->db->insert('notification_log', $data);

    }

    public function order_placed($tablenumber,$waiter,$order_id){
       
        $data = array(
            'notifications' => 'Order Placed',
            'order_id'=>$order_id,
            'created_at' => date('Y-m-d H:i:s'),
            
            'waiter' => $waiter,
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>1 ,
            'is_watch'=>0,
            'text'=>"Customer: <span class='label label-success label-as-badge'>$waiter</span> Place Order On Table <span class='label label-info label-as-badge'>". $tablenumber."</span>"          
        );
        $this->db->insert('notification_log', $data);
    }


    public function staff_logged($staff_name){
        $data = array(
            'notifications' => 'Staff LoggedIn',
            'order_id'=>'N/A',
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => 'N/A',
            'waiter' => 'N/A',
            'staff'=>$staff_name,
            'tablenumber' => 'N/A',
            'type_id'=>3 ,
            'is_watch'=>0,
            "text"=>"<div><span class='label label-primery label-as-badge'>".$staff_name."</span> login at <span class='label label-warning label-as-badge'> ".date('Y-m-d H:i:s')  ."</span></div>"
                   
        );
        $this->db->insert('notification_log', $data);
        
        // exit();
    }
    
    public function customer_logged($customer_unique_id,$tablenumber){
        $customer=explode('_',$customer_unique_id);

        $data = array(
            'notifications' => 'Customer LoggedIn',
            'order_id'=>0,
            'created_at' => date('Y-m-d H:i:s'),
            'customer_unique_id' => $customer_unique_id,
            'waiter' => 'N/A',
            'staff'=>'N/A',
            'tablenumber' => $tablenumber,
            'type_id'=>4,
            'is_watch'=>0,
            'text'=>"Customer: <span class='label label-success label-as-badge'>".$customer[0]."</span> come on Table "."<span class='label label-info label-as-badge'>".$tablenumber."</span>"          
        );
        $this->db->insert('notification_log', $data);

    }

    public function get_notifications_by_id($id){
        $query=$this->db->query("SELECT *  from notification_log where type_id=$id");
        return $query->result();
        // echo $this->db->last_query();
    }

    public function load_notifications_by_id($id){
        $query=$this->db->query("SELECT
                    notification_log.id as log_id,
                    notification_master.notification,
                    notification_log.created_at,
                    notification_log.order_id,
                    notification_log.customer_unique_id,
                    notification_log.waiter,
                    notification_log.tablenumber,
                    notification_log.staff,
                    notification_log.type_id,
                    notification_log.is_watch,
                    notification_log.text,
                    notification_log.notifications,
                    notification_master.is_active
                FROM
                    notification_log
                JOIN notification_master ON notification_log.type_id = notification_master.id
                WHERE
                    notification_log.is_watch = 0
                AND notification_master.is_active = 1
                AND notification_log.id = $id

                ORDER BY
                    notification_log.created_at DESC ");
        return $query->result_array();
        // echo $this->db->last_query();
    }

     function get_customer_login_notification(){
        $query=$this->db->query("SELECT
                                *
                            FROM
                                notification_log AS nl
                            JOIN `order` ON nl.customer_unique_id = `order`.customer_unique_id
                            JOIN `table` ON `table`.tablenumber = nl.tablenumber
                            WHERE
                                `order`.payment_status = 0
                            AND `order`.`status` != 4
                            AND `table`.inuse = 1
                            GROUP BY
                                nl.customer_unique_id
                            order by nl.created_at DESC");
        return $query->result_array();
    }
    
}

?>
