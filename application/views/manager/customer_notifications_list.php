<?php 
            // print_r($notifications_info);
            // exit(); 

                       foreach ($notifications_info as $notify) {
                        
                       

                        $time=(strtotime(date('Y-m-d H:i:s'))-strtotime($notify->created_at));
                        // $c_h=date('H');
                        // $c_i=date('i');
                        // $c_s=date('s');
                        // $c_d=date('d');
                        $h=date('H',strtotime($notify->created_at));
                        $i=date('i',strtotime($notify->created_at));
                        $s=date('s',strtotime($notify->created_at));
                        // $p_d=date('d',strtotime($notify->created_at));
                         // $d=$c_d-$p_d;
                         //echo $d;  
                        // echo $t=date('Y-m-d H:i:s',$time);
                         
                        ?>
                            <li class="left clearfix">
                                  <i class="fa fa-clock-o fa-fw"></i><?php  if($h!=00){echo "At $h : ";} if($i!=00) echo "$i :  "; if($s!=00) echo "$s  "; ?> <div style="font-size:1.3em; padding:5%;"><?php echo $notify->text;?></div>
                                </li>
                        <?php }
                       
                        ?>