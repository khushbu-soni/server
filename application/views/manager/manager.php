<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<style type="text/css">
			.pagination > li {
			  display: inline;
			  float: right !important;
			}
			.search-form1{
				margin-top: -33px !important;
			}
			.search-form2{
				margin-top: -33px !important;
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
                        <ul class="nav nav-pills">
								<li class="active"><a type="0" href="#" onclick="get_today()" class="">Today's Added</a></li>
								<li><a type="1" onclick="get_all()" href="#" class="">Available Stock </a></li>
								
							</ul>
                        <div class='search-form1 pull-right today'>
							<select name='type' id="item1" onchange="select()">
								<option value="All">Select Ingredient</option>
								<option value="All">All</option>
									
								<?php foreach ($today_stock as $today) {?>

								<option value="<?php echo $today->id;?>"><?php echo $today->name;?></option>
								<?php }?>

							</select>
							</div>
                        <div class='search-form2 all pull-right' style="display:none;">
							<select name='type' id="item2" onchange="select2()">
								<option value="All">Select Ingredient</option>
								<option value="All">All</option>
								<?php foreach ($all_stock as $all) {?>
								<option value="<?php echo $all->id;?>"><?php echo $all->name;?></option>
								<?php }?>

							</select>
                        </div>

                    </div>

                    <div class="panel-body" id="first">
                         <?php 	if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>
                       

                            <div class="table-responsive today" id="view">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ingredient Name</th>
                                            <th>Quantity</th>
                                                                                       
                                            <th>Minimum</th>
                                            <th>Date</th>
                                             <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;" id="data">
							Ingredient 
							
						</div>
							

							<?php if (empty($today_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($today_stock as $val): ?>
										<tr class="odd gradeX" id="old_today">
                                            <td>
                                            <?php
                                            echo $val->name;?>
                                            </td>
                                            <td>
                                            	<?php echo $val->quantity; ?>
                                            </td>
                                            
                                           <td>

                                            <?php echo $val->min_ingr; ?>
                                            </td>
                                            
                                           

                                           <td>

                                            <?php echo $val->date; ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url().'kitchen/ingredients/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
                                            </td>
                                        </tr>
									<?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                           <div class="table-responsive all" style="display:none;">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                           <th>Ingredient Name</th>
                                            <th>Quantity</th>
                                           
                                            <th>Minimum Ingredient</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Ingredient
							
						</div>
							

							<?php if (empty($all_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($all_stock as $val): ?>
										<tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $val->name;?>
                                            </td>
                                            <td>
                                            	<?php echo $val->quantity; ?>
                                            </td>

                                            
                                           <td>

                                            <?php echo $val->min_ingr; ?>
                                            </td>
                                            
                                           

                                           <td>

                                            <?php echo $val->date; ?>
                                            </td>

                                            <td>

                                            <a href="<?php echo base_url().'kitchen/ingredients/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
                                            </td>

                                        </tr>
									<?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>


		</div>
		</div>
		</div>
		</div>
		</div>


	 <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.10.2.js'?>"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    
      
    
         <!-- CUSTOM SCRIPTS -->
    <<script type="text/javascript">
			$(document).ready(function () {
                $('#dataTables-example').dataTable();
                $('#dataTables-example2').dataTable();
            });

				function get_today(){
				
				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});
				$(".all").css("display", "none");
				$(".today").css("display", "block");
				$('.menu-loading').show();
				$('.today').show();
				
				
			}
			function get_all(){
				
				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});
				$(".today").css("display", "none");
				$(".all").css("display", "block");
				$('.menu-loading').show();
				$('.today').hide();
				$('.all').show();
				
				

			}



			function select(){
				

                       
                        var select =  $("#item2").val();

                       
                     
                       // var user_role = $("#item option:selected").val();
                        $.post("<?php echo site_url('kitchen/inventory/filter'); ?>",{select:select},
                        function(data){
                                //alert(data);

                               
                              //$('.container-fluid').html(data);
                                
                                });
					}

			function select2(){
				$(location).attr('href'," <?php echo site_url('kitchen/inventory/filter'); ?>/"+$('#item2').val());
			}
		</script>
	</body>
</html>