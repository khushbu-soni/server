<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/binary-assets/css/bootstrap-3.0.0.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/binary-assets/css/pick-a-color-1.2.3.min.css'?>">	 

		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#statusform').validationEngine();
			});	
		</script>
		<style type="text/css">
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
                    <div class="col-md-12  rounded-6px">


				
				<div class="panel panel-default">
                        <div class="panel-heading">
                             Add Status
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form id="statusform" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/status/add/'); ?>">
								<div style="">
									<table class="form pull-left" style="width:50%;margin-right:20px;">
										<tbody>
											<tr>
												<td class="formlabel label20">Name</td>
												<td><input required  type="text" name="status" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Order</td>
												<td><input required  type="number" step="1" value="1" name="order" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Status back-ground color</td>
												<td><input type="text" required value="000" name="bgcolor" class="pick-a-color form-control"></td>
											</tr>
											<tr>
												<td class="formlabel label20">Status Color</td>
												<td><input type="text" required value="000" name="color" class="pick-a-color form-control"></td>
											</tr>
										</tbody>
									</table>
									
								</div>
								<br class="clear" />
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#statusform').submit()" class="btn btn-info"><i class="icon-ok"></i> Add Status</button>
									<a href="<?php echo site_url('manager/status'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
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

	<script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.9.1.min.js'?>"></script>
	<script src="<?php echo base_url() . 'assets/binary-assets/js/tinycolor-0.9.15.min.js'?>"></script>
	<script src="<?php echo base_url() . 'assets/binary-assets/js/pick-a-color-1.2.3.min.js'?>"></script>	
	
	<script type="text/javascript">
		$(".pick-a-color").pickAColor();
	</script>
	</body>
</html>