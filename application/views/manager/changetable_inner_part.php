<div class="table-responsive">
                       				
	                       		<?php

	                                        if(!empty($active_customers)){
	                                        foreach ($active_customers as $customers) {
	                                            
	                                              
	                                            $url=base_url() . "assets/img/default.png";
	                                          
	                                        ?>

	                                        <div class="pull-left " style="margin-left:10px;">
	                                            

	                                      <button type="button" attr="<?php echo $customers['customer_unique_id'];?>" data="<?php echo $customers['customername'];?>" new="<?php echo $customers['tablenumber'];?>"  class="btn btn-primary btn-lg" style=" padding:15px;" id="waiter" data-toggle="modal" data-target="#activeCustomerModal">

	                                            <img  class="img-thumbnail" src="<?php echo $url; ?>" style="float:right;height:40px;width:40px" />
                                        	</button>
	                                            <div class="text-center" style="font-weight:bold;"><?php echo $customers['customername'];?>[<?php echo $customers['tablenumber'];?>]</div>
	                                        </div>
	                                       
	                                     <?php }
	                                        }else{?>
	                                        <div class="alert alert-danger"> No Active Customers </div>
	                                        <?php

	                                    	}
	                                     ?>



                            </div>