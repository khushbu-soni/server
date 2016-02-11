

<?php 
if (empty($total_tables_customer)) {
	echo "<center> <b>No Customer On Table Please <a href='".site_url()."waiter/dashboard/customer_order_call/$table_no'> ASK Name? </a></b></center> <br>";
	echo "<div style='border-radius: 10px; border-bottom:solid #d9534f; text-align:center; border-top:solid #d9534f; text-align:center;'>

	<b>Reserved  Table</b>
	<form action='".site_url()."waiter/dashboard/reserve_table/$table_no' method='post' > ";
	echo "<br> customer name : <input type='text' name='r_txt' required>";
	echo "<br> Time From : <input type='text' style='width:50px;' name='time_from' required>";
	echo " &nbsp;To <input required type='text' style='margin:10px 10px 10px 10px; width:50px;' name='time_to'>";
	echo "<br>&nbsp;&nbsp;&nbsp;<input type='submit' class='btn btn-success' value='Reserved'>";
	echo "</div>";

	//echo "<br>Reserved  Table 	<a href='".site_url()."waiter/dashboard/reserve_table/$table_no' class='btn btn-success'> ASK Name? </a>";
}else
{
	echo "<div style='float:right; border-radius: 10px; border:solid #d9534f;'> 
	New Customer <a class='btn btn-danger' href='".site_url()."waiter/dashboard/customer_order_call/$table_no'> ASK Name? </a>
	</div>";

		$i = 1;
foreach ($total_tables_customer as $customer_list) {

	echo "<form style='border-radius: 10px; width:auto; border:solid #eee;' style='float:inline;' method='post' id='takeorder".$i."' action='".site_url()."waiter/dashboard/takeorder/".base64_encode($customer_list->customername)."/".base64_encode($customer_list->tablenumber)."/".base64_encode($customer_list->customer_unique_id)."/".base64_encode($customer_list->id)."'><div style=''>";
echo "<a class=";
$r = (($i*2)/$i);
if ($r==$i) {

echo "'btn btn-success'" ;

}else{
	echo "'btn btn-info'" ;	
}



echo "href='#'  onclick=$('#takeorder$i').submit()><img src='".base_url()."assets/img/default.png' height='80px' />".$customer_list->customername."</a>";

echo "</div></form>";
$i++;

}
}

?>