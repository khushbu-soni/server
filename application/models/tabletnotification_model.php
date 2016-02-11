<?php
class tabletnotification_model extends CI_Model{
    //constructor
    //constructor for table notification
    public function __construct(){
        //$this->load->database();
        require_once('application/models/vo/RefillVO.php');
    }
    
    public function get_tabletnotifications(){
        $query = $this->db->get('tabletnotification');
        return $query->result();
    }

   public function insert_tabletnotification(){

    $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $waiter_id = $this->session->userdata('assign_waiter');
        $order_id = $this->session->userdata('order_id');
        if($this->session->userdata('order_id'))
        {
            $order_id_c = $this->session->userdata('order_id');
        }else
        {
            $order_id_c = 0;
        }

        //echo "goto";
        if($tablenumber== false || $tabletnumber== false ){return false;}
           
           $data = array(
                'tablenumber'     =>   $tablenumber,
                'tabletnumber'     =>   $tabletnumber,
                'type'     =>           0,
                'description'      =>   "HELP REQUEST",
                'waiter_id'         => $waiter_id,
                'orderid'    => $order_id,
                  'datetime'   => date('Y-m-d h:i:s')
            );
           //print_r($data);
            //$this->db->insert('tabletnotification',$data);
            
            //Entry in log
            $this->load->model('notification_log', 'notifications');
            $this->load->model('staff_model', 'staff');
            $waiter=$this->staff->get_name($waiter_id);

            $waiter_name=$waiter->fname;

            $customer_unique_id=$this->session->userdata['customer_unique_id'];
            $customername=$this->session->userdata['customername'];
            $this->notifications->waiter_called($tablenumber,$waiter_name,$customer_unique_id,$customername);
            //Entry in log

             $test = array('tablenumber'=>$tablenumber,'tabletnumber'=>$tabletnumber,'waiter_id'=> $waiter_id,'orderid'=> $order_id_c,'acceptedby' =>null,'type' =>0);
            $testUsed =  $this->db->get_where('tabletnotification',$test);

             
            //echo $this->db->last_query();
            echo $testUsed->num_rows();
            $orders=$testUsed->result();
            //print_r($orders);

            if($this->session->userdata('order_id')== '')
            {
                 $this->db->insert('tabletnotification',$data);
            }
            if($testUsed->num_rows() == 0 )
                {
                    $this->db->insert('tabletnotification',$data);
                }
                else 
                {
                    if($this->session->userdata('order_id')== $orders->id)
                    {
                        $this->db->update('tabletnotification',$data,$test);
                    }
                    else
                    {
                         $this->db->update('tabletnotification',$data,$test);
                    }
                   
                }
                
        
    }
    
    public function insert_drinkrefill(){
	   $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        $waiter_id = $this->session->userdata('assign_waiter');
        $order_id = $this->session->userdata('order_id');
           $data = array(
                'tablenumber'     =>   $tablenumber,
                'tabletnumber'     =>   $tabletnumber,
                'type'     =>           1,
                'description'      =>   "DRINK REFILL",
                'orderid'      =>   $order_id,
                'waiter_id' => $waiter_id
            );

            

            $test = array('tablenumber'=>$tablenumber,'tabletnumber'=>$tabletnumber,'acceptedby' =>null,'type' =>1);
            $testUsed =  $this->db->get_where('tabletnotification',$test);
            if($testUsed->num_rows() == 0 ){
                //Validate Drink refill
                $result = $this->db->query("SELECT orderitem.id FROM (orderitem JOIN menuitem ON orderitem.menuid = menuitem.id) WHERE menuitem.type = 3");
                if($result->num_rows() != 0 ){
                    //Entry in log
                    $this->load->model('notification_log', 'notifications');
                    $this->load->model('staff_model', 'staff');
                    $waiter=$this->staff->get_name($waiter_id);
                    $waiter_name=$waiter->fname;
                    $customer_unique_id=$this->session->userdata['customer_unique_id'];
                    $customername=$this->session->userdata['customername'];
                    $this->notifications->drink_refil_req($tablenumber,$waiter_name,$customer_unique_id,$customername);
                    //Entry in log
                    $this->db->insert('tabletnotification',$data);
                    
                    return true;
                }
                else{return false;}
                
             }
             else{return false;}
                
        
    }
    // get_tabletnotification_of_type
    // get notifications by type
    public function get_tabletnotification_of_type(){   
        $query = $this->db->get_where('tabletnotification',array('type'=>$this->input->post('type')));
        return $query->result();
    }
    
    public function get_table($id){

        $query=$this->db->query("SELECT tablenumber from tabletnotification where id=$id");
        return $query->row_array();
        
    }


    public function accept_notification($id=null){
        $tablenumber = $this->session->userdata('tablenumber');
        $tabletnumber = $this->session->userdata('tabletnumber');
        // print_r($this->session->userdata);
        if($id){
            $tablenumber_info=$this->get_table($id);
                if(!$tablenumber){
                    $tablenumber=$tablenumber_info['tablenumber'];
                }
        }
        
        $waiter_id = $this->session->userdata('waiter_id');
        $order_id = $this->session->userdata('order_id');
      
        $data = array('acceptedby' => $this->session->userdata('userid'));

        //Entry in log
            $this->load->model('notification_log', 'notifications');
            $this->load->model('staff_model', 'staff');
            $waiter=$this->staff->get_name($waiter_id);
            $waiter_name=$waiter->fname;
            
            $this->notifications->waiter_accept_req($tablenumber,$waiter_name);
        //Entry in log

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tabletnotification', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function resolve_notification(){
        $this->db->delete('tabletnotification', array('id' => $this->input->post('id')));
    }

    public function delete_tabletnotification(){
	$this->db->delete('tabletnotification', array($this->get_id_set()));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /* get help requests */
    public function get_unaccepted_help_requests()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 0);
        $this->db->where('acceptedby', null);
        $query = $this->db->get();
        return $query->result();
    }

    /* get accepted help request */
    public function get_accepted_help_requests()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 0);
        $this->db->where('acceptedby IS NOT null');
        $query = $this->db->get();
        return $query->result();
    }

    /* get unaccepted drink refill requests */
    public function get_unaccepted_refills()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 1);
        $this->db->where('acceptedby', null);
        $query = $this->db->get();
        return $query->result('RefillVO');
    }

    /* get accepted drink refill requests */
    public function get_accepted_refills()
    {
        $this->db->select('*');
        $this->db->from('tabletnotification');
        $this->db->where('type', 1);
        $this->db->where('acceptedby IS NOT null');
        $query = $this->db->get();
        return $query->result('RefillVO');
    }

     public function delete_by_id($id){
        $query=$this->db->query("Delete  From `tabletnotification` where orderid=$id");
         if ($this->db->affected_rows() > 0)
            return 0;
        return 1; 
    }

}
?>
