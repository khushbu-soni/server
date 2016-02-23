<!DOCTYPE html>
<html>
    <head>

        <title>Biryani House.</title>
        
        <?php echo $dependencies; ?>
        <script type="text/javascript">
       
            function readCard () {

               document.getElementById('swiped').focus();

                 var card_data = document.getElementById("swiped").value;
               //alert(card_data);
                var details1 = card_data.split("^");

                 var card_number = details1[0];
                 card_number = card_number.substring(2);
                 //alert(card_number);

                 var names = details1[1].split("/");



                var full_name = names[0];

                var details2 = details1[2].split(";");
                details2 = details2[1].split("=");

                 var exp_date = details2[1];

                exp_date = exp_date.substring(0, exp_date.length - 1);

                 exp_date = exp_date.substring(2, 4) + "/" + exp_date.substring(0,2);


               var pattern = new RegExp("^\%B(\d+)\^(\w+)\/(\w+)\^\d+\?;\d+=(\d\d)(\d\d)\d+$");
                var match = pattern.exec(card_data);



 
            document.getElementById("full_name").value = full_name;
            document.getElementById("card_no").value = card_number;
            document.getElementById("expiry").value = exp_date;


 
}

        </script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <style type="text/css">
            .form-horizontal input {
            height: 35px;
        }

        .table-bordered {
          font-size: smaller;
          /* border:none !important;*/
          }

        </style>
    </head>
  <body>
    <div id="wrapper">
      <?php echo $header;?>
      <?php echo $sidebar;?>
<script type="text/javascript">

        $('document').ready(function(){
                $('#with_tax').hide();
                // $('#print_with_tax').hide();
                setInterval(function() {
                var url = "<?php echo site_url('manager/billing/ajax_handler'); ?>" 
                $.post(url,'', function(data){
                            $('#orders').html(data);
                    });
                }, 3000);

                $("#cal").change(function(){
                    $('#with_tax').toggle();
                    $('#without_tax').toggle();
                    if($('#cal:checked').val()){
                      // $('#print_with_tax').toggle();
                      // $('#print_without_tax').toggle();
                            $('#cal_val').val('1');
                            $('#cal_val_1').val('1');
                    }
                    if(!$('#cal:checked').val()){
                      // $('#print_with_tax').toggle();
                      // $('#print_without_tax').toggle();
                            $('#cal_val').val('0');
                            $('#cal_val_1').val('0');
                           
                    }
                });

            $( "#dis" ).focusout(function() {
              var discount_amount= $('#dis').val();
              $('#discount').val(discount_amount);
              

            });

             $( "#cash" ).focusout(function() {
              
              var cash= $('#cash').val();
              $('#cash_t').val(cash);

            });
           
            });
        </script>
      
<?php echo $header;?>


      <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3" >
                   
                                    <div class="text-center">
                                          <!-- <i class="fa fa-spinner fa-pulse icon-spin fa-3x"></i> -->
                                      </div>
                    </div>


                <!-- Payment Form -->
                    <div class="col-md-5 col-sm-12 col-xs-12">
                         
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                Invoice Details
                            </div>
                            <div class="">
                            <?php if (empty($orders_details)): ?>
                            <div class="alert alert-danger">
                                    Please Select Any Order.
                                </div>
                                </div>
                            <?php endif;?>
