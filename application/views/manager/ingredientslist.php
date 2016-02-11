<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');
				var res=confirm('Are You Sure??');
				if(res==true){

					$.ajax({
					     type: "GET",
					     url: "<?php echo site_url('manager/ingredients/delete'); ?>" + '/' + accountid,
					     
					     success: function(data){
					      
					      //$('#page-wrapper').html(data);
					      location.reload();   
					      
					     }
					    });
					}
				
			}
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
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-heading">
                        <div class='search-form'>
							<select name='type' id="type">
								<option value="All">Select Ingredients</option>
								<option value="All">All</option>
								<?php foreach ($ingredientss_name as $ingredients) {?>
								<option value="<?php echo $ingredients->id;?>"><?php echo $ingredients->ingredients_name;?></option>
								<?php }?>

							</select>
						</div>
                        </div>
                        <div class="panel-body">
                        <?php 	if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>
                       
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ingredients</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Menu Type
							<a href="<?php echo site_url('manager/ingredients/add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Ingredient</a>
						</div>
							

							<?php if (empty($ingredients)): ?>
								<div class="alert alert-danger">
									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($ingredients as $ingredients): ?>
										<tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $ingredients->name;?>
                                            </td>
                                            <td>
                                            	<a href="<?php echo site_url('manager/ingredients/edit/' . base64_encode($ingredients->id)); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                            <td><a href="" accountid="<?php echo $ingredients->id; ?>" onclick="deleteAccount(event)"  class="btn btn-danger">Delete</a></td>
                                            
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
		</div>
		<div class="modal hide fade" id="confirm-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Are you sure?</h3>
	</div>
	<div class="modal-body">
		<p>Are you sure you want to delete this entry?</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo site_url('manager/ingredients'); ?>" id="btnDelete" class="btn btn-large transition">Yes</a>
		&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large">No</a>
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
<script type="text/javascript">

$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
		$( "#type" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/ingredients/filter/'); ?>/"+$('#type').val());
		});
		</script>
	</body>
</html>