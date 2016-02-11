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
		<?php
 $free_waiter_notify_color=$configruation->free_waiter_notify_color;
 $busy_waiter_notify_color=$configruation->busy_waiter_notify_color;
 $upper_block_refresh_time=$configruation->upper_block_refresh_time;
      $free_waiter_auto_refresh_time=$configruation->free_waiter_auto_refresh_time;
      $free_table_auto_refresh_time=$configruation->free_table_auto_refresh_time;
      $customer_notification_auto_refresh_time=$configruation->customer_notification_auto_refresh_time;
?>
	    <div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>

      <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 rounded-6px">
        <div class="panel panel-default">
                        <div class="panel-heading">
                          Active Customers

                        </div>
                        <div class="panel-body" id="active_customers">
                       
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


<div class="modal fade" id="activeCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="free_tables">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

	 
    
         <!-- CUSTOM SCRIPTS -->
    
	</body>

	<script type="text/javascript">
    
    $(document).on('click', "#waiter", function() {
         
               var customer_unique_id = $(this).attr('attr');
               var customername = $(this).attr('data');
               var old_tablenumber = $(this).attr('new');
               $('#myModalLabel').html("Change Table For <b>"+customername+"</b>");
                
                
                  $.ajax({
                type: 'POST',
                url: "<?php echo site_url('manager/changetable/show_free_tables'); ?>/",
                data: {'old_tablenumber' :old_tablenumber,'customer_unique_id':customer_unique_id,'customername':customername},
                beforeSend: function() {
                    // setting a timeout
                    // $(placeholder).addClass('loading');
                },
                success: function(data) {
                      $('#free_tables').html(data);
                },
                complete: function() {
                    // $(placeholder).removeClass('loading');
                },
                dataType: 'html'
              });

        });

    $(document).ready(function(){
                
                setInterval(function() {
                var url = "<?php echo site_url('manager/changetable/load_active_customers'); ?>" 
                // $.post(url,'', function(data){
                //             $('#active_customers').html(data);
                //     });

                  $.ajax({
                type: 'POST',
                url: "<?php echo site_url('manager/changetable/load_active_customers'); ?>",
                beforeSend: function() {
                    // setting a timeout
                    // $(placeholder).addClass('loading');
                },
                success: function(data) {
                     $('#active_customers').html(data);
                },
                complete: function() {
                    // $(placeholder).removeClass('loading');
                },
                dataType: 'html'
              });


                // console.clear();
                },5000);
            });
            
</script>
</html>