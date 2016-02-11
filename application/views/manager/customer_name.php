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
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/cal/css/jquery.calculator.css'; ?>" type="text/css"/>
		<script src="<?Php echo base_url() . 'assets/cal/js/jquery.plugin.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/cal/js/jquery.calculator.js'; ?>" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){

				

	$('#customermobile').on('keydown',function(e){
    var deleteKeyCode = 8;
    var backspaceKeyCode = 46;
    if ((e.which>=48 && e.which<=57) ||
         (e.which>=96 && e.which<=105)  || // for num pad numeric keys
         e.which === deleteKeyCode || // for delete key,
             e.which === backspaceKeyCode) // for backspace
         // you can add code for left,right arrow keys
    {
        $(this).removeClass('error');
        return true;
    }
    else
    {
        $(this).addClass('error');
        return false;
    }
});

				
					
			});

			function callWaiter(event){
				type = 0;
				$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
			}

			$(function () {
				$.calculator.setDefaults({showOn: 'both', buttonImageOnly: true, buttonImage: 'calculator.png'});
			$('#basicCalculator').calculator();
			$('#basicCalculator2').calculator();
				$('#sciCalculator').calculator({layout: $.calculator.scientificLayout});
			});

			function showname(){
				 
		//document.getElementById("a-name").style.display = "none";
		document.getElementById("customermobile").value = "";
		 document.getElementById("name").style.display = "";	
		  document.getElementById("mobile").style.display = "none";	
				
			}

			function showmobile(){
				document.getElementById("customername").value = "";
				//document.getElementById("a-name").style.display = "";
				 document.getElementById("name").style.display = "none";	
				 document.getElementById("mobile").style.display = "";	
						}
		</script>





	</head>
	<body>
			<?php echo $menuheader; ?>
		
		<div class="container-fluid" style="margin-top:120px;">	
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<h4 style="">Welcome to Hogo Restaurant!</h4>
					<?php if ($this->session->flashdata('sameuser') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('sameuser'); ?>
						</div>
					<?php endif; ?>
					<!--   <pre>
					<?php print_r($this->session->all_userdata()); ?>
					</pre> -->
					
					<p style="">Please, can you tell us your name?</p><br/>
						


					<form id="welcomeform_name" method="post" action="<?php echo site_url('manager/customer_name/setname'); ?>">
						<div  class="control-group">
							<label for="tabletnumber" class="control-label">Your Name </label>
							<div class="controls">
								<input required type="text" class="input-xlarge validate[required, custom[onlyLetterSp]]" value="" id="customername" name="customername" /><br/>
							</div>
						</div>
						<div style="" class="control-group">
							<label for="tabletnumber" class="control-label">Mobile Number</label>
							<div class="controls">
								<input required type="text" id="basicCalculator" class="input-xlarge validate[required, custom[onlyNumberSp]], maxSize[10], minSize[10]" value="" name="key" /><br/>
							</div>
						</div>
					</form>
					<div class="form-actions nobottomspace" style="background-color:inherit;border-color: #99A2B6;padding-left:0">
						<a class="btn btn-large" href="#" onclick="$('#welcomeform_name').submit()"><i class="icon-shopping-cart"></i> Begin</a>
						</div>
					</div>


					<div class="" id="mobile" style="display:none">
					<br/>
					
					<p style="">Please, can you tell us your Mobile Number?</p><br/>
					<form id="welcomeform_mobile" method="post" action="<?php echo site_url('customer/welcome/setmobile'); ?>">
						<div  class="control-group">
							<label for="tabletnumber" class="control-label">Your Mobile </label>
							<div class="controls">
								<input type="text" id="customermobile" class="input-xlarge validate[required, custom[onlyNumberSp]],maxSize[10], minSize[10]" value="" id="customermobile" name="customermobile" /><br/>
							</div>
						</div>

						<div style="" class="control-group">
							<label for="tabletnumber" class="control-label">Security Key</label>
							<div class="controls">
								<input type="text" id="basicCalculator2" class="input-xlarge validate[required, custom[onlyNumberSp]], maxSize[4], minSize[4]" value="" name="key" /><br/>
							</div>
						</div>
					</form>
					<div class="form-actions nobottomspace" style="background-color:inherit;border-color: #99A2B6;padding-left:0">
						<a class="btn btn-large" href="#" onclick="$('#welcomeform_mobile').submit()"><i class="icon-shopping-cart"></i> Begin</a>
						&nbsp;&nbsp;&nbsp;
						<a class="btn btn-large" href="#callwaiter-modal" onclick="callWaiter(event)" data-toggle="modal"><i class="icon-user"></i> Call a Waiter</a>
					</div>
					</div>


					
				</div>
			</div>
			
		</div>
	</body>

</html>

