<?php
class menuitem_model extends CI_Model{
    //__construct
    //Constructor for menutitem
    public function __construct(){
        //$this->load->database();
    }
    
    //get_menutitems
    //returns all menuitems
    public function get_menuitems($type=0){
        
        $query= $this->db->get_where('menuitem', "type = $type");
        return $query->result();
    }
    
    public function get_all_available_menu_item(){
         $query = $this->db->query("SELECT item_no,name from menuitem where available=1");
         return $query->result_array();
    }


    public function get_all_available_menu_item_from_biryani(){
         $query = $this->db->query("SELECT item_no,name from menuitem where available=1 and res_category='BH'");
         return $query->result_array();
    }

    public function get_all_available_menu_item_from_cafe(){
         $query = $this->db->query("SELECT item_no,name from menuitem where available=1 and res_category='CS'");
         return $query->result_array();
    }

    public function get_all_available_menu_item_from_bar(){
         $query = $this->db->query("SELECT item_no,name from menuitem where available=1 and res_category='BAR'");
         return $query->result_array();
    }

    public function get_all_menuitems()
    {
        $query = $this->db->query("SELECT * from menuitem");
        return $query->result();
    }

    public function get_all_biryani_house_menuitems()
    {
        $query = $this->db->query("SELECT * from menuitem where res_category='BH'");
        return $query->result();
    }

    public function get_all_cafe_one_six_menuitems()
    {
        $query = $this->db->query("SELECT * from menuitem where res_category='CS'");
        return $query->result();
    }

    
     public function get_all_bar_menuitems()
    {
        $query = $this->db->query("SELECT * from menuitem where res_category='BAR'");
        return $query->result();
    }

    function mark_available($cat){
            $data = array('available'=>1);
        $this->db->where('res_category',$cat);
        return $this->db->update('menuitem', $data);
    }

