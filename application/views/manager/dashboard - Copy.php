<!DOCTYPE html>
<html>
    <head>
    <?php
      $upper_block_refresh_time=$configruation->upper_block_refresh_time;
      $free_waiter_auto_refresh_time=$configruation->free_waiter_auto_refresh_time;
      $free_table_auto_refresh_time=$configruation->free_table_auto_refresh_time;
      $customer_notification_auto_refresh_time=$configruation->customer_notification_auto_refresh_time;
    ?>
        <title>Biryani House.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <?php echo $dependencies; ?>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
          
        <style type="text/css">
      .pagination > li {
        display: inline;
        float: right !important;
      }
         
     @keyframes throbbler {
            0% {    transform: rotate(0deg);  }
            12.5% {    transform: rotate(0deg);  }
            12.5% {    transform: rotate(45deg);  }
            25% {    transform: rotate(45deg);  }
            25% {    transform: rotate(90deg);  }
            37.5% {    transform: rotate(90deg);  }
            37.5% {    transform: rotate(135deg);  }
            50% {    transform: rotate(135deg);  }
            50% {    transform: rotate(180deg);  }
            62.5% {    transform: rotate(180deg);  }
            62.5% {    transform: rotate(225deg);  }
            75% {    transform: rotate(225deg);  }
            75% {    transform: rotate(270deg);  }
            87.5% {    transform: rotate(270deg);  }
            87.5% {    transform: rotate(315deg);  }
            100% {    transform: rotate(315deg);  }
          }

      .icon-spin:before {
          animation-duration: 1s;  
          animation-name: throbbler;  
          animation-iteration-count: infinite;
          animation-timing-function: linear;
      }

               
    </style>


        <script type="text/javascript">
        // $.noConflict();
// Code that uses other library's $ can follow here.

        $(document).ready(function(){
          
                
                
                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/waiter_count'); ?>" 
                $.post(url,'', function(data){
                            $('#waiter_count').html(data);
                    });
                // console.clear();
                }, <?php echo $upper_block_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/today_payment'); ?>" 
                $.post(url,'', function(data){
                            $('#today_payment').html(data);
                    });
                // console.clear();
                }, <?php echo $upper_block_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/monthly_payment'); ?>" 
                $.post(url,'', function(data){
                            $('#monthly_payment').html(data);
                    });
                // console.clear();
                }, <?php echo $upper_block_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/pending_order'); ?>" 
                $.post(url,'', function(data){
                            $('#pending_order').html(data);
                    });
                // console.clear();
                }, <?php echo $upper_block_refresh_time;?>);

                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/customer_notification'); ?>" 
                $.post(url,'', function(data){
                            $('#customer_notifications').html(data);
                    });
                
                }, <?php echo $customer_notification_auto_refresh_time;?>);

                 setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/order_slip'); ?>" 
                $.post(url,'', function(data){
                            $('#order_slip').html(data);
                    });
                
                }, <?php echo $customer_notification_auto_refresh_time;?>);


                setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/free_waiters'); ?>" 
                $.post(url,'', function(data){
                            $('#free_waiters').html(data);
                    });
                // console.clear();
                },<?php echo $free_waiter_auto_refresh_time;?>);

                              setInterval(function() {
                var url = "<?php echo site_url('manager/dashboard/free_tables'); ?>" 
                $.post(url,'', function(data){
                            $('#free_tables').html(data);
                    });
                // console.clear();
                }, <?php echo $free_table_auto_refresh_time;?>);



                
           
            });

         

          // function freeWaiters(tablenumber){
              
          //    setInterval(function() {
          //       var url = "<?php echo site_url('manager/dashboard/show_free_waiters'); ?>/"+tablenumber 
          //       $.post(url,'', function(data){
          //                   $('#dialog1').html(data);
          //           });
          //       console.clear();
          //       }, <?php echo $free_waiter_auto_refresh_time;?>);
          // }
              
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
                  
                  width: 50% !important;
                  height: 315px !important;
                  /*left: 309px !important;*/
               }
               nav{
                margin-top: 5px !important;
                /*margin-bottom: -43px !important;*/
                
               }
               hr {
                  -moz-border-bottom-colors: none;
                  -moz-border-left-colors: none;
                  -moz-border-right-colors: none;
                  -moz-border-top-colors: none;
                  border-color: #eee -moz-use-text-color -moz-use-text-color;
                  border-image: none;
                  border-right: 0 none;
                  border-style: solid none none;
                  border-width: 1px 0 0;
                  margin-bottom: 10px;
                  margin-top: 0;
              }

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
       <!--  <pre>
          <?php print_r($this->session->all_userdata()); ?>
          </pre> -->
                    <div class="col-md-12">
                    <br/>
                      </div>
        </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">           
                <div class="panel panel-back noti-box" style="padding:5px;">
                <span class="icon-box bg-color-red set-icon">
                <div id="waiter_count">

                </div>
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.5em;">Available</p>
                    <p class="text-muted">Waiters</p>
              </div>
               </div>
         </div>
        <div class="col-md-3 col-sm-12 col-xs-12" id="today_payment_div">           
          <div class="panel panel-back noti-box" style="padding:5px;">
                <span class="icon-box bg-color-green set-icon" style="font-size:20px;">
                   <div id="today_payment">
                    
                  </div>
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.5em;">Payment</p>
                    <p class="text-muted">Today</p>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-12 col-xs-12" id="monthly_payment_div"> 
        <input type="hidden" value="1" id="month"/>          
            <div class="panel panel-back noti-box" style="padding:5px;">
                <span class="icon-box bg-color-blue set-icon" style="font-size:20px;">
                    <div id="monthly_payment">
                    
                    </div>
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.5em;">Payment</p>
                    <p class="text-muted">Monthly</p>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-12 col-xs-12 close_modal" data-toggle="modal" data-target="#myModal2">           
            <div class="panel panel-back noti-box" style="padding:5px;" >
                <span class="icon-box bg-color-brown set-icon">
                <div id="pending_order"  >            

               </div>

                  
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.5em;">Orders</p>
                    <p class="text-muted">Pending</p>
                </div>
             </div>
         </div>
      </div>
                 
                <hr />                
              

                <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12" >
                      <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                          
                            <i class="fa fa-comments fa-fw"></i>
                           Orders Slip
                            <?php $manager_id = $this->session->userdata('userid'); ?>
                           <div style="float:right;">
                           <form style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;" action="<?php echo site_url().'manager/dashboard/customer_order_call/'.$manager_id;?>" method="post">
                             <input class="btn-success" type="submit" value="Take Away" >                             
                           </form>
                         
                         </div>
                        </div>
                     
                          
                      
                         <div class="panel-body" id="order_slip">
                         <div class="text-center">
                              <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
                          </div>

                         </div>
                         </div>
                    </div>


                    <div class="col-md-6 col-sm-12 col-xs-12" >
                      <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Notifications
                        </div>
                         <div class="panel-body" id="customer_notifications">
                         <div class="text-center">
                              <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
                          </div>

                         </div>
                         </div>
                    </div>
                          <div class="col-md-6 col-sm-12 col-xs-12">
                                   <div class="panel panel-default" >

                                      <div class="panel-heading">
                                    <i class="fa fa-user fa-fw"></i>Free Waiters
                                      </div>
                                      <div class="panel-body" id="free_waiters" style="max-height: 269px;overflow-y: scroll;">
                                       <div class="text-center">
                                          <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
                                      </div>

                                      </div>
                                      
                                      
                                      </div>

                                      <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          
        </h4>
      </div>
      
       <div class="modal-body" id="khushi">
        
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade close_modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel1"></h4>
      </div>
      <div class="modal-body" id="khushi1">
        
      </div>
       
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
 -->      </div>
    </div>
  </div>
