<!-- <meta http-equiv="refresh" content="2";> -->
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){
					 console.clear();
			});

			function confirm(event)
			{

				order = $(event.target);
				$(order.parent().parent()).removeClass('pending');
				orderid = order.attr('orderid');
				$('#btnCancel').attr('menuid', orderid);

				}

			function cancelOrder(event)
			{
				order = $(event.target);
				

				menuid = order.attr('menuid');
				
				//alert(menuid);
				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/orders/cancelOrder'); ?>",
					data: "menuid=" + menuid ,
					success: function(data, textStatus){

							 
						
						
						
						console.clear();
					}
				});
				//alert(ogorderid);


			}
			function viewOrder(event){
				order = $(event.target);
				$(order.parent().parent()).removeClass('pending');
				orderid = order.attr('orderid');
				tablenumber= order.attr('tablenumber');
				tabletnumber= order.attr('tabletnumber');

				$('#btnDelivery').attr('orderid', orderid); //set the orderid attribute of the set to delivery button

				//set the title of the popup (orderdetails)
				$('#tablenumber').html(order.attr('tablenumber'));
				$('#tabletnumber').html(order.attr('tabletnumber'));
				$('#customername').html(order.attr('customername'));
				//alert($('#tablenumber').html(order.attr('tablenumber')));
				//get the details of the order
				$('#loading').show();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/orders/getorderdetails'); ?>",
					data: "id=" + orderid + "&status=1" + "&tablenumber=" + tablenumber + "&tabletnumber=" + tabletnumber,
					success: function(data, textStatus){

							 console.clear();
						$('#loading').hide();
						$('#orderdetails').html(data);
						$('#orderdetails').show();
					}
				});
			}





				function viewOrderItem(event){
				order = $(event.target);
				$(order.parent().parent()).removeClass('pending');
				orderid = order.attr('orderid');
				ogorderid = order.attr('ogorderid');
				numrow = order.attr('numrow');
				//alert(ogorderid);
				tablenumber= order.attr('tablenumber');
				tabletnumber= order.attr('tabletnumber');

				$('#btnDelivery').attr('orderid', orderid); //set the orderid attribute of the set to delivery button
				$('#btnDelivery').attr('ogorderid', ogorderid);
				$('#btnDelivery').attr('numrow', numrow);
				
				//set the title of the popup (orderdetails)
				$('#tablenumber').html(order.attr('tablenumber'));
				$('#tabletnumber').html(order.attr('tabletnumber'));
				$('#customername').html(order.attr('customername'));
				//alert($('#tablenumber').html(order.attr('tablenumber')));
				//get the details of the order
				//$('#loading').show();
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/orders/getorderdetails_item'); ?>",
					data: "id=" + orderid + "&status=1" + "&tablenumber=" + tablenumber + "&tabletnumber=" + tabletnumber,
					success: function(data, textStatus){
							 console.clear();
						//$('#loading').hide();
						//$('#orderprocessitem').html(data);
						//$('#orderprocessitem').show();
					}
				});
			}

			function setForDelivery_item(event)
	{
		order = $(event.target);
		order_id = order.attr('orderid');
		ogorder_id = order.attr('ogorderid');
		numrow = order.attr('numrow');
		//alert(order_id);
		//alert(ogorder_id);
		//return;
			 console.clear();
		$.post("<?php echo site_url('kitchen/orders/completeorder_item'); ?>", "id="+ order_id + "&status=2" + "&ogorderid=" + ogorder_id + "&numrow=" + numrow);
	
	}
		</script>

	<script type="text/javascript">
   setInterval("my_function();",1200);
    
    		function my_function(){
 			//console.clear();
    	//alert(x);
    	
       	 $('#refresh').load(location.href + ' #refresh');
       	 $('#refresh2').load(location.href + ' #refresh2');
       	 $('#num').load(location.href + ' #num');
       	  $('u').toggleClass('blink');
       	 console.clear();
       
}
       

   
</script>
<style type="text/css">
	u {color:mediumblue; text-decoration: none; font-size: 20px;}
 
/* The class "Blink" is set to be transparent*/
	u.blink {color:transparent;}

	.left{
		width: 48%;
		float: left;
	}
	.right{
		width: 48%;
		float: right;
	}
	.outer-frame-nopadding {
    background-color: #d0d8ea;
    border: 1px solid #9cacd3;
    padding: 2px;
}
</style>
	</head>

	<body>
