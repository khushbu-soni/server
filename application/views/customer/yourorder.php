<style type="text/css">
.cart-header {
    background: none repeat scroll 0 0 #1c2c39;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
}


*::after, *::before {
    box-sizing: border-box;
}
*::after, *::before {
    box-sizing: border-box;
}
.cart-content {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #e5e5e5;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    z-index: 962;

   
}
.ordereditem:hover {
    box-shadow: 0px 0px 8px #BBB;
}
</style>
<div class="cart-content span3 outer-frame rounded-6px" style="">
	<div class="leftmenucol rounded-4px" >
		<div class="cart-header boxheading toprounded-4px" >
			YOUR ORDER 
		</div>
		<div class="leftmenucontent" >
			
		   
		    <div style="max-height:500px; overflow-y: scroll;">    
		       
			
			<div class="items" >
				
				<!-- <input id="demo3" type="text" value="" name="demo_vertical2">
		   
			<script>
			    $("input[name='demo_vertical2']").TouchSpin({
			      verticalbuttons: true,
			      verticalupclass: 'glyphicon glyphicon-plus',
			      verticaldownclass: 'glyphicon glyphicon-minus'
			    });
			</script> -->
			

			</div>
				</div>
			
			<br class="clear" />
	
		<div class="placeorder" >
		 <?php print_r($yourorder_total); ?>
			<a href="#placeorder-modal" class="btn btn-placeorder" data-toggle="modal" ><i class="icon-ok"></i> Place Order</a>
		</div>
	</div>
</div>


<!-- 

				<div class="cart-content span3 outer-frame rounded-6px" style="">
	<div class="leftmenucol rounded-4px" >
		<div class="cart-header boxheading toprounded-4px" >
			YOUR ORDER <span id="refresh" > : <?php echo sizeof($yourorder_total); ?> </span>
		</div>
		<div class="leftmenucontent" >
			
		   
		    <div style="max-height:500px; overflow-y: scroll;">    
		       
			
			<div class="items" >
				
				<input id="demo3" type="text" value="" name="demo_vertical2">
		   
			<script>
			    $("input[name='demo_vertical2']").TouchSpin({
			      verticalbuttons: true,
			      verticalupclass: 'glyphicon glyphicon-plus',
			      verticaldownclass: 'glyphicon glyphicon-minus'
			    });
			</script>
			

			</div>
				</div>
			
			<br class="clear" />
	
		<div class="placeorder" id="refresh2">
		 	<?php if(sizeof($yourorder_total) != 0) {?>
			<a href="#placeorder-modal" class="btn btn-placeorder" data-toggle="modal" ><i class="icon-ok"></i> Place Order</a>
			<?php } ?>
		</div>
	</div>
</div>






			</div>
			<br/>
		</div>


 -->