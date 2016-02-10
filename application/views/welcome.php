<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Biryani House</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<style type="text/css">
			@font-face {
    font-family: advanced_pixel_lcd;
    src: url('<?php echo base_url() . 'assets/font/advanced_pixel_lcd-7.ttf'?>');
}
		</style>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">Biryani House</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<p style="text-align:center;">Welcome to <i>Biryani House</i>.</p> 
					<h4 style="text-align:center;">Please pick a section!</h4>
					<div class="menubuttons">
						<table id="mainmenu">
							<tr>
								<td><a href="<?php echo site_url('customer'); ?>" class="mainbtn btn btn-inverse btn-large transition"><img  src="<?php echo base_url() . 'assets/img/64-Admin-User.png'; ?>">Customer</a></td>
								<td><a href="<?php echo site_url('waiter'); ?>" class="mainbtn btn btn-large btn-inverse transition"><img  src="<?php echo base_url() . 'assets/img/pda_alt.png'; ?>">Waiter</a></td>
							</tr>
							<tr>
								<td><a href="<?php echo site_url('kitchen'); ?>" class="mainbtn btn btn-large btn-inverse transition"><img  src="<?php echo base_url() . 'assets/img/setup_assistant.png'; ?>">Kitchen</a></td>
								<td><a href="<?php echo site_url('manager'); ?>" class="mainbtn btn btn-large btn-inverse transition"><img  src="<?php echo base_url() . 'assets/img/blockdevice.png'; ?>">Manager</a></td>
							</tr>
							<tr >
								<!-- <td><a href="<?php echo site_url('tablesetup'); ?>" class="mainbtn btn btn-large btn-inverse transition">Table Setup</a></td> -->
								
							</tr>
						</table>
						<div style="background-color:black;text-align:center;padding:10px 10px 10px 10px; font-size:auto; font-family:advanced_pixel_lcd !important;"><a style="text-shadow: 0 1px 0 rgba(0, 0, 0, 0.5); color:green; " href="<?php echo site_url('deskboard'); ?>" class="">screen</a></div>

					</div>
				</div>
			</div>
		</div>
	</body>

</html>