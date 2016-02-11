                   <?php 
                    foreach ($notifications as $notify) {
                      
                                        }
                   ?>
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Notifications
                        </div>
                        <?php 
                          if(!empty($notifications)){
                        ?>
                        <div class="panel-body">
                        <ul class="chat-box">



                         <?php 
                     
                       foreach ($notifications as $notify) {
                        
                       

                        $time=(strtotime(date('Y-m-d H:i:s'))-strtotime($notify['created_at']));
                        $c_h=date('H');
                        $c_i=date('i');
                        $c_s=date('s');
                        $c_d=date('d');
                        $p_h=date('H',strtotime($notify['created_at']));
                        $p_i=date('i',strtotime($notify['created_at']));
                        $p_s=date('s',strtotime($notify['created_at']));
                        $p_d=date('d',strtotime($notify['created_at']));
                         $d=$c_d-$p_d;
                         //echo $d;  
                        // echo $t=date('Y-m-d H:i:s',$time);
                         if($d==1)
                        {
                           $h =  abs(($c_h + 24) - $p_h) ;
                        }else
                        {

                        $h=abs(abs($c_h)-abs($p_h));
                        }
                        $i=abs($c_i-$p_i);
                        $s=$c_s;
                        
                        ?>
                                <li class="left clearfix">
                                  <i class="fa fa-clock-o fa-fw"></i><?php  if($h!=00){echo "$h Hours ";} if($i!=00) echo "$i Minutes and "; if($s!=00) echo "$s Seconds "; ?> ago  <div style="font-size:1.3em; padding:5%;"><?php echo $notify['text'];?></div>
                                </li>
                        <?php }?>
                        </ul>
                        </div>
                    <?php
                    } else{

                        ?>
                          <div class="alert alert-danger">No Customers Yet</div>
                           
                        <?php }?>


                        <div class="panel-footer"></div>

                    </div>
                    
                