<?php


 $free_waiter_notify_color=$configruation->free_waiter_notify_color;
 $busy_waiter_notify_color=$configruation->busy_waiter_notify_color;
 $upper_block_refresh_time=$configruation->upper_block_refresh_time;
      $free_waiter_auto_refresh_time=$configruation->free_waiter_auto_refresh_time;
      $free_table_auto_refresh_time=$configruation->free_table_auto_refresh_time;
      $customer_notification_auto_refresh_time=$configruation->customer_notification_auto_refresh_time;
?>

<script type="text/javascript">

		$('#free_waiters').click(function(){
			// alert("jhkj");
			$('.ui-dialog').show();
		});

	function closeBtn(tablenumber,waiter_id){
		
      $( ".ui-dialog" ).hide('fast');
		var postdata = {'tablenumber' :tablenumber,'waiter_id':waiter_id};
            $.post('<?php echo site_url() ?>waiter/dashboard/assign_table',postdata , function(edit_res){
                // $('#purpose').val(edit_res['purpose']);
            },'json');
	}

</script>
<?php
$background_url=base_url() . 'assets/img/table1.png';
$assign_tables=$this->data['free_waiters'];

?>


<?php 
$background_url=base_url() . 'assets/img/table1.png';
$used_table_array=array();
$free_table_array=array();
foreach ($assign_tables as $table) {
$used_table_array[]=$table->tablenumber;
}

?>
<div class="panel1 panel-back1 noti-box1 pull-left">
<?php 
$no=$total_tables->no_of_table;
if(!empty($no)){
$background_color="";
for($i=1;$i<=$no;$i++){

		$free_table_array[]=$i;
	{
		$background_color="red";
	}

?>

<button class="icon-box1  set-icon" attr="<?php echo $i;?>" data-toggle="modal" data-target="#myModal1" id="table"  style="display: block;
float: left;margin: 0px 10px 10px 0;padding:40px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>') ;
background-size:90% 67%;background-color:<?php if(in_array($i,$used_table_array)) echo "#ebccd1"; ?>; background-repeat:no-repeat;background-position: center;" >

  <b><?php echo $i;?></b>  
</button>
<?php
	// }
}
 }

 if(empty($free_table_array))
 	echo "<h2 class='alert alert-danger'>No Free Tables Available</h2>";
 ?>
</div>

<script type="text/javascript">
    
    $(document).on('click', "#table", function() {
         
               var tablenumber = $(this).attr('attr');
                 $('#myModalLabel1').html("Available Customer in Table <b style='font-size:1.5em;'>"+tablenumber+"</b>");
                
                $.ajax({
            type: "POST",
            url: "<?php echo site_url('waiter/dashboard/show_table_customer'); ?>",
            data: "tablenumber=" + tablenumber,
            success: function(data, textStatus){
               //alert(data);
               $('#customer').html(data);
            }
          });
              
                          
                  
                // setInterval(function() {
                // // console.clear();
                // }, <?php echo $free_table_auto_refresh_time?>);
            
            
           
            
        });
</script>
         