
		
		
		
		<style type="text/css">
			.margin-10px{
				margin: 10px ;
			}

			.padding-10px{
				padding: 5px !important;
			}
			.menuimg {
			    height: 30px !important;
			    margin-right: 20px;
			    width: 140px;
		       margin-top: -18px !important;
			}

			.outer-frame {
			    background-color: #f0f6f6 !important;
			    border: 1px solid #9cc177 !important;
			    padding: 5px;
			}

			

		</style>
		<script type="text/javascript">
		$(document).ready(function(){
					
				
                setInterval(function() {
				var url = "<?php echo site_url('manager/billing/ajax_handler'); ?>" 
            	alert('hi');
            	$.post(url,'', function(data){
							$('#orders').html(data);
                	});
				                	
                }, 1000);
					

			});
		</script>

		<script type="text/javascript">
	$(document).ready(function(){
		$('#<?php  echo $this->session->userdata[1] ?>').removeClass('btn btn-default').toggleClass('sample btn1 custom large l');
	});
</script>
<style type="text/css">
	
.btn1.l {
    background-color: hsl(145, 62%, 68%);
    background-image: linear-gradient(hsl(145, 62%, 88%), hsl(145, 62%, 68%));
    background-repeat: repeat-x;
    border-color: hsl(145, 62%, 68%) hsl(145, 62%, 68%) hsl(145, 62%, 63%);
    color: #333;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.33);
}

.btn1 {
  display: inline-block;
  *display: inline;
  padding: 4px 14px;
  margin-bottom: 0;
  *margin-left: .3em;
  font-size: 14px;
  line-height: 20px;
  *line-height: 20px;
  color: #333333;
  text-align: center;
  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
  vertical-align: middle;
  cursor: pointer;
  background-color: #f5f5f5;
  *background-color: #e6e6e6;
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
  background-repeat: repeat-x;
  border: 1px solid #bbbbbb;
  *border: 0;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
  border-bottom-color: #a2a2a2;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  filter: progid:dximagetransform.microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
  filter: progid:dximagetransform.microsoft.gradient(enabled=false);
  *zoom: 1;
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.btn1:hover {
  color: #333333;
  text-decoration: none;
  background-color: hsl(145, 62%, 68%) !important;
  *background-color: #d9d9d9;
  /* Buttons in IE7 don't get borders, so darken on hover */

  background-position: 0 -15px;
  -webkit-transition: background-position 0.1s linear;
     -moz-transition: background-position 0.1s linear;
       -o-transition: background-position 0.1s linear;
          transition: background-position 0.1s linear;
}
/*
.btn{
	background-color:lightgreen !important;
}*/
</style>

<div id="wrapper">
	    <?php echo $header;?>
	    <?php echo $sidebar;?>


	    <div id="page-wrapper" >
            <div id="page-inner">
	    <div class="row row-fluid">
				<div class="span3 ">
				<div id="or">
					<!-- Button trigger modal -->
				</div>
				</div>
<div class="span9 outer-frame rounded-6px">
<?php if (empty($orders_details)): ?>
	<div class="alert alert-danger">
									Please Select Any Order.
								</div>
<?php endif;?>
<?php if (!empty($orders_details)): ?>
                    <div class="paymentmain rounded-4px" style="">
                    <div class="row-fluid">
                    <div class="span12 alert alert-primery" style="text-align:center; font-size:30px;" >Invoice</div>
                    <div class="span12 " style="text-align:center;" ><img class="img-polaroid menuimg" height="37px" src="<?php echo base_url() . 'assets/dishes/' . $basic_info->logo; ?>" /></div>
                    <hr/>
                    </div>
                    
                    		
                    	
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
							<td><?php echo round($totals['total'],2);?></td>
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
            <?php endif; ?>
            </div>    
            </div>    
            </div>    
            </div>    
            </div>    

</div>