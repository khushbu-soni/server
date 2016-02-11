<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/binary-assets/css/bootstrap-datetimepicker.min.css'; ?>" type="text/css"/>
		<script type="text/javascript">
			function deleteAccount(event){
				account = $(event.target);
				accountid = account.attr('accountid');

				$.ajax({
     type: "GET",
     url: "<?php echo site_url('manager/useraccounts/delete'); ?>" + '/' + accountid,
     
     success: function(data){
      
      //$('#page-wrapper').html(data);
      location.reload();   
      
     }
    });
			}
		</script>
		<style type="text/css">
			.pagination > li {
			  display: inline;
			  float: right !important;
			}

.modal {
    bottom: 0;
    display: none;
    left: 0;
    outline: 0 none;
    overflow-x: auto;
    overflow-y: hidden !important;
    position: fixed;
    right: 0;
    top: 0;
    z-index: 1050;
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
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-heading">
                        <div class='search-form'>
                						<select name='user' id="user">
                							<option value="All">Select Status</option>
                							<option value="All">All</option>
                							<?php foreach ($all_status as $st) {?>
                							<option value="<?php echo $st->id;?>"><?php echo $st->status;?></option>
                							<?php }?>
                						</select>
              			
                      &nbsp;
                      <div class="input-append date form_date pull-right end_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <label>End Date&nbsp;&nbsp;&nbsp;</label>
                        <input size="16" type="text" id="ed" value="<?php echo date('d F Y');?>" readonly>
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                        <input type="hidden" id="#ed_hidden" value="" /><br/>&nbsp;
                      </div>
                      <div class="input-append date form_date pull-right start_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <label>Start Date&nbsp;&nbsp;&nbsp;</label>
                         <input size="16" type="text" id="sd" value="<?php echo date('d F Y');?>" readonly>
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"><i class="icon-th"></i></span>
                        <input type="hidden" id="#sd_hidden" value="" /><br/>&nbsp;
                      </div>

                      
                      </div>
                  
                            
                        </div>
                        <div class="panel-body">
                        <?php 	if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>
                            <div class="table-responsive" id="oldtable">
                                <table class="table  table-bordered " id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>Customer Name</th>
                                            <th>Table Number</th>
                                            <th>Status</th>
                                            <th>Payment Info</th>
                                            <th>Order Details</th>
                                            <th>View Bill</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                     
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;" id="table">
							Orders
						</div>
						

							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no orders to display.
								</div>
							<?php endif; ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="odd gradeX">
                                            
                                            <td>
                                            <?php echo $order->orderID;?>
                                            </td>
                                            <td>
                                            <?php echo $order->customername;?>
                                            </td>
                                            <td>
                                            <?php echo $order->tablenumber;?>
                                            </td>
                                            <td style="color:<?php echo $order->color?>; background-color:<?php echo $order->bgcolor;?>">
                                            <?php echo $order->status_name;?>
                                            </td>
                                            <td class="alert alert-default">
                                                <?php if($order->status==4){?>
                                            	 <button type="button" class="btn btn-info"  data-toggle="popover" data-placement="top" data-content="<?php echo "Total Amount :: $order->amount ";?>">
                                                  Payment Info
                                                </button>
                                                    <?php }else{?>
                                                    N/A
                                                    <?php }?>
                                                
                                            </td>
                                            <td>
                                                <button type="button" id="order_details" attr="<?php echo $order->orderID;?>"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                                  Order Details
                                                </button>
                                            </td>
                                             <td>
                                                <?php if($order->status==4){?>
                                                <a  id="order_detail" href="<?php echo site_url('manager/billing/bill/'.base64_encode($order->orderID));?>" target="_blank" attr="<?php echo $order->orderID;?>"  class="btn btn-primary btn-sm" >
                                                  View Bill
                                                </a>
                                                 <?php }else{?>
                                                 N/A
                                                 <?php }?>
                                            </td> 
                                            

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $order->orderID;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Print Bill</h4>
      </div>
      <div class="modal-body">
      <iframe src="<?php echo site_url().'assets/pdf/'.$order->orderID.'.pdf'; ?>" width="100%" height="100%"></iframe>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




                                        </tr>

                                       <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                           
                            
                        </div>

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>

<div class="modal-dialog modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-left:350px; width:50%;height:71%;position:absolute;">
  <div class="">
    <div class="modal-content";>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Order Details</h4>
      </div>
      <div class="modal-body" id="details">
            


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/jquery.metisMenu.js'?>"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/dataTables/dataTables.bootstrap.js'?>"></script>
     <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.js'?>" charset="UTF-8"></script>
  <script src="<?php echo base_url() . 'assets/binary-assets/js/bootstrap-datetimepicker.fr.js'?>" charset="UTF-8"></script>
      
    
         <!-- CUSTOM SCRIPTS -->
    

		<script type="text/javascript">
      	$(document).ready(function () {
                $('#dataTables-example').dataTable();
            
                $('.form_date').datetimepicker({
        
                  weekStart: 1,
                  todayBtn:  1,
                  autoclose: 1,
                  todayHighlight: 1,
                  startView: 2,
                  minView: 2,
                  forceParse: 0
              });

              
            });
      	$(function () {
              $('[data-toggle="popover"]').popover()
            });



		$( "#user" ).change(function() {
			$(location).attr('href'," <?php echo site_url('manager/orders/filter/'); ?>/"+$('#user').val());
      
		});

    $( "#sd" ).change(function() {
      // $('#oldtable').hide();
      // $(location).attr('href'," <?php echo site_url('manager/orders/filter/'); ?>/"+$('#user').val());
      var url = "<?php echo site_url('manager/orders/filter_by_date'); ?>" 
      var start_date = $('#sd').val();
      var end_date = $('#ed').val();
            var postdata = {'start_date' :start_date,'end_date':end_date};
                $.post(url,postdata, function(data){
                            $('#dataTables-example').html(data);
                    });

    });
    $( "#ed" ).change(function() {
      // $('#oldtable').hide();
      // $(location).attr('href'," <?php echo site_url('manager/orders/filter/'); ?>/"+$('#user').val());
      var url = "<?php echo site_url('manager/orders/filter_by_date'); ?>" 
      var start_date = $('#sd').val();
      var end_date = $('#ed').val();
            var postdata = {'start_date' :start_date,'end_date':end_date};
                $.post(url,postdata, function(data){
                            $('#dataTables-example').html(data);
                    });

    });

    $(document).on('click', "#order_details", function() {
           var url = "<?php echo site_url() ?>manager/orders/order_info"; 
           var id = $(this).attr('attr');
            var postdata = {'id' : id};
                $.post(url,postdata, function(data){
                          
                            $('#details').html(data);
                    });
            
        });

     
            
           
            


		</script>
	</body>
</html>