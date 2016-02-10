<?php
class menutype_model extends CI_Model{
    //__construct
    //Constructor for tmenutype
    public function __construct(){
        //$this->load->database();
    }
    
    //get_tmenutypes
    //returns all menutypes
    public function get_menutypes($menutypesid){
        $query= $this->db->get_where('menutype', "id = $menutypeid");
        return $query->result();
    }

    public function get_all_menutypes()
    {
        $query = $this->db->get('menutype');
        return $query->result();
    }

    //get_tmenutypes
    //returns all menutypes
    public function get_available_menutypes(){
        $query = $this->db->get_where('menutype', array('available' => 1));
        return $query->result();
    }
    //insert_menutype
    //add menutype
    //Note that since we can add the duplicate menutypes,
    //We don't check to see if there any duplicate
    public function insert_menutype(){
        $data = array(
            'menutype_name' =>$this->input->post('menutype_name')
        );
        
        $this->db->insert('menutype', $data);
        return $this->db->insert_id();
        
    }

    public function search_by_title(){
        $this->db->select('*');
        $this->db->from('menutype');
        //$this->db->join('ingredient', 'menutype.id =  ingredient.menutypeid');
        $array = array('menutype.menutype_name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        return $this->db->get()->result();
    
    }
    //remove_menutype_by_id
    // remove menutype by id
    public function delete_menutype($menutypeid){
	    $this->db->delete('menutype', array('id' => $menutypeid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;      
    }
    
    public function edit_menutype($menutypeid){
        $data = array(
            'menutype_name' =>$this->input->post('menutype_name')
        );

        $this->db->where('id', $menutypeid);
        $this->db->update('menutype', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function get_menutype_by_id($id){
        $query = $this->db->get_where('menutype', array('id' =>$id));
        return $query->result();
    }

    public function get_menutype($menutypeid){
        $query = $this->db->get_where('menutype', array('id' => $menutypeid));
        return $query->row();
    }

    public function set_availability(){
        $available = $this->input->post('available');
        $data = array('available'=>$available);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('menutype', $data);
    }
    public function get_leastOrdermenutype(){
        $query=$this->db->query(
            "SELECT menutype. * , COUNT( * ) AS sells
            FROM menutype, ordermenutype
            WHERE ordermenutype.id = menutype.id
            GROUP BY menutype.id
            Order By sells
            LIMIT 0,1");
        return $query->result();
        
    }

}
?>
