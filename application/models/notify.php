<button type="button"  class="btn btn-info btn-lg dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
                 Notifications <span class="badge" id="notify" ><?php echo $notifications['notification'];?></span></a>
</button>
                <ul class="dropdown-menu pull-right" role="menu" data-spy="scroll" >
                  <?php foreach ($notifications_info as $info) {?>

                  <li id="hide">
                  <a href="<?php echo site_url('manager/notificationlist/'); ?>"><?php echo $info->text;?></a>
                  </li>
                    <div id="dashed" style="color:lightgray">-----------------------------------------------------------------------------</div>
                  <?php }?>
                </ul>
<script>
$(document).ready(function(){
	$('#hide').hover(function(){
		$(this).fadeOut(2000);
		$('#dashed').fadeOut(2000);
    var id=$('#log_id').val();

		var url = "<?php echo site_url('manager/notificationlist/mark_watch'); ?>";
    var data={'id':id} 
                $.post(url,data, function(data){
                            // $('#waiter_count').html(data);
                    });

	});
	
});
</script>