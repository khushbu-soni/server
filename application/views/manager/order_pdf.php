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
<body onload="window.print()" onfocus="window.close()">

<div class="span11" style="padding: 10px;">
    <div id="page-wrap">
    <div class="sapn3"></div>
       <div class=" span4 paymentmain rounded-4px" >
                    <div class="row-fluid">
                    <!-- <div class="span12 alert alert-primery" style="text-align:center ;font-size:20px;width:220px;" >Bill</div> -->
                    <!-- <hr/> -->
                    </div>
                       


                        <table  style="font-size:10px;width:260px;" >
                       	

							<?php   foreach ($orders as $order): ?>
							<tr>
							 <td colspan="3" style="text-align:center;border: 0px solid black !important;">
							 Date/time:  <?php echo $order->timestamp; ?>
                          </td>

							<tr>
							<tr>
							 <td colspan="3" style="text-align:center;border: 0px solid black !important;">
							 Waiter:  <b><u><?php echo $waiter_name; ?></u></b>
                          </td>

							<tr>

							
							<tr>
                            <td >
                            <b>Table Number : <h3><?php echo $order->tablenumber; ?></h3></b>
                            </td>
                           
                            </tr>

                       		
                        	
								
								<tr><td><b>Ordered Items: </b></td></tr>
								
											<?php
												$ordereditems = $order->getOrderedItems();
												
												foreach ($ordereditems as $ordereditem){
													
														echo '<tr><td>';
													echo $ordereditem->itemname;
													echo ' -> ';
													echo $ordereditem->quantity;

													
												
												
												if($ordereditem->ingredients!='All')
												{
												echo "&nbsp;&nbsp;&nbsp;<b style=color:green;>[ Extra ";
													echo $ordereditem->ingredients;
													echo " ] </b>";
												}
													echo '</td></tr>';
												}
											?>
											
										</tr>
  
                             				
							
								<tr>
								<td>-------------------------------------------</td>
								</tr>
								 <tr><td ><b>Order No:<?php echo $order->id; ?></b>
                           
                            </td>
                            </tr>
                            
							<?php endforeach; ?>
							<tr>

							                <td colspan="3" style="text-align:center;border: 0px solid black !important;">POS Provided by Hogo Africa <br>www.hogoworld.com<br>+91 9668845878
                          </td>
                            </tr>
                            <tr>

							                <td colspan="3" style="text-align:center;border: 0px solid black !important;">&nbsp;
                          </td>
                            </tr>
                            
				                       </table>

                       
                    </div>
                        <div class="sapn3"></div>
    </div>
    <!--</form>-->
</div>	

</body>
</html>			