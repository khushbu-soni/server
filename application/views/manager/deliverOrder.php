<div class="chat-panel panel panel-default chat-boder chat-panel-head">
                        <div class="panel-heading">
                            <i class="fa fa-list fa-fw"></i>
                            Order List
                        </div>
                    
                        <div class="panel-body" style="height:600px !important;">
                            <ul class="chat-box">
                                <?php if (empty($orders)): ?>
                            <div class="alert alert-danger">
                                    No Order Place yet.
                                </div>
                                </div>
                            <?php endif;?>
                            <?php foreach ($orders as $order) {?>
                                <li class="left clearfix ">
                                    <div class="row">
                                      <div class="col-md-3">
                                      <button class=" alert alert-info ">[<?php echo $order->tablenumber;?>]</button>
                                        
                                      </div>
                                      <div class="col-md-4" >
                                      <h4><?php echo $order->customername;?></h4>
                                      </div>
                                      <div class="col-md-3">
                                        <a href="<?php echo site_url('manager/billing/payment/' . base64_encode($order->customer_unique_id)); ?>" id="pay" orderid="<?php echo $order->id ?>" class='btn btn-info btn-lg' style="color:white;" >Pay</a>
                                      </div>
                                    </div>                                   
                          
                                </li>
                                <?php }?>  
                            </ul>
                        </div>

                        <div class="panel-footer">
                  <span>Recent Orders List</span>                          
                        </div>

                    </div>