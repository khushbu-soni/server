<!-- <meta http-equiv="refresh" content="2";> -->
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>


<SCRIPT language=JavaScript1.2>

//change 1 to another integer to alter the scroll speed. Greater is faster
/*
var speed=1

var currentpos=0,alt=1,curpos1=0,curpos2=-1

function initialize(){

startit()
$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() > $(document).height() - 50) {
       $(window).unbind('scroll');
    $('html, body').animate({scrollTop:0}, 'slow');
       
   }
});
}

function scrollwindow(){

if (document.all &&

!document.getElementById)

temp=document.body.scrollTop

else

temp=window.pageYOffset

if (alt==0)

alt=2

else

alt=1

if (alt==0)

curpos1=temp

else

curpos2=temp

if (curpos1!=curpos2){

if (document.all)

currentpos=document.body.scrollTop+speed

else

currentpos=window.pageYOffset+speed

window.scroll(5,currentpos)

}

else{

currentpos=10

window.scroll(5,currentpos)

}

}

function startit(){


setInterval("scrollwindow()",20);
 
}



	window.onload=initialize*/
</script>



		<script type="text/javascript">

 

function toggleFullScreen() {
	 
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }
$("#fullScreen").removeClass( "btn-info" ).addClass( "btn-danger");      
document.getElementById("fullScreen").value="Cancel FullScreen"; 
  } else { 

    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
    $("#fullScreen").removeClass( "btn-danger" ).addClass( "btn-info");  
    document.getElementById("fullScreen").value="FullScreen"; 
  }  
}
		
			$(document).ready(function(){
				


			
			});

			function viewOrder(event){
				order = $(event.target);
				$(order.parent().parent()).removeClass('pending');
				orderid = order.attr('orderid');

				$('#btnDelivery').attr('orderid', orderid); //set the orderid attribute of the set to delivery button

				//set the title of the popup (orderdetails)
				$('#tablenumber').html(order.attr('tablenumber'));
				$('#tabletnumber').html(order.attr('tabletnumber'));
				$('#customername').html(order.attr('customername'));

				//get the details of the order
				$('#loading').show();
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('deskboard/orders/getorderdetails'); ?>",
					data: "id=" + orderid + "&status=1",
					success: function(data, textStatus){
						$('#loading').hide();
						$('#orderdetails').html(data);
						$('#orderdetails').show();
					}
				});
			}
		</script>

	<script type="text/javascript">
  var x=0;
  setInterval("my_function();",500);
  
    
    function my_function(){

    	//alert(x);
    	x=x+1;
        $('#refresh').load(location.href + ' #refresh');

         $('#refresh-tablefix').load(location.href + ' #refresh-tablefix');
       

      
        /* scrollDown = function() {
   document.body.scrollTop = document.body.scrollHeight;
}
        $("window").load(scrollDown);
 */

    }
</script>

	</head>

	<body background-color="green">
		<a href="#thirdPage"></a>
		<div>
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="" id="tableHolder">
						<div class="boxheading toprounded-4px">
						
							Pending Orders
							<input class="btn btn-info" type="submit" id="fullScreen" onClick="toggleFullScreen()" value="fullscreen">
 							
 								<?php 
 									$total_order=0;
 								foreach ($orders as $order){$total_order++;}?>
 								
 								
 									<div  class="tablenumber_kitchen_screen_fix rounded-4px pull-left" style="margin-left:85%; float:right; position:fixed;">
										
											<b id="refresh-tablefix" style="color:black;"><?php echo $total_order; ?><br></b>
										</div>
 									
						</div>
						<div id="refresh" class="deskboard">
						
								<div class="deskboard" >
							<?php if (empty($orders)): ?>
								<div class="alert alert-danger deskboard">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>

								<?php foreach ($orders as $order): ?>

									<div class="kitchenorder <?php if ($order->status == 0) echo 'pending'; ?>">
										<div class=" col-lg-9 col-sm-9">
											<div class="col-lg-4 col-sm-4 tablenumber_kitchen_screen rounded-4px pull-left">
										
												<?php if ($order->tablenumber == 0) {
													echo "<img height=80px width=80px src='".base_url()."assets/img/takeaway_bag.png' >";
												}else{ 
													echo $order->tablenumber;
													} ?>


											</div>
											<div class="col-lg-8 col-sm-8">

											<img src="<?php echo base_url() ?>assets/img/200px.png"/> <?php echo $order->customername; ?>
											<?php  
											
											$time=date('h:i A', strtotime($order->timestamp));?>
											<b> Time :	</b> <?php echo $time; ?>

											<br>Ordered Items: <br/>
											<b><?php if($order->status==1) echo "<span style=color:green> In process...";  ?></b>
											<?php 
												$ordereditems = $order->getOrderedItems();
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo ', ';
													echo $ordereditem->itemname;
													echo "Quantity : ";
													echo $ordereditem->quantity;

													$count = $count + 1;
													echo "<br/>";
												}
												
												if($ordereditem->ingredients!='All')
												{
												echo "&nbsp;&nbsp;&nbsp;<b style=color:green;>Extra ";
													echo $ordereditem->ingredients;
													echo "</b>";
												}
											?>
											</div>

										</div>
										<div class="pull-right">
											<?php echo "<i>Total Order  : </i>";
												echo $count; ?>
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
			<div id="time" class="deskboard">
			<a href="#secondPage"></a>
			</div>
		<?php echo $orderdetails; ?>
	</body>
</html>