<?php
class Customer_details_model extends CI_Model{
    //__construct
    //Constructor for Coupon
    public function __construct() {
       // $this->load->database();
    }
    //get_coupons 
    //Get all coupons
    public function get_profile(){
      
       
        if($this->session->userdata('customermobile') == '')
        {

             $data = array(
            'customer_name' =>  $this->session->userdata('customername')
            );
           

        }else
        {

              $data = array(
            'mobile' =>  $this->session->userdata('customermobile')
            );
        }
        $query = $this->db->get_where('customer_data',$data);

        return $query->result();
        

        
    }

}
?>