<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/style.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/prism.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/chosen.css'; ?>" />

		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>


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
                <div class="row row-fluid">

				<div class="span12 rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="">
							Add Menu Item
						</div>
						<div class="singlecontent padding-10px">
							<form id="menuitemform" class="form-horizontal" name="menuitemform" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/menuitems/bar_add'); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									
									<table class="form pull-left" style="width:50%;margin-right:2px;">
										<tbody>
											<tr>
												<td for="inputName" class="formlabel label20">Name</td>
												<td><input type="text"  id="inputName"  name="name" placeholder="Menu Type" required></td>
												<td></td>
											</tr>

											<tr>
												<td for="inputDesc" class="formlabel label20">Description</td>
												<td><textarea id="inputDesc" required name="description"></textarea></td>
											</tr>
											<tr>
												<td for="inputPrice" class="formlabel label20">Price</td>
												<td><input id="inputPrice" type='number' step='.01' maxlength="10"  name="price" required placeholder="Numeric and Decimal Value Only"/></td>
											</tr>
											<tr>
												<td class="formlabel label20">Picture Upload</td>
												<td><input type="file" name="userfile" /></td>
											</tr>
											<!-- <tr>
												<td class="formlabel label20">Category</td>
												<td>
													<select name="category" required>
														<option value="">Select Category</option>
														<option value="restro">Restro</option>
														<option value="bar">Bar</option>
													</select>
														
												</td>
											</tr> -->
											<tr>
												<td class="formlabel label20">Availability</td>
												<td>
													<select name="available" required>
														<option value="1" selected>Yes</option>
														<option value="0">No</option>
													</select>
												</td>
											</tr>
											<!-- <tr>
												<td class="formlabel label20">Retaurant Category</td>
												<td>
													<select name="res_category" required>
														<option value="BH" selected>Biryani House</option>
														<option value="CS">Cafe 1 Six</option>
														<option value="BAR">BAR</option>
													</select>
												</td>
											</tr> -->
										</tbody>
									</table>
										<img class="img-polaroid" src="<?php echo base_url() . 'assets/img/140x140.gif'; ?>" style="float:right" />
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/docsupport/chosen.jquery.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/docsupport/prism.js'; ?>"></script>

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
    
    
  </script>

							
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		


	</body>
	
>>>>>>> f17bfc0a755a2d71b8ff7d4ae2cdd3f25ba00aee
</html>