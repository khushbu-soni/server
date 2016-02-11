<script type="text/javascript">


	function closeBtn(new_tablenumber,old_tablenumber,customer_unique_id){
		if(new_tablenumber==old_tablenumber){
				$('#error_box').toggle();
					$('#activeCustomerModal').attr('backdrop','static');
					
				}

		var postdata = {'new_tablenumber' :new_tablenumber,'old_tablenumber':old_tablenumber,'customer_unique_id':customer_unique_id};
            $.post('<?php echo site_url() ?>manager/changetable/shift_table',postdata , function(edit_res){

            },'json');

	}
	if( $('#activeCustomerModal').hasClass('in') ) {
	setTimeout(function() {
    $('#activeCustomerModal .close').trigger('click');
    }, 5000);
	}

		$('doucument').ready(function(){
			$('#error_box').hide();
		});

</script>
<?php
$background_url=base_url() . 'assets/img/table1.png';
$customer_unique_id=$this->data['customer_unique_id'];
$customer_unique_id= $this->data['customer_unique_id'];
$customername= $this->data['customername'];
$old_tablenumber= $this->data['old_tablenumber'];
$background_url=base_url() . 'assets/img/table1.png';
?>
<div class="panel1 panel-back1 noti-box1 pull-left uniq">

<?php 
$all_tables=$this->data['all_tables'];	

foreach ($all_tables as $info) {

?>
<div class="pull-left">


<button class="icon-box1  set-icon" data-dismiss="modal" id="table" onclick="closeBtn('<?php echo $info['tablenumber'];?>','<?php echo $old_tablenumber;?>','<?php echo $customer_unique_id;?>')" style="display: block;
float: left;margin: 0px 15px 0px 0;padding:45px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>');
background-size:90% 67%;background-position: center;background-repeat:no-repeat;pointer-events:<?php if($info['tablenumber']==$old_tablenumber) echo "none;"?>; background-color:<?php if($info['inuse']) echo "#".$configruation->occupied_table_notify_color;?>" >
	
  <b><?php echo $info['tablenumber'];?></b>  
</button>
<div class="text-center" style="font-weight:bold;"><?php if($info['inuse']) echo "Occupied"; else echo "Free";?></div>
</div>
<?php
	
	}



 if(empty($all_tables))
 	echo "<h2 class='alert alert-danger'>No Free Tables Available</h2>";
 ?>
</div>
         