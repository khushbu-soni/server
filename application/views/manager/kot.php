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
<!--onfocus="window.close()" -->
<body onload="window.print()" onfocus="window.close()">
<?php 
// if(isset($_POST['order_id']))
//   header('Location:')
$kot_info=$_POST;
if(isset($_POST['total_item']))
  $total_item=$_POST['total_item'];



?>
<div class="span11" style="padding: 10px;">
<table style="font-size:10px;width:260px;">

  <tr>
     <td style="text-align:center;border: 0px solid black !important;">
     Date/time:  <?php echo  date('d-m-Y')." " .date('H:i:s'); ; ?>
    </td>
  </tr>
  <tr>
  <?php 
  $td="";
    if($_POST['waiter_name']!=''){
      
       $td.="<td style='text-align:center;border: 0px solid black !important;'>
         Waiter:<b><u>".$_POST['waiter_name']."</u></b></td>";
       }

       elseif($_POST['customer_name']!=''){
          $td.="<td style='text-align:center;border: 0px solid black !important;'>
               For Customer:<b><u>".$_POST['customer_name']."</u></b></td>";
       }

       echo $td;
    ?>
    
  </tr>
    <tr>
      <td> Ordered Items</td>
    </tr>
  <?php for($i=1;$i<=$total_item;$i++):?>
              <tr>
                <td  >
                 <?php echo $_POST['item_name_'.$i];?>
                -->
                 <?php echo $_POST['qty_'.$i];?>
                </td>
              </tr>
  <?php endfor;?>
<tr>
    <td>-------------------------------------------</td>
</tr>
<tr><td ><b>Order No:<?php echo $_POST['order_id']; ?></b>
                           
                            </td>
</tr>
<tr>

                              <td colspan="" style="text-align:center;border: 0px solid black !important;">POS Provided by Hogo Africa <br>www.hogoworld.com<br>+91 9668845878
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