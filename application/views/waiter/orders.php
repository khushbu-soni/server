<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
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
						<div class="boxheading toprounded-4px" style="padding-bottom:15px;">
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
							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no pending orders at this time.
								</div>
							<?php endif; ?>

							<?php  foreach ($orders as $order): ?>
								<div class="kitchenorder">
									<div class="orderitems pull-left" style="">
										<div class="tablenumber rounded-4px pull-left" style="width: 114px !important; ">
											<?php echo $order->tablenumber; ?>
										</div>
										<p class="pull-right"><b>Ordered Items:<br></b>
											<?php
												$ordereditems = $order->getOrderedItems();
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo '<br>';
													echo $ordereditem->itemname;
													$count = $count + 1;
												
												
												if($ordereditem->ingredients!='All')
												{
												echo "&nbsp;&nbsp;&nbsp;<b style=color:green;>Extra ";
													echo $ordereditem->ingredients;
													echo "</b>";
												}
												}
											?>
											<br/>
											Table <?php echo $order->tablenumber; ?>, Device <?php echo $order->tabletnumber; ?> (<?php echo $order->customername; ?>)<br/>
											<b>
												<?php 
												if ($order->status == 2) echo "<img src=".base_url()."assets/img/beng.jpg><span style='color:green'>Being prepared</span>"; else if ($order->status==2) echo "<span style='color:red'>Ready for Delivery</span>";
												?>
												
											</b>
										</p>
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