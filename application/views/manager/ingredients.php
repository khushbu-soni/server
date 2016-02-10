<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Biryani House</title>
		  <?php echo $dependencies; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/boostrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// $(document).ready(function(){
			// 	$('#tablesetupform').validationEngine();	
		
			// });
		</script>
	</head>
	<body>
		<div class="titlebar">
			<span class="title">Biryani House</span>
		</div>
		<?php echo $header;?>
      <?php echo $sidebar;?>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<h3 style="text-align:center">Add Ingredients</h3>
					<?php if ($this->session->flashdata('successmsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('successmsg'); ?>
						</div>
					<?php endif; ?>
					<form class="form-horizontal" id="tablesetupform" method="post" action="<?php echo site_url('manager/ingredients/add'); ?>">
						<div class="control-group">
							<label class="control-label" for="tabletnumber">Ingredients</label>
							<div class="controls">
								<input type="text" id="devicenumber" class="validate[required]" name="name" />
							</div>
						</div>
						<div class="form-actions nobottomspace" style="padding-left:0;text-align:center;background-color:inherit;border-color:#99A2B6">
							<a href="#" onclick="$('#tablesetupform').submit()" class="btn btn-large"><i class="icon-ok"></i> Save</a>
							&nbsp;&nbsp;&nbsp;
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>