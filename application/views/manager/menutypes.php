<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$.ajax({
     type: "GET",
     url: "<?php echo site_url('manager/menutype/delete'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('#page-wrapper').html(data);
      location.reload();   
      
     }
    });
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
								<option value="All">Select Menu Type</option>
								<option value="All">All</option>
								<?php foreach ($menutypes_name as $menutype) {?>
								<option value="<?php echo $menutype->id;?>"><?php echo $menutype->menutype_name;?></option>
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
                                            <th>Menu Type</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Menu Type
							<a href="<?php echo site_url('manager/menutype/add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Menu Item</a>
						</div>
							

							<?php if (empty($menutypes)): ?>
								<div class="alert alert-danger">
									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($menutypes as $menutype): ?>
										<tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $menutype->menutype_name;?>
                                            </td>
                                            <td>
                                            	<a href="<?php echo site_url('manager/menutype/edit/' . base64_encode($menutype->id)); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                            <td><a href="#confirm-modal" accountid="<?php echo $menutype->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td>
                                            
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
		<a href="<?php echo site_url('manager/menutype'); ?>" id="btnDelete" class="btn btn-large transition">Yes</a>
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
			$(location).attr('href'," <?php echo site_url('manager/menutype/filter/'); ?>/"+$('#type').val());
		});
		</script>
	</body>
</html>