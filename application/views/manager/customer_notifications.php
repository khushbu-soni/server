                   <?php 
                    foreach ($notifications as $notify) {
                      
                                        }
                   ?>
                    
                        <?php 
                          if(!empty($notifications)){
                        ?>
                       
                        <ul class="chat-box">



                         <?php 
                     
                       foreach ($notifications as $notify) {
                        
                       

                        $time=(strtotime(date('Y-m-d H:i:s'))-strtotime($notify->created_at));
                       
                        $h=date('H',strtotime($notify->created_at));
                        $i=date('i',strtotime($notify->created_at));
                        $s=date('s',strtotime($notify->created_at));
                        $d=date('d',strtotime($notify->created_at));
                     
                         //echo $d;  
                        
                        ?>
                                <li class="left clearfix">
                                  <i class="fa fa-clock-o fa-fw"></i><?php  if($h!=00){echo " At $h:";} if($i!=00) echo "$i: "; if($s!=00) echo "$s"; ?>  <div style="font-size:1.3em; padding:5%;"><?php echo $notify->text;?></div>
                                </li>
                        <?php }?>
                  
                    <?php
                    } else{

                        ?>
                          <div class="alert alert-danger">No Customers Yet</div>
                           
                        <?php }?>


                        <div class="panel-footer"></div>

                    </div>
                    
                