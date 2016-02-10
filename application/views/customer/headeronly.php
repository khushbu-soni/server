<script type="text/javascript">
	function callWaiter(event){
		type = 0;
		$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
	}
</script>
<style type="text/css">

</style>
<div class="mainheader navbar-fixed-top">
	<div class="titlebar">
		<span class="title">Restaurant HOGO</span>
	</div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

			    <form class="navbar-form pull-left" style="margin-left:16px;">
			    	<a href="<?php echo site_url('customer/menu/customer_exit'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Exit</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	
			    </form>
			</div>
		</div>
	</div>
</div>