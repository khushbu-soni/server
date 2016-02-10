<!DOCTYPE html>
<html>
    <head>
    
        <title>Biryani House.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <?php echo $dependencies; ?>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/highcharts.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/js/exporting.js'; ?>"></script>
          
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
          min-height: 65px;
          /*padding: 20px;*/
      }
               
    </style>



        
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
            .stat {
    border-right: 1px solid #e8e9ee;
    box-shadow: 1px 0 0 0 white;
    padding: 25px 0 30px;
    position: relative;
    text-align: right;
}
.stats-row {
    box-shadow: -1px 0 5px 2px #f9f9f9 inset;
    margin: 0;
}
              
               
        </style>
              
    </head>

    <body>
<div id="wrapper">

 <?php echo $header;?>
     

       
           <!-- /. NAV TOP  -->
        <!-- /. NAV SIDE  -->
      <div id="page-wrapper" style="margin-left:0px;" >
        <div id="page-inner">
        <div id="info">
        <div class="row">
               
                <div class="col-md-3 col-sm-12 col-xs-12">           
                <span class="icon-box1 bg-color-red1 set-icon1 " style="margin-left:50px;">
                  <a href="#" id="stock" class="btn btn-block btn-cyan btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> Stock Info </a>
                </span>
               </div>
               
        <div class="col-md-3 col-sm-12 col-xs-12" id="today_payment_div">           
          <span class="icon-box1 bg-color-red1 set-icon1 " style="margin-left:50px;">
                <a href="#" id="payment" class="btn btn-block btn-golden btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> Payment Info</a>
                </span>
         </div>

        <div class="col-md-3 col-sm-12 col-xs-12" >
          <span class="icon-box1 bg-color-red1 set-icon1 " style="margin-left:50px;">
                  <a href="#" id="profile" class="btn btn-block btn-skyblue btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> Update Profile </a>
                </span>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 close_modal" data-toggle="modal" data-target="#myModal2">           
            <span class="icon-box1 bg-color-red1 set-icon1 " style="margin-left:50px;">
                  <a href="#" id="trash" class="btn btn-block btn-pink btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> Move To Trash</a>
                </span>
         </div>
      </div>
                 
                <hr />                
              

                <div class="row">

                          <div class="col-md-12 col-sm-12 col-xs-12" style="min-height:500px;">
                                   <div class="panel panel-default" id="box" >

                                      <div class="panel-heading" style="backgound-color:red">
                                   <i class="fa fa-user fa-fw"></i><span id="title"></span>
                                      </div>
                                      <div class="panel-body" id="info_box" style="max-height: 500px;overflow-y: scroll;">
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
            
            </div>
         
       
     
   
     <!-- DATA TABLE SCRIPTS -->
    <script type="text/javascript">
      $.ajax({
             type: "POST",
             url: "<?php echo site_url('admin/dashboard/get'); ?>",
                 success: function(data){
                  $('#box').removeClass('panel-cyan');
                  $('#box').removeClass('panel-golden');
                  $('#box').removeClass('panel-skyblue');
                  $('#box').removeClass('panel-pink');
                  $('#box').addClass('panel-default');
                  $('#dashboard').addClass('disabled');
                  $('#stock').removeClass('disabled');
                  $('#payment').removeClass('disabled');
                          $('#profile').removeClass('disabled');
                          $('#trash').removeClass('disabled');
                  $('#info_box').html(data);  
                  $('#title').html("");
                  $('#title').html("Dashboard");
              
             }     
          });

    
        $('#stock').click(function(){
          $.ajax({
             type: "POST",
             url: "<?php echo site_url('admin/stock/get'); ?>",
             
                 success: function(data){
                  $('#box').removeClass('panel-default');
                  $('#box').removeClass('panel-golden');
                  $('#box').removeClass('panel-skyblue');
                  $('#box').removeClass('panel-pink');
                  $('#box').addClass('panel-cyan');
                  $('#stock').addClass('disabled');
                  $('#payment').removeClass('disabled');
                          $('#profile').removeClass('disabled');
                          $('#trash').removeClass('disabled');
                  $('#info_box').html(data);  
                  $('#title').html("");
                  $('#title').html("Stock Reports");
              
             }     
          });
        });

        $('#payment').click(function(){
          $.ajax({
             type: "POST",
             url: "<?php echo site_url('admin/payment/get'); ?>",
             
                 success: function(data){
                  $('#box').removeClass('panel-cyan');
                  $('#box').removeClass('panel-default');
                  $('#box').removeClass('panel-skyblue');
                  $('#box').removeClass('panel-pink');
                  $('#box').addClass('panel-golden');
                    $('#payment').addClass('disabled');
                     $('#stock').removeClass('disabled');
                          $('#profile').removeClass('disabled');
                          $('#trash').removeClass('disabled');
                  $('#info_box').html(data);
                  $('#title').html("");
                  $('#title').html("Payment Reports");
              
             }     
          });
        });

        $('#profile').click(function(){
          $.ajax({
             type: "POST",
             url: "<?php echo site_url('admin/profile/get'); ?>",
             
                 success: function(data){
                  $('#box').removeClass('panel-cyan');
                  $('#box').removeClass('panel-default');
                  $('#box').removeClass('panel-golden');
                     $('#box').removeClass('panel-pink');
                  $('#box').addClass('panel-skyblue');
                          $('#profile').addClass('disabled');
                           $('#stock').removeClass('disabled');
                          $('#payment').removeClass('disabled');
                          $('#trash').removeClass('disabled');
                  $('#info_box').html(data);
                  $('#title').html("Update Profile");
              
             }     
          });
        });

        $('#trash').click(function(){
          $.ajax({
             type: "POST",
             url: "<?php echo site_url('admin/trash/get'); ?>",
             
                 success: function(data){
                  $('#box').removeClass('panel-cyan');
                  $('#box').removeClass('panel-default');
                  $('#box').removeClass('panel-golden');
                  $('#box').removeClass('panel-skyblue');
                  $('#box').addClass('panel-pink');
                          $('#trash').addClass('disabled');
                          $('#stock').removeClass('disabled');
                          $('#payment').removeClass('disabled');
                          $('#profile').removeClass('disabled');
                  $('#info_box').html(data);
                  $('#title').html("Move To Trash");
              
             }     
          });
        });
          
       

    </script>
    </body>
</html>
   