<div id="wrapper">
		<?php echo $header; ?>
			<?php echo $sidebar; ?>
				  <div id="page-wrapper" >
            <div id="page-inner">
            <div id="info">
        <div class="row">
                    <div class="col-md-12">
                 
                      </div>
        </div> 
       
               
               
      
      </div>
	
			<div class="">
				<div class="left outer-frame-nopadding rounded-6px" >
					<div class="whitebg" id="tableHolder">
						<div class="boxheading toprounded-4px">
							Inbound Orders
							<?php /*if (!empty($orders_item_process)){?>
							
			<span id="num" class="icon-box bg-color-red set-icon" style="width:20px; padding-left:10px;">
                	

                	<i class="icon-user "  style="width:auto;">
                	<?php $numrow = sizeof($orders_item_process);

                	echo $numrow; ?>

              	</i>
                </span>
						
							<?php } */?>
								

							
 						<?php  //print_r($this->session->all_userdata()); ?>
 						<?php //print_r($manager_id);?>
 						
						</div>
						
						<div style="overflow: auto; max-height:600px;  height:auto; word-wrap:normal;">
						<div id="refresh" >

							<?php if (empty($orders_item_process)): ?>
								<div class="alert alert-danger">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>
								<?php $numrow = sizeof($orders_item_process);


								foreach ($orders_item_process as $order): ?>
								<?php if ($order->STATUS == 0) {
										
											?>
									<div class="kitchenorder <?php if ($order->STATUS == 0) echo 'pending'; ?>">
										<div>
										<img src="<?php echo $img_path.$order->image; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="">
										
										</div>
										<div>
										 <span class="icon-box bg-color-blue set-icon" style="padding:10px 10px 10px 10px;width:auto;font-size:20px;" >
                		<sapn>Table</sapn>	
                	 <?php echo $order->tablenumber; ?>
              
                </span>

               
                	
										</div>
										<span style="">
										<p><b><?php echo $order->name; ?></b></p>
											
											<b>Ordered  Qty :</b> 
										<u  class="">	
											<?php echo $order->qty; ?>
											</u>
										</span>
										                <span><?php if(!empty($manager_id))
                			{ 
                			if($manager_id['id'] == $order->tablenumber)
                			 echo "Take Away"; 
                			}?></span>
										<br>	<br>
										<hr>

										<div class="orderaction pull-right">
										
										


										<a class="btn btn-success" numrow="<?php echo $numrow; ?>" ogorderid="<?php echo $order->orderid; ?>" orderid="<?php echo $order->menuid; ?>"  href="#" onclick="viewOrderItem(event)" data-toggle="modal" class="btn btn-large">Process...</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										



										<a class="btn btn-danger"  numrow="<?php echo $numrow; ?>" ogorderid="<?php echo $order->orderid; ?>" orderid="<?php echo $order->menuid; ?>"  href="#cancel-modal" onclick="confirm(event)" data-toggle="modal" class="btn btn-large">Cancelled Order</a>
										
										




										</div>
									</div>
									<?php } ?>
								<?php endforeach; ?>
							<?php endif; ?>
							</div>
						</div>
						</div>
					</div>

		
				<div class="right outer-frame-nopadding rounded-6px">
					
					<div class="whitebg" id="tableHolder">
						<div class="boxheading toprounded-4px">
							Outbound Orders
							
 						<?php  //print_r($this->session->all_userdata()); ?>
 						<?php //print_r($orders_item_process);?>
 						
						</div>
						
						<div style="overflow: auto; max-height:600px;  height:auto; word-wrap:normal;">
						<div id="refresh2" >

							<?php if (empty($orders_item_process)): ?>
								<div class="alert alert-danger">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>
								<?php $numrow = sizeof($orders_item_process);

								foreach ($orders_item_process as $order): ?>
								<?php if ($order->STATUS == 1) {?>
									<div class="kitchenorder <?php if ($order->STATUS == 0) echo 'pending'; ?>">
										<div>
										<img src="<?php echo $img_path.$order->image; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="">
										
										</div>
										<div>
										 <span class="icon-box bg-color-blue set-icon" style="padding:10px 10px 10px 10px;width:auto;font-size:20px;" >
                		<sapn>Table</sapn>	
                	 <?php echo $order->tablenumber; ?>
              
                </span>

                 
                	
										</div>
										<span style="">
										<p><b><?php echo $order->name; ?></b></p>
											
											<b>Ordered  Qty :</b> 
										<u id="qt" class="">	
											<?php echo $order->qty; ?>
											</u>
										</span>
										<br>	<br>
										<hr>

										<div class="orderaction pull-right">
											<a class="btn btn-success" orderid="<?php echo $order->menuid; ?>" numrow="<?php echo $numrow; ?>" ogorderid="<?php echo $order->orderid; ?>" id="btnDelivery1" onclick="setForDelivery_item(event)"  href="#" data-dismiss="modal" class="btn btn-large">
											<i class="icon-ok"></i> Ready for Delivery</a>
											</a>
										
										
										</div>
									</div>
									<?php } ?>
								<?php endforeach; ?>
							<?php endif; ?>
							</div>
						</div>
				</div>
					</div>
				</div>
		</div>
	


				</div>
		</div>
<!-- MOdel -->


		<div class="modal hide fade" id="cancel-modal">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Are You Sure You ?</h3>
										</div>
										<div class="modal-body">
											<p>
											Cancelled Orders Order	
											</p>
											</div>
										<div class="modal-footer">
											
											<a numrow="" menuid="" id="btnCancel" onclick="cancelOrder(event)"  href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-ok"></i> Yes</a>
											
											<a href="#" data-dismiss="modal" class="btn btn-large">No</a>
										</div>
									</div>


		<?php echo $orderdetails; ?>

		<?php //echo $orderprocessitem; ?>
	</body>
</html>