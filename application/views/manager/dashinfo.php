       <style type="text/css">
       .img-thumbnail{
        width: 75px;
        height: 75px;

       }
       </style>

       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

             <script>

             $(document).ready(function(){
                console.clear();
              $( "#dialog" ).hide();
              
             });


             function changeID(waiter_id)
            { 

            window.open('<?php echo site_url('manager/dashboard/show_free_tables'); ?>/+waiter_id','ContactUs','width=500,height=550,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,copyhistory=yes');
              
            }

            </script>    
           

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
          			<div class="panel panel-back noti-box" id="waiter_count">
                <!-- waiter_count -->
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
                    <b><?php if($monthly_payment['month_pay']) echo $monthly_payment['month_pay']; echo "0";?></b>
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
                  
                    <b><?php echo $pending_order['count'];?></b>
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
                    <div class="col-md-6 col-sm-6 col-xs-6">

                   <?php 
                 
                   foreach ($notifications as $notify) {

                   }
                   ?>
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Notifications
                        </div>
                        <?php 
                          if(!empty($notifications)){
                        ?>
                        <div class="panel-body">
                        <ul class="chat-box">

                         <?php 
                     
                       foreach ($notifications as $notify) {
                        ?>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        Customer
                                    </span>

                                    <div class="chat-body">                                        
                                            <strong ><?php $str=explode('_',$notify['customer_unique_id']); echo $str[0];?></strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i>few mins ago
                                            </small>                                      
                                        <p>
                                            <?php echo $notify['text'];?>
                                        </p>
                                    </div>
                                </li>
                        <?php }?>
                        </ul>
                        </div>
                    <?php
                    } else{

                        ?>
                          <div class="alert alert-danger">No Customers Yet</div>
                           
                        <?php }?>


                        <div class="panel-footer"></div>

                    </div>
                    
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                         <div class="panel panel-default">
                            <div class="panel-heading">
                              Free Waiters
                            </div>
                            
                            <div class="panel-body">
                                <div class="row">
                                    <div>   
                                      
                                        <?php
                                        foreach ($free_waiters as $waiter) {
                                            $img=$waiter['pic'];
                                            $url=base_url() . "assets/dishes/$img";
                                          
                                        ?>



                                        <div class="pull-left " style="margin-left:10px;">
                                            <button class="btn btn-default" id="waiter" onclick="changeID('<?php echo $waiter['id'];?>')"  >
                                            <img  class="img-thumbnail" src="<?php echo $url; ?>" style="float:right" />
                                            </button>
                                            <div class="text-center"><?php echo $waiter['fname'];?></div>
                                        </div>
                                       
                                     <?php }?>
                                      
                                     </div>
                                 </div>
                            </div>
                            </div>
                 <div id="dialog" title="Basic dialog">
                  
                  </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              Free Tables
                            </div>
                            <div class="panel-body">
                                <span class="label label-default">Default</span>
                            </div>
                        </div>
                         
                    </div>
                    </div>
                        
                      
                </div>


    