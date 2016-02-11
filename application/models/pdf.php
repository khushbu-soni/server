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
<body onload="window.print()" onfocus="window.close()">
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
                            <td colspan="3"><center><img  style="height: 80px;width:110px;"  src="<?php echo base_url() . 'assets/dishes/logo.jpg' ?>" /></center></td>
                        </tr>
                        <tr>

                            <td colspan="3"><center><b><?php echo $basic_info->hotel_name;?></b>
                            </center>
                            </td>
                            </tr>
                        
                        <tr>
                        
                            <td colspan="3"><center>Address :<?php echo $basic_info->address;?></center>
                          </td>
                            </tr>
                     
                        <tr>
                        
                            <td colspan="3"><center>Phone No :<?php echo $basic_info->contact;?></center>
                          </td>
                            </tr>
                            <tr>
                        
                            <td colspan="3">&nbsp;
                          </td>
                            </tr>

                        <tr>

                            <th style="text-align:left">Menu Item</th>
                            <th style="text-align:left">Qty</th>
                            <th style="text-align:left">Price</th>
                            </tr>
                          
                        <?php foreach ($orders_details as $val): ?>
                            <tr><td><?php echo $val->name ;?></td>
                                <td><?php echo $val->quantity ;?></td>
                                <td><?php echo $basic_info->currency." ".$val->price ;?></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td>Tax</td>
                            <td><?php echo $tax;?></td>
                        </tr>
                        <tr id="with_tax" style="background-color:#000000;">
                            <td></td>
                            <td style="color:#FFFFFF;font-weight:bold">TOTAL</td>
                            <td style="color:#FFFFFF;font-weight:bold"><?php echo $basic_info->currency." ".round($totals['total'],2);?></td>
                        </tr>
                        <tr>
                        
                            <td colspan="3">&nbsp;
                          </td>
                            </tr>
                        <tr>
                        
                            <td colspan="3" style="text-align:center">POS Provided by Hogo Africa <br>www.hogoworld.com<br>+91 000000000
                          </td>
                            </tr>
                            
                        <tr>
                        
                            <td colspan="3" style="text-align:center"><b>**** THANKS YOU FOR VISIT ****</b>
                          </td>
                            </tr>
                        <tr>
                        
                            <td colspan="3">&nbsp;
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
