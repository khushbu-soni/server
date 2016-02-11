<html>

	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		
		 <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/prism.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/docsupport/chosen.css'; ?>" />

		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#menuitemform').validationEngine();
			});	
		</script>

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
						<div class="boxheading " style="">
							Edit Menu Item
						</div>
						<div class="singlecontent padding-10px">
							<form id="menuitemform" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/menuitems/edit_res/' .base64_encode($menuitem->id)); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									
									<table class="form pull-left" style="width:50%;margin-right:2px;">
										<tbody>
											<tr>
												<td class="formlabel label20">Name</td>
												<td><input type="text" name="name" value="<?php echo $menuitem->name; ?>" required /></td>
												<td></td>
											</tr>
											<tr>
												<td class="formlabel label20">Item No.</td>
												<td><input type="number" name="item_no" value="<?php echo $menuitem->item_no; ?>" required /></td>
												<td></td>
											</tr>

											<tr>
												<td class="formlabel label20">Description</td>
												<td><textarea required name="description"><?php echo $menuitem->description; ?></textarea></td>
											</tr>
											<tr>
												<td class="formlabel label20">Price</td>
												<td><input type="text" name="price" class="span3" type='number' step='.01' maxlength="10" required  value="<?php echo $menuitem->price; ?>" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Calories Count</td>
												<td><input type="text" name="calories" class="span2" type='number' step='.01' value="<?php echo $menuitem->calories; ?>" required /></td>
											</tr>
											<tr>
												<td class="formlabel label20" for='ingredients[]'>Optional Ingredients (comma separated)</td>
												<td>

										<div id="container">
									      <div id="content">
										      <div class="side-by-side clearfix">
										        <div>
													<select name='ingredients[]' data-placeholder="Choose a Ingredients ..." class="chosen-select" multiple style="width:350px;" tabindex="4" >
														<option value="<?php if(isset($ingredient->name) && $ingredient->name == "") echo ""; ?>">Select</option>
												     	
												     	<?php $edit_values=explode(',',$menuitem->keywords);
												     	// print_r($edit_values);
												     	// exit();	
												     	?>
													     <?php foreach ($ingredients as $ingredient) {?>
													        <!-- <option value='".$ingredient->name."'>".<?php echo $ingredient->name?>."</option>"; -->
													      	<option value="<?php echo $ingredient->name ?>"
													      		<?php
													      	 if(in_array($ingredient->name,$edit_values)) echo "selected"; 
													      	 	# code...
													      	 ?>
													      	 ><?php echo  $ingredient->name; ?></option>
													      <?php }?>

													</select>
													</div>
													</div>
													</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="formlabel label20">Picture Upload</td>
												<td><input type="file" name="userfile" value="<?php echo $menuitem->picturepath; ?>" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Type</td>
												<td>
													<select name="type" required>
														<option value="<?php if(isset($menutype->id) && $menutype->id == "") echo ""; ?>">Select</option>
													      <?php
													      foreach ($menutypes as $menutype) {
													      	?>
													      	<option value="<?php echo $menutype->id ?>"  <?php if(isset($menutype->id) && isset($menuitem->item_id) && ($menuitem->item_id  == $menutype->id)) echo "selected"; ?> > <?php echo  $menutype->menutype_name; ?>  </option>
													      	<?php
													      }

													      ?>
													</select>
														
												</td>
											</tr>
											
											<tr>
												<td class="formlabel label20">Availability</td>
												<td>
													<select name="available" required>
														<option <?php if ($menuitem->available == 1) echo 'selected'; ?> value="1" selected>Yes</option>
														<option <?php if ($menuitem->available == 0) echo 'selected'; ?> value="0">No</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="formlabel label20">Restaurant Category</td>
												<td>
													<select name="res_category" required>
														<option <?php if ($menuitem->res_category == 'BH') echo 'selected'; ?> value="BH" selected>Biryani House</option>
														<option <?php if ($menuitem->res_category == "CS") echo 'selected'; ?> value="CS">Cafe 1 Six</option>
														<option <?php if ($menuitem->res_category == "BAR") echo 'selected'; ?> value="BAR">BAR</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
										<img class="img-polaroid menuimg" src="<?php if ($menuitem->picturepath == null || $menuitem->picturepath == '') echo base_url() . 'assets/img/140x140.gif'; else echo base_url() . 'assets/dishes/' . $menuitem->picturepath; ?>" />
								</div>
								
								<br class="clear" />


								<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#menuitemform').submit()" class="btn btn-info"><i class="icon-ok"></i> Edit Menu Items</button>
									<a href="<?php echo site_url('manager/menuitems'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
								  	</div>
								
								</div>
								
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
		</div>
</form>
</div>
	</body>
	
>>>>>>> f17bfc0a755a2d71b8ff7d4ae2cdd3f25ba00aee
</html>