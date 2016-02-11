<?php
class Status_model extends CI_Model{
    //__construct
    //Constructor for tstatus
    public function __construct(){
        //$this->load->database();
    }
    
    //get_tstatus
    //returns all status
    public function get_status($statusid){
        $query= $this->db->get_where('status', "id = $statusid");
        return $query->result();
    }

    public function get_all()
    {
        $query = $this->db->get('status');
        return $query->result();
    }

    //get_tstatus
    //returns all status
    public function get_available_status(){
        $query = $this->db->get_where('status', array('available' => 1));
        return $query->result();
    }
    //insert_status
    //add status
    //Note that since we can add the duplicate status,
    //We don't check to see if there any duplicate
     public function insert_status(){
            $data = array(
            'status' =>$this->input->post('status'),
            'order'=>$this->input->post('order'),
            'bgcolor'=>'#'.$this->input->post('bgcolor'),
            'color'=>'#'.$this->input->post('color')
            );
            $this->db->insert('status', $data);
            return $this->db->insert_id();
     }
    public function search_by_title(){
        $this->db->select('*');
        $this->db->from('status');
        //$this->db->join('ingredient', 'status.id =  ingredient.statusid');
        $array = array('status.status_name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        return $this->db->get()->result();
    
    }
    //remove_status_by_id
    // remove status by id
    public function delete_status($statusid){
	    $this->db->delete('status', array('id' => $statusid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;      
    }
    
    
     public function edit_status($statusid){
        $data = array(
        'status' =>$this->input->post('status'),
        'order'=>$this->input->post('order'),
        'bgcolor'=>'#'.$this->input->post('bgcolor'),
        'color'=>'#'.$this->input->post('color')
        );
        $this->db->where('id', $statusid);
        $this->db->update('status', $data);
        if ($this->db->affected_rows() > 0)
        return TRUE;
        return FALSE;
        }

    public function get_status_by_id($id){
        $query = $this->db->get_where('status', array('id' =>$id));
        return $query->result();
    }

    // public function get_status($statusid){
    //     $query = $this->db->get_where('status', array('id' => $statusid));
    //     return $query->row();
    // }

    public function set_availability(){
        $available = $this->input->post('available');
        $data = array('available'=>$available);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('status', $data);
    }
    public function get_leastOrderstatus(){
        $query=$this->db->query(
            "SELECT status. * , COUNT( * ) AS sells
            FROM status, orderstatus
            WHERE orderstatus.id = status.id
            GROUP BY status.id
            Order By sells
            LIMIT 0,1");
        return $query->result();
        
    }

    public function get_all_orderBy($arrange){
        $query=$this->db->query(
            "SELECT * FROM status Order By `order` $arrange          
            ");
         return $query->result();
    }


}
?>
