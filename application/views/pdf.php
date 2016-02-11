<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/print.css' media="print" />
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/example.js'></script>

<div class="span11" style="padding: 10px;">
    <div id="page-wrap">

       

        

       <div class="paymentmain rounded-4px" style="">
                    <form class="form-horizontal" name="paymentform" method="post" action="<?php echo site_url('manager/billing/makepayment'); ?>">
                        <table class="table table-bordered">
                        <tr>
                            <th>Menu Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            </tr>
                        <?php foreach ($orders_details as $val): ?>
                            <tr><td><?php echo $val->name ;?></td>
                                <td><?php echo $qty['qty'] ;?></td>
                                <td><?php echo $val->price*$qty['qty'] ;?></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td>Tax</td>
                            <td><input type='text' name='tax' value="<?php echo $basic_info->tax;?>"</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td><?php echo $totals['total'];?></td>
                        </tr>
                        <tr>
                                <td></td>
                                <td><input type='hidden' name='total' value="<?php echo $totals['total'];?>" /></td>
                                <td><input type='hidden' name='tablenumber' value="<?php echo $tablenumber['tablenumber'];?>" /></td>
                                <td><input type='hidden' name='customer_unique_id' value="<?php echo $tablenumber['customer_unique_id'];?>" /></td>
                            </tr>                       
                        <tr>
                            <td>
                                <button type="button" id="makepayment" class="btn btn-default" aria-label="Left Align">
                                  <i class="icon-thumbs-up icon-black"></i>Make Payment</span>
                                </button>
                            </td>
                            <td></td>
                            <td>
                                <button type="button" id="print" class="btn btn-default" aria-label="Left Align">
                                  <i class="icon-print icon-black"></i>Print</span>
                                </button>
                            </td>
                        </tr>
                        </table>
                        </form>
                    </div>

<?php $this->load->view('common/footer.php'); ?>