<script type="text/javascript">
	
	function setForDelivery(event)
	{
		
		order_id = $('#btnDelivery').attr('orderid');
		alert(order_id);

		$.post("<?php echo site_url('kitchen/orders/completeorder'); ?>", "id="+ order_id + "&status=2");
	}
	function setForProcess(event)
	{
		order_id = $('#btnProcess').attr('orderid');
		$.post("<?php echo site_url('kitchen/orders/process'); ?>", "id="+ order_id + "&status=1");
	}
</script>



	
<?php

		foreach ($status_all as $row){

			
			
		foreach ($ordereditems as $ordereditem){ ?>

			<div class="kitchenorder"><p><b>
			<?php echo $ordereditem->itemname; ?>
			</b></p>
			<?php 

			if (trim($ordereditem->ingredients) == ''){ ?>

				<ul><li>No extra ingredients.</li></ul>
			</div>
			<?php } else if ($ordereditem->ingredients == 'All'){ ?>
				 <ul><li>All available ingredients.</li></ul>

			</div>
			<?php } else { 
				
				$ingredients = explode(',', $ordereditem->ingredients); ?>
				<ul>
				<?php 

				foreach ($ingredients as $ingredient){ ?>
				<li> <?php echo ucfirst($ingredient); ?> </li>

				<?php } ?>
				</ul></div>

<?php 
			}
		} ?>
		

		<div class="modal-footer">
				
		<?php
		if($row->status==0){
			?>
		<a orderid="" id="btnProcess" onclick="setForProcess(event)"  href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-time"></i>Process</a>
				&nbsp;&nbsp;&nbsp;
		<?php	} ?>
		<a orderid="" id="btnDelivery" onclick="setForDelivery(event)"  href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-ok"></i> Ready for Delivery</a>
		&nbsp;&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-remove"></i> Close</a>
	</div>
	<?php } ?>

<div class="modal hide fade" id="vieworder-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Order Details for <span id="tablenumber">Table 2</span>, <span id="tabletnumber">Device 2</span> (<span id="customername">David</span>)</h3>
	</div>
	<div id="loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div id="orderdetails" class="modal-body hide">
		
	</div>
	
</div>