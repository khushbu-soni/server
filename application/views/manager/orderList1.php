<!DOCTYPE html>
<html>
	<head>
		<title>Biryani House.</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/boostrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap-collapse.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		
		<style type="text/css">
			.margin-10px{
				margin: 10px ;
			}

			.padding-10px{
				padding: 5px !important;
			}
		</style>
		<script type="text/javascript">
		$(document).ready(function(){

			$('#tr tr').on('click',function(){
		  // $('tr').removeClass('btn btn-warningdefault');
				  $(this).removeClass('btn btn-default').toggleClass('btn btn-warning');
				});
		
			setInterval(function(){alert()},100);
  
		    function my_function(){
				      
		    }


			// });
			

		
		</script>
		
	</head>
<div id="or">
<?php echo $order;?>
	<!-- Button trigger modal -->
</div>

<!-- Modal -->

<!-- MOdel -->
</div>
<div class="span9 outer-frame rounded-6px">
<?php if (empty($orders_details)): ?>
	<div class="alert alert-danger">
									Please Select Any Order.
								</div>
<?php endif;?>
<?php if (!empty($orders_details)): ?>
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
							<td><input type='text' name='tax' value="<?php echo $tax_info->tax;?>"</td>
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
								<button type="button" class="btn btn-default" aria-label="Left Align">
								  <i class="icon-print icon-black"></i>Print</span>
								</button>
							</td>
						</tr>
						</table>
						</form>
                    </div>
                    
            <?php endif; ?>    
<script type="text/javascript">
	$(document).ready(function(){
		$('#makepayment').click(function(){
			$(paymentform).submit();
		});
	});
</script>
</div>

	

	