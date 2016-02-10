<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
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
				$('#welcomeform').validationEngine();	
			});

			function callWaiter(event){
				type = 0;
				$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
			}
		</script>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">Restaurant HOGO</span>
		</div>
		<div class="container-fluid">	
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<h4 style="">Welcome to Hogo Restaurant!</h4>
					<?php if ($this->session->flashdata('sameuser') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('sameuser'); ?>
						</div>
					<?php endif; ?>
					  <pre>
					<?php print_r($this->session->all_userdata()); ?></pre>
					<p style="">Please, can you tell us your name?</p><br/>
					<form id="welcomeform" method="post" action="<?php echo site_url('customer/customer_two/setname_two'); ?>">
						<input type="text" class="input-xlarge validate[required, custom[onlyLetterSp]]" value="" name="customername" />
					</form>
					<div class="form-actions nobottomspace" style="background-color:inherit;border-color: #99A2B6;padding-left:0">
						<a class="btn btn-large" href="#" onclick="$('#welcomeform').submit()"><i class="icon-shopping-cart"></i> Begin</a>
						&nbsp;&nbsp;&nbsp;
						<a class="btn btn-large" href="#callwaiter-modal" onclick="callWaiter(event)" data-toggle="modal"><i class="icon-user"></i> Call a Waiter</a>
					</div>
				</div>
			</div>
			<?php echo $callwaiter; ?>
		</div>
	</body>

</html>