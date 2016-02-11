<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
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
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="">
							Add Stock
						</div>
						<div class="singlecontent padding-10px">
							<form id="itemform" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('kitchen/stock/add'); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									<table class="form pull-left" style="width:50%;margin-right:20px;">
										<tbody>
											<tr>
												<td class="formlabel label20">Item</td>
												<td><input class="validate[required]" type="text" name="item" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Quantity</td>
												<td><input class="validate[required]" type="text" name="quantity" /><span> KG</span></td>

											</tr>

											<tr>
												<td class="formlabel label20">Supplier</td>
												<td><input class="validate[required]" type="text" name="supplier" /></td>

											</tr>

											<tr>
												<td class="formlabel label20">Available</td>
												<td>
												<select name="available">
												<option value="1">Yes</option>
												<option value="0">No</option>
												 </select>
												 </td>
											</tr>
										</tbody>
									</table>
									
								</div>
								<!-- <br class="clear" /> -->
								<div class="form-actions">
									<a href="#" onclick="$('#itemform').submit()" class="btn btn-large">ADD</a>
									&nbsp;&nbsp;
									<a href="<?php echo site_url('kitchen/inventory'); ?>" class="btn btn-large transition">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
</html>