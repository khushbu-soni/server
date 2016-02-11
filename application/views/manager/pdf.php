 <link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url() ?>invoice/css/print.css' media="print" />
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>invoice/js/example.js'></script>
<style>
    table td, table th {
    border: 1px solid black;
    padding: 5px;
}
  #header, #footer { 
    visibility: hidden !important;
    display: none !important;
 }

  .header, .footer { 
    visibility: hidden !important;
    display: none !important;
 }

@media print {
     #header, #footer { 
    visibility: hidden !important;
    display: none !important;
 }

  .header, .footer { 
    visibility: hidden !important;
    display: none !important;
 }
}
</style>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript">
$( document ).ready(function() {

  
});
</script>
<html>
<?php
// print_r($orders_details);
$OrderID="";
foreach ($orders_details as $val) {
    $OrderID=$val->orderid;
    $tablenumber=$val->tablenumber;
    $waiter_name=$val->waiter_name;
}

// exit();

?>
<!-- onfocus="window.close()" -->
<body onload="window.print()"  >
<div class="" id="wrapper" >
    <div id="page-wrap">
   
       <div class=" span4 paymentmain1 rounded-4px1" >
                    <div class="row-fluid">
                    <!-- <div class="span12 alert alert-primery" style="text-align:center ;font-size:20px;width:220px;" >Bill</div> -->
                    <!-- <hr/> -->
                    </div>
                        <div>

                        <table  style="font-size:10px;width:260px;" >
                        <tr>
                            <td colspan="3" style=" border-right: none;padding:0px;"><center><img  style="height: 60px;width:90px;margin-bottom:-7"  src="<?php echo base_url() . 'assets/dishes/logo.jpg' ?>" /></center></td>
                            <td colspan="" style=" border-left: none;"><center><img  style="height: 80px;width:110px;border-left:none;margin-bottom:-20"  src="<?php echo base_url() . 'assets/dishes/cafe1six.jpg' ?>" /></center></td>
                        </tr>
                        <!-- <tr>

                            <td colspan="3"><center><b><?php echo $basic_info->hotel_name;?></b>
                            </center>
                            </td>
                            </tr> -->
                        
                        <tr>
                        
                            <td colspan="4"><center><?php echo $basic_info->address;?><br/>Phone: <?php echo $basic_info->contact;?></center><center></center>
                          </td>
                        </tr>
                     
                         <tr>
                        
                            
                            <td colspan="4" style="text-align:left">
                            
                                <b>Table No.</b>&nbsp;<?php echo $tablenumber; ?>&nbsp;&nbsp;<b>Date:</b>&nbsp;<?php echo date('d-m-Y')."  ".date('h:i A', strtotime(date('m-d-Y H:i:s')));?>
                            </td>
                            <?php
                            // $date = '08/04/2010 22:15:00';
                            date_default_timezone_set('Asia/Kolkata');
                            
                            ?>

                            

                            </tr>
                            <tr>
                            <td colspan="4" style="text-align:left">
                            
                                 <b>OrderID:</b>&nbsp;<?php echo $OrderID; ?>&nbsp;&nbsp; <b>Served By:</b> &nbsp;<?php echo $waiter_name;?>
                            
                            </td>
                            
                          
                            </tr>

                        <tr>

                            <th colspan="2" style="text-align:left">Menu Item</th>
                            <th style="text-align:left;">Qty</th>
                            <th colspan="" style="text-align:left">Price</th>
                            </tr>
                          
                        <?php foreach ($orders_details as $val): ?>
                            <tr ><td colspan="2" style="text-align:left"><?php echo $val->name ;?></td>
                                <td style="text-align:left"><?php echo $val->quantity ;?></td>
                                <td  style="text-align:left"><?php echo $val->price ;?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                        if($tax){
                            $tr="<tr > 
                                <td colspan='2'></td>
                                <td >Tax</td><td colspan='2'>".$tax."%</td></tr>";
                                echo $tr;
                        }
                        ?>
                        <?php
                        if($discount){
                            $tr="<tr> 
                                <td colspan='2'></td>
                                <td >Discount Amount</td><td colspan='2'>".$discount."</td></tr>";
                                echo $tr;
                        }
                        ?>
                        
                        <tr id="with_tax" >
                            
                            <td colspan="4"  style="font-weight:bold;text-align:right">Eat In Total <?php echo "<span style=''>&nbsp;&nbsp;&nbsp;$basic_info->currency ".round($totals['total'],2)."</span> ";?></td>
                        </tr>
                         <tr >
                           
                            <td colspan="4" style="font-weight:bold;text-align:right">Cash Tendered <?php echo $cash_tendered;?>
                            </td>
                        </tr>
                         <tr >
                            
                            <td colspan="4" style="font-weight:bold;text-align:right">Change <?php echo $change;?></td>
                        </tr>
                        
                        <tr>
                        
                            <td colspan="4" style="text-align:center">POS Provided by <b>www.jdiafrica.com</b><br>+256-786222064&nbsp;<b>Tin No.00000000<b>
                          </td>
                            </tr>
                            
                        
                        <tr>
                            <td colspan="4" style="text-align:center"><b>**** THANKS YOU FOR VISIT ****</b>
                          </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4">&nbsp;
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
