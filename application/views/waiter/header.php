 <style type="text/css">
 	body {
    	background-color: white;
    	 margin: -25px -4px -4px;
      }
      .navbar {
	    color: #777777;
	    height: 80px;
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

.label-as-badge {
    border-radius: 3em !important;
}
.navbar-header1{
  padding-top: 25px;
	padding-bottom:- 15px !important;
  margin-top: -25px !important;
  margin-bottom: 0px !important;
  margin-right: 0px !important;
}

.form-horizontal input{
    height: 35px;
}

.dropdown-menu {
   max-height: 500px !important;
   max-width: 400px !important;
   overflow-y: auto !important;
   overflow-x: auto !important;
   font-size: 20px !important;
}
.dropdown-menu li > a:hover,
.dropdown-menu li > a:focus,
.dropdown-submenu:hover > a {
  color: red;
  text-decoration: none;
  background-color: white;
  background-color: white;
  background-image: -moz-linear-gradient(top, white, white);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(white), to(white));
  background-image: -webkit-linear-gradient(top, white, white);
  background-image: -o-linear-gradient(top, white,white);
  background-image: linear-gradient(to bottom, white, white);
  background-repeat: repeat-x;
  filter: progid:dximagetransform.microsoft.gradient(startColorstr='#fwhite', endColorstr='#ff0077b3', GradientType=0);
}
 </style>

 <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <script type="text/javascript">

        $(document).ready(function(){
                // console.clear();
                setInterval(function() {
                var url = "<?php echo site_url('waiter/orders/notification'); ?>" 
                $.post(url,'', function(data){
                            var id = $(this).attr('attr');

                            $('#notify').html(data);
                    });
                // console.clear();
                }, 3000);

         


                 <?php
                    if(array_key_exists('new_last_id',$this->session->userdata)){
                      $id=$this->session->userdata['new_last_id'];
                    }
                    else
                      $id=0;
                ?>
                  

                setInterval(function() {

                var url1 = "<?php echo site_url('waiter/orders/notification'); ?>" 
                
                  var url2 = "<?php echo site_url('waiter/orders/notification'); ?>" 
                  $.post(url2,'', function(data){
                    var id="<?php echo $id;?>";
                          new_id=data;
                       
                       if(new_id!=id){

                          $.post(url1,'', function(data){

                          var id="<?php echo $id;?>";
                          
                            if(id!=0)
                                    $('ul.un').prepend(data);

                          });
                                      
                       }       


                        });
                
                }, 3000);



      $('.dropdown-toggle').click(function(){
        
           var url = "<?php echo site_url('waiter/orders/notification'); ?>" 
                    $.post(url,'', function(data){

                                $('#li_part').html(data);

                                
                        });


            });
      });


     


        </script> 

        <style type="text/css">
        li#hide:hover{
          background-color:skyblue ;

        }
        </style>
 <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: -25px;margin-top:1px">
            <div class="navbar-header1">
                
                <a class="navbar-brand" >Manager Panel </a>
                
                <div style="color: white;
                padding: 0px 16px 3px 9px;     
                float: right;
                font-size: 16px;"> Today's Date : <?php echo date('d, M Y')?> &nbsp; <a href="<?php echo site_url(); ?>" class="btn btn-danger square-btn-adjust">Logout</a>
             <!-- <div id="notify"> -->
             
              <!-- </div> -->
              </div>
              <!-- <div class="btn-group pull-right" id="notification" style="padding:0px 10px 0px 0px">
                
                
                </div>
 -->
                <div class="btn-group pull-right" id="notification" style="padding:0px 10px 0px 0px">
                  
                  <button type="button" id="show_li" class="btn btn-info btn-lg dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
        
                 <span class="badge" id="notify" >
                   
                 </span>
                    </button>
                                    <div class="dropdown-menu pull-right un" role="menu" data-spy="scroll" id="li_part">
                                      
                                    </div>
                    
                
                </div>
             </div>
             
        </nav> 
        