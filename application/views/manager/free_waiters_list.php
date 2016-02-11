<?php
 $free_waiter_notify_color=$configruation->free_waiter_notify_color;
 $busy_waiter_notify_color=$configruation->busy_waiter_notify_color;
?>
<script type="text/javascript">

    function closeBtn(tablenumber,waiter_id){
     
        var postdata = {'tablenumber' :tablenumber,'waiter_id':waiter_id};
            $.post('<?php echo site_url() ?>manager/dashboard/assign_table',postdata , function(edit_res){
                // $('#purpose').val(edit_res['purpose']);
            },'json');
    }

if( $('#myModal1').hasClass('in') ) {
   setTimeout(function() {
    $('#myModal1 .close').trigger('click');
    }, 5000);
}

</script>
<div class="row" style="">
                                    <div>   
                                      <!-- 
                                        <?php
                                        $tablenumber=$this->data['tablenumber'];
                                        if(!empty($free_waiters)){
                                        foreach ($free_waiters as $waiter) {
                                            $img=$waiter['pic'];
                                            if($img)
                                                $url=base_url() . "assets/dishes/$img";
                                            $url=base_url() . "assets/img/default.png";
                                          
                                        ?>



                                        <div class="pull-left " style="margin-left:10px;">
                                            <button class="btn" data-dismiss="modal" style="background-color:#<?php echo $free_waiter_notify_color;?>;padding:15px;" id="waiter" onclick="closeBtn('<?php echo $tablenumber;?>','<?php echo $waiter['id'];?>')"  >
                                            <img  class="img-thumbnail" src="<?php echo $url; ?>" style="float:right" />
                                            </button>
                                            <div class="text-center"><?php echo $waiter['fname'];?></div>
                                        </div>
                                       
                                     <?php }
                                        }
                                     ?> -->
                                       <?php
                                       
                                        if(!empty($waiter_info)){
                                        foreach ($waiter_info as $waiter) {
                                            $img=$waiter['pic'];
                                            if($img)
                                                $url=base_url() . "assets/dishes/$img";
                                            $url=base_url() . "assets/img/default.png";
                                          
                                        ?>
                                        <div class="pull-left " style="margin-left:200px;">
                                            <button class="btn" data-dismiss="modal" style="background-color:#<?php echo $busy_waiter_notify_color;?>;padding:15px;" id="waiter" onclick="closeBtn('<?php echo $tablenumber;?>','<?php echo $waiter['waiter_id'];?>')"  >
                                            <img  class="img-thumbnail" src="<?php echo $url; ?>" style="float:right" />
                                            </button>
                                            <div class="text-center"><?php echo $waiter['fname'];?></div>
                                        </div>
                                       
                                     <?php }
                                        }
                                     ?>
                                     </div>
                                 </div>
                         