<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>

<script type="text/javascript">
$(document).ready(function(){
     $("li.active > ul").slideUp();

   
 
    $('a').click(function(){

        $("li.active > ul").toggle();
    });
   
});
</script>
<style type="text/css">
        
.navbar-side {
    padding-top: 17px !important;
    position: absolute;
    width: 260px;
    z-index: 1;
}
.menu{
color:red !important;

}
</style>
<div class="hidden-sm hidden-xs">
<nav id ="sidebar" class="navbar-default navbar-side navbar-transparent" role="navigation" style="padding-top: 24px;">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center"></li>

                <?php 
                $r=$this->data;
              
                     $categories = array();
             $rootCategories = array();
            
           

               $categories = array();
             $rootCategories = array();
              foreach ($r['sidemenu'] as $row) { 

                    $row->childs = array();
                    $categories[$row->id] = $row;
                    if(empty($row->parent_id)) {
                            $rootCategories[$row->id] = $categories[$row->id];
                    } else {
                            $categories[$row->parent_id]->childs[] = $categories[$row->id];
                    }
             }

  

        foreach($rootCategories as $record) {


               
              echo  '<li>';
             
                 
                        if(!empty($record->childs)) {
                            

                               echo '<a ';
                               if (!empty($r['active-sub'])) {
                                                if($record->id == $r['active-sub'])
                                                {
                                                   echo 'class="active-menu"';
                                                }
                                               
                                            }
                               echo ' href="#"><i class="fa '.$record->icon.' fa-3x"></i><br/>'.$record->menu_name.'<span class="fa arrow"></span></a>';
                            foreach($record->childs as $c) 
                            {
                                

                                  echo '<ul class="nav nav-second-level collapse" >
                                            <li>
                                               <a class=""  href="'.site_url().'admin/'.$c->menu_url.'"><i class="fa '.$record->icon.' fa-3x"></i><br/>'.$c->menu_name.'</a>
                                            </li>
                                           
                                        </ul>';      


                            }
                          
                      

                        }
                        else{

                              
                           
                            echo  '<a ';
                            if (!empty($r['active'])) {
                                if($record->id == $r['active'])
                                {
                                   echo 'class="active-menu"';
                                }
                               
                            }
                            
                            echo 'href="'.base_url().'admin/'.$record->menu_url.'"><i class="fa '.$record->icon.' fa-3x"></i><br/>'.$record->menu_name.'</a>';
                        }
                         echo '</li>';
                       
               
        }
        ?>

                   

          
                    
                     

                </ul>
               
            </div>
           
           
        </nav> 
        </div>

<div class="hidden-lg hidden-md">
        <br/><br/><br/><br/><br/><br/>
        <div class="list-box">
           
        </div>
        <br/>
</div>

