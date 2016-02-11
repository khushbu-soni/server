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
				$('#menuitemform').validationEngine();
			});	

		</script>
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
                             Edit  Menu Type
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form id="menuitemform" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/menutype/edit/' . base64_encode($menutype->id)); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									<!-- <table class="form pull-left" style="width:50%;margin-right:20px;">
										<tbody>
											<tr>
												<td class="formlabel label20">Name</td>
												<td><input class="validate[required]" value="<?php echo $menutype->menutype_name; ?>" type="text" name="menutype_name" /></td>
											</tr>
										</tbody>
									</table> -->

									<div style="margin-bottom:25px;overflow:auto;">
									
										<div class="control-group">
								    	<label for="menuType"  class="control-label">Menu Type</label>
									    <div class="controls">
											    <input type="text"  id="menuType" value="<?php echo $menutype->menutype_name; ?>" name="menutype_name" placeholder="Menu Type" required>
										</div>
									  </div>
									
									</div>
									
								</div>
								<br class="clear" />
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#menuitemform').submit()" class="btn btn-info"><i class="icon-ok"></i> Edit Menu Type</button>
									<a href="<?php echo site_url('manager/menutype'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
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