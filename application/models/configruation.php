<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to OpenBooth</title>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/binary-assets/css/bootstrap-3.0.0.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/binary-assets/css/pick-a-color-1.2.3.min.css'?>">	 
		    <?php echo $dependencies;?>
			<style type="text/css">
			.form-horizontal input {
		    height: 35px;
		}

		#free_waiter_notify{
			width: 300px !important;
		}
		#busy_waiter_notify{
			width: 300px !important;

		}
		#occupied_table_notify{
			width: 300px !important;

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
                        <div class="panel-heading">
                        Configruation Setup
                        </div>
                        <div class="panel-body">
                        	<form enctype="multipart/form-data" data-toggle="validator" role="form" class="form-horizontal" id="orderform" method="post" action="<?php echo site_url('manager/configruation/setOrderPerPage'); ?>">
						<div class="row">
						<div class="col-md-6">
						<div class="control-group">
							<label class="control-label" for="employeeid">Minimum Order Per Page <small>(Kitchen Display)</small></label>
							<div class="controls">
							<select class="span4" name="min_order_per_page">
							<option value="<?php echo $info->min_order_per_page ?>"  <?php if(isset($info->min_order_per_page) && isset($info->min_order_per_page) && ($info->min_order_per_page  == $info->min_order_per_page)) echo "selected"; ?> > <?php echo  $info->min_order_per_page; ?>  </option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							</select>
						</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Number Of Table<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="text" name="no_of_table" class="span4 validate[required, custom[onlyNumberSp]]" value="<?php echo $info->no_of_table;?>"/>
						</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Set Tax Value<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type='text' name="tax" class="span4 validate[required, custom[number]]" value="<?php echo $info->tax;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Dashboard Upper Block Auto Refresh Time<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="number"  min="1000" name="upper_block_refresh_time" class="span4" value="<?php echo $info->upper_block_refresh_time;?>" required/>
							<small class="text-center text text-danger" style="margin: 27px;">Keep Specify Time in Milliseconds</small>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label " for="employeeid">Dashboard Notification List Block Auto Refresh Time<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="number"  min="1000" name="customer_notification_auto_refresh_time" class="span4" value="<?php echo $info->customer_notification_auto_refresh_time;?>" required/>
							<small class="text-center text text-danger" style="margin: 27px;">Keep Specify Time in Milliseconds</small>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Dashboard Free Waiter Block Auto Refresh Time<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="number"  min="1000" name="free_waiter_auto_refresh_time" class="span4" value="<?php echo $info->free_waiter_auto_refresh_time;?>" required/>
							<small class="text-center text text-danger" style="margin: 27px;">&nbsp;&nbsp;Keep Specify Time in Milliseconds</small>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Dashboard Free Table Block Auto Refresh Time<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="number"  min="1000" name="free_table_auto_refresh_time" class="span4" value="<?php echo $info->free_table_auto_refresh_time;?>" required/>
							<small class="text-center text text-danger" style="margin: 27px;">Keep Specify Time in Milliseconds</small>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Free Waiter Notify Color<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="text" required  name="free_waiter_notify" class="pick-a-color form-control" value="<?php echo $info->free_waiter_notify_color;?>">
							</div>
						</div>
						</div>
						<div class="col-md-6">
						<div class="control-group">
							<label class="control-label " for="employeeid">Busy Waiter Notify Color<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="text" required  name="busy_waiter_notify" class="pick-a-color form-control " value="<?php echo $info->busy_waiter_notify_color;?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Occupied Table Notify Color<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="text" required  name="occupied_table_notify" class="pick-a-color form-control " value="<?php echo $info->occupied_table_notify_color;?>">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label " for="employeeid">Hotel Name<small>&nbsp;</small>  </label>
							<div class="controls">
							<input type="text" name="hotel_name" class="span4 validate[required]" value="<?php echo $info->hotel_name;?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Address<small>&nbsp;</small>  </label>
							<div class="controls">
							<textarea name="address" class="span4 validate[required]"/><?php echo $info->address;?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Contact Info<small>&nbsp;</small>  </label>
							<div class="controls">
							<input name="contact" class="span4 validate[required]" value="<?php echo $info->contact;?>"/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label " for="employeeid">Picture Upload<small>&nbsp;</small>  </label>
							<div class="controls">
							<img class="img-polaroid menuimg" src="<?php if ($info->logo == null || $info->logo == '') echo base_url() . 'assets/img/140x140.gif'; else echo base_url() . 'assets/dishes/' . $info->logo; ?>" />
							<input type="file" name="userfile" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label " for="employeeid">Picture Upload<small>&nbsp;</small>  </label>
							<div class="controls">
							<img class="img-polaroid menuimg" src="<?php if ($info->logo == null || $info->logo == '') echo base_url() . 'assets/img/140x140.gif'; else echo base_url() . 'assets/dishes/' . $info->logo; ?>" />
							<input type="file" name="userfile" />
							</div>
						</div>
						<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#orderform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</button>
								  	</div>
								
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