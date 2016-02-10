<!DOCTYPE html>
<html>
    <head>
    
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
         

               
    </style>


        <script type="text/javascript">
        // $.noConflict();
// Code that uses other library's $ can follow here.

  function setAsDelivereditem(event){
   
        order = $(event.target);
        orderid = order.attr('orderid');
        ogorderid = order.attr('ogorderid');
        numrow = order.attr('numrow');
        if (!order.hasClass('disabled')){
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('waiter/orders/setasdelivered_item'); ?>",
            data: "numrow=" + numrow + "&orderid=" + ogorderid + "&id=" + orderid + "&status=" + 3,
            success: function(data, textStatus){
              order.parent().parent().fadeOut();
            }
          });
        }
      }

  function order_notification()
  {

    var url = "<?php echo site_url('waiter/dashboard/order_notification'); ?>" 
                $.post(url,'', function(data){
                            $('#order_notifications').html(data);
                    }); 
                   console.clear();
  }

  function free_table()
  {

     var url = "<?php echo site_url('waiter/dashboard/free_tables'); ?>" 
                $.post(url,'', function(data){
                            $('#free_tables').html(data);
                    });
   
  }

        $(document).ready(function(){
          
                
                order_notification();
                free_table();

                setInterval(function() {
                var url = "<?php echo site_url('waiter/dashboard/free_tables'); ?>" 
                $.post(url,'', function(data){
                            $('#free_tables').html(data);
                    });
                 console.clear();
                },3000);


                  setInterval(function() {
                var url = "<?php echo site_url('waiter/dashboard/order_notification'); ?>" 
                $.post(url,'', function(data){
                            $('#order_notifications').html(data);
                    });
                 console.clear();
                },3000);




                
           
            });

         

         
              
        </script>
        <style type="text/css">
             .cart-header-modal-top {
       background: none repeat scroll 0 0 #bf5656;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
}
  .cart-header-modal-bottom {
   
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
}
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
                    
                 <!-- /. ROW  -->
             
                          
              

                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12" >
                      <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                             Pending Orders 
                        </div>
                         <div class="panel-body" id="order_notifications">

                         </div>
                         </div>
                    </div>
                          <div class="col-md-6 col-sm-12 col-xs-12">

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
      <div class="modal-header cart-header-modal-top">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel1"></h4>
      </div>
      <div class="modal-body" id="customer" style="height:auto;">
        
      </div>
       
      <div class="modal-footer  cart-header-modal-bottom ">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      
     </div>
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
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
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
                                        <i class="fa fa-bell fa-fw"></i>Take Order
                                        <span style="float:right;"> 
                                        <div style="border-radius: 100%; float:left;background-color: #ebccd1; width: 20px; height: 20px;">

                                        </div>
                                        <span> &nbsp;Assign Table</span>
                                    
                                       
                                    

                                       

                                         </span>
                                      </div>
                                      <div class="panel-body" id="free_tables" style="max-height: 430px;overflow-y: scroll;">
                                      
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
   

