<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<?php echo $dependencies; ?>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				// $('#createaccform').validationEngine();

				$('#createaccform').submit(function(){
					if($('#inputPassword').val()!=$('#inputConfirm').val()){
						alert("Password Must Match");
					

						return false;
					}
				});
			});	
		</script>
		<style type="text/css">
			.form-horizontal input {
		    height: 35px;
		}
		</style>
	</head>

	<body>
		<div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>


	    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 outer-frame rounded-6px">


				
				<div class="panel panel-default">
                        <div class="panel-heading">
                             Add User
                        </div>
                        <?php 	if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>
                        <div class="panel-body">
                            <div class="table-responsive">

                            <form class="form-horizontal" enctype="multipart/form-data" data-toggle="validator" role="form" method="post" id="createaccform" action="<?php echo site_url('manager/useraccounts/create'); ?>">
								<div class="control-group">
							    	<label for="inputFname"  class="control-label">First Name</label>
								    <div class="controls">
										    <input type="text"  id="inputFname"  name="fname" placeholder="First Name" required>
									</div>
								  </div>

								  <div class="control-group">
							    	<label for="inputLname"  class="control-label">Last Name</label>
								    <div class="controls">
										    <input type="text" name="lname"  id="inputLname" placeholder="Last Name" required>
									</div>
								  </div>
								<div class="control-group">
							    	<label for="inputUname"  class="control-label">User Name</label>
								    <div class="controls">
										    <input type="text" name="uname" id="inputUname" placeholder="User Name" required>
									</div>
								  </div>
								<div class="control-group">
							    	<label for="inputPassword"  class="control-label">Password</label>
								    <div class="controls">
										    <input type="password" name="password" id="inputPassword" placeholder="Password" required>
									</div>
								  </div>

								  <div class="control-group">
							    	<label for="inputConfirm"  class="control-label">Confirm Password</label>
								    <div class="controls">
										    <input type="password"  id="inputConfirm" placeholder="Confirm Password" required>
									</div>
								  </div>

								<div class="control-group">
									<label for="inputType" class="control-label" for="role">Account Type</label>
									<div class="controls">
										<select for="inputType" name="role" required>
											<option value="">Select Account Type</option>
											<option value="0">Waiter Staff</option>
											<option value="1">Kitchen Manager</option>
											<option value="2">Manager</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label " for="employeeid">Picture Upload<small>&nbsp;</small>  </label>
									<div class="controls">
									<img style="margin-left:-1px;" class="img-polaroid" src="<?php echo base_url() . 'assets/img/140x140.gif'; ?>" style="float:right" />
									<input type="file" name="userfile" />
									</div>
								</div>
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#createaccform').submit()" class="btn btn-primary">Submit</button>
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