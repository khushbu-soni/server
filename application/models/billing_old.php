<!DOCTYPE html>
<html>
    <head>
        <title>Biryani House.</title>
        
        <?php echo $dependencies; ?>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
        <style type="text/css">
            .form-horizontal input {
            height: 35px;
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
                setInterval(function() {
                var url = "<?php echo site_url('manager/billing/ajax_handler'); ?>" 
                $.post(url,'', function(data){
                            $('#orders').html(data);
                    });
                }, 3000);

                $("#cal").change(function(){
                    $('#with_tax').toggle();
                    $('#without_tax').toggle();
                    if($('#cal:checked').val())
                            $('#cal_val').val('1');
                    if(!$('#cal:checked').val())
                            $('#cal_val').val('0');
                });

            });
        </script>
<?php echo $header;?>


	    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-4" id="orders">
                   
                    
                    </div>


                <!-- Payment Form -->
                    <div class="col-md-6 col-sm-12 col-xs-12">
                         
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                Invoice Details
                            </div>
                            <div class="panel-body">
                            <?php if (empty($orders_details)): ?>
                            <div class="alert alert-danger">
                                    Please Select Any Order.
                                </div>
                                </div>
                            <?php endif;?>
<?php if (!empty($orders_details)): ?>
                     <form class="form-horizontal" name="paymentform" method="post" action="<?php echo site_url('manager/billing/makepayment'); ?>">
                        <table class="table table-bordered">
                        <tr>
                            <th>Menu Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            </tr>
                        <?php foreach ($orders_details as $val): ?>
                            <tr><td><?php echo $val->name ;?></td>
                                <td><?php echo $val->quantity ;?></td>
                                <td><?php echo $val->price ;?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td>Calculate Tax</td>
                            <td><input type="checkbox" name="cal" id="cal" val="1"/></td>
                        </tr>
                        <tr style="display:none;">
                            <td></td>
                            <td>Tax</td>
                            <td><input type='text' name='tax' id='tax' value="<?php echo $basic_info->tax;?>"></td>
                           
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td id="with_tax"><input type="text" value="<?php echo round($totals_with_tax['total'],2);?>" name="total_with_tax"/></td>
                            <td id="without_tax"><input type="text" value="<?php echo round($totals_without_tax['total'],2);?>" name="total_without_tax"/></td>
                        </tr>
                        <tr>
                                <td></td>
                                <td><input type='hidden' name='total' value="<?php echo $totals_with_tax['total'];?>" /></td>
                                <td><input type='hidden' name='total' value="<?php echo $totals_without_tax['total'];?>" /></td>
                                <td><input type='hidden' name='tablenumber' value="<?php echo $tablenumber['tablenumber'];?>" /></td>
                                <td><input type='hidden' name='customer_unique_id' value="<?php echo $tablenumber['customer_unique_id'];?>" /></td>
                            </tr>                       
                        <tr>
                            <td>
                                <button type="button" id="makepayment" class="btn btn-info" aria-label="Left Align">
                                  <i class="icon-thumbs-up icon-black"></i>Make Payment</span>
                                </button>
                            </td>
                            <td></td>
                            <td>
                                <button type="button" id="print" class="btn btn-info" aria-label="Left Align">
                                  <i class="icon-print icon-black"></i>Print</span>
                                </button>
                            </td>
                        </tr>
                        </table>
                        </form>
                        <?php
                         $id=$tablenumber['customer_unique_id'];
                         $url=site_url('manager/billing/pdf/'.$id);
                        ?>
                        <form name="hidden_form" method="post" action="<?php echo $url; ?>">
                            <input name='cal_val' id="cal_val" type="hidden" value="0" />
                        </form>      
                    <?php endif; ?>
                      
		
		</div>
	</body>
    <script type="text/javascript">
    $(document).ready(function(){
        <?php
            $this->session->unset_userdata('cal_with');
            $this->session->unset_userdata('cal_without');
            // print_r($this->session->userdata);
            // exit();
        ?>
        $('#makepayment').click(function(){
            $(paymentform).submit();
        });

        
        <?php 
        $id=$tablenumber['customer_unique_id'];
        $url=site_url('manager/billing/pdf/'.$id);

        ?>
        $('#print').click(function(){
           // window.location.href="<?php echo $url;?>";
            $(hidden_form).submit();
        });
    });
</script>
</html>