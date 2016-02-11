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
            $.post('<?php echo site_url() ?>manager/dashboard/assign_table',postdata , function(edit_res){
                // $('#purpose').val(edit_res['purpose']);
            },'json');
	}

</script>
<?php
$background_url=base_url() . 'assets/img/table1.png';
// print_r($total_bill_amount);
echo "<span style='color:pink'>Today Total Bill Amount Due :: <b>".round($total_bill_amount['bill_amount'],2)."</b></span><br/>";
echo "<span style='color:skyblue;'>Today Total Bill Clear :: <b>".round($total_bill_pay['bill_amount'],2)."</b></span>";
// echo "Today Total Bill Clear:: ".$total_bill_pay['bill_amount'];
?>


<?php 
$background_url=base_url() . 'assets/img/table1.png';
$used_table_array=array();
$free_table_array=array();
foreach ($used_tables as $table) {
$used_table_array[]=$table['tablenumber'];
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
float: left;margin:0px 20px 16px 0px;padding:45px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>') ;
background-size:90% 67%; background-repeat:no-repeat;background-position: center; pointer-events:<?php if(in_array($i,$used_table_array)) echo "auto;"?><?php if(!in_array($i,$used_table_array)) echo "none;"?>background-color:<?php if(in_array($i,$used_table_array)) echo "#".$configruation->occupied_table_notify_color;?>" >

  <b><?php echo $i;?></b>
  
  <?php if(in_array($i,$used_table_array)) echo "<p style='position: relative;
top: 16px;
right: 20px;'>".round($table_bill_amount[$i]['bill_amount'],2)."</p>"?>;
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
                 $('#myModalLabel1').html("Assign Table No <b style='font-size:1.5em;'>"+tablenumber+"</b>");
                var url = "<?php echo site_url('manager/dashboard/show_free_waiters'); ?>/"+tablenumber 
                $.post(url,'', function(data){

                            $('#khushi1').html(data);
                    });
                // setInterval(function() {
                // // console.clear();
                // }, <?php echo $free_table_auto_refresh_time?>);
            
            
           
            
        });
</script>
         