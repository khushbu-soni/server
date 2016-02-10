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
      .noti-box {
          min-height: 37px;
          /*padding: 20px;*/
      }

          .noti-box .icon-box {
display: block;
float: left;
margin: -10 15px 10px 0;
width: 70px;
height: 50px;
line-height: 75px;
vertical-align: middle;
text-align: center;
font-size: 40px;
padding-top: -20px;
}
          
.text-box p{
    margin: -20px 0 3px;
}   
    </style>


        <script type="text/javascript">

     
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
                
                }, 2000);


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
               
                console.clear();
                }, <?php echo $free_table_auto_refresh_time;?>);



                
           
            });
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

                .form-horizontal input {
            height: 35px;
        }

        .table-bordered {
          font-size: smaller;
          /* border:none !important;*/
          }
            .stat {
    border-right: 1px solid #e8e9ee;
    box-shadow: 1px 0 0 0 white;
    padding: 25px 0 30px;
    position: relative;
    text-align: right;
}

  .searchable-container{margin:20px 0 0 0}
.searchable-container label.btn-default.active{background-color:#007ba7;color:#FFF}
.searchable-container label.btn-default{width:90%;border:1px solid #efefef;margin:5px; box-shadow:5px 8px 8px 0 #ccc;}
.searchable-container label .bizcontent{width:100%;}
.searchable-container .btn-group{width:90%}
.searchable-container .btn span.glyphicon{
    opacity: 0;
}
.stats-row {
    box-shadow: -1px 0 5px 2px #f9f9f9 inset;
    margin: 0;
}
.searchable-container .btn-group {
    width: 106%;
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
                <div class="col-md-3 col-sm-12 col-xs-12 ">           
                <div class="panel panel-back noti-box " style="padding:0px;">
                <span class="icon-box bg-color-red1 set-icon1" >
                <div id="waiter_count">

                </div>
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.2em;">Available</p>
                    <small>Waiters</small>
              </div>
               </div>
         </div>
        <div class="col-md-3 col-sm-12 col-xs-12" id="today_payment_div">           
          <div class="panel panel-back noti-box" style="padding:0px;">
                <span class="icon-box bg-color-green1 set-icon1" >
                   <div id="today_payment">
                    
                  </div>
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.2em;">Payment</p>
                    <small>Today</small>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-12 col-xs-12" id="monthly_payment_div"> 
        <input type="hidden" value="1" id="month"/>          
            <div class="panel panel-back noti-box" style="padding:0px;">
                <span class="icon-box bg-color-blue1 set-icon1" >
                    <div id="monthly_payment">
                    
                    </div>
                </span>
                <div class="text-box">
                    <p class="main-text" style="font-size:1.2em;">Payment</p>
                    <small>Monthly</small>
                </div>
             </div>
             </div>
        <div class="col-md-3 col-sm-12 col-xs-12 close_modal" data-toggle="modal" data-target="#myModal2">           
            <div class="panel panel-back noti-box" style="padding:0px;" >
                <span class="icon-box bg-color-brown1 set-icon1" >
                <div id="pending_order"  >            

               </div>

                  
                </span>
                <div class="text-box" >
                    <p class="main-text" style="font-size:1.2em;">Orders</p>
                    <small>Pending</small>
                </div>
             </div>
         </div>
      </div>
                 
                <hr />                
              

                <div class="row">

                <div class="col-md-7 col-sm-12 col-xs-12" >
                      <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                          
                            <i class="fa fa-comments fa-fw"></i>
                           Orders Slip
                            <?php $manager_id = $this->session->userdata('userid'); ?>
                           <div style="float:right;">
                           <!-- <form style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;" action="<?php echo site_url().'manager/dashboard/customer_order_call/'.$manager_id;?>" method="post">
                             <input class="btn-success" type="submit" value="Take Away" >                             
                           </form> -->

                           <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" id="take_order_btn" data-target="#myModal3">
                            Take Order
                          </button>

<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Place Order</h4>
      </div>
      <link rel="stylesheet" href="<?php echo base_url() . 'assets/autocomplete/fm.selectator.jquery.css';?>"/>
  <style>
      
    #select4 {
      width: 350px;
      height: 36px;
      margin-bottom: 9px !important; 
    }

     #selectator_select4 {
      margin-bottom: 9px !important; 
    }

     #selectator_select5 {
      margin-bottom: 10px;
      margin-left: 9px; 
    }

     #selectator_select6 {
      margin-left: 13px; 
    }

        #select5 {
      width: 350px;
      height: 36px;
    }   

    #select6 {
      width: 350px;
      height: 36px;
    }   
      #el {
      width: 350px;
      height: 36px;
      border: 1px solid #D0D1D4;
