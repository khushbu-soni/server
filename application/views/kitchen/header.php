 <style type="text/css">
 	body {
    	background-color: white;
    	 margin: -25px -4px -4px;
      }

  .navbar {
	    color: #777777;
	    height: 80px;
      margin-bottom: -20px !important;
      margin-top: 25px !important;
	}
	.navbar-cls-top .navbar-brand {
    background: none repeat scroll 0 0 #c90000;
    color: #fff;
    font-size: 23px;
    font-weight: 700;
    height: 61px;
    text-align: center;
    width: 257px;

}

 </style>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <script type="text/javascript">

        $(document).ready(function(){
                // console.clear();
             

                 var url = "<?php echo site_url('kitchen/ingredients/notification'); ?>" 
                
                $.post(url,'', function(data){
                            $('#notification').html(data);
                          });
           
           setInterval(function() {
                var url = "<?php echo site_url('kitchen/ingredients/notification'); ?>" 
                
                $.post(url,'', function(data){
                            $('#notification').html(data);
                          });
                 
                //console.clear();
                }, 1000);
               
            
      });

         
        </script> 
 
 <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: -25px;margin-top:1px">
            <div class="navbar-header1">
                
                <a class="navbar-brand" >Kitchen Panel </a>
                
                <div style="color: white;
                padding: 0px 16px 3px 9px;     
                float: right;
                font-size: 16px;"> Today's Date : <?php echo date('d, M Y')?> &nbsp; <a href="<?php echo site_url('kitchen/welcome/logout'); ?>" class="btn btn-danger square-btn-adjust">Logout</a>
             <!-- <div id="notify"> -->
             
              <!-- </div> -->

              </div>
               </div>

              <div class="btn-group pull-right" id="notification" style="padding:0px 10px 0px 0px; ">
                
              
                </div>
             </div>
             
        </nav> 
        