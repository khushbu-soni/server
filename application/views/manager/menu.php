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
				$.post("<?php echo site_url('manager/menu/profile'); ?>", "id="+ order_id + "&status=2");
			}
		</script>

		<script type="text/javascript">
		$(document).ready(function()
		{


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
					url: "<?php echo site_url('manager/menu/get_menu_items_all'); ?>",
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
					url: "<?php echo site_url('manager/menu/get_menu_items'); ?>",
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
					url: "<?php echo site_url('manager/menu/search'); ?>",
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
					url: "<?php echo site_url('manager/menu/temp_your_order'); ?>",
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
				 <!-- <pre>
		
		<?php 
		print_r($this->session->all_userdata());
		?>

		</pre> 
		 -->
			
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
							</div>
							<div style="float:right;">
								Search :
									  <input onkeyup="searchmenu(event)" type="text" id="searchbox" placeholder="Search Menu" title="Search Menu By Key">
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
	
	


				<div class="modal hide fade" id="profile-modal">
						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Profile</h3>
											<?php
											//print_r($get_profile);
											 ?>


										</div>
										<form class="form-horizontal" id="registerHere" method='post' 
										action="<?php echo site_url('manager/menu/set_profile')?>">
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