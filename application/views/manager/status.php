<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function deleteItem(event){
				item = $(event.target);
				statusid = item.attr('itemid');

				$('#btnDelete').attr('href', "<?php echo site_url('manager/status/delete'); ?>" + '/' + statusid);
			}
		</script>
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
                        Status
                        </div>
                        <div class="panel-body">
                        <?php if ($this->session->flashdata('successmsg') != ''): ?>
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
                                            <!-- <th>Delete</th> -->
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Menu Type
							<a href="<?php echo site_url('manager/status/add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Status</a>
						</div>
							

							<?php if (empty($status)): ?>
								<div class="alert alert-danger">
									There are no Menu Types to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($status as $st): ?>
										<tr class="odd gradeX">
                                            <td>
                                            <?php echo $st->status;?>
                                            </td>
                                            <td>
                                            	<a href="<?php echo site_url('manager/status/edit/' . $st->id); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                           <!--  <td><a href="#confirm-modal" statusid="<?php echo $st->id; ?>" onclick="deleteItem(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td> -->
                                            
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
				<a href="<?php echo site_url('manager/status/delete/'); ?>" id="btnDelete" class="btn btn-large transition">Yes</a>
				&nbsp;&nbsp;
				<a href="#" data-dismiss="modal" class="btn btn-large">No</a>
			</div>
		</div>
		<script type="text/javascript">
		$( "#status" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/status/filter/'); ?>/"+$('#item').val());
		});

		$( "#arrange" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/status/orderBy/'); ?>/"+$('#arrange').val());
		});
		</script>
	</body>
</html>