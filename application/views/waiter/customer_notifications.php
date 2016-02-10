
<?php



$background_url=base_url() . 'assets/img/table1.png';




$background_url=base_url() . 'assets/img/table1.png';

?>

					
							<?php if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" style="width:50%">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>Payment successful!</strong>
								</div>
							<?php endif; ?>
							

							<?php /*echo $userid;*/if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no pending orders at this time.
								</div>
							<?php endif; ?>

							<?php foreach ($orders as $order): ?>
								<div class="col-lg-12" style="border-bottom: #eee 2px solid; padding:10px 0px 10px 0px;margin-bottom">
							
									
									<div class="col-lg-3">
										<button class="icon-box1  set-icon" 
										 data-toggle="modal" 
										 data-target="#myModal1" id="table"  
										 	style="display: block;
float: left;margin: 0px 15px 10px 0;padding:45px;width: 70px;height: 70px;line-height: 8px;vertical-align: middle;
text-align: center;font-size: 20px;background-image:url('<?php echo $background_url;?>') ;
background-size:90% 67%; background-repeat:no-repeat;background-position: center; ">

  <b><?php echo $order->tablenumber; ?></b>  

</button>
 <br> 
 <p> <br> <span class="icon-box bg-color-green set-icon">
 <?php echo $order->customername; ?></span></p>

					 
											
												<?php 
												if ($order->status == 1) 

													echo "<b><span style=color:blue>Being prepared</span></b>";
													 else if ($order->status==2) 
													 	echo "<b><span style=color:red>Ready for Delivery</span></b>";
												?>
												
											
										</div>
									<div class="col-lg-9">
										<b>Ordered Items:</b><br/>
											<?php
											//	$ordereditems=0;
												$ordereditems = $order->getOrderedItems_waiter();
												//print_r($this->db->last_query());
												
												//print_r($ordereditems);
												
												$numrow = sizeof($ordereditems);
												/*echo $numrow;*/
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo '<br>';
													echo "<span style=font-size:20px;>".$ordereditem->itemname."</span>";
													echo " X ";
													//echo $order->id;
													echo "<span style='padding:0px 5px 0px 5px;''  class='icon-box bg-color-red set-icon'><b>";
													echo $ordereditem->quantity;
													echo "</b></span>";

													if($ordereditem->status==2)
													{
														echo "<a href=# onclick=setAsDelivereditem(event) numrow=". $numrow ." ogorderid=". $order->id ." orderid=".$ordereditem->menuid."  class='btn btn-large'>Set as Delivered</a>";

													}

													

													 
													

													$count = $count + 1;
												}
												//echo $count;
												if($ordereditem->ingredients!='All')
												{
												echo "&nbsp;&nbsp;&nbsp;<b style=color:green;><br>[ Extra ";
													echo $ordereditem->ingredients;

													echo " ]</b>";
												}
											?>
											<br/>

											
										</p>
										
									

									<div class="orderaction pull-right">
										
										<?php if ($ordereditem->status == 1) {?>
										<img src="<?php echo base_url() ?>assets/img/process.gif"/>
										<?php }?>
											
										
										&nbsp;&nbsp;
										<?php if ($order->status == 2) {?>
										<a href="#" onclick="setAsDelivered(event)" orderid="<?php echo $order->id; ?>" class="btn btn-large">Set as Delivered</a>
										<?php } ?>&nbsp;&nbsp;

										<a href="#comp-modal" onclick="getOrderDetails(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Comp</a>
										
										&nbsp;&nbsp;
										<?php if ($order->status == 3) {?>
										<a href="#payment-modal" onclick="setOrderId(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Make Payment</a>
										<?php } ?>

									</div>
								</div>

								</div>
								
								

							
							<?php endforeach; ?>


			