<?php if (!empty($orders_details)): ?>
                     <form class="form-horizontal" name="paymentform" method="post" action="<?php echo site_url('manager/billing/makepayment'); ?>" >
                        <table class="table table-bordered ">
                        <tr>
                            <th>Menu Item</th>
                            <th class="text-center">Qty x Actual Price</th>
                            <th class="text-center">Price</th>
                            </tr>
                            <input name='cal_val' id="cal_val" type="hidden" value="0" />
                        <?php foreach ($orders_details as $val): ?>
                          <input type="hidden" value="<?php echo $val->orderid;?>" name="order_id" />
                          <input type="hidden" value="<?php if($val->tablenumber!=0) echo $val->tablenumber; else echo "take away";?>" name="tablenumber" />
                            <input name='customername' id="customername" type="hidden" value="<?php echo $customername['customername']?>" />
                            <tr><td><?php echo $val->name ;?></td>
                                <td class="text-center"><?php echo $basic_info->currency."".$val->actual_price." x ".$val->quantity ;?></td>
                                <td class="text-center"><?php echo $val->price ;?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td>Apply Service Charge</td>
                            <td><input type="checkbox" style="width: 67px; height:auto" name="cal" id="cal" val="1"/></td>
                        </tr>
                         <tr>
                            <td></td>
                            <td>Discount Amount</td>
                            <td><input type="number" style="width: 67px; height:auto" name="dis" id="dis" value="0"/></td>
                        </tr>

                        <tr style="display:none;">
                            <td></td>
                            <td>Tax</td>
                            <td><input type='text' name='tax' id='tax' value="<?php echo $basic_info->tax;?>"></td>
                           
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Total  </b></td>
                            <td id="with_tax"><input type="text" style="width: 67px; height:auto" value="<?php echo $this->data['totals_with_tax'];?>" name="total_with_tax" readonly/></td>
                            <td id="without_tax"><input style="width: 67px;height:auto" type="text" value="<?php echo round($totals_without_tax['total'],2);?>" name="total_without_tax" readonly/></td>
                            <td>
                            <input id="tax_amount" style="width: 67px;height:auto" type="hidden" value="<?php echo round($this->data['tax_amount'],2);?>" name="tax_amount"/>
                            <input id="tax_amount_not" style="width: 67px;height:auto" type="hidden" value="0" name="tax_amount_not"/>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><b>Cash Given</b></td>
                            <td>
                            <input type="number" id="cash" style="width: 67px; height:auto" value="" name="cash" /></td>
                           
                        </tr>
                        
                        
                                             
                        <tr>
                            <td>
                                <button type="button" id="makepayment" class="btn btn-info" aria-label="Left Align">
                                  <i class="icon-thumbs-up icon-black"></i>Proceed</span>
                                </button>
                            </td>
                            <td></td>
                            <td>
                                <button  type="button" id="print" class="btn btn-info" aria-label="Left Align">
                                  <i class="icon-print icon-black"></i>Print</span>
                                </button>

                                <!-- <button type="button" id="print_without_tax" class="btn btn-info" aria-label="Left Align">
                                  <i class="icon-print icon-black"></i>Print</span>
                                </button> -->
                               
                            </td>

                        </tr>

                      
                        </table>
                        </form>
                        </div>
                        </div>
                        </div>

                        

                             
                    <?php endif; ?>
                      
    
    <div class="col-md-4 col-sm-12 col-xs-12" id="inner_part">
                            
          </div>
          
                    <?php
                          if(!empty($orders_details)):
                           $id=$tablenumber;
                           $url=site_url('manager/billing/pdf/'.$id);
                         

                        ?>
                        <form name="hidden_form" method="post" action="<?php echo $url; ?>">
                            <input name='cal_val_1' id="cal_val_1" type="hidden" value="0" />
                            <input name='discount' id="discount" type="hidden" value="0" />
                            <input name='cash_t' id="cash_t" type="hidden" value="0" />
                        </form>
                    <?php endif; ?>
            
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment Via Cash </h4>
      </div>
      <div class="modal-body">
        <h4>Are You Sure...?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="$(paymentform).submit();">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
  </body>
    <script type="text/javascript">
    $(document).ready(function(){
      var cal_val=$('#cal_val').val();
     
        <?php 
        
          $id=$tablenumber;

         $url=site_url('manager/billing/pdf/'.$id);
        ?>
        $('#print').click(function(){
           

          $(hidden_form).attr('target','_blank').submit();
        });

         $('#print_without_tax').click(function(){
           // window.location.href="<?php echo $url;?>";
             var id = "<?php echo $id;?>";
             var cal_val = $('#cal_val').val();
            var postdata = {'id' : id,'cal_val':cal_val};
              $.post('<?php echo site_url('manager/billing/pdf_without_tax/'.$id) ?>',postdata, function(data){
                  
                  var windowName="Test";
                  myWindow=window.open("<?php echo site_url('manager/billing/pdf_without_tax/'.$id) ?>", windowName, "height=200,width=200");
                // myWindow=window.open('','', "height=200,width=200");
                  // myWindow.document.write(data);
                // myWindow.focus();
                  myWindow.print();  
                // myWindow.close(); //missing code

                });
        });
            
 
     
        
        

         $('#makepayment').click(function(){
           
           
           $("html, body").animate({ scrollTop: 0 }, "slow");

              $.ajax({
             type: "POST",
             url: "<?php echo site_url('manager/billing/load_inner_part'); ?>",
             
                 success: function(data){
              
              $('#inner_part').html(data);
             
                $('.box').css('box-shadow','2px 4px 3px skyblue');
             }

        });
    });
          });
</script>
</html>