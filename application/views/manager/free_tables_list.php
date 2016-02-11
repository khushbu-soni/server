<script type="text/javascript">


	function closeBtn(tablenumber,waiter_id){
		
		var postdata = {'tablenumber' :tablenumber,'waiter_id':waiter_id};
            $.post('<?php echo site_url() ?>manager/dashboard/assign_table',postdata , function(edit_res){
                // $('#purpose').val(edit_res['purpose']);
            },'json');

	}
	if( $('#myModal').hasClass('in') ) {
	setTimeout(function() {
    $('#myModal .close').trigger('click');
    }, 5000);
	}

		// $('doucument').ready(function(){
			// $(doucument).ready(function(){

			//  setTimeout('window.location.reload();', 5000);
			// });
		// });

</script>
<?php
$background_url=base_url() . 'assets/img/table1.png';
$waiter=$this->data['waiter'];
?>


<?php 
$background_url=base_url() . 'assets/img/table1.png';
$used_table_array=array();
$free_table_array=array();
foreach ($used_tables as $table) {
$used_table_array[]=$table['tablenumber'];
$used_table_waiter_array[$table['tablenumber']]=$table['waiter_name'];
}

?>
<div class="panel1 panel-back1 noti-box1 pull-left uniq">
<?php 
$no=$total_tables->no_of_table;
if(!empty($no)){
$background_color="";
for($i=1;$i<=$no;$i++){
		$free_table_array[]=$i;
	{
		$background_color="red";
	}
		$text="Free";
	if(!empty($used_table_waiter_array)){
	if(array_key_exists($i,$used_table_waiter_array))
		$text=$used_table_waiter_array[$i];
		
	}
	
?>
<div class="pull-left">

<button class="icon-box1  set-icon" data-dismiss="modal" id="table" onclick="closeBtn('<?php echo $i;?>','<?php echo $waiter;?>')" style="display: block;
float: left;margin: 0px 15px 0px 0;padding:45px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>');
background-size:90% 67%;background-position: center;background-repeat:no-repeat; pointer-events:<?php if(in_array($i,$used_table_array)) echo "none;"?><?php if(!in_array($i,$used_table_array)) echo "auto;"?>background-color:<?php if(in_array($i,$used_table_array)) echo "#".$configruation->occupied_table_notify_color;?>" >
	
  <b><?php echo $i;?></b>  
</button>
<div class="text-center" style="font-weight:bold;"><?php echo $text;?></div>
</div>
<?php
	
	// }
}
 }

 if(empty($free_table_array))
 	echo "<h2 class='alert alert-danger'>No Free Tables Available</h2>";
 ?>
</div>
         