box-sizing: border-box;
background-color: #FFF;
display: inline-block;
text-decoration: none;
    }  
     .select8 {
      border: 1px solid #D0D1D4;
box-sizing: border-box;
background-color: #FFF;
display: inline-block;
text-decoration: none;
      width: 300px;
      height: 36px;
    }   
      
      
  </style>
  
      <div class="modal-body">
        <label for="select4">
      Biryani House Menu Item:
    </label>
  
    <select id="select4" name="select4" multiple required>
      <optgroup label="" class="group_one">
        <?php foreach ($this->data['biryani_menuitems'] as $biryani_menuitems) {?>
          
        <option value="<?php echo $biryani_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $biryani_menuitems['name'];?>" ><?php echo $biryani_menuitems['item_no'];?></option>
        <?php }?>
        <?php if(empty($this->data['biryani_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator4" type="button">

     <label for="select5">
      Cafe One Six Menu Item:
    </label>

    <select id="select5" name="select5" multiple required>
      <optgroup label="" class="group_one">
      <?php if(!empty($this->data['cafe_menuitems'])) {    ?>
        <?php foreach ($this->data['cafe_menuitems'] as $cafe_menuitems) {?>
          
        <option value="<?php echo $cafe_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $cafe_menuitems['name'];?>" ><?php echo $cafe_menuitems['item_no'];?></option>
        <?php }?>
        <?php }?>

        <?php if(empty($this->data['cafe_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator5" type="button">
      <!-- Button trigger modal -->

<label for="select6">
      BAR Menu Item:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </label>

    <select id="select6" name="select6" multiple required>
      <optgroup label="" class="group_one">
        <?php if(!empty($this->data['bar_menuitems'])) {?>
        <?php foreach ($this->data['bar_menuitems'] as $bar_menuitems) {?>
          
        <option value="<?php echo $bar_menuitems['item_no'];?>" class="option_one" data-subtitle="<?php echo $bar_menuitems['name'];?>" ><?php echo $bar_menuitems['item_no'];?></option>
        <?php }?>
        <?php }?>
        <?php if(empty($this->data['bar_menuitems'])) {    ?>
       
        <option value="" class="option_one" data-subtitle="No Items Available" >No Items Available</option>
        <?php }?>
      </optgroup>
      
    </select>
    <input style="display:none;" value="activate selectator" id="activate_selectator6" type="button">

<div>
    <label style="padding: 19px 52px 14px 44px;">
      ETHNICITY:
    </label>

              <select class='form-control ' id='el' name='el' required>
              <option value='indian'>INDIAN</option>
              <option value='ugandian'>UGANDAN</option>
              <option value='muzungu'>MUZUNGU</option>
                
              </select> 
<br/>
    <label style="padding: 19px 52px 14px 44px;">
      SPICEY: &nbsp;
    </label>

              <select class='form-control input-lg1 select8' id='sl' name='sl'>
              <option value='mild'>MILD</option>
              <option value='medium'>MEDIUM</option>
              <option value='spicy'>SPICY</option>
              </select>
</div class='text-center'>
<button type="submit"  id="add" class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal" data-target="#myModal4">
  Add
</button>

<button type="submit"  id="add_order" class="btn btn-danger btn-sm"  data-toggle="modal" data-dismiss="modal" data-target="#myModal4">
  Add
</button>
<p id="msg" style="color:red; text-align:center">Please Provide Item No.</p>
<input type="hidden" value="" id="select_order" />
<input type="hidden" value="" id="order_add_type" />

<!-- Modal -->

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div>
</div>


                         
                     <!--  Add Item button Modal-->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="-">-</button>
        <h4 class="modal-title" id="myModalLabel">Please Confirm</h4>
        <input type="text" value="" name="item_list" id="itemlist"/>
        <input type="hidden" value="" name="order_type" id="order_type"/>
        <h4 id="order_placed_msg">Order has been Placed..</h4>
        <button type="button" id="close_box"   class="btn btn-pink" >Close</button>
        <!-- <button type="button" id="kot" class="btn btn-danger" >Genrate KOT</button> -->
        <button type="button" id="placeorder"  class="btn btn-primary">Place Order</button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        
        <button class="btn btn-info btn-lg" id='take_away'>Take Away</button>
        <button class="btn btn-danger btn-lg" id='table_order'>Table Order</button>
          <form class="form-inline1" id="form_item">
          <input type='hidden' value='' name='tablenumber' id='table_no' value="0" />
          <div id="table_order_block">
          <h3 class="text-center">Place Order On Table</h3>

          <table class="table">
          <tr>
          <td>

           <div class="form-group" id="table_dropdown">
             
            </div>
            </td>
            <td>
           <div class="form-group">
              <label for="exampleInputName2">Waiter Name</label>
              <select class="form-control input-lg select2" id="waiter" name="waiter" id="waiter">
              <option value="no">Select Waiter</option>
                <?php 
                
                $drop="";
                foreach ($this->data['waiters_list'] as $waiter) {
            
                
                    $drop.="<option value=".$waiter['id'].">".$waiter['fname']."</option>";
                  }
                  echo $drop;
                  ?> 
              </select> 
              <input type="hidden" value="" name="waiter_name" id="waiter_name" />
              <div  class="text text-danger text-center" id="waiter_msg">Please Provide Waiter Name </div>
            </div>
            </td> 
            </tr>
          
            </table>
          </div>
          <div id="take_away_block">
          <h3 class="text-center"> Take Away Order</h3>
            <table class="table">
          <tr>
          <td>
           <div class="form-group">
              <label for="exampleInputName2">Customer Name</label>
                <input class="form-control" type="text" name="customer_name" value="" id="customer_name" required />
                <div  class="text text-danger text-center" id="customer_msg">Please Provide Customer Name </div>
            </div>
            </td>
            <td>
           <div class="form-group">
              <div class="form-group">
              <label for="exampleInputName2">Mobile No.</label>
                <input class="form-control" type="numbar" name="mobile" id="mobile" />
                <div  class="text text-danger text-center" id="mobile_msg">Please Provide Mobile No </div>
            </div>
            </div>
            </td> 
            </tr>

            
            </table>

          </div>

        <div id='common_block' style='overflow:scroll;height:400px;'>
          </form>
        </div>
        </div>
      </div>
      <div class="modal-footer">
       
       
      </div>
    </div>
  </div>
</div>   
             
 <!--  Add Item button Modal-->
                      
                         <div class="panel-body1" id="order_slip">
                         <div class="text-center">
                              <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i>
                          </div>

                         </div>
                         </div>
                    </div>


                          <div class="col-md-5 col-sm-12 col-xs-12">
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
      </div>
    </div>
  </div>
</div>

<!-- Pending Orders -->
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
<!-- Pending Orders End-->
                                      
                      

                          
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <i class="fa fa-bell fa-fw"></i>Free Tables
                                      </div>
                                      <div class="panel-body" id="free_tables" >
                                      
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
     
  <!-- Make Payment -->

<div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Make Payment</h4>
        <input type="text" value="" id="pay_for_order" />
      </div>
      <div class="modal-body">
        <form class="form-horizontal" name="paymentform" method="post" action="<?php echo site_url('manager/billing/makepayment'); ?>">
          <table class="table table-bordered ">
            <th>Menu Item</th>
            <th>Qty x Actual price</th>
            <th>Price</th>
            <tr>
            <td>gjhg</td>
            <td>jh</td>
            <td>hjg</td>
            </tr>
          </table>
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <!-- Make Payment -->
<!-- View_order -->


<!-- Button trigger modal -->

<div class="modal fade" id="myModal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Order Info</h4>
      </div>
      <div class="modal-body">
      <div id="view_order">
      
      </div>
         <!-- <table class="table table-bordered ">
         <th>Item Name</th>
         <th>QTY</th>
         
         <tr>
         <td></td>
         <td></td>
         </tr>
        
         </table> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- View_order -->

      <!--Cancle Order  -->

     <!--  <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
      <!--Cancle Order  -->
     <!-- DATA TABLE SCRIPTS -->

   <script type="text/javascript" src="<?php echo base_url() . 'assets/autocomplete/jquery-1.11.0.min.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/autocomplete/fm.selectator.jquery.js'; ?>"></script>
    <script type="text/javascript">


      $(function () {
      

      var $activate_selectator4 = $('#activate_selectator4');
      $activate_selectator4.click(function () {
        var $select4 = $('#select4');
        if ($select4.data('selectator') === undefined) {
          $select4.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select4.selectator('destroy');
          $activate_selectator4.val('activate selectator');
        }
      });
      $activate_selectator4.trigger('click');

    });


      $(function () {
      

      var $activate_selectator5 = $('#activate_selectator5');
      $activate_selectator5.click(function () {
        var $select5 = $('#select5');
        if ($select5.data('selectator') === undefined) {
          $select5.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select5.selectator('destroy');
          $activate_selectator5.val('activate selectator');
        }
      });
      $activate_selectator5.trigger('click');

    });
      

        $(function () {
      

      var $activate_selectator6 = $('#activate_selectator6');
      $activate_selectator6.click(function () {
        var $select6 = $('#select6');
        if ($select6.data('selectator') === undefined) {
          $select6.selectator({
            showAllOptionsOnFocus: true
          });
          // $activate_selectator4.val('destroy selectator');
        } else {
          $select6.selectator('destroy');
          $activate_selectator6.val('activate selectator');
        }
      });
      $activate_selectator6.trigger('click');

    });



        $(document).ready(function(){

          // $('#del').click(function(){
          
          //     alert('gfkjdh');
          
          // });
            

            $('#msg').hide();
            $('#customer_msg').hide();
            $('#mobile_msg').hide();
            $('#table_msg').hide();
            $('#waiter_msg').hide();
            $('#itemlist').hide();
            $('#table_order_block').hide();
            $('#common_block').hide();
            $('#take_away_block').hide();
            $('#order_placed_msg').hide();
            $('#waiter_msg').hide();
            $('#table_order').val(" ");
            $('#placeorder').hide();
            $('#kot').hide();
            $('#take_away').show();
            $('#table_order').show();
            $('#add_order').hide();
            $('#add').hide();
            
        });

        $('#take_order_btn').click(function(){
            $('#add').show();
            $('#add_order').hide();
            $('#order_add_type').val('new');
            $.ajax({
               type:'GET',
               url: "<?php echo site_url('manager/dashboard/get_table'); ?>",
              
              
               success: function(result){
                $('#table_dropdown').html(result);
                $('#table_msg').hide();
              
               }
               })

        });
  $('#placeorder').click(function(){
    var total_item_count=$('#total_item').val();
    // alert(total_item_count);
    if(total_item_count){

        for(var i=1;i<=total_item_count;i++){
          if(!$('#qty_'+i).val()){
              $('#qty_msg_'+i).show();
       // alert($('#qty_'+i).val());
              return false;
          }
           if($('#qty_'+i).val()<=0){
              $('#qty_msg_'+i).show();
              $('#qty_msg_'+i).html('Please Provide qty More then 0');
              return false;
          }

        }


    }
      // event.preventDefault();
       if($('#order_type').val()=='take_away'){

          if(!$('#customer_name').val()){
            
              $('#customer_msg').show();
              $('#mobile_msg').hide();
                return false;
          }

          if(!$('#mobile').val()){

              $('#mobile_msg').show();
              $('#customer_msg').hide();
                return false;
          }
       }
       if($('#order_type').val()=='table_order'){


          if($('#tablenumber').val()=='no'){
              $('#table_msg').show();
              $('#waiter_msg').hide();
                return false;
          }

          if($('#waiter').val()=='no'){
              $('#waiter_msg').show();
              $('#table_msg').hide();
                return false;
          }
       }


         var form_data= $('#form_item').serialize();

            $.ajax({
              type:'POST',
              url: "<?php echo site_url('manager/dashboard/placeOrder'); ?>",
              data:form_data,
            
              success: function(result){
              // $('#common_block').html(result);
          //     alert('ghdfjhg');
          

              $('#order_id').val(result);
              $('#placeorder').hide();
              $('#close_box').show();
              $('#common_block').hide();
              $('#table_order').hide();
              $('#take_away').hide();
              $('#table_order_block').hide();
              $('#take_away_block').hide();
              $('#kot').hide();

              var value=$('#order_add_type').val();
               var order_id =$('#order_id').val();
              if(value=='new'){
               $('#kot').show();
               $('#placeorder').hide(); 
                $("#order_placed_msg").fadeIn(300);
              }
              if(value=='old'){
                $("#order_placed_msg").fadeIn(300);
               $("#order_placed_msg").html('Order has been Updated');
              }
            url="<?php echo site_url() ?>manager/dashboard/dashboard_kot/"+order_id;    
                window.open(url,'_blank');
                // $.ajax({
                //  type:'GET',
                //  url: "<?php echo site_url('manager/dashboard/dashboard_kot'); ?>",
                //  data:{order_id:order_id},
                
                
                //  success: function(re){
                //  alert(res);
                
                //  }
                //  })
                

              
               
              }
        });

       

      
  });

  $('#kot').click(function(){

    $('#form_item').attr('target','_blank')
    $('#form_item').attr('method','post')
    $('#form_item').attr('action',"<?php echo site_url('manager/dashboard/genrate_kot'); ?>")
    $('#form_item').submit();

  });

$('#close_box').click(function(){
    window.location.reload();
});
$(document).on("change", "#waiter", function(){
    $.ajax({
        type:'GET',
        url: "<?php echo site_url('manager/dashboard/get_waiter_name'); ?>",
        data:$('#waiter').val(),
      
        success: function(data){
          if(data)
            $('#waiter_name').val(data);
          else
            $('#waiter_name').val('');
        }
      });
});

  $('#add').click(function(){
    // alert($('#select2').val());
    // ('#waiter_name').val($('#waiter').val());

            
            $('#msg').hide();
            $('#order_placed_msg').hide();
            $('#customer_msg').hide();
            $('#mobile_msg').hide();
            $('#table_msg').hide();
            $('#waiter_msg').hide();
            $('#table_order').val(" ");
            $('#table_order_block').hide();
            $('#common_block').hide();
            $('#take_away_block').hide();
            $('#placeorder').hide();
            $('#kot').hide();
           
            $('#take_away').show();
            $('#take_away').html("Take Away");
            $('#take_away').removeClass("btn btn-golden disabled");
            $('#take_away').addClass("btn btn-info");
            $('#table_order').show();
            
        $.ajax({
        type:'GET',
        url: "<?php echo site_url('manager/dashboard/get_waiter_name'); ?>",
        data:$('#waiter').val(),
      
        success: function(data){
          if(data)
            $('#waiter_name').html(data)
          else
            $('#waiter_name').html('This is take Away')
        }
      })

      $('#msg').hide();

    if($('#select4').val() || $('#select5').val() || $('#select6').val()){
      if($('#select4').val()){
        var item_list_brirayni=$('#select4').val();
      }
      else{
        var item_list_brirayni='';
      }
      if($('#select5').val()){
        var item_list_cafe_one_six=$('#select5').val();
      }
      else{
        var item_list_cafe_one_six='';
      }
      if($('#select6').val()){
        var item_list_bar=$('#select6').val();
      }
      else{
        var item_list_bar='';
        }
        var itemes=item_list_cafe_one_six.concat(item_list_brirayni);

       //var item_list_brirayni_with_comma=item_list_brirayni;
      
       //var item_list_brirayni_with_comma_cafe=item_list_cafe_one_six.concat(item_list_brirayni_with_comma);
       
       // var item_list=item_list_brirayni_with_comma_cafe;
       //var item_list=item_list_bar.concat(item_list_brirayni_with_comma_cafe);

        var item_list=item_list_bar.concat(itemes);


      $('#itemlist').val(item_list);
      var item=$('#itemlist').val();

      var order=$('#select_order').val();
      var el=$('#sl').val();
      var sl=$('#el').val();

       $.ajax({
        type:'GET',
        url: "<?php echo site_url('manager/dashboard/get_item_list'); ?>",
        data:{order:order,item:item,el:el,sl:sl},
      
        success: function(result){

        $('#common_block').html(result)
        var total_item_count=$('#total_item').val();
          if(total_item_count){
              for(var i=1;i<=total_item_count;i++){
                    $('#qty_msg_'+i).hide();

                    // $('#del_'+i).click(function(){
                    //   alert($(this).attr('data'));
                    //   // alert($('item_no_'+i).val());
                    // });
              }
          }
        }

      });

      
    }else{
      if(!($('#select4').val() || $('#select5').val() || $('#select4').val()))
      $('#msg').show();
      return false;
    }

  });

  $('#add_order').click(function(){

       $('#msg').hide();
            $('#order_placed_msg').hide();
            $('#customer_msg').hide();
            $('#mobile_msg').hide();
            $('#table_msg').hide();
            $('#waiter_msg').hide();
            $('#table_order').val(" ");
            $('#table_order_block').hide();
            $('#common_block').show();
            $('#take_away_block').hide();
            $('#placeorder').show();
            $('#kot').hide();
           
            
            $('#take_away').html('Add More Order');
            
            $('#take_away').addClass('bt btn-golden disabled');
            $("#take_away").off("click");
            $('#table_order').hide();
            


      $('#msg').hide();
    if($('#select4').val() || $('#select5').val() || $('#select6').val()){
     if($('#select4').val())
        var item_list_brirayni=$('#select4').val();
      else
        var item_list_brirayni='';
      if($('#select5').val())
        var item_list_cafe_one_six=$('#select5').val();
      else
        var item_list_cafe_one_six='';
      if($('#select6').val())
        var item_list_bar=$('#select6').val();
      else
        var item_list_bar='';
       var itemes=item_list_brirayni.concat(item_list_cafe_one_six);
       var item_list=item_list_bar.concat(itemes);

      $('#itemlist').val(item_list);
      var item=$('#itemlist').val();
      var order=$('#select_order').val();
      var el=$('#el').val();
      var sl=$('#sl').val();
      

       $.ajax({
        type:'GET',
        url: "<?php echo site_url('manager/dashboard/get_item_list'); ?>",
        data:{item:item,order:order,el:el,sl:sl},
      
        success: function(result){
        $('#common_block').html(result)
        var total_item_count=$('#total_item').val();
        var order=$('#select_order').val();
          if(total_item_count){
              for(var i=1;i<=total_item_count;i++){
                  
                    $('#order_id').val(order);
                    $('#qty_msg_'+i).hide();

                   

            
              }
          }
        }

      });

        
    }else{
      $('#msg').show();
      return false;
    }
    



  });

        

      


        $('#today_payment_div').click(function(){
            $(location).attr('href',"<?php echo site_url('manager/orders'); ?>");          
        });
          
        $('#monthly_payment_div').click(function(){
            $(location).attr('href',"<?php echo site_url('manager/orders/?month=1'); ?>");          
        });



  $('#table_order').click(function(){

    // $('#placeorder').click(function(){
    //     alert($('#tablenumber').val());
    //     return false;
    // });

  $('#order_type').val('table_order');
  $('#order_type_check').val('table_order');
    $('#table_order_block').show();
    $('#placeorder').show();
    $('#kot').hide();
    $('#common_block').show();
    $('#take_away_block').hide();
    // $('#table_order').toggle();
    // $('#take_away').toggle();
    $('#take_away').removeClass('disabled');
    $('#table_order').addClass('disabled');
  });

  $('#take_away').click(function(){
    $('#order_type').val('take_away');
    $('#order_type_check').val('take_away');

    $('#table_order_block').hide();
    $('#common_block').show();
    $('#take_away_block').show();
    $('#take_away').addClass('disabled');
    $('#table_order').removeClass('disabled');
    $('#placeorder').show();
    $('#kot').hide();
    // $('#take_away').toggle();
    // $('#table_order').toggle();

     $.ajax({
       type:'GET',
       url: "<?php echo site_url('manager/dashboard/get_table'); ?>",
      
      
       success: function(result){
       $('#table_dropdown').html(result);
       $('#table_msg').hide();
      
       }
       })

  });

  function get(event){
     
    menuitem = $(event.target);
    del_item = menuitem.attr('data');
     var item_list=$('#str').val();
     //alert(item_list);
      $('#itemlist').val($('#str').val());
      // $('#itemlist').val(item_list);
      order=$('#select_order').val();
      var item=$('#itemlist').val();
      alert("Are You Sure????");
    $.ajax({
              type:'GET',
              url: "<?php echo site_url('manager/dashboard/get_list'); ?>",
              data:{del_item:del_item,item_list:item_list,order:order},
            
              success: function(result){
                
          


              $('#common_block').html(result)
              var total_item_count=$('#total_item').val();
              var order=$('#select_order').val();

                if(total_item_count){
                    for(var i=1;i<=total_item_count;i++){
                        
                          $('#order_id').val(order);
                          $('#qty_msg_'+i).hide();

                          
                    }
                }
              }

            });
   }
  
    </script>
    </body>
</html>
   

