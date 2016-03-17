<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
		
			function featured_item(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$.ajax({
         type: "GET",
         url: "<?php echo site_url('manager/menuitems/featured_item'); ?>" + '/' + accountid,
         
         success: function(data){
          
      $('#tbody1').html(data);
    location.reload();   
      
     }
    });
			}

			function unfeatured_item(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$.ajax({
     type: "GET",
     url: "<?php echo site_url('manager/menuitems/unfeatured_item'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('.table-responsive').html(data);
      location.reload();   
      
     }
    });
			}


      function searchMenuFor_res(searchstring){
        //remove the active class from all the list items

       
        $('#tbody1').hide();

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('manager/menuitems/search_res'); ?>",
          data: "search=" + searchstring,
          success: function(data, textStatus){
            $('#tbody1').html(data);
            $('#tbody1').fadeIn();
          }
        });
      } 

      function searchMenuFor_bar(searchstring){
        //remove the active class from all the list items
      
       
        $('#tbody2').hide();

        $.ajax({
          type: "POST",
          url: "<?php echo site_url('manager/menuitems/search_bar'); ?>",
          data: "search=" + searchstring,
          success: function(data, textStatus){
            $('#tbody2').html(data);
            $('#tbody2').fadeIn();
          }
        });
      }

      function searchmenu(searchstring){
      $('#searchbox_res').keyup(function(e){
          
            searchstring = $('#searchbox_res').val();
            searchMenuFor_res(searchstring);
            //return false;
        });

      $('#searchbox_bar').keyup(function(e){
          
            searchstring = $('#searchbox_bar').val();
            searchMenuFor_bar(searchstring);
            //return false;
        });
          
    }


			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$.ajax({
     type: "GET",
     url: "<?php echo site_url('manager/menuitems/delete'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('#page-wrapper').html(data);
      location.reload();   
      
     }
    });
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
                       <div class='search-form'>

							
						</div>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                  <li id="a" role="presentation" class="active"><a href="#home" class="btn btn-info" aria-controls="home" role="tab" data-toggle="tab">Restro</a></li>
                                  <li id="b" role="presentation"><a href="#profile" class="btn btn-warning" aria-controls="profile" role="tab" data-toggle="tab">Cafe One Six</a></li>
                                  <li id="c" role="presentation"><a href="#bar" class="btn btn-danger" aria-controls="bar" role="tab" data-toggle="tab">BAR</a></li>
                            </ul>   

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">
      
      <?php     if ($this->session->flashdata('successmsg_restro') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg_restro'); ?></h4>
                                </div>
                            <?php endif; ?>
                       

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Menu Item</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Featured Item</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbody1">
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
                            <span class ='text text-info'>Biryani House Menu Item</span>

                            <a href="<?php echo site_url('manager/menuitems/restro_add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Menu Item</a>
                            <div style="float:right;margin-right:12px">
                
                               Search :<input onkeyup="searchmenu(event)" type="text" id="searchbox_res" placeholder="Search MenuItem" title="Search ">
                          </div>
                        </div>
                            

                            <?php if (empty($biryani_menuitems)): ?>

                                <div class="alert alert-danger">

                                    There are no Menu Types to display.
                                </div>
                            <?php endif; ?>
                            

                          
                                    <?php foreach ($biryani_menuitems as $menuitem): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $menuitem->name;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('manager/menuitems/edit_res/' . base64_encode($menuitem->id)); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td>
                                           <?php  if ($menuitem->featured_item == 1) { ?>
                                           
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="unfeatured_item(event)" data-toggle="modal" class="btn btn-success">Un featured</a></td>

                                           <?php }
                                           else {?>

                                            <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="featured_item(event)" data-toggle="modal" class="btn btn-danger">featured</a></td>

                                           <?php } ?>
                                           
                                           
                                            
                                        </tr>
                                         
                                    <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>



                            </div>





  </div>
  <div role="tabpanel" class="tab-pane" id="profile">
      
      
      <?php     if ($this->session->flashdata('successmsg') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
                                </div>
                            <?php endif; ?>
                       

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Menu Item</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Featured Item</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
                            <span class='text text-warning'>Cafe One Six Menu Item</span>
                            <a href="<?php echo site_url('manager/menuitems/restro_add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Menu Item</a>

                            <div style="float:right;margin-right:12px">
                
                               Search :<input onkeyup="searchmenu(event)" type="text" id="searchbox_bar" placeholder="Search MenuItem" title="Search ">
                          </div>
                        </div>
                            

                            <?php if (empty($cafe_one_six_menuitems)): ?>

                                <div class="alert alert-danger">

                                    There are no Menu Types to display.
                                </div>
                            <?php endif; ?>
                            

                          
                                    <?php foreach ($cafe_one_six_menuitems as $menuitem): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $menuitem->name;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('manager/menuitems/edit_bar/' . base64_encode($menuitem->id)); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td>
                                           <?php  if ($menuitem->featured_item == 1) { ?>
                                           
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="unfeatured_item(event)" data-toggle="modal" class="btn btn-success">Un featured</a></td>

                                           <?php }
                                           else {?>

                                            <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="featured_item(event)" data-toggle="modal" class="btn btn-danger">featured</a></td>

                                           <?php } ?>
                                           
                                           
                                            
                                        </tr>
                                         
                                    <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>



                            </div>

  </div>
 <div role="tabpanel" class="tab-pane" id="bar">
      
      <?php     if ($this->session->flashdata('successmsg_restro') != ''): ?>
                                <div class="alert alert-success" >
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <h4><?php echo $this->session->flashdata('successmsg_restro'); ?></h4>
                                </div>
                            <?php endif; ?>
                       

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Menu Item</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Featured Item</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tbody1">
                         
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
                            <span class ='text text-danger'>BAR Menu Item</span>

                            <a href="<?php echo site_url('manager/menuitems/bar_add'); ?>" class="btn btn-info pull-right transition" style="margin-right:14px;">Add Menu Item</a>
                            <div style="float:right;margin-right:12px">
                
                               Search :<input onkeyup="searchmenu(event)" type="text" id="searchbox_res" placeholder="Search MenuItem" title="Search ">
                          </div>
                        </div>
                            

                            <?php if (empty($bar_menuitems)): ?>

                                <div class="alert alert-danger">

                                    There are no Menu Types to display.
                                </div>
                            <?php endif; ?>
                            

                          
                                    <?php foreach ($bar_menuitems as $menuitem): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                            <?php
                                            echo $menuitem->name;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('manager/menuitems/edit_bar/' . base64_encode($menuitem->id)); ?>" class="btn btn-info">Edit</a>
                                            </td>
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="deleteAccount(event)" data-toggle="modal" class="btn btn-danger">Delete</a></td>
                                           <?php  if ($menuitem->featured_item == 1) { ?>
                                           
                                           <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="unfeatured_item(event)" data-toggle="modal" class="btn btn-success">Un featured</a></td>

                                           <?php }
                                           else {?>

                                            <td><a href="#confirm-modal" accountid="<?php echo $menuitem->id; ?>" onclick="featured_item(event)" data-toggle="modal" class="btn btn-danger">featured</a></td>

                                           <?php } ?>
                                           
                                           
                                            
                                        </tr>
                                         
                                    <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>



                            </div>





  
</div>


<script>
  // $(function () {
  //   $('#myTab a:first').tab('show')
  // })
</script>



                         
                            
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

	
	<script type="text/javascript">

		$(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
		$( "#item" ).change(function() {

			$(location).attr('href'," <?php echo site_url('manager/menuitems/filter/'); ?>/"+$('#item').val());
		});
		</script>
	</body>
</html>