<!DOCTYPE html>
<html>
    <head>
    <?php
      $auto_refresh_time=$configruation->auto_refresh_time;
    ?>
        <title>Biryani House.</title>
        <?php echo $dependencies; ?>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <link href="<?php echo base_url() . 'assets/jquery/jquery-ui.css'; ?>" rel="stylesheet">
        <script type="text/javascript">

        $(document).ready(function(){

             
                
                console.clear();
                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/waiter_count'); ?>" 
                $.post(url,'', function(data){
                            $('#waiter_count').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/today_payment'); ?>" 
                $.post(url,'', function(data){
                            $('#today_payment').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/monthly_payment'); ?>" 
                $.post(url,'', function(data){
                            $('#monthly_payment').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/pending_order'); ?>" 
                $.post(url,'', function(data){
                            $('#pending_order').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/customer_notification'); ?>" 
                $.post(url,'', function(data){
                            $('#customer_notifications').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);

                

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/free_waiters'); ?>" 
                $.post(url,'', function(data){
                            $('#free_waiters').html(data);
                    });
                console.clear();
                },<?php echo $auto_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/free_tables'); ?>" 
                $.post(url,'', function(data){
                            $('#free_tables').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);
                
            });

          function freeTables(waiter_id){
             $('.ui-dialog #dialog').show();
             $('.ui-dialog #dialog1').closest('.ui-dialog #dialog1').hide();
              $( "#dialog" ).dialog({
                autoOpen: true,
                height: 600,
                stack: true,
                sticky: true //uses ui dialog extension to keep it fixed
     });
             setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/show_free_tables'); ?>/"+waiter_id 
                $.post(url,'', function(data){
                            $('#dialog').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);
          }

          function freeWaiters(tablenumber){
              $('.ui-dialog #dialog1').show();
              $('.ui-dialog #dialog').closest('.ui-dialog #dialog').hide();
              $( "#dialog1" ).dialog({
                autoOpen: true,
                height: 600,
                stack: true,
                sticky: true //uses ui dialog extension to keep it fixed
               });
             setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/show_free_waiters'); ?>/"+tablenumber 
                $.post(url,'', function(data){
                            $('#dialog1').html(data);
                    });
                console.clear();
                }, <?php echo $auto_refresh_time;?>);
          }
              
        </script>
        <style type="text/css">
            .pagination > li {
              display: inline;
              float: right !important;
            }
            .img-thumbnail{
                width: 75px;
                height: 75px;

               }
               #dialog{
                display: none;
               }
               .ui-dialog{
                  top: 300px !important;
                  width: 497px !important;
                  height: 315px !important;
                  left: 309px !important;
               }
               nav{
                margin-top: 24px !important;
                margin-bottom: -43px !important;
                
               }

               
        </style>
    </head>

    <body>
<div id="wrapper">
 <?php echo $header;?>
        <?php echo $sidebar;?>

       
           <!-- /. NAV TOP  -->
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <div id="info">
        <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $username->fname." ".$username->lname; ;?> , Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
                <div class="panel panel-back noti-box" >
                <span class="icon-box bg-color-red set-icon">
                <div id="waiter_count">

                </div>
                </span>
                <div class="text-box" >
                    <p class="main-text ">Available</p>
                    <p class="text-muted">Waiters</p>
              </div>
               </div>
         </div>
        <div class="col-md-3 col-sm-6 col-xs-6">           
          <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon" style="font-size:20px;">
                   <div id="today_payment">
                    
                  </div>
                </span>
                <div class="text-box" >
                    <p class="main-text">Payment</p>
                    <p class="text-muted">Today</p>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-3 col-xs-3">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon" style="font-size:20px;">
                    <div id="monthly_payment">
                    
                    </div>
                </span>
                <div class="text-box" >
                    <p class="main-text">Payment</p>
                    <p class="text-muted">Monthly</p>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-3 col-xs-3">           
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                  <div id="pending_order">
                   
                  </div>
                </span>
                <div class="text-box" >
                    <p class="main-text">Orders</p>
                    <p class="text-muted">Pending</p>
                </div>
             </div>
         </div>
      </div>
                 
                <hr />                
              

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6" id="customer_notifications">
                      
                    </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="panel panel-default">
                            <div class="panel-heading">
                              Free Waiters
                            </div>
                            <div class="panel-body" id="free_waiters" style="max-height: 300px;overflow-y: scroll;">
                            </div>
                            
                            
                            </div>
<!-- ui-dialog -->
          <div id="dialog" title="Select Any" >
          </div>
          <div id="dialog1" title="Select Any" >
          </div>
<!-- ui-dialog -->

                
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              Free Tables
                            </div>
                            <div class="panel-body" id="free_tables" style="max-height: 300px;overflow-y: scroll;">
                            
                            </div>
                        </div>
                         
                    </div>
                    </div>
                        
                      
                </div>

            </div>
                
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     
   <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery-1.10.2.js'?>"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/jquery/jquery.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/jquery/jquery-ui.js'?>"></script>
    
         <!-- CUSTOM SCRIPTS -->
    
    </body>
</html>
   

