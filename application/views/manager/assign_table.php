<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to OpenBooth</title>
		
		
		<style type="text/css">
			.pagination > li {
			  display: inline;
			  float: right !important;
			}
		</style>
	    <?php echo $dependencies;?>
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
                        <div class="panel-heading">
                            Assign Table
                        </div>
                        <?php if ($this->session->flashdata('successmsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('successmsg'); ?>
						</div>
					<?php endif; ?>
                        <div class="panel-body">
                        
							
                    <div class="table-responsive">
                    	<form class="form-horizontal" data-toggle="validator" role="form" method="post" id="createaccform" action="<?php echo site_url('manager/assign/add'); ?>">
							<div class="control-group">
							<label class="control-label" for="employeeid">Waiter Select</label>
							<div class="controls">
							<select name="waiter_id" id="employeeid" required>
														<option value="<?php if(isset($item->id) && $item->id == "") echo ""; ?>">Select</option>
													      <?php
													      foreach ($waiters as $waiter) {
													      	?>
													      	<option value="<?php echo $waiter->id ?>"> <?php echo  $waiter->fname." ".$waiter->lname; ?>  </option>
													      	<?php
													      }

													      ?>
													</select>
						</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="tablenumber">Table Number</label>
							<div class="controls">
							<select name="tablenumber" if ="tablenumber" required>
														<option value="<?php if(isset($item->id) && $item->id == "") echo ""; ?>">Select</option>
													      <?php
													      $tables=array();
													      for($i=1;$i<=$tablenumbers->no_of_table;$i++){
													      	foreach ($used_table as $table)
													      		$tables[]=$table->tablenumber;

													      	if(!in_array($i,$tables)){
													      	?>
													      	<option value="<?php echo $i ?>"> <?php echo  $i ?>  </option>
													      	<?php
														      }
													      }

													      ?>
													</select>
							</div>
						</div>
						<div class="control-group" style="display:none">
							<label class="control-label" for="tabletnumber">Device Number</label>
							<div class="controls">
								<input type="text" id="devicenumber" class="validate[required, custom[onlyNumberSp]]" name="tabletnumber" />
							</div>
						</div>
						<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#tablesetupform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</button>
									<a href="<?php echo site_url('manager/assign/assign_info'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
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