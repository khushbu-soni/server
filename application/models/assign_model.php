<?php
class assign_model extends CI_Model{
    //__construct
    public $data;
    //Constructor of abstract_userlogin_model
    public function __construct() {
       // $this->load->database();
    }

    public function create(){

        $data = array(
            'tablenumber'=>   $this->input->post('tablenumber'),
            'tabletnumber'=>   $this->input->post('tablenumber'),
            'inuse'=>0,
            'notes'=>'assign',
            'waiter_id'=>$this->input->post('waiter_id')
        );
        return $this->db->insert('table', $data); 
        }

    function get_all(){

            $this->db->select('table.*,staff.fname,staff.lname');    
            $this->db->from('table');
            $this->db->join('staff', 'staff.id =table.waiter_id');
            $query = $this->db->get();
            return $query->result();
    }

     public function only_tables(){
        $query=$this->db->query("SELECT Distinct(tablenumber) from table ");
        return $query->result();
        
    }

    public function get_staff_by_waiterid($waiterid){
        $this->db->select('table.*,staff.fname,staff.lname');    
            $this->db->from('table');
            $this->db->join('staff', 'staff.id =table.waiter_id');
            $this->db->where('table.waiter_id', $waiterid);
            $query = $this->db->get();
        return $query->result();
       // echo $this->db->last_query();
       // exit();
    }

    public function get_record($assignid){
        $query = $this->db->get_where('table', array('id' => $assignid));
        return $query->row();

        }

        public function delete($assignid){
            return $this->db->delete('table', array('id' => $assignid)); 
        }

    public function edit($assignid){
        $data = array(
            'tablenumber'=>   $this->input->post('tablenumber'),
            'tabletnumber'=>   $this->input->post('tablenumber'),
            'inuse'=>0,
            'notes'=>'Edit info',
            'waiter_id'=>$this->input->post('waiter_id')
        );

        $this->db->where('id', $assignid);
        $this->db->update('table', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    public function alreadyExit($tablenumber,$assignid=null){
        if(!$assignid){
            $data = array(
                'tablenumber'=>   $tablenumber,
            );
        }else
            $data = array(
                'tablenumber'=>   $tablenumber,
                'id !='=>$assignid
            );


       $query= $this->db->get_where('table', $data);
        
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    } 
    
    }


