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
     url: "<?php echo site_url('manager/useraccounts/delete'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('#page-wrapper').html(data);
      location.reload();   
      
     }
    });
			}


			function getMenuItems(event){
				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/menuitems/get_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
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
                        Make Menu Enable/Disable
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
                            	<div class="singlecontent padding-10px">
							<ul class="nav nav-pills">
							<li class="active"><a type="0" href="#" onclick="getMenuItems(event)" class="">All</a></li>
								
								<?php 

								foreach ($menutypes as $menutype) { ?>

									<li class="active"><a type="<?php echo $menutype->id;?>" href="#" onclick="getMenuItems(event)" class=""><?php echo $menutype->menutype_name;?></a></li>
								<?php } ?>
							</ul>
							<?php echo $menucontent; ?>
						</div>
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
      	

		$( "#user" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter/'); ?>/"+$('#user').val());
		});
		$( "#role" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/useraccounts/filter_by_role/'); ?>/"+$('#role').val());
		});
		</script>
	</body>
</html>