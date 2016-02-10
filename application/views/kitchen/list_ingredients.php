<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		
		<script type="text/javascript">
			function searchMenu(searchstring){
				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('#tbody').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/ingredients/search'); ?>",
					data: "search=" + searchstring,
					success: function(data, textStatus){
						$('#tbody').html(data);
						$('#tbody').fadeIn();
						$('.menu-loading').hide();
					}
				});
			}

			function searchmenu(searchstring){
			$('#searchbox').keyup(function(e){
					
						searchstring = $('#searchbox').val();
						searchMenu(searchstring);
						//return false;
					
				});
		}

			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$('#btnDelete').attr('href', "<?php echo site_url('kitchen/ingredients/delete'); ?>" + '/' + accountid);
			}

			function ActiveAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				   $.ajax({
          type: "POST",
          url: "<?php echo site_url('kitchen/ingredients/active'); ?>" + '/' + accountid,
          data: "accountid="+accountid,
          success: function(data, textstatus){
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
						<select name='user' id="ing">
							<option value="All">Select Ingrediant</option>
							<option value="All">All</option>
							<?php foreach ($ingr_name as $ing) {?>

								<option value="<?php echo $ing->id;?>"><?php echo $ing->name;?></option>

								<?php }?>

						</select>
						<div style="float:right;">
								Search :
									  <input onkeyup="searchmenu(event)" type="text" id="searchbox" placeholder="Search Ingredient" title="Search Ingredient By Key">
							</div>
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
                                            <th>Ingredient Name</th>
                                            <th>Qty</th>
                                            <th>Minimum</th>
                                            <th>Quantity</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                     
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Ingredients
							<a href="<?php echo site_url('kitchen/ingredients/addIngName'); ?>" class="btn btn-info pull-right" style="margin-right:14px;">
							Add Ingredients
							</a>
						</div>
							
							<div id="loading" class="hide menu-loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>


							<?php if (empty($ingredients)): ?>
								<div class="alert alert-danger">
									There are no Ingredients to display.
								</div>
							<?php endif; ?>
							
                                   <?php foreach ($ingredients as $ingr): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            	<?php echo $ingr->name;?>
                                            </td>
                                            <td class="odd gradeX" width="150px;">
                                            	<?php echo $ingr->quantity;?>
                                            </td>
                                            <td>
                                            	<?php echo $ingr->min_ingr;?>
                                            </td>
                                            <td>
                                            <a href="<?php echo site_url('kitchen/ingredients/add/' . base64_encode($ingr->id)); ?>" class="btn btn-success">Quantity</a>
                                            </td>
                                            <td>
                                            <a href="<?php echo site_url('kitchen/ingredients/edit/' . base64_encode($ingr->id)); ?>" class="btn btn-info transition">Edit</a>
                                            </td>
                                            <td>
											<a href="#confirm-modal" accountid="<?php echo $ingr->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a>
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
		</div>

<?php echo $deleteconfirm; ?>
      <!-- BOOTSTRAP SCRIPTS -->
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    
      
    
         <!-- CUSTOM SCRIPTS -->
   

		<script type="text/javascript">
      	$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });

		$( "#ing" ).change(function() {
			$(location).attr('href'," <?php echo site_url('kitchen/ingredients/filter/'); ?>/"+$('#ing').val());
		});
		$( "#role" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter_by_role/'); ?>/"+$('#role').val());
		});
		</script>
	</body>
</html>