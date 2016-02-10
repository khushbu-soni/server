<?php
 class ingredient_model extends CI_Model{
    //__contruct 
    //ingredient constructor 
    public function __contruct(){
        //$this ->load->database();
    }    
    //get_ingredients
    //Get ingredient
    public function get_ingredients(){
        $query = $this->db->get_where('ingredients','delete = 0');
        return $query->result();
    }
     public function get_ingredients_name(){
        $query = $this->db->query("Select id,name from ingredients where  `delete` = '0' order by name asc");
        return $query->result_array();
    }

    public function get_inward_ingredients_name(){
        $query = $this->db->query("SELECT ingredients.name,ingredients.id FROM stock_transaction JOIN ingredients on stock_transaction.item_id=ingredients.id WHERE stock_transaction.type='Inward' GROUP BY stock_transaction.item_id");
        return $query->result_array();
    }

    public function notification_limit()
    {
        $query = $this->db->query("SELECT * FROM `ingredients` WHERE quantity <= min_ingr");
        return $query->result();

    }


    public function get_ingredients_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM `ingredients` WHERE id =".$id);
        return $query->result_array();

    }
    //insert_ingredient
    //add new ingredient
     public function search_by_title(){
        $this->db->select('*');
        $this->db->from('ingredients');
        //$this->db->join('ingredient', 'menuitem.id =  ingredient.menuItemid');
        $array = array('ingredients.name' => $this->input->post('search'));
          //  'ingredient.name' => $this->input->post('search') );
        $this->db->like($array); 
        return $this->db->get()->result();
    
    }

    public function insert_ingredient($category=null){
        $data = array(
            'name' => $this->input->post('name'),
            'quantity' => $this->input->post('quantity'),
             'min_ingr' => $this->input->post('countpercent1'),
            'menuitemid' => 0,
            'date' => date('Y-m-d'),
            'category'=>$category,

        );

        $this->db->insert('ingredients',$data);

         $data_stock = array(
            'ing_id' => $this->db->insert_id(),
            'add_date' => date('Y-m-d'),
             'available' => $this->input->post('quantity'),
            'type' => 0,
            'quantity' => $this->input->post('quantity'),
            'ing_name' =>  $this->input->post('name')
        );

         $this->db->insert('stock',$data_stock);


      
        $id= $this->db->insert_id();
        $query=$this->db->query("select id from ingr_available where ingr_id=$id");
        if($id==$query)
        {

            $data2 = array(
           
              'quantity' => $this->input->post('quantity')
              );

             return $this->db->update('ingr_available',$data2);
        }else
        {
             $data2 = array(
            'ingr_id' => $id,
              'quantity' => $this->input->post('quantity')
              );
       
            return $this->db->insert('ingr_available',$data2);
        }
        
        
    }



 public function update_ingredient_minus($id){
    $total_quantity1= $this->input->post('available') - $this->input->post('quantity');
         $query=$this->db->query("select * from ingredients where id=$id and min_ingr <= ".$total_quantity1)
        ->result_array();
       
      
        if(isset($query) && !empty($query))
        {
            $total_quantity= $this->input->post('available') - $this->input->post('quantity');

            $data = array(
            
            'quantity' => $total_quantity,
            
            'menuitemid' => 0,

            'date' => date('Y-m-d')
        );

              $this->db->update('ingredients',$data,"id = $id");

               $data2 = array(
            'ing_id' => $id,
              'quantity' => $total_quantity,
              'add_date' => date('Y-m-d'),
              'name' => $this->input->post('name')
              );
       
            return $this->db->insert('stock',$data2);
        }else
        {
             $this->session->set_flashdata('successmsg', "New Quantity is Less then Minimum Quantity.");
                redirect('kitchen/ingredients');
         

        }
        }
        
        
    

    public function insert_ingredient_name(){
        $data = array(
            'name' => $this->input->post('name'),
             'min_ingr' => $this->input->post('min_ingr'),
             'date' => date('Y-m-d'),
           'ing_type' => $this->input->post('ing_type')
        );

      $this->db->insert('ingredients',$data);

         $data_stock = array(
            'ing_id' => $this->db->insert_id(),
            'add_date' => date('Y-m-d'),
             'available' => $this->input->post('quantity'),
            'type' => 0,
            
            'ing_name' =>  $this->input->post('name'),
             'ing_type' => $this->input->post('ing_type')
        );

        return $this->db->insert('stock',$data_stock);
       
            
                   
       
        
    }

 public function update_ingredient_name($id){
      
        $data = array(
            'name' => $this->input->post('name'),
           'min_ingr' => $this->input->post('min_limit'),
           'date' => date('Y-m-d'),
            'ing_type' => $this->input->post('ing_type')
        );

        $this->db->update('ingredients',$data, "id = $id");

         $data2 = array(
            'ing_id' => $id,
             'add_date' => date('Y-m-d'),
             'available' => $this->input->post('min_limit'),
              'ing_type' => $this->input->post('ing_type')
              );
       
         $this->db->insert('stock',$data2);

         $data3 = array(
            'ingr_id' => $id,
             'quantity' => $this->input->post('min_limit')

              );
       
            return $this->db->insert('ingr_available',$data3);

    }

     public function update_ingredient($id){
       


       // $this->db->update('ingredients',$data, "id = $id");
                   
     

      
      
        $query=$this->db->query("select * from ingredients where id= ".$id)
        ->result_array();
       
      
        if(isset($query) && !empty($query))
        {
            //$total_quantity= $this->input->post('quantity')+$this->input->post('available');
          $new_q = $this->input->post('total_quantity');
          $min_ingr = $this->input->post('min_ingr');

         

             $data12 = array('in_limit' => 1);

               $this->db->update('ingredients',$data12,"id = $id");
             
          
            $data = array(
            
            'quantity' => $this->input->post('total_quantity'),
            
            'menuitemid' => 0,

            'date' => date('Y-m-d')
        );

              $this->db->update('ingredients',$data,"id = $id");

              //Stock Transaction Entry

              $stock_data = array(
              'item_id' => $id,
              'qty' => $this->input->post('quantity'),
              'type' => $this->input->post('type'),
              'date' => date('Y-m-d')
              );
            $this->db->insert('stock_transaction',$stock_data);
            //Stock Transaction Entry

              $this->session->set_flashdata('successmsg', "Add Quantity Sucessfully.");
              redirect('kitchen/ingredients','refresh');

      
        }else
        {
             $this->session->set_flashdata('errormsg', "Error.");
                 redirect('kitchen/ingredients','refresh');
         

        }
      
        
        
    }


    public function update_manager_ingredient($id){
   

       // $this->db->update('ingredients',$data, "id = $id");
                   
     

      
      
        $query=$this->db->query("select * from ingredients where id= ".$id)
        ->result_array();
       
      
        if(isset($query) && !empty($query))
        {
            //$total_quantity= $this->input->post('quantity')+$this->input->post('available');
          $new_q = $this->input->post('total_quantity');
          $min_ingr = $this->input->post('min_ingr');

         

             $data12 = array('in_limit' => 1);

               $this->db->update('ingredients',$data12,"id = $id");
             
          
            $data = array(
            
            'quantity' => $this->input->post('total_quantity'),
            
            'menuitemid' => 0,

            'date' => date('Y-m-d')
        );

              $this->db->update('ingredients',$data,"id = $id");

               $data2 = array(
            'ing_id' => $id,
              'quantity' => $this->input->post('total_quantity'),
              'add_date' => date('Y-m-d')
              );
       
            //Stock Transaction Entry
            $this->db->insert('stock',$data2);

              $stock_data = array(
              'item_id' => $id,
              'qty' => $this->input->post('quantity'),
              'type' => $this->input->post('type'),
              'date' => date('Y-m-d')
              );
            $this->db->insert('stock_transaction',$stock_data);
            //Stock Transaction Entry


              $this->session->set_flashdata('successmsg', "Add Quantity Sucessfully.");
              redirect('manager/inventory','refresh');

      
        }else
        {
             $this->session->set_flashdata('errormsg', "Error.");
                 redirect('manager/inventory','refresh');
         

        }
      
        
        
    }


   

    

    public function get_ingr(){
   
           $query= $this->db->get_where('ingredients','delete = 0');
           return $query->result();
    }

    public function delete_ingredient($userid){

       $condition = array(
        'delete' => 1

        );

         $query = $this->db->update('ingredients',$condition,array('id' => $userid));
      return TRUE;
    }

     public function active_ingredient($userid){

  
       $condition = array(
        'delete' => 0

        );

         $query = $this->db->update('ingredients',$condition,array('id' => $userid));
      return TRUE;
    }


    public function get_ingr_by_id($userid){
       $query = $this->db->get_where('ingredients', array('id' => $userid));
        return $query->result();
    }
    
    public function remove_ingredient_by_id($id){
	    $this->db->delete('ingredient', array('menuItemid' => $id));
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;   
    }
    //update_menuitem_by_id 
    public function update_menuitem_by_id(){
        $data = array(
            'menuitemid' => $this->input->post('menuitemid'),
            'name' =>$this->input->post('name'),
             'min_ingr' =>$this->input->post('min_ingr')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ingredient', $data); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;     
    }
    //get_ingredients_by_menuitem
    //get all ingredients by menu item
    public function get_ingredients_by_menuitem(){
      $id = $this->input->post('menuitemid');
      
	$query = $this->db->get_where('menuitem', array('id' => $id));
    //print_r($this->db->last_query());
  // exit();
        return $query->result();
    }

    public function get_ingredient($ingredient){
        $query = $this->db->get_where('ingredients', array('id' => $ingredient));
 
        return $query->result();
    }

    public function alreadyExit($name){
        
            $data = array(
                'name'=>   $name,
            );


       $query= $this->db->get_where('ingredients', $data);
        
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    } 
}

?>