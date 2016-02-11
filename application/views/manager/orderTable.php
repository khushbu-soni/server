<div class="table-responsive">
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
                     
                        <div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Orders
						</div>
						

							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no orders to display.
								</div>
							<?php endif; ?>
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

    <script type="text/javascript">
      
        $(function () {
              $('[data-toggle="popover"]').popover()
            });
        </script>
