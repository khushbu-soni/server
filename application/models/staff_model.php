<?php
class staff_model extends CI_Model{
    //__construct
    //Constructor for staff
    public function __construct(){
       // $this->load->database();
    }
    
    //get_staff_members
    // get information of all staff
    public function get_staff_members(){
       $query = $this->db->get_where('staff', array('delete' => 0));
           return $query->result();
    }
    //get_staff_by_id
    //get all information on staff by id
     public function get_staff_by_id($userid){
       $query = $this->db->get_where('staff', array('id' => $userid,'delete'=>0));
        return $query->result();
    }

    
    public function get_waiters(){
        $query=$this->db->query("SELECT fname,id  from `staff` where role=0");
        return $query->result_array();
    }

    function update_profile($data)
    {
        
        $this->db->where('id', $_POST['id']);
        $this->db->update('staff', $data);

    }
    //get_staff_by_login
    //get all information on staff by logincode
    public function get_staff_by_logincode(){
        $query = $this->db->get_where('staff', array('logincode' =>$this->input->post('logincode'),'delete'=>0));
        return $query->row();
    
    }

     public function get_waiter_by_tablenumbar($tablenumber){
       $query=$this->db->query("SELECT * FROM `staff` JOIN `table` on `table`.waiter_id=staff.id WHERE `table`.tablenumber=$tablenumber");
        return $query->result_array();
    
    }

     function get_waiter_count(){
       $query=$this->db->query("SELECT COUNT(*) as `count` from `staff` where role=0");
        return $query->row_array();
     }

    public function get_name($id){
        $query = $this->db->get_where('staff', array('id' =>$id,'delete'=>0));
        return $query->row();

    } 
     public function get_free_waiter_by_id($waiterid){
        $query=$this->db->query("SELECT tablenumber from `table` where waiter_id = $waiterid");
        return $query->result();
    } 
    
    
    //insert_new_staff_member
    //add new staff member
    public function insert_new_staff_member($filename){
        //generate six digit login code for the new staff member
        if(!$filename)
            $filename="default.png";
        else
            $filename=$filename."png";
        $continue = true;
        $code;
        while($continue){
            $code =  rand(100000, 999999);
            $check = $this->db->get_where('staff',array('logincode'=>$code));
            if($check->num_rows() <=0){$continue = false;}
        }

        $data = array(
            'fname'     =>   $this->input->post('fname'),
            'lname'     =>   $this->input->post('lname'),
            'uname'     =>   $this->input->post('uname'),
            'logincode'     =>$this->input->post('password'),
            'role'      =>   $this->input->post('role'),
            'pic'=>$filename,
            'delete'=>0
            // 'logincode' =>   $code
        );
        return $this->db->insert('staff', $data); 
    }

    function edit_account($userid,$filename)
    {
        
        $data = array(
            'fname'     =>   $this->input->post('fname'),
            'lname'     =>   $this->input->post('lname'),
            'uname'     =>   $this->input->post('uname'),
            'logincode'     =>   $this->input->post('password'),
            'role'      =>   $this->input->post('role'),
            'pic'=>$filename.".jpg",
            'delete'=>0
            // 'logincode' =>   $code
        );
        $this->db->where('id', $userid);
        $this->db->update('staff', $data);

    }
    
    //remove_staff_by_logincode
    public function remove_staff_by_logincode(){
    $this->db->delete('staff', array('logincode' => $this->input->post('logincode')));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;        
    }
    
    //remove_staff_by_id
    public function delete_account($userid){
       // return $this->db->delete('staff', array('id' => $userid));
       $query=$this->db->query("UPDATE staff set `delete` =1 where id=$userid");
       // ret$query->result(); 
    }
     public function free_waiter($waiter_id){
       // return $this->db->delete('staff', array('id' => $userid));
       $query=$this->db->query("UPDATE staff set `inuse` =0 where id=$waiter_id");
       // ret$query->result(); 
    }
    
    //get_staff_in_role
    //get all information on staff by id
    public function get_staff_by_role($role=null){
        if($role){
            $query = $this->db->get_where('staff', array('role' =>$role,'delete'=>0));
        }else{

            $query = $this->db->get_where('staff', array('role' => $this->input->post('role'),'delete'=>0));
        }
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }    
    //new
    public function waiters(){
        $query = $this->db->get_where('staff', array('role' =>'0','delete'=>0));
            return $query->result();
    }
    
    public function is_table_assign($id){
        
        $query=$this->query("SELECT count(*) FROM staff JOIN `table` on staff.id=`table`.waiter_id where staff.id=$id and staff.`delete`=0");
        return $query->row();
    }

    public function get_free_waiter(){
        $query=$this->db->query("SELECT * from `staff` where role =0 and id not IN (
                    SELECT `staff`.id FROM staff JOIN `table` on staff.id=`table`.waiter_id WHERE staff.role=0 and staff.`delete`=0 and `table`.`inuse`=1)");
        return $query->result_array();
    } 

    public function get_busy_waiter(){
        $query=$this->db->query("SELECT * FROM staff join `table` on staff.id=`table`.waiter_id where staff.`delete`=0 and `table`.`inuse`=1 group by `table`.waiter_id ");
        
        return $query->result_array();
    }   

    public function table_assign($userid){
        // echo $userid;
        // exit();
        $query=$this->db->query("SELECT count(*) as `count` FROM staff join `table` on `table`.waiter_id=staff.id where staff.`delete`=0 and `table`.waiter_id=$userid");
        return $query->row();
        
    }

}
?>
