<?php
class supplier_model extends CI_Model{
    //__construct
    //Constructor for staff
    public function __construct(){
       // $this->load->database();
    }
    
    //get_staff_members
    // get information of all staff
    public function get(){
       $query=$this->db->query("SELECT * FROM suppliers ");
        return $query->result();
    }
   
    public function is_exist($name){

        $query=$this->db->query("SELECT * from suppliers where name='".$name."'");

        return $query->result();
    }


    public function add($name){
        $data = array(
            'name'     =>   $name,
            'address'     =>   'null',
            'phone_no'     =>   'null',
            'email'     =>'null',
        );

        return $this->db->insert('suppliers', $data);
    }

}
?>
