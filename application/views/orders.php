
<div class="span3 outer-frame rounded-6px">
	<div class="whitebg">
		<div class="boxheading toprounded-4px" >
			Orders
		</div>
		<div class="statsidebar singlecontent padding-10px">
		<?php if (empty($orders)): ?>
			<div class="alert alert-danger">
				No Orders More.
			</div>
		<?php endif;?>
		<?php if (!empty($orders)): ?>
		<table class="pay" id='tr' width="100%">
		<?php foreach ($orders as $order) {?>
			<!-- <br/><br/> -->
				  <tr class="btn btn-default" id='tr'>
					  <td class="span2" style="font-size:30px; color:skyblue">[<?php echo $order->tablenumber;?>]</td>
					  <td class="span2"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
					  Details
					</button></td>
					
					  <td class="span2"><a href="<?php echo site_url('manager/billing/payment/' . base64_encode($order->customer_unique_id)); ?>" id="pay" orderid="<?php echo $order->id ?>" class='btn btn-danger' >Pay</a></td>
					</tr>
					
			<?php }?>
		</table>
		<?php endif;?>	
		</div>
	</div>