     function mark_unavailable($cat){
            $data = array('available'=>0);
        $this->db->where('res_category',$cat);
        return $this->db->update('menuitem', $data);
    }
    //get_menutitems
    //returns all menuitems
    public function get_available_menuitems(){
        $query = $this->db->get_where('menuitem', array('available' => 1));
        return $query->result();
    }
    //insert_menuitem
    //add menuitem
    //Note that since we can add the duplicate items,
    //We don't check to see if there any duplicate
    public function insert_menuitem($ingredients,$category){
        $data = array(
            'price' => $this->input->post('price'),
            'name' =>$this->input->post('name'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'calories' => $this->input->post('calories'),
            'available' =>$this->input->post('available'),
            'keywords' => $ingredients,
            'item_id' => $this->input->post('type'),
            'category'=>$category,
            'item_no'=>$this->input->post('item_no'),
            'res_category'=>$category,
          
        );


        
        $this->db->insert('menuitem', $data);
        return $this->db->insert_id();
        
    }

    public function update_image($menuitemid)
    {
        $filename = $menuitemid . '.jpg';
        $data = array('picturepath'=>$filename);
        $this->db->where('id', $menuitemid);
        return $this->db->update('menuitem', $data);
    }

    public function search_by_title(){
        $this->db->select('*');
        $this->db->from('menuitem');
        //$this->db->join('ingredient', 'menuitem.id =  ingredient.menuItemid');
        $array = array('menuitem.name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        return $this->db->get()->result();
    
    }

    public function search_res_by_title(){
        $this->db->select('*');
        $this->db->from('menuitem');
        //$this->db->join('ingredient', 'menuitem.id =  ingredient.menuItemid');
        $array = array('menuitem.name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->where('category','restro'); 
        $this->db->like($array);
        
        return $this->db->get()->result();
    
    }

    public function get_item_name($item_no){
      
        $query=$this->db->query("Select name,id,price,res_category from menuitem where item_no='".$item_no."'");        
        return $query->row();
    }

    public function search_bar_by_title(){
        $this->db->select('*');
        $this->db->from('menuitem');
        //$this->db->join('ingredient', 'menuitem.id =  ingredient.menuItemid');
        $array = array('menuitem.name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        $this->db->where('category','bar');
        return $this->db->get()->result();
    
    }
    //remove_menuitem_by_id
    // remove menuitem by id
    public function delete_menuitem($menuitemid){
	    $this->db->delete('menuitem', array('id' => $menuitemid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;      
    }
     public function set_featured_item($menuitemid){
        $data = array(
            'featured_item' => 1
            );
        $this->db->update('menuitem', $data ,array('id' => $menuitemid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;      
    }
     public function unset_featured_item($menuitemid){
        $data = array(
            'featured_item' => 0
            );
        $this->db->update('menuitem', $data ,array('id' => $menuitemid));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE; 
         
    }
    //0 -appetizer
    //1 - main dish
    //2 - dessert
    //3 - nonalcoholic drinks
    //4 - alcoholic drinks 
    public function get_menuitem_by_type($type){
	   $query = $this->db->get_where('menuitem', array('type' => $type, 'available'=>1));
       return $query->result();
    }

      public function get_beverages_menuitem_by_type($type){
       $query = $this->db->get_where('menuitem', array('type' => $type, 'available'=>1));
       return $query->result();
    }

     public function getSpecialOfferMenuItems($type){
       $query = $this->db->get_where('menuitem', array('type' => $type, 'available'=>1));
       return $query->result();
    }

    public function get_menuitem_type(){
         $query=$this->db->query(
            "SELECT  * 
            FROM menutype
            WHERE menu_type = '1'
            GROUP BY menutype_name
            Order By menu_order
            ");
        return $query->result();
    }
     public function  get_menuitem_beverages_type(){
         $query=$this->db->query(
            "SELECT  * 
            FROM menutype
            WHERE menu_type = '2'
            GROUP BY menutype_name
            Order By menu_order
            ");
        return $query->result();
    }

     public function  get_menuitem_specialoffer_type(){
         $query=$this->db->query(
            "SELECT  * 
            FROM menutype
            WHERE menu_type = '3'
            GROUP BY menutype_name
            Order By menu_order
            ");
        return $query->result();
    }

    public function  get_menuitem_shisha_type(){
         $query=$this->db->query(
            "SELECT  * 
            FROM menutype
            WHERE menu_type = '4'
            GROUP BY menutype_name
            Order By menu_order
            ");
        return $query->result();
    }
   
    
    //update_menuitem_by_id
    //update menuitem by id
    public function edit_menuitem($menuitemid,$ingredients,$category){
        $data = array(
            'price' => $this->input->post('price'),
            'name' =>$this->input->post('name'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'calories' => $this->input->post('calories'),
            'available' =>$this->input->post('available'),
            'keywords' => $ingredients,
            'item_id' => $this->input->post('type'),
            'category'=>$category,
            'item_no'=>$this->input->post('item_no'),
            'res_category'=>$category
        );

        $this->db->where('id', $menuitemid);
        $this->db->update('menuitem', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }

    public function get_menuitem_by_id($id){
        
        $query = $this->db->get_where('menuitem',array('id' => $id ));
        return $query->row();
    }

/*public function get_menuitem_by_id($id){
        
        $query = $this->db->get_where('menuitem',array('id' => $id ));
        return $query->row();
    }*/

    public function get_menuitem($menuitemid){
        $query = $this->db->get_where('menuitem', array('id' => $menuitemid));
        return $query->row();
    }

    public function set_availability(){
        $available = $this->input->post('available');
        $data = array('available'=>$available);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('menuitem', $data);
    }
    public function get_leastOrderItem(){

        $query=$this->db->query(
                            "SELECT
                    menuitem.*,
                    COUNT(*) AS sells
                FROM
                    menuitem,
                    orderitem
                WHERE
                    menuitem.featured_item = 1
                GROUP BY
                    menuitem.id
                ORDER BY
                    sells
                LIMIT 0,
                 5");

        return $query->result();
       
       
        
    }

}
?>
