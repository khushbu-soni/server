<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
		</script>
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
	</head>

	<body>
	    <div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>

      <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-6 rounded-6px ">
        <div class="panel panel-default">
                        <div class="panel-heading">
                          Menu Items Available/UnAvailable
                        </div>
                        <div id="msg" class="alert alert-info">sgfg</div>
                        <div class="panel-body">
                       
                        <table class="table" width="50px">
                        <tr>
                        <td>
                          
                       <div class="form-group">
                      <label for="exampleInputName2">Retaurant</label>
                      <select class="form-control input-lg select2" id="restro" name="restro" id="waiter">
                      <option value="no">Select Restaurant</option>
                      <option value="BH">Biryani House</option>
                      <option value="CS">Cafe 1 Six</option>
                        
                      </select> 
                    </div>
                      </td>
                        
                      <td >
                     <div class="form-group">
                      <label for="exampleInputName2">Retaurant</label>
                      <select class="form-control input-lg select2" id="status" name="status" id="waiter">
                      <option value="1">Mark Available</option>
                      <option value="0">Mark UnAvailable</option>
                        
                      </select> 
                    </div>
                      </td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                      <td>
                        <button id="save" class="btn btn-info btn-lg text-center">Save</button>
                      </td>
                    </tr>
                    </table>
                
                  
                           
                        </div>

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>




	 
    
         <!-- CUSTOM SCRIPTS -->
    
	</body>

	<script type="text/javascript">
     $(document).ready(function(){
       $('#msg').hide();
      

       $('#save').click(function(){
        
           var status=$('#status').val();
           var restro=$('#restro').val();

          $.ajax({
                type:'POST',
                url: "<?php echo site_url('manager/menu_utilty/mark'); ?>",
             
                data:{ status: status,restro:restro },
              
               success: function(result){
                $('#msg').show();
                $('#msg').html(result);
                if(result=='1')
                    $('#msg').html("Mark Available Seccuessfully");
                if(result=='0')
                    $('#msg').html("Mark UnAvailable Seccuessfully");

              
               }
               })
       });
     });
   
 

   
            
</script>
</html>