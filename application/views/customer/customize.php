<div class="modal hide fade" id="customize-modal">
	<div class="modal-header cart-header-modal-top">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><span id="mealname">Cheeseburger</span> Options</h3>
	</div>
	<div id="loading" class="ingr-loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div id="ingr_list" class="modal-body hide">
		<!-- ingredient listing here -->
	</div>
	<div class="modal-footer cart-header-modal-bottom">
		<a href="#" data-dismiss="modal" onclick="addToOrder(event)" id="customizeAddbtn" ingredients="All" class="btn btn-primary btn-plus"><i class="icon-plus"></i> Add to Order</a>
		&nbsp;&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-danger "><i class="icon-remove"></i> Close</a>
	</div>
</div>