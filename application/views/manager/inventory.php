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

			.navbar{
			    margin-bottom: -18px !important;
			    margin-top: 28px !important;
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
                       		
                        <div class='search-form1 pull-right today'>
							</div>
                        <div class='search-form2 all pull-right' style="display:none;">
                        </div>

                    </div>


                    <ul class="nav nav-tabs" role="tablist" id="myTab">
					  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Restro</a></li>
					  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bar</a></li>
					</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">
  	
    <div class="panel-body" id="first">
    <div class="boxheading toprounded-4px" style="padding-bottom:15px;" id="data">
							Restro Inventory 
							
						</div>
    	 <ul class="nav nav-pills">
								<li class="active"><a type="0" href="#" onclick="get_today()" class="">Today's Added</a></li>
								<li><a type="1" onclick="get_all()" href="#" class="">Available Stock </a></li>
								
							</ul>

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
                         
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							
							
						</div>
							

							<?php if (empty($res_today_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($res_today_stock as $val): ?>
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
                                            <a href="<?php echo base_url().'manager/inventory/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
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
							
							
						</div>
							

							<?php if (empty($res_all_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($res_all_stock as $val): ?>
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

                                            <a href="<?php echo base_url().'manager/inventory/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
                                            </td>

                                        </tr>
									<?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        

    </div>




  </div>
  

  <div role="tabpanel" class="tab-pane" id="profile">
  	
  	<div class="panel-body" id="first">
  	<div class="boxheading toprounded-4px" style="padding-bottom:15px;" id="data">
							Bar Inventory 
							
						</div>
    	 <ul class="nav nav-pills">
								<li class="active"><a type="0" href="#" onclick="get_today()" class="">Today's Added</a></li>
								<li><a type="1" onclick="get_all()" href="#" class="">Available Stock </a></li>
								
							</ul>
    	
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
                                            <th>Brand Name</th>
                                            <th>Quantity</th>
                                                                                       
                                            <th>Minimum</th>
                                            <th>Date</th>
                                             <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;" id="data">
							
							
						</div>
							

							<?php if (empty($bar_today_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($bar_today_stock as $val): ?>
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
                                            <a href="<?php echo base_url().'manager/inventory/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
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
                                           <th>Brand Name</th>
                                            <th>Quantity</th>
                                           
                                            <th>Minimum </th>
                                            <th>Date</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
								
							
						</div>
							

							<?php if (empty($bar_all_stock)): ?>
								<div class="alert alert-danger">

									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($bar_all_stock as $val): ?>
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

                                            <a href="<?php echo base_url().'manager/inventory/add/'. base64_encode($val->id);?>" class="btn btn-info">Edit </a>
                                            </td>

                                        </tr>
									<?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        

    </div>
  	
  </div>
</div>

<script>
  $(function () {
    $('#myTab a:first').tab('show')
  })
</script>



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
                        $.post("<?php echo site_url('manager/inventory/filter'); ?>",{select:select},
                        function(data){
                                //alert(data);

                               
                              //$('.container-fluid').html(data);
                                
                                });
					}

			function select2(){
				$(location).attr('href'," <?php echo site_url('manager/inventory/filter'); ?>/"+$('#item2').val());
			}
		</script>
	</body>
</html>