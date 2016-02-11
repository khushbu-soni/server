<!DOCTYPE html>
<html>
	<head>

<?php
$background_url=base_url() . 'assets/img/table1.png';

$background_url=base_url() . 'assets/img/table1.png';

?>
		<title>Welcome to Restaurant</title>
		 <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <?php echo $dependencies; ?>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
          
        <style type="text/css">
      .pagination > li {
        display: inline;
        float: right !important;
      }
         

               
    </style>
<script type="text/javascript">
			$(document).ready(function(){
				$('#paymentform').validationEngine();	
			});

			function setAsDelivered(event){
				order = $(event.target);
				orderid = order.attr('orderid');
				if (!order.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/orders/setasdelivered'); ?>",
						data: "id=" + orderid + "&status=" + 3,
						success: function(data, textStatus){
							order.parent().parent().fadeOut();
						}
					});
				}
			}

			function setAsDelivereditem(event){
				order = $(event.target);
				orderid = order.attr('orderid');
				ogorderid = order.attr('ogorderid');
				numrow = order.attr('numrow');
				if (!order.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/orders/setasdelivered_item'); ?>",
						data: "numrow=" + numrow + "&orderid=" + ogorderid + "&id=" + orderid + "&status=" + 3,
						success: function(data, textStatus){
							order.parent().parent().fadeOut();
						}
					});
				}
			}

			function compItem(event)
			{
				item = $(event.target);
				itemid = item.attr('itemid');
				price = $('#price_' + itemid).val();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/orders/compitem'); ?>",
					data: "id=" + itemid + "&price=" + price,
					success: function(data, textStatus){
						$('#compsuccess').slideDown();
						setTimeout("$('#compsuccess').slideUp()", 4000);
					}
				});
			}

			function makeCashPayment(event)
			{
				order = $(event.target);
				orderid = order.attr('orderid');
				$('input[name=order]').val(orderid);
			}

			function getOrderDetails(event)
			{
				$('#loading').show();
				$('#itemstocomp').hide();
				orderid = $(event.target).attr('orderid');

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/orders/getorderitems'); ?>",
					data: "orderid=" + orderid,
					success: function(data, textstatus){
						$('#loading').hide();
						$('#itemstocomp').html(data);
						$('#itemstocomp').show();
					}
				});
			}

			function setOrderId(event)
			{
				$('#orderid').html($(event.target).attr('orderid'));
				$('input[name=orderid]').val($(event.target).attr('orderid'));
			}




		</script>


		<script type="text/javascript">
  
  		setInterval("my_function();",500);
  
    
    		function my_function(){

    	//alert(x);
    	
       	 $('#refresh').load(location.href + ' #refresh');
       

      
         
      /*  $("window").load(scrollDown);
 */

    }
</script>

 <style type="text/css">
            .pagination > li {
              display: inline;
              float: right !important;
            }
            .img-thumbnail{
                width: 75px;
                height: 75px;

               }
               #dialog{
                display: none;
               }
               .ui-dialog{
                  
                  width: 50% !important;
                  height: 315px !important;
                  /*left: 309px !important;*/
               }
               nav{
                margin-top: 25px !important;
                /*margin-bottom: -43px !important;*/
                
               }
               hr {
                  -moz-border-bottom-colors: none;
                  -moz-border-left-colors: none;
                  -moz-border-right-colors: none;
                  -moz-border-top-colors: none;
                  border-color: #eee -moz-use-text-color -moz-use-text-color;
                  border-image: none;
                  border-right: 0 none;
                  border-style: solid none none;
                  border-width: 1px 0 0;
                  margin-bottom: 10px;
                  margin-top: 0;
              }

              }
            
              
               
        </style>

	</head>

	<body>
	<div id="wrapper">
	 <?php echo $header;?>
        <?php echo $sidebar;?>

         <div id="page-wrapper" >
            <div id="page-inner">
           
        <div class="row">

	
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="padding-bottom:15px;">
				<!-- <pre>
		
		<?php 
		print_r($this->session->all_userdata());
		?>

		</pre>  -->
		
							Pending Orders 
							</div>
						<div class="singlecontent padding-10px">
							<?php if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" style="width:50%">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>Payment successful!</strong>
								</div>
							<?php endif; ?>
							<div id="refresh" >

							<?php /*echo $userid;*/if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no pending orders at this time.
								</div>
							<?php endif; ?>

							<?php foreach ($orders as $order): ?>
								<div class="col-lg-12" style="border-bottom: #eee 2px solid; padding:10px 0px 10px 0px;margin-bottom">
							
									
									<div class="col-lg-3">
										<button class="icon-box1  set-icon" 
										 data-toggle="modal" 
										 data-target="#myModal1" id="table"  
										 	style="display: block;
float: left;margin: 0px 15px 10px 0;padding:45px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>') ;
background-size:90% 67%; background-repeat:no-repeat;background-position: center; ">

  <b><?php echo $order->tablenumber; ?></b>  

</button>
 <br> 
 <p> Customers Name :<br> 

 	<span class="icon-box bg-color-green set-icon" style="padding: 0px 10px 0px 10px;">
 	<?php echo $order->customername; ?>
 	</span></p>





					 
											
												<?php 
												if ($order->status == 1) 

													echo "<b><span style=color:blue>Being prepared</span></b>";
													 else if ($order->status==2) 
													 	echo "<b><span style=color:red>Ready for Delivery</span></b>";
												?>
												
											
										</div>
									<div class="col-lg-9">
										<b>Ordered Items:</b><br/>
											<?php
											//	$ordereditems=0;
												$ordereditems = $order->getOrderedItems_waiter();
												//print_r($this->db->last_query());
												
												//print_r($ordereditems);
												
												$numrow = sizeof($ordereditems);
												/*echo $numrow;*/
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo '<br>';
													echo "<span style=font-size:20px;>".$ordereditem->itemname."</span>";
													echo " X ";
													//echo $order->id;
													echo "<span style='padding:0px 5px 0px 5px;''  class='icon-box bg-color-red set-icon'><b>";
													echo $ordereditem->quantity;
													echo "</b></span>";

													if($ordereditem->status==2)
													{
														echo "<a href=# onclick=setAsDelivereditem(event) numrow=". $numrow ." ogorderid=". $order->id ." orderid=".$ordereditem->menuid."  class='btn btn-large'>Set as Delivered</a>";

													}

													

													 
													

													$count = $count + 1;
												}
												//echo $count;
												if($ordereditem->ingredients!='All')
												{
												echo "&nbsp;&nbsp;&nbsp;<b style=color:green;><br>[ Extra ";
													echo $ordereditem->ingredients;

													echo " ]</b>";
												}
											?>
											<br/>

											
										</p>
										
									

									<div class="orderaction pull-right">
										
										<?php if ($ordereditem->status == 1) {?>
										<img src="<?php echo base_url() ?>assets/img/process.gif"/>
										<?php }?>
											
										
										&nbsp;&nbsp;
										<?php if ($order->status == 2) {?>
										<a href="#" onclick="setAsDelivered(event)" orderid="<?php echo $order->id; ?>" class="btn btn-large">Set as Delivered</a>
										<?php } ?>&nbsp;&nbsp;

										<a href="#comp-modal" onclick="getOrderDetails(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Comp</a>
										
										&nbsp;&nbsp;
										<?php if ($order->status == 3) {?>
										<a href="#payment-modal" onclick="setOrderId(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Make Payment</a>
										<?php } ?>

									</div>
								</div>

								</div>
								
								

							
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<?php echo $comporder; ?>
		<?php echo $makepayment; ?>
	</body>
</html>