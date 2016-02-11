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

			function count_percent()
			{


			}
		</script>
	</head>
	<body>
	<?php 
if(isset($ing_info) && !empty($ing_info)){
$name = $ing_info[0]['name'];
}else{
$name = set_value('name');
}
	?>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">HOGO</span>
		</div>
		<?php echo $header; ?>
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
								<input type="text" value="<?php echo $name; ?>" id="devicenumber" class="validate[required]" name="name" />
							</div>
							<label class="control-label" for="tabletnumber">Quantity</label>
							<div class="controls">
								<input type="text" id="quantity" class="validate[required]" name="quantity" />
							</div>

							<label class="control-label" for="tabletnumber">Minimum Limits</label>
							
							<div class="controls" onchange="count_percent()">
								<select name="min_limit">
								<option value="10">10%</option>
								<option value="20">20%</option>
								<option value="30">30%</option>
								<option value="40">40%</option>
								<option value="50">50%</option>
								<option value="60">60%</option>
								<option value="70">70%</option>
								<option value="80">80%</option>
								<option value="90">90%</option>

								</select>
							</div>
							<div class="controls">
								<label class="control-label" for="tabletnumber"></label>
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