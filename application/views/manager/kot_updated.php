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
<!--onload="window.print()"  onfocus="window.close()" -->
<body onload="window.print()"  onfocus="window.close()">
<?php 
// if(isset($_POST['order_id']))
$orders=$this->data['orders'];

// echo "<pre>";
// print_r($this->data['orders']);
// echo "</pre>";
// exit();


?>
<div class="span11" style="padding: 10px;">
<table style="font-size:12px;width:260px;">
  <tr>
     <td style="text-align:center;border: 0px solid black !important;">
     <h3>Biryani House</h3>
    </td>
  </tr>
  <tr >
    <td style="text-align:center;border: 0px solid black !important;font-size:10px !important;">
      <p><!-- 
    AFRICA AVENUE 16 KAMPALA UGANDA<br/>
        THE FOOD OF KINGS<br/>
        TIN NO. 1004245136<br/> -->
           <b> XXX KOT XXX</b>
    </p>
    </td>
  </tr>
    
  
  <tr>
     <td style="text-align:center;border: 0px solid black !important;">
     Date/time:  <?php echo  date('d-m-Y')." " .date('H:i:s'); ; ?>
    </td>
  </tr>
  <tr>
  <?php 
  $td="";
  foreach ($orders as $junk){
    $tablenumber=$junk['tablenumber'];
    $customer_name=$junk['customername'];
    $waiter_name=$junk['waiter_name'];
  }
    if($tablenumber!=0){
      
       $td.="<td style='border: 0px solid black !important;'>
         Waiter:<b><u>".$waiter_name."</u>&nbsp;&nbspStatus:<b><u>Dine</u></b>&nbsp;&nbsp;Table No.:<b><u>".$tablenumber."</u></b></b></td>";
       }

       else{
          $td.="<td style='border: 0px solid black !important;'>
               For Customer:<b><u>".$customer_name."</u>&nbsp;&nbsp;Status:<b><u>Take Away</u></b></b></td>"
               ;
       }

       echo $td;
    ?>
    
  </tr>
    <tr>
      <td> Ordered Items</td>
    </tr>
 
   <?php foreach ($orders as $junk):?>
              <tr>
                <td  >
                 <?php
                 $order_id=$junk['orderid'];
                 $sl=$junk['el'];
                 $el=$junk['sl'];
                  echo $junk['name'];?>
                -->
                 <?php echo $junk['quantity'];?>
                </td>
              </tr>
  <?php endforeach;?>
<tr>
    <td>-------------------------------------------</td>
</tr>
<tr><td ><b>Order No:<?php echo $order_id; ?></b>
<tr><td ><b>ETHNICITY:<?php echo $el; ?></b>
<tr><td ><b>SPICEY:<?php echo $sl; ?></b>
                           
                            </td>
</tr>
<tr>

                              <td colspan="" style="text-align:center;border: 0px solid black !important;">POS Provided by Hogo Africa <br>www.algolafrica.com<!-- <br>+256 783866971 -->
                          </td>
                            </tr>
                            <tr>

                              <td colspan="0" style="text-align:center;border: 0px solid black !important;">&nbsp;
                          </td>
                            </tr>
  </table>
</div>	

</body>
</html>			