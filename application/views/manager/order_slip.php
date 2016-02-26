<?php 
$i=1;
foreach ($this->data['orders'] as $order) :?>
    <div class="row">
        <div class="form-group1">
            <div class="searchable-container">
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                     
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>
                                        <?php
                                        // print_r($order);
                                        if($order['customername']!='' and $order['tablenumber']==0)
                                            echo "<b>Customer<br/><small>( Take Away )</small></b> <br/>".$order['customername'];
                                        elseif ($order['tablenumber']!=0) {
                                            echo "<b>Table No.</b> <br/>".$order['tablenumber'];
                                            
                                        }
                                        ?>
                                    </h5>
                                </div>
                            </label>
                        </div>
                       
                    </div>
                </div>
               <div class="items col-xs-5 col-sm-5 col-md-9 col-lg-9">
                    <div class="info-block block-info clearfix">
                     
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <p>
                                       <button class="btn btn-pink btn-sm" id="view_order_<?php echo $i;?>" attr="<?php echo $order['id'];?>" data-toggle="modal" data-target="#myModal11">View</button>
                                       
                                       <a href="<?php echo site_url('manager/billing/payment/' .$order['id']); ?>" target="_blank" class="btn btn-golden btn-sm" id="bill_modal_<?php echo $order['id'];?>" atrr="<?php echo $order['id'];?>">
                                       Pay
                                       </a>
                                       
                                       <a class="btn btn-cyan btn-sm"  href="<?php echo site_url('manager/dashboard/dashboard_kot/' . $order['id']); ?>" target="_blank" >Kot</a>
                                       <?php if($order['tablenumber']!=0):?>
                                       
                                       <a class="btn btn-danger btn-sm"  href="<?php echo site_url('update?id=' . $order['id']); ?>" target="_blank" >Add Order</a>
                                       
                                       <?php endif;?>
                                       <a  onclick="delete_order(<?php echo $order['id'];?>)" target="_blank" class="btn btn-warning btn-sm" id="bill_modal_<?php echo $order['id'];?>" atrr="<?php echo $order['id'];?>">
                                       DELETE
                                       </a>
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
	</div>
  

<?php $i++; endforeach; ?>

<script type="text/javascript">
$(document).ready(function(){
 
  // alert(r);
if($('#select4').val()){
            // alert($('#modal_bill_'+r).val());
            var r=$('#modal_add_order').attr('attr');
            var ch=$('#order_add_type').val();
      
            
           
             
              var item_list=$('#select4').val();
              $('#itemlist').val(item_list);
              
          }
 
         for(var i=1;i<=<?php echo count($this->data['orders']);?>;i++){

            $('#add_modal_order_'+i).click(function(){
                
                $('#add_order').show();
                $('#add').hide();
                $('#take_away').hide();
                $('#table_no').val($(this).attr('attrr'));                

                $('#order_add_type').val('old');

                $('#select_order').val($(this).attr('attr'));
             
            });

         $('#view_order_'+i).click(function(){
          
                $.ajax({
                 type:'GET',
                 url: "<?php echo site_url('manager/dashboard/view_order'); ?>",
                  data:$(this).attr('attr'),
                
                 success: function(result){
                  $('#view_order').html(result);
                 }
               })
             
            });

          

         }
          });
         
       function delete_order(order){
        var res =confirm("Are You Sure order will not be recover, after deleting???? ")
        if(res==true){
            var option=confirm('Are You Sure ???');
            if(option==true){
              $.ajax({
              type:'GET',
              url: "<?php echo site_url('manager/orders/delete_order'); ?>",
              data:{order:order},
            
              success: function(result){
                
              


              
              }

            });
            }
        }
        

       }
        




           
                
         
</script>

<!-- Modal -->

