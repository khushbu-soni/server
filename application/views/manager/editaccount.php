<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#editaccform').validationEngine();
			});	
		</script>
	</head>
	<body>
	<div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>
<?php $useraccounts=$this->data['useraccounts']; $useraccount=$useraccounts[0];

 ?>

	    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 outer-frame rounded-6px">


				
				<div class="panel panel-default">
                        <div class="panel-heading">
                             Edit  Account
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" id="editaccform" action="<?php echo site_url('manager/useraccounts/edit/' . base64_encode($useraccount->id)); ?>">
								<!--<div class="control-group">
									<label class="control-label" for="employeeid">Employee ID</label>
									<div class="controls">
										<input type="text" class="validateuneditable-input" id="employeeid" name="employeeid" value="123456" />
									</div>
								</div>-->
								
								<div class="control-group">
									<label class="control-label" for="firstname">First Name</label>
									<div class="controls">
										<input type="text" value="<?php echo $useraccount->fname; ?>" id="firstname" name="fname" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="lname">Last Name</label>
									<div class="controls">
										<input type="text" value="<?php echo $useraccount->lname; ?>" id="lname" name="lname"  required />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="uname">Username</label>
									<div class="controls">
										<input type="text" value="<?php echo $useraccount->uname; ?>" id="uname" name="uname"  required />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="password">Password</label>
									<div class="controls">
										<input type="password" value="<?php echo $useraccount->logincode; ?>" id="password" name="password" required />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="accounttype">Account Type</label>
									<div class="controls">
										<select name="role" id="accounttype" required>
											<option value="">Select Account Type</option>
											<option <?php if ($useraccount->role == 0) echo 'selected'; ?> value="0">Waiter Staff</option>
											<option <?php if ($useraccount->role == 1) echo 'selected'; ?> value="1">Kitchen Manager</option>
											<option <?php if ($useraccount->role == 2) echo 'selected'; ?> value="2">Manager</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label " for="employeeid">Picture Upload<small>&nbsp;</small>  </label>
									<div class="controls">
									<!-- <img style="margin-left:-1px;" class="img-polaroid" src="<?php echo base_url() . 'assets/img/140x140.gif'; ?>" style="float:right" /> -->
									<img class="img-polaroid menuimg" src="<?php if ($useraccount->pic == null || $useraccount->pic == '') echo base_url() . 'assets/img/140x140.gif'; else echo base_url() . 'assets/dishes/' . $useraccount->pic; ?>" />
									<input type="file" name="userfile" />
									</div>
								</div>
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#editaccform').submit()" class="btn btn-primary">Submit</button>
									<a href="<?php echo site_url('manager/useraccounts'); ?>" class="btn btn-danger transition">Cancel</a>
								  	</div>
								
								</div>
								
							</form>
                            </div>
                            
                        </div>

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</body>
</html>