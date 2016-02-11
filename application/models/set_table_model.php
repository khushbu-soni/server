<?php
class Set_table_model extends CI_Model{
    //__construct
    //Constructor for table
    public function __construct() {
        //$this->load->database();
        require_once('application/models/vo/TableVO.php');
    }
  
    
    public function get_tables(){
        $query = $this->db->query('select tables from table');
        return $query->result(); 
    }
    
     
    //insert_table
    //add table
    public function set_identity(){
       
            $data = array(
               
                  'inuse'=> 1

            );
            $check =
            array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tablenumber'))
            );
            //$this->insert_table();
             $data1 = array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tablenumber')),
            'assign_waiter'  => trim($this->input->post('waiter')),
            'inuse'=> 1
            );
            $this->session->set_userdata($data1);
           // return TRUE;
                
            return $this->db->update('table', $data, $check);
        }
    

/*public function insert_table(){
        $data = array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tablenumber')),
            'inuse'=> 1
            );
        $check = $this->db->get_where('table', array(
            'tablenumber'=>trim($this->input->post('tablenumber')),
            'tabletnumber'=> trim($this->input->post('tablenumber'))
        ));

        if($check->num_rows() <= 0){
            $this->db->insert('table',$data); 
            $information = $this->db->get_where('table',$data)->row();
           /*print_r($information);
           echo "no data";
           exit();
            $this->session->set_userdata('info',$information);
            return $information;  

             
             
        }
        return false;
    }*/

    /*
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



      public function insert_orderitem_uniq_customer(){
        $data = array(
'menuid'=> 0,
'orderid'=> 0,
'price'=> 0,
            'cust_name'=> $this->session->userdata('customername'),
            );
       $this->db->insert('orderitem',$data); 
    }

    //get_tables
    //Get information on all tables
    public function get_tables(){
        $query_str = "SELECT DISTINCT tablenumber FROM `table`";
        $query = $this->db->query($query_str);
        return $query->result('TableVO');
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
        return false;
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
            'tablenumber'     =>   $this->input->post('tablenumber'),
            'tabletnumber'     =>   $this->input->post('tabletnumber')
        )
                ); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;    
    }*/


}
?>
