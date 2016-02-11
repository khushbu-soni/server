<!-- <meta http-equiv="refresh" content="2";> -->
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){
					 //console.clear();
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
				

				orderid = order.attr('menuid');
				
				//alert(orderid);
				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/orders/cancelOrder'); ?>",
					data: "orderid=" + orderid ,
					success: function(data, textStatus){

							 
						
						
						
						//console.clear();
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

							// console.clear();
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
				
				//alert(ogorderid);
				tablenumber= order.attr('tablenumber');
				tabletnumber= order.attr('tabletnumber');

				$('#btnDelivery').attr('orderid', orderid); //set the orderid attribute of the set to delivery button
				$('#btnDelivery').attr('ogorderid', ogorderid);
			
				
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
					data: "orderid=" + ogorderid + "id=" + orderid + "&status=1" + "&tablenumber=" + tablenumber + "&tabletnumber=" + tabletnumber,
					success: function(data, textStatus){
							 //console.clear();
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
			 //console.clear();
		$.post("<?php echo site_url('kitchen/orders/completeorder_item'); ?>", "id="+ order_id + "&status=2" + "&ogorderid=" + ogorder_id + "&numrow=" + numrow);
	
	}
	function setForDeliveryorder(event)
	{
		//alert("hjfksjdhf");

		order = $(event.target);
		order_id = order.attr('orderid');
		ogorder_id = order.attr('ogorderid');
		numrow = order.attr('numrow');
		//alert(order_id);
		//alert(ogorder_id);
		
			 //console.clear();
		$.post("<?php echo site_url('kitchen/orders/completeorder'); ?>", "id="+ order_id + "&status=2");
	
	}
	function setForDelivery(event)
	{
		//alert("hjfksjdhf");

		order = $(event.target);
		order_id = order.attr('orderid');
		ogorder_id = order.attr('ogorderid');
		numrow = order.attr('numrow');
		//alert(order_id);
		//alert(ogorder_id);
		
			 //console.clear();
		$.post("<?php echo site_url('kitchen/orders/completeorder'); ?>", "id="+ order_id + "&status=2");
	
	}

	function takeAway(event)
	{
		order = $(event.target);
		order_id = order.attr('orderid');
		ogorder_id = order.attr('ogorderid');
		//numrow = order.attr('numrow');
		//alert(order_id);
		//alert(ogorder_id);
		//return;
			 //console.clear();
		$.post("<?php echo site_url('kitchen/orders/takeAway'); ?>", "id="+ order_id + "&status=3");
	
	}
		</script>

	<script type="text/javascript">
   setInterval("my_function();",1200);
    
    		function my_function(){
 			//console.clear();
    	//alert(x);
    	
       	
       	 $('#refresh2').load(location.href + ' #refresh2');
       	  $('#backup').load(location.href + ' #backup');
       	 $('#num').load(location.href + ' #num');
       	  $('u').toggleClass('blink');
       	 //console.clear();
       
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
				

		
				<div class="outer-frame-nopadding rounded-6px">
					
					<div class="whitebg" id="tableHolder">
						<div class="boxheading toprounded-4px">
							Outbound Orders
							
 						<?php  //print_r($this->session->all_userdata()); ?>
 						<?php //print_r($orders_item_process);?>
 						
						</div>
						
						<div style="overflow: auto; max-height:600px;  height:auto; word-wrap:normal;">
						<div id="refresh2" >

							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>
								<?php foreach ($orders as $order): 
								$items = $order->getOrderedItems_kitchen_dlvr();

								
								?>



												
									
										<div  class="kitchenorder <?php if ($order->status == 0) echo 'pending'; ?>">
											<div class="col-lg-3">
										<div class="tablenumber rounded-4px " style="width:100px; ">
												 
                								
                			
											<?php if ($order->tablenumber == 0) {
													echo "<img height=80px width=80px src='".base_url()."assets/img/takeaway_bag.png' >";
												}else{ 
													echo $order->tablenumber;
													} ?>
											

										</div>
									</div>
									<div class="col-lg-7 ">
									<?php if($order->customername != '') { ?>
										<span class="icon-box bg-color-green set-icon" style="padding:0px 10px 0px 10px; font-size:18px;">
										<?php echo $order->customername; ?>

										</span>
									<?php } ?>
										<br><b>Ordered Items:</b>
										<p style="padding-top:5px !important;">
											<br>
											<?php 
												$ordereditems = $order->getOrderedItems_kitchen_dlvr();

												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo '<br/> ';

													echo "<input type=text value='$ordereditem->itemname' readonly>";
													echo "Quantity :".$ordereditem->quantity;
													if($ordereditem->status==1)
													{
														echo "<img style=height:20px; src=".base_url()."assets/img/loadin6g.gif>";
													}
													$count = $count + 1;

												}
											?>
											<?php //echo $order->tablenumber; ?>
										<hr>
										</div>
										<div class="orderaction pull-right">
							
														<a class="btn btn-success" orderid="<?php echo $order->orderid; ?>" 
											 ogorderid="<?php echo $order->orderid; ?>" id="btnDelivery" onclick="setForDeliveryorder(event)"  href="#" data-dismiss="modal" class="btn btn-large">
											<i class="icon-ok"></i> Ready for Delivery</a>
											</a>
											
										
										
										
										
										</div>
										
									</div>

								<?php   endforeach; ?>
							<?php endif; ?>
							</div>
				</div>
					</div>
				</div>
		</div>
	


				</div>
		</div>
<!-- MOdel -->


<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
      </div>
      <div class="modal-body">
     <p>Are you sure you want to delete this Order?</p>
      </div>
     <div class="modal-footer">
			<a class="btn btn-success" numrow="" orderid="" menuid="" id="btnCancel" onclick="cancelOrder(event)"  href="javascript:;" data-dismiss="modal" class="btn btn-large"><i class="icon-ok"></i> Yes</a>
				&nbsp;&nbsp;&nbsp;							
		<a class="btn btn-info" href="javascript:;" data-dismiss="modal" class="btn btn-large">No</a>
	</div>
    </div>
  </div>
</div>
		
	


		<?php echo $orderdetails; ?>

		<?php //echo $orderprocessitem; ?>
	</body>
</html>