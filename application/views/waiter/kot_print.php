 <link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/print.css' media="print" />
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/example.js'></script>
<style>
    table td, table th {
    border: 1px solid black;
    padding: 5px;
}
</style> 
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript">
$( document ).ready(function() {

  
});
</script>
<html>
<body onload="window.print()" onblur="window.close()">
<div class="span11" style="padding: 10px;">
    <div id="page-wrap">
    <div class="sapn3"></div>
       <div class="span4 paymentmain rounded-4px" >
                    <div class="row-fluid">
                    <!-- <div class="span12 alert alert-primery" style="text-align:center ;font-size:20px;width:220px;" >Bill</div> -->
                    <!-- <hr/> -->
                    </div>
                        <div>

                        <table class="table-cont" style="font-size:10px;" >
                            <tr>
                            <td >
                            <b>Table Number :<?php echo $tablenumber; ?></b>
                            </td>
                           
                            </tr>

                            <tr>
                            <td >
                            <b>Customer Name :<?php echo $customername; ?></b>
                            </td>
                           
                            </tr>
                            <tr><td><b>Ordered Items: </b></td></tr>
                            <?php   foreach ($tempitems as $order): ?>
                            
                                
                <tr collspan="2">
                <td ><b><?php echo $order->itemname; ?></b></td>
                <td>  <?php echo $order->quantity; ?></td>
                </tr>
                                            
                            
                           
                            
                            <?php endforeach; ?>
                            <tr>
                                <td>-------------------------------------------</td>
                                </tr>
                                 <tr>
                                 <td >
                                 <?php if(!empty($orderid)){ ?>
                                    <b>Order ID:<?php echo $orderid; ?></b>
                                   <?php  }else{

                                     ?>
                                 <b>Order By Waiter ID:<?php echo $waiter_id; ?></b>
                                 <?php } ?>
                                  </td>

                            </tr>
                                       </table>
                        </div>
                    </div>
                        <div class="sapn3"></div>
    </div>
    <!--</form>-->
</div>  

</body>
</html>

