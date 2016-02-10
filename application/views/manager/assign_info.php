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
     url: "<?php echo site_url('manager/assign/delete'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('#page-wrapper').html(data);
      location.reload();   
      
     }
    });
			}
		</script>
		<style type="text/css">
			.pagination > li {
			  display: inline;
			  float: right !important;
			}

			.tablenumber {
				 background-color: #e4f4ff ! important;
			    font-size: 40px;
			    margin-right: 20px;
			    overflow: auto;
			    padding: 20px;
			    text-align: center;
			    width: 40px;
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
						<select name='user' id="user">
							<option value="All">Select Waiter</option>
							<option value="All">All</option>
							<?php foreach ($waiters_name as $as) {?>
							<option value="<?php echo $as->id;?>"><?php echo $as->fname." ".$as->lname ;?></option>
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
                                            <th>Table Number</th>
                                            <th>Waiter</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                     
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							
							<a href="<?php echo site_url('manager/assign'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Assign Table</a>
						</div>
							

							<?php if (empty($assign_info)): ?>
								<div class="alert alert-danger">
									Records Not found.
								</div>
							<?php endif; ?>
                                   <?php foreach ($assign_info as $as): ?>
                                        <tr class="odd gradeX">
                                        <td class="tablenumber alert alert-primery rounded-4px1 ">
           								<b><?php echo $as->tablenumber; ?></b>
	          							</td>
                                            <td>
                                           <?php echo $as->fname." ".$as->lname;?></p>	
                                            </td>
                                            <td>
                                            	<a href="<?php echo site_url('manager/assign/edit/' . base64_encode($as->id)); ?>" class="btn btn-info transition">Edit</a>
                                            </td>
                                            <td><a href="#confirm-modal" accountid="<?php echo $as->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td>
                                            
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


	 <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.10.2.js'?>"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    
      
    
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

		<script type="text/javascript">
      	$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });

		$( "#user" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/assign/filter/'); ?>/"+$('#user').val());
		});
		</script>
	</body>
</html>