</div>


<div class="modal fade close_modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">
          Pending Orders Information
        </h4>
      </div>
      
       <div class="modal-body" id="pending_order">
        <div class="row">

                                              <?php foreach ($pending_order_info as $info): ?>
                                              <div class="col-sm-4 col-md-4">
                                                <div class="text-center" style="background-color: #d9edf7;">
                                                  <div class="">
                                                  <div>
                                                  <img class="img-thumbnail " width="30%" height="30%" style="margin-top:8px;margin-bottom:-8px;" src="<?php echo base_url() . 'assets/img/default.png'?>" alt="...">
                                                  <div class="caption1">
                                                    <h5 class="text-center"><?php echo $info['customername']." on Table No [".$info['tablenumber']."]";?></h5>
                                                    </div>
                                                    </div>
                                                    <div class="text-center">
                                                    <table  class="table table-hover aler alert-warning">
                                                      <?php if(array_key_exists($info['id'],$orderitems)){                                                      ?>
                                                      <?php foreach ($orderitems[$info['id']] as $item):

                                                      ?>
                                                      <tr >
                                                        <td><?php echo $item['name'];?></td>
                                                        <td><?php echo $item['quantity'];?></td>
                                                      </tr>
                                                      
                                                     <?php endforeach; ?>
                                                     <?php } ?>
                                                     </table>
                                                    </div>
                                        

                                                  </div>
                                                </div>
                                              </div>
                                                <?php endforeach; ?>
                                            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                                      
                                <!-- ui-dialog -->
                                          <div id="dialog" title="Select Any" >
                                          </div>
                                          <div id="dialog1" title="Select Any" >
                                          </div>
                                          <div id="dialog_pending_order" title="Order Info" style="display:none;" >
                                              

                                          </div>
                                <!-- ui-dialog -->

                          
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <i class="fa fa-bell fa-fw"></i>Free Tables
                                      </div>
                                      <div class="panel-body" id="free_tables" style="max-height: 230px;overflow-y: scroll;">
                                      
                                           <div class="text-center">
                                              <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
                                          </div>

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
     
    <!-- METISMENU SCRIPTS -->
      
   
     <!-- DATA TABLE SCRIPTS -->
    <script type="text/javascript">
        




    
        $('#today_payment_div').click(function(){
            $(location).attr('href',"<?php echo site_url('manager/orders'); ?>");          
        });
          
        $('#monthly_payment_div').click(function(){
            $(location).attr('href',"<?php echo site_url('manager/orders/?month=1'); ?>");          
        });

    </script>
    </body>
</html>
   

