<?php
class configruation_model extends  CI_Model{
    //__construct
    public $data;
    //Constructor of abstract_userlogin_model
    public function __construct() {
       $this->load->database();
    }

    public function sidebar_menus($for_panel)
    {
 
         $query=$this->db->query("SELECT * FROM (`sidebar_menus`) WHERE for_panel='".$for_panel."' order by `order` asc");
     
        return $query->result();

    }

    public function get_config(){
        $query=$this->db->query("SELECT * from configraution");
        return $query->row();
    }

    public function get_all(){
         $user_data=$this->session->userdata;
         //print_r($user_data);
         //exit();
        $query = $this->db->get_where('configraution', array('manager_id' => $user_data['userid']));
        if(empty($query))
        {
            echo"no user <br>";
            print_r($this->db->last_query());
            exit();
        }
        return $query->row();

        }

    public function only_tables(){
        $query=$this->db->query("SELECT Distinct(tablenumber),inuse from `table` ORDER BY tablenumber");
        //$query=$this->db->query("SELECT Distinct(tablenumber),(SELECT MAX(no_of_table) FROM `configraution`) from `table` where inuse=0");
        return $query->result();
        
    }
    public function create(){
       
         $user_data=$this->session->userdata;
         
         $data = array(
            'min_order_per_page'=>$this->input->post('min_order_per_page'),
            'manager_id'=>$user_data['userid'],
            'no_of_table'=>$this->input->post('no_of_table'),
            'tax'=>$this->input->post('tax'),
            'upper_block_refresh_time'=>$this->input->post('upper_block_refresh_time'),
            'free_table_auto_refresh_time'=>$this->input->post('free_table_auto_refresh_time'),
            'free_waiter_auto_refresh_time'=>$this->input->post('free_waiter_auto_refresh_time'),
            'customer_notification_auto_refresh_time'=>$this->input->post('customer_notification_auto_refresh_time'),
            'busy_waiter_notify_color'=>$this->input->post('busy_waiter_notify'),

        );

        return $this->db->insert('configraution', $data); 
    }

   public function getTax(){
 
 
        $query=$this->db->query("SELECT tax from configraution  limit 1");
        return $query->row();
    }
 

    public function update_image($filename,$filename1)
    {
        // print_r($filename);
        // exit();
        $data = array(
            'no_of_table'=>$this->input->post('no_of_table'),
            'tax'=>$this->input->post('tax'),
            'auto_refresh_time'=>$this->input->post('auto_refresh_time'),
            'hotel_name'=>$this->input->post('hotel_name'),
            'address'=>$this->input->post('address'),
            'contact'=>$this->input->post('contact'),
            'free_waiter_notify_color'=>$this->input->post('free_waiter_notify'),
            'busy_waiter_notify_color'=>$this->input->post('busy_waiter_notify'),
            'logo'=>$filename[0].".jpg",
            'logo1'=>$filename1[0].".jpg",
            'upper_block_refresh_time'=>$this->input->post('upper_block_refresh_time'),
            'free_table_auto_refresh_time'=>$this->input->post('free_table_auto_refresh_time'),
            'free_waiter_auto_refresh_time'=>$this->input->post('free_waiter_auto_refresh_time'),
            'customer_notification_auto_refresh_time'=>$this->input->post('customer_notification_auto_refresh_time')
        );
        
        return $this->db->update('configraution', $data);
    }

     public function update_order($manager_id,$filename){
        
        $data = array(
            'min_order_per_page'=>$this->input->post('min_order_per_page')
            );
           
         $this->db->where('manager_id', $manager_id);
        return $this->db->update('configraution', $data);
     }

    public function edit($filename=array()){
        // echo print_r($filename);
        // exit();
        if(empty($filename))
            $filename="";
        $data = array(
            'no_of_table'=>$this->input->post('no_of_table'),
            'tax'=>$this->input->post('tax'),
            'hotel_name'=>$this->input->post('hotel_name'),
            'address'=>$this->input->post('address'),
            'contact'=>$this->input->post('contact'),
            'auto_refresh_time'=>$this->input->post('auto_refresh_time'),
            'free_waiter_notify_color'=>$this->input->post('free_waiter_notify'),
            'busy_waiter_notify_color'=>$this->input->post('busy_waiter_notify'),
            'upper_block_refresh_time'=>$this->input->post('upper_block_refresh_time'),
            'free_table_auto_refresh_time'=>$this->input->post('free_table_auto_refresh_time'),
            'free_waiter_auto_refresh_time'=>$this->input->post('free_waiter_auto_refresh_time'),
            'customer_notification_auto_refresh_time'=>$this->input->post('customer_notification_auto_refresh_time')
        );

        // print_r($data);
        // exit();
        // $this->db->where('manager_id', $userid);
        $this->db->update('configraution', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    public function alreadySet($userid){
        
            $data = array(
                'manager_id'=>$userid,
            );


       $query= $this->db->get_where('configraution', $data);
        
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    } 
    
    }


