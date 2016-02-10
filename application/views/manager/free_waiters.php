<?php
 $free_waiter_notify_color=$configruation->free_waiter_notify_color;
 $busy_waiter_notify_color=$configruation->busy_waiter_notify_color;
 $upper_block_refresh_time=$configruation->upper_block_refresh_time;
      $free_waiter_auto_refresh_time=$configruation->free_waiter_auto_refresh_time;
      $free_table_auto_refresh_time=$configruation->free_table_auto_refresh_time;
      $customer_notification_auto_refresh_time=$configruation->customer_notification_auto_refresh_time;
?>

<div class="row">
                                    <div>   
                                      
                                        <?php
                                        if(!empty($free_waiters)){
                                        foreach ($free_waiters as $waiter) {
                                            $img=$waiter['pic'];
                                            if($img)
                                                $url=base_url() . "assets/dishes/$img";
                                            $url=base_url() . "assets/img/default.png";
                                          
                                        ?>

                                        <div class="pull-left " style="margin-left:10px;">
                                            <!-- <button class="btn" style="background-color:#<?php echo $free_waiter_notify_color;?>; padding:15px;" id="waiter" onclick="freeTables('<?php echo $waiter['id'];?>')"  data-container="body" data-toggle="popover" data-placement="top" 
                                              data-content="I am There"> -->

                                      <button type="button" attr="<?php echo $waiter['id'];?>" data="<?php echo $waiter['fname'];?>"  class="btn btn-primary btn-lg" style="background-color:#<?php echo $free_waiter_notify_color;?>; padding:15px;" id="waiter" data-toggle="modal" data-target="#myModal">

                                            <img  class="img-thumbnail" src="<?php echo $url; ?>" style="float:right;height:40px;width:40px" />
                                            </button>
                                            <div class="text-center" style="font-weight:bold;"><?php echo $waiter['fname'];?></div>
                                        </div>
                                       
                                     <?php }
                                        }
                                     ?>
                                       <?php
                                       
                                        if(!empty($busy_waiters)){
                                        foreach ($busy_waiters as $waiter) {
                                             $img=$waiter['pic'];
                                            if($img)
                                                $url=base_url() . "assets/dishes/$img";
                                            $url=base_url() . "assets/img/default.png";
                                          
                                        ?>
                                        <div class="pull-left " style="margin-left:10px;">
                                           <!--  <button class="btn" style="background-color:#<?php echo $busy_waiter_notify_color;?>; padding:15px;" id="waiter" onclick="freeTables('<?php echo $waiter['waiter_id'];?>')"  data-container="body" data-toggle="popover" data-placement="top" 
                                          data-content="I am there"> -->

                                        <button type="button" attr="<?php echo $waiter['waiter_id'];?>" data="<?php echo $waiter['fname'];?>" style="background-color:#<?php echo $busy_waiter_notify_color;?>; padding:15px;" id="waiter" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                            <img  class="img-thumbnail" src="<?php echo $url ?>" style="float:right;height:40px;width:40px" />
                                            </button>
                                            <div class="text-center" style="font-weight:bold;"><?php echo $waiter['fname'];?></div>
                                        </div>
                                       
                                     <?php }
                                        }
                                     ?>
                                     </div>
                                 </div>

<script type="text/javascript">
    
    $(document).on('click', "#waiter", function() {
         
               var waiter_id = $(this).attr('attr');
               var waiter_name = $(this).attr('data');
               // $('#myModalLabel').html("Assign Table To <b>"+waiter_name+"</b>");
                var url = "<?php echo site_url('manager/dashboard/show_free_tables'); ?>/"+waiter_id 
                $.post(url,'', function(data){

                            $('#khushi').html(data);
                            
                    });
                //                setInterval(function() {
                // console.clear();
                // }, <?php echo $free_table_auto_refresh_time;?>);
            
            
           
            
        });
</script>
<!-- Modal -->

                                 
                      