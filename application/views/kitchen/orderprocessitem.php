<script type="text/javascript">
	function setForDelivery_item(event)
	{
		order_id = $('#btnDelivery').attr('orderid');
		ogorder_id = $('#btnDelivery').attr('ogorderid');
		numrow = $('#btnDelivery').attr('numrow');
		//alert(order_id);
		//alert(ogorder_id);
		
		$.post("<?php echo site_url('kitchen/orders/completeorder_item'); ?>", "id="+ order_id + "&status=2" + "&ogorderid=" + ogorder_id + "&numrow=" + numrow);
		
	}
</script>
<div class="modal hide fade" id="vieworder-modal-item">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Order Details for <span id="tablenumber">Table 2</span>, <span id="tabletnumber">Device 2</span> (<span id="customername">David</span>)</h3>
	</div>
	<div id="loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div id="orderprocessitem" class="modal-body hide">
		
	</div>
	<div class="modal-footer">
		
		<a numrow="" ogorderid="" orderid="" id="btnDelivery" onclick="setForDelivery_item(event)"  href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-ok"></i> Ready for Delivery</a>
		
		&nbsp;&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-remove"></i> Close</a>
	</div>
</div>