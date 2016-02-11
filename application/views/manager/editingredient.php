<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#menuitemform').validationEngine();
			});	

		</script>
		<style type="text/css">
			.form-horizontal input {
		    height: 35px !important;
		}
		</style>
		<?php echo $dependencies; ?>
	</head>

	<body>
		<div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>
<?php $name=$ingredients[0]['name'];?>

	    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-heading">
                             Add Ingredient
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                       			<form id="itemform" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/ingredients/add'); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									
									<div class="control-group">
							    	<label for="menuType"  class="control-label">Ingredient</label>
								    <div class="controls">
										    <input type="text"  id="ingredient"  name="name" placeholder="Ingredient" required value="<?php echo $name;?>">
									</div>
								  </div>
									
								</div>
								<!-- <br class="clear" /> -->
								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#itemform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</button>
									<a href="<?php echo site_url('manager/ingredients'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
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