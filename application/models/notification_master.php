<?php
/*
 * Quentin Mayo
 *
 */
class notification_master extends CI_Model{
    //__construct
    //constructor for notification
    public function __construct(){
        //$this->load->database();
        require_once('application/models/vo/DespatchVO.php');
    }
    
    //get_notiications
    //return all notifications
    public function get_all(){
        $query = $this->db-> get('notification_master');
        return $query->result();
    }
    
   public function get($id){
        // $id=base64_decode($id);
    // echo $id;
    // exit();
        $query=$this->db->query(" SELECT * from notification_master where id=$id");
        return $query->row();
   }
    
    public function mark_active($id){
        
        // $id=base64_decode($id);
        return $this->db->query(" UPDATE notification_master set is_active=1 where id=$id");
        // return $query->result();

    }

    public function mark_deactive($id){
        return $this->db->query(" UPDATE notification_master set is_active=0 where id=$id");

    }
       
}

?>
