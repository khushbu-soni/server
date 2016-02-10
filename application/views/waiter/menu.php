<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<style type="text/css">
		
		</style>
		<?php echo $dependencies; ?>



		<script type="text/javascript">

		

			function setprofile(event)
			{
				order_id = $('#btnDelivery').attr('orderid');
				$.post("<?php echo site_url('waiter/menu/profile'); ?>", "id="+ order_id + "&status=2");
			}
		</script>

		<script type="text/javascript">
		$(document).ready(function()
		{


				type = 0;

				//remove the active class from all the list items
				
				$('.menu-loading').show();
				$('.menurow').hide();
				
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/menu/get_menu_items_all'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});
			

			window.setInterval(scrollit, 5000);

function scrollit() {
    console.log(($("#scroller").scrollTop() + $("#scroller").innerHeight()))
    console.log($("#scroller")[0].scrollHeight)

    if(($("#scroller").scrollTop() + $("#scroller").innerHeight()) >= $("#scroller")[0].scrollHeight)   
        $('#scroller').animate({ scrollTop: 0 }, 1000).delay(900);  
    else   
        $('#scroller').animate({ scrollTop: $("#scroller").scrollTop() + 170 }, 'slow',function(){

    });
}

		$('#mobile').on('keydown',function(e){
		    var deleteKeyCode = 8;
		    var backspaceKeyCode = 46;
		    if ((e.which>=48 && e.which<=57) ||
		         (e.which>=96 && e.which<=105)  || // for num pad numeric keys
		         e.which === deleteKeyCode || // for delete key,
		             e.which === backspaceKeyCode) // for backspace
		         // you can add code for left,right arrow keys
		    {
		        $(this).removeClass('error');
		        return true;
		    }
		    else
		    {
		        $(this).addClass('error');
		        return false;
		    }
		});

		  

		


		});
		</script>

		<script type="text/javascript">

		
		function getMenuItemsAll(event){
				menuitem = $(event.target);
				type = 0;

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();
				
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/menu/get_menu_items_all'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});
			}




			function getMenuItems(event){
				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/menu/get_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});
			}

			function searchMenu(searchstring){
				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/menu/search'); ?>",
					data: "search=" + searchstring,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
					}
				});
			}

			function searchmenu(searchstring){
			$('#searchbox').keyup(function(e){
					
						searchstring = $('#searchbox').val();
						searchMenu(searchstring);
						//return false;
					
				});
		}
			

			$(document).ready(function(){
				

				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/menu/temp_your_order'); ?>",
					data: "type=" + 0,
					success: function(data, textStatus){
						$('.items').html(data);
						
					}
				});


			});
	
		</script>
	
	</head>

	<body>
	
		<?php echo $menuheader; ?>
			
			
			<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid" >
				<div class="span9" >
				<?php if ($this->session->flashdata('successmsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('successmsg'); ?>
						</div>
				<?php endif; ?>
			<!--  <pre>
		
		<?php 
		print_r($this->session->all_userdata());
		?>

		</pre> 
		 -->
					<?php $div_count=1; if (!empty($featureditem)): ?>
					
						
						<div id="scroller" class="rounded-6px" style="background-color:#ffffff;margin-bottom:10px; max-width:75%px;max-height:166px; overflow-y: scroll; ">

							
							<?php foreach ($featureditem as $feature){ ?>

			
							<div  class="row-fluid" id="div<?php echo $div_count;?>" >
								<div class="featured span7"  style="  padding:10px; ">

								
										
									<img src="<?php echo $img_path . $feature->picturepath; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="" />
									<span><?php echo $feature->name; ?></span>&nbsp;&nbsp;<br/><span><b>$<?php echo $feature->price; ?></b></span><br/><br/>
									<a href="#moreinfo-modal" itemid="<?php echo $feature->id; ?>" onclick="getMoreInfo(event)" class="btn btn-moreinfo btn-moreinfo" data-toggle="modal"><i class="icon-wrench"></i>More Info</a>
									<br/><br/>
									<a href="#" itemid="<?php echo $feature->id; ?>" ingredients="All" itemimg="<?php echo $img_path . $feature->picturepath; ?>" onclick="addToOrder(event)" class="btn btn-primary btn-plus" itemname="<?php echo $feature->name; ?>" price="<?php echo $feature->price; ?>"><i class="icon-plus"></i> Add to Order</a>
									&nbsp;&nbsp;
									<a href="#customize-modal" itemimg="<?php echo $img_path . $feature->picturepath; ?>" onclick="getIngredients(event)" itemprice="<?php echo $feature->price; ?>" itemname="<?php echo $feature->name; ?>" itemid="<?php echo $feature->id; ?>" class="btn btn-custom btn-customize" data-toggle="modal"><i class="icon-wrench"></i> Customize</a>
									<br class="clear" />

								</div>
								<div class="span5 featured_desc" style="">
									<h4 style="line-height: 0px !important;">
									Featured Item
									</h4> <hr style="margin-bottom: 0px !important;"> <b style="margin: 0px 0px 0px !important;"><?php echo $feature->name; ?></b>
									<p style="overflow: auto; width:390px; height:100px;
word-wrap:normal;"><?php echo $feature->description; ?>
									</p>
								</div>
							</div>
							 
					<?php $div_count++;} ?>



						</div>
						<!-- <div style=" max-width:100px; ">
 		<?php for ($c=1;$c<=sizeof($featureditem);$c++){ ?>

						
						<a href="#div<?php echo $c; ?>"><?php echo $c; ?></a>
						
						
						<?php } ?>
						</div> -->
					<?php endif; ?>
					<div class="outer-frame rounded-6px">
						<div class="rightmenucol rounded-4px" style="">
							<div class="boxheading toprounded-4px" >
								Welcome,
						<!--  <pre>
					<?php print_r($this->session->all_userdata()); ?></pre> 	 -->
								<?php /*print_r($this->session->all_userdata());*/ ?>
								<?php /*echo $this->session->userdata('userid');*/?>

								<?php 
								echo $this->session->userdata('customername');
									?>
									<div style="float:right;">
								Search :
									  <input onkeyup="searchmenu(event)" type="text" id="searchbox" placeholder="Search Menu" title="Search Menu By Key">
							</div>
							</div>
							
							<div class="rightmenucontent" >
								<ul class="nav nav-pills">
								<li class="active"><a href="#" onclick="getMenuItemsAll(event)"  class="">All</a></li>
								<?php 	
								foreach ($menutypes as $menutype) { ?>
									<li class="active"><a href="#" onclick="getMenuItems(event)" type="<?php echo $menutype->id;?>" class=""><?php echo $menutype->menutype_name;?></a></li>
								<?php } ?> 
									
									</ul>

								<?php echo $menucontent; ?>			
							</div>
							<!--<br class="clear" /><br/>-->
						</div>
					</div>
				
				</div>
				<?php echo $yourorder; ?>
			</div>
			<br/>
		</div>
		<?php echo $moreinfo; ?>
		<?php echo $customize; ?>
	
	
	<div class="modal hide fade " id="placeorder-modal">
						<div class="modal-header cart-header-modal-top">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Click Yes To Confirm The Order</h3>
											

										</div>
							




										<div class="modal-footer">
										<center>
										<a data-dismiss="modal" class="btn btn-success" href="javascript:;"  onclick="placeOrder(event)" ><i class="icon-ok icon-white"></i> Yes, Confirm My Order</a>
										<a  class="btn btn-info" href="<?php echo site_url('waiter/menu/print_placeorder_kot'); ?>" target='_blank' onclick="placeOrder(event)"  ><i class="icon-print icon-white"></i> Print, Confirm My Order</a>
										<!-- <form method="post"  action="<?php echo site_url('waiter/menu/print_placeorder_kot'); ?>"   > <input  class="btn btn-success"  type="submit" value="Print, Confirm My Order"></form> -->
										<br><br>	<a href="#" data-dismiss="modal" class="btn btn-danger"><i class="icon-remove icon-white"></i>No, I Need To Change My Order</a>

						</center>
						</div>
			</div>



				<div class="modal hide fade" id="profile-modal">
						<div class="modal-header cart-header-modal-top">

											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Profile</h3>
											<?php
											//print_r($get_profile);
											 ?>


										</div>
										<br/>
										<form class="form-horizontal" id="registerHere" method='post' 
										action="<?php echo site_url('waiter/menu/set_profile')?>">
									<fieldset>

									<?php if(empty($get_profile))
									{ ?>
										<div class="control-group">
									<label class="control-label">Name</label>
									<div class="controls">

									<input type="text" value="<?php if($this->session->userdata('customername') !='')echo $this->session->userdata('customername');?>" class="input-xlarge" id="user_name" name="user_name" rel="popover" <?php if($this->session->userdata('customername') =='Guest'){}else{?>readonly <?php } ?>>
									</div>
									</div>


									<div class="control-group">
									<label class="control-label">Mobile</label>
									<div class="controls">
									<input type="text" <?php if($this->session->userdata('customermobile') !='') echo "readonly"?> value="<?php if($this->session->userdata('customermobile') !='')echo $this->session->userdata('customermobile');?>" class="input-xlarge" id="mobile" name="mobile" rel="popover" data-content="Enter your first and last name." data-original-title="Valid Mobile Number 10 Digit">
									</div>
									</div>


									<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
									<input type="text" class="input-xlarge" id="user_email" name="user_email" rel="popover" data-content="What’s your email address?" data-original-title="Email">
									</div>
									</div>

									<div class="control-group">
									<label class="control-label">Birth Date</label>
									<div class="controls">
									  <input  type="text" id="birth_date" name="birth_date" placeholder="click to show datepicker" class="datepicker" id="datepicker">


									</div>
									</div>


									<?php }?>

										<?php 
									
								foreach ($get_profile as $getprofile) { ?> 

							
								
									<div class="control-group">
									<label class="control-label">Name</label>
									<div class="controls">

									<input type="text" value="<?php if($getprofile->customer_name !='')echo $getprofile->customer_name;?>" class="input-xlarge" id="user_name" name="user_name" rel="popover" readonly>
									</div>
									</div>


									<div class="control-group">
									<label class="control-label">Mobile</label>
									<div class="controls">
									<input type="text" value="<?php if($getprofile->mobile != '')echo $getprofile->mobile;?>" class="input-xlarge" id="mobile" name="mobile" rel="popover" data-content="Enter your first and last name." data-original-title="Valid Mobile Number 10 Digit">
									</div>
									</div>


									<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
									<input type="text" value="<?php if($getprofile->email != '')echo $getprofile->email;?>"  class="input-xlarge" id="user_email" name="user_email" rel="popover" data-content="What’s your email address?" data-original-title="Email">
									</div>
									</div>

									<div class="control-group">
									<label class="control-label">Birth Date</label>
									<div class="controls">
									  <input  type="text" value="<?php if($getprofile->birth_date != '')echo $getprofile->birth_date;?>" id="birth_date" name="birth_date" placeholder="click to show datepicker" class="datepicker" >
 <input  type="hidden" value="<?php if($getprofile->id != '')echo $getprofile->id;?>" id="id" name="id">


									</div>
									</div>

								<?php } ?>

									<div class="control-group">
									<label class="control-label"></label>
									<div class="controls">
									<button type="submit" class="btn btn-success" >Create My Account</button>
									</div>
									</div>

									</fieldset>
									</form>



										<div class="modal-footer">
											<a href="#" data-dismiss="modal" class="btn btn-large">Close</a>
						</div>
			</div>


	</body>
</html>