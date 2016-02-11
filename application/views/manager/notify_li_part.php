<script type="text/javascript">
	$(document).ready(function(){

		 $('li#hide a').hover(function(){
                        $(this).fadeOut(2000);
                        $('#dashed').fadeOut(2000);
                        var id = $(this).attr('attr');
                        
                        var url = "<?php echo site_url('manager/notificationlist/mark_watch'); ?>";
                        var data={'id':id} 
                        
                                    $.post(url,data, function(data){
                                                // $('#waiter_count').html(data);
                                        });

                      });

                $('div#dashed').hover(function(){
                  $(this).fadeOut(2000);
    
                    });



	});

</script>

<?php $last_id=$this->session->userdata['new_last_id'];?>
<?php foreach ($notifications_info as $info) {?>
                                      <li id="hide" attr="<?php echo $last_id; ?>">
                                      <a id="hide" attr="<?php echo $info->log_id;?>" href="<?php echo site_url('manager/notificationlist/'); ?>"><?php echo $info->text;?></a>
                                      </li>
                                        <div id="dashed" style="color:lightgray">-----------------------------------------------------------------------------</div>
                                      <?php }?>