<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/prism.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/chosen.css'; ?>" />
		 <style type="text/css" media="all">
		    .chosen-rtl .chosen-drop { left: -90px; }
		    .form-horizontal input {
		    height: 35px !important;
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
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-body">
                        <?php 	if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>
                            <div class="table-responsive">
                            	<form id="menuitemform" class="form-horizontal" name="menuitemform" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/email/emailconfig'); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									
									<table class="form pull-left" style="width:50%;margin-right:2px;">
										<tbody>
											<tr>
												<td for="inputName" class="formlabel label20">Name</td>
												<td><input type="text"  id="inputName"  name="name" placeholder="Menu Type" required></td>
												<td></td>
											</tr>



											
											<tr>
												<td for="Fromemail" class="formlabel label20">From Address</td>
												<td><input id="fromemail" type='email'   name="from" required placeholder="Enter Email"/></td>
											</tr>

											<tr>
												<td for="Toemail" class="formlabel label20">To Email</td>
												<td><input id="toemail" type='email'   name="to" required placeholder="Enter Email"/></td>
											</tr>

											<tr>
												<td for="cc" class="formlabel label20"> CC </td>
												<td><input id="cc" type='email'   name="cc" required placeholder="Enter Email CC"/></td>
											</tr>

											<tr>
												<td for="bcc" class="formlabel label20">BCC</td>
												<td><input id="bcc" type='email'   name="bcc" required placeholder="Enter Email BCC"/></td>
											</tr>
											<tr>
												<td for="host" class="formlabel label20">Host</td>
												<td><input id="host" type='text'   name="host" required placeholder="Enter Host "/></td>
											</tr>

											<tr>
												<td for="post" class="formlabel label20">Port</td>
												<td><input id="port" type='text'   name="port" required placeholder="Enter Port"/></td>
											</tr>

											<tr>
												<td for="email" class="formlabel label20">Email / User Name</td>
												<td><input id="inputPrice" type='email'   name="username" required placeholder="Enter Email / User Name"/></td>
											</tr>
											
											<tr>
												<td for="password" class="formlabel label20">Password</td>
												<td><input  id="password" type='password'  name="password" required placeholder="password"/></td>
											</tr>
											
											
											<tr>
												<td class="formlabel label20">Type</td>
												<td>
													<select name="type" required>
														<option value="">Select Type</option>

														<option value="SMTP">SMTP</option>
														<option value="FTP">FTP</option>
														
													</select>
														
												</td>
											</tr>
											<tr>
												<td class="formlabel label20">Availability</td>
												<td>
													<select name="available" required>
														<option value="1" selected>Yes</option>
														<option value="0">No</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
										<img  width="200px" height="300px" src="<?php echo base_url() . 'assets/img/mail.png'; ?>" style="float:right" />
								</div>
								
								<br class="clear" />
									
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#menuitemform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</button>
									<a href="<?php echo site_url('manager/menuitems'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
								  	</div>
								
								</div>
								

								</form>
                            </div>
                            
                        </div>
                         <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }

    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    
    
  </script

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>


	 
      
    
         <!-- CUSTOM SCRIPTS -->
   
	</body>
</html>