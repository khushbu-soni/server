<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class sidebar extends CI_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('configruation_model');
	}

	
	public function sidebarMENU()
	{


		$sidebars = $this->configruation_model->sidebar_menus();



             $categories = array();
             $rootCategories = array();
             foreach ($sidebars as $row ) {

                    $row->childs = array();
                    $categories[$row->id] = $row;
                    if(empty($row->parent_id)) {
                            $rootCategories[$row->id] = $categories[$row->id];
                    } else {
                            $categories[$row->parent_id]->childs[] = $categories[$row->id];
                    }
             }

  

        $this->rederTreeById($rootCategories, 1);


	}



function rederTreeById($records, $id=false) {

	


	
        
        foreach($records as $record) {


               
             
                echo  '<li>';
                 
                        if(!empty($record->childs)) {
                               echo '<a href="#"><i class="fa '.$record->icon.' fa-3x"></i>'.$record->menu_name.'<span class="fa arrow"></span></a>';
                        	foreach($record->childs as $c) 
                        	{
                        		

                                  echo '<ul class="nav nav-second-level">
				                            <li>
				                               <a class=""  href="'.site_url().'manager/'.$c->menu_url.'"><i class="fa '.$record->icon.' fa-3x"></i>'.$c->menu_name.'</a>
				                            </li>
				                           
				                        </ul>';      


                        	}
                          
                      

                        }
                        else{


                           
                            echo  '<a class=""  href="'.base_url().'manager/'.$record->menu_url.'"><i class="fa '.$record->icon.' fa-3x"></i>'.$record->menu_name.'</a>';
                        }
                         echo '</li>';
                       
               
        }
       
 }








 public function sidebarMENURESPONS()
	{


		$sidebars = $this->configruation_model->sidebar_menus();



 $categories = array();
 $rootCategories = array();
 foreach ($sidebars as $row ) {

        $row->childs = array();
        $categories[$row->id] = $row;
        if(empty($row->parent_id)) {
                $rootCategories[$row->id] = $categories[$row->id];
        } else {
                $categories[$row->parent_id]->childs[] = $categories[$row->id];
        }
 }

  

 $this->rederTreeByIdRes($rootCategories, 1);


	}



function rederTreeByIdRes($records, $id=false) {

	


	 echo '<select onchange="location = this.options[this.selectedIndex].value;"class="form-control" width="50px;">
                <option> Select Menu</option>';
  
        
        foreach($records as $record) {
               
             
                       echo  '<option value='.site_url().'manager/'.$record->menu_url.'>'.$record->menu_name.'</option>';
                 
                        if(!empty($record->childs)) {
                        		echo '<optgroup >';
                               
                        	foreach($record->childs as $c) 
                        	{
                        		
                        		 

				                 echo ' <option value='.site_url().'manager/'    .$c->menu_url.'>'.$c->menu_name.'</option>';  
				                        


                        	}
                        	echo "</optgroup>";
                          
                      

                        }
                            
                       
               
        }
        echo '</select>';
 }








}
