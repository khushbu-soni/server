<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/cal/css/jquery.calculator.css'; ?>" type="text/css"/>
		<script src="<?Php echo base_url() . 'assets/cal/js/jquery.plugin.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/cal/js/jquery.calculator.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#welcomeform').validationEngine();
				$(key_form).submit(function(){
					
					if(!$('#basicCalculator').val()){
						alert("Please Enter Key");
						return false;
					}

				});
				
			});

			function callWaiter(event){
				type = 0;
				$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
			}

			$(function () {
				$.calculator.setDefaults({showOn: 'both', buttonImageOnly: true, buttonImage: 'calculator.png'});
				$('#basicCalculator').calculator();
				$('#sciCalculator').calculator({layout: $.calculator.scientificLayout});
			});

			 function changeID(customer_unique_id,customername)
            {              
            	var id=customer_unique_id;           
            	var name=customername;           
               // alert(id);
	            $("#temp").val(id);
	            $("#customername").val(customername);
            }


		</script>
		<style type="text/css">
		.calculator-popup{
			display: block;
		    left: 447.5px;
		    position: absolute;
		    top: 127px;
		    width: auto;
		    z-index: 100000 !important;
		}
		</style>
	</head>

	<body>
		<?php echo $paymentheader; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span4 outer-frame1 rounded-6px" style="">
					<div class="rounded-4px1 paymentorder1"></div>
				</div>
				<div class="span4 outer-frame rounded-6px">
					<div class="paymentmain rounded-4px" style="">

						<?php if ($this->session->flashdata('sameuser') != ''): ?>
					    <div class="alert alert-danger">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('sameuser'); ?>
						</div>
					<?php endif; ?>

						<div class="boxheading toprounded-4px">
							Customers On Table No .<?php echo $this->session->userdata['tablenumber'];?>
						</div>

						<div class="chat-panel panel panel-default chat-boder chat-panel-head">
                        <div class="panel-heading">
                            <i class="fa fa-list fa-fw"></i>
                           
                        </div>
                    <?php $all_exist_customers=$this->data['info']; ?>
                        <div class="panel-body" style="height:350px !important;">
                           
                                <?php if (empty($all_exist_customers)): ?>
								<div class="alert alert-danger">
									You Are not Place any order please 
									<a href="<?php echo site_url('customer/menu');?>">continue. </a>
								</div>
							<?php endif; ?>

                           <?php
							
							foreach ($all_exist_customers as $customer) {
							?>
	                       		<a href="#myModal" role="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" onclick="changeID('<?php echo $customer['customer_unique_id']?>','<?php echo $customer['customername']?>')"><?php echo $customer['customername'];?></a>
	                        <?php }?>  
                          
                        </div>

                        
                    </div>

					</div>
				</div>
				<div class="span4 outer-frame1 rounded-6px1">
					<div class="wincoupon rounded-4px" style=""></div>
				</div>
			</div>
			<br/>
		</div>
		


 
<!-- Modal -->

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Enter You Secuirty Key</h3>
</div>
<div class="modal-body">
<form method="post" data-toggle="validator" role="form" name="key_form" action="<?php echo site_url('customer/welcome/placeorder'); ?>">
	
	<div style="" class="control-group">


							<div class="controls">
								<input type="text" id="basicCalculator" class="input-xlarge" required value="" name="key" /><br/>
								 <input id="temp" type="hidden" name="customer_unique_id" value="temp value" />
								 <input id="customername" type="hidden" name="customername" value="temp value" />
							</div>
						</div>

</form>
</div>

<!-- <div class="modal-footer form-actions">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" onclick="$(key_form).submit()" class="save">Save changes</button>
</div> -->

<!-- <div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									    <button type="submit" onclick="$('#menuitemform').submit()" class="btn btn-info"><i class="icon-ok"></i> Save</button>
									<a href="<?php echo site_url('manager/menuitems'); ?>" class="btn btn-danger transition"><i class="icon-remove"></i> Cancel</a>
								  	</div>
								
								</div>
 -->
<div class="form-actions" style="margin-bottom:0;">
									<div class="form-group">
									<button class="btn btn-primary" onclick="$(key_form).submit()" class="btn btn-info"><i class="icon-ok"></i> Submit</button>
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								  	</div>
								
								</div>
</div>

	</body>

</html>