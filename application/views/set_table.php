<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Biryani House</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablesetupform').validationEngine();	
		
			});


			function get_waiter_on_table(tableId)
			{
				  var dataString = 'tableId='+ tableId;
  					
      			
				  $.ajax({
			     type: "POST",
			     url: "<?php echo site_url('set_table/waiter_by_table'); ?>",
			     data: dataString,
			     cache: false,
			     success: function(result){
			    $('#waiter').val(result);
			     }
			   });


			}

		</script>
	</head>
	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">HOGO</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<h3 style="text-align:center">Set Table</h3>
					<?php if ($this->session->flashdata('errormsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('errormsg'); ?>
						</div>
					<?php endif; ?>
					<?php //print_r($use_table); ?>
					<form class="form-horizontal" id="tablesetupform" method="post" action="<?php echo site_url('set_table/setidentity'); ?>">
						
						<div class="control-group">
							<label class="control-label" for="tablenumber">Table Number</label>
							<div class="controls">
								<select name="tablenumber" class="validate[required]" onchange="get_waiter_on_table(this.value)">
														     <?php

													      foreach ($tablenumbers as $table){

													      	if(!empty($use_table))
													      	{
													      		  foreach ($use_table as $inuse){

													      		if($table->tablenumber==$inuse->tablenumber){
												      	?>
													     
																<option value="<?php echo $inuse->tablenumber; ?>" > <?php echo  $inuse->tablenumber; ?>
													    		 </option>
													      	
													      	<?php
													    		 }}  } ?>
													    		  
													    		 
													    		
													    		
													    			  			   

													    
														      
													      <?php 	}?>
													      	
								</select>
								<input type="hidden" name="waiter" id="waiter">
							</div>
						</div>
					
					
							
						</div>
						<div class="form-actions nobottomspace" style="padding-left:0;text-align:center;background-color:inherit;border-color:#99A2B6">
							<a href="#" onclick="$('#tablesetupform').submit()" class="btn btn-large"><i class="icon-ok"></i> Save</a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url(); ?>" class="btn btn-large transition"><i class="icon-remove"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>