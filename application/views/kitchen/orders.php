<!-- <meta http-equiv="refresh" content="2";> -->
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){

			});

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
						$('#loading').hide();
						$('#orderdetails').html(data);
						$('#orderdetails').show();
					}
				});
			}
		</script>

	<script type="text/javascript">
   setInterval("my_function();",500);
    
    		function my_function(){

    	//alert(x);
    	
       	 $('#refresh').load(location.href + ' #refresh');
       
}
       

   
</script>

	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg" id="tableHolder">
						<div class="boxheading toprounded-4px">
							Pending Orders
							
 						<?php //print_r($this->session->all_userdata()); ?>
						</div>
						
						<div id="refresh" >

							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>
								<?php foreach ($orders as $order): ?>
									<div class="kitchenorder <?php if ($order->status == 0) echo 'pending'; ?>">
										<div class="orderitems pull-left" style="">
											<p><b>Order from <?php echo $order->tablenumber; ?>, Device <?php echo $order->tabletnumber; ?> (<?php echo $order->customername; ?>)</b></p>
											
											<b>Ordered Items:</b> 
											<br/>
											<?php 
												$ordereditems = $order->getOrderedItems();
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo '<br/> ';
													echo $ordereditem->itemname;
													echo " Quantity: ".$ordereditem->quantity;
													$count = $count + 1;
												}
											?>
											<?php //echo $order->tablenumber; ?>
										</div>

										<div class="orderaction pull-right">
										<?php if ($order->status == 1) {?>
										<b style="color:green; font-size:35px">Processing...</b>
										<a orderid="<?php echo $order->id; ?>" tablenumber="<?php echo $order->tablenumber; ?>" customername="<?php echo $order->customername; ?>" tabletnumber="<?php echo $order->tabletnumber; ?>" href="#vieworder-modal" onclick="viewOrder(event)" data-toggle="modal" class="btn btn-large">
											View Order
											</a>
										<!-- <img style="height:5%" src="<?php echo base_url() ?>assets/img/tumblr_mftv4raqEG1r8ysxso1_250.gif"/> -->
										
										<?php }else{?>
											<a orderid="<?php echo $order->id; ?>" tablenumber="<?php echo $order->tablenumber; ?>" customername="<?php echo $order->customername; ?>" tabletnumber="<?php echo $order->tabletnumber; ?>" href="#vieworder-modal" onclick="viewOrder(event)" data-toggle="modal" class="btn btn-large">
											Process
											</a>
											<?php }?>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $orderdetails; ?>
	</body>
</html>