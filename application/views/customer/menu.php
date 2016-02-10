<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Restaurant</title>
		<style type="text/css">
.cart-header {
    background: none repeat scroll 0 0 #1c2c39;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
}

@font-face {
   font-family: candy;
    src: url('<?php echo base_url() . 'assets/font/mycandy.otf'?>');
  }

  @font-face {
   font-family: LDFComicSansBold;
    src: url('<?php echo base_url() . 'assets/font/LDFComicSansBold.ttf'?>');
  }


*::after, *::before {
    box-sizing: border-box;
}
*::after, *::before {
    box-sizing: border-box;
}
.cart-content {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #e5e5e5;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    z-index: 962;

   
}
.ordereditem:hover {
    box-shadow: 0px 0px 8px #BBB;
}
.accordion-toggle{
	
	 font-size: 120%;

}
.accordion-toggle:hover{
	
	 font-size: 150%;
}
</style>
		<style type="text/css">
		
		</style>
		<?php echo $dependencies; ?>
<script> 
$(document).ready(function(){
	//console.clear();
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });


     $("#flip-Beverages").click(function(){
        $("#panel-Beverages").slideToggle("slow");
    });

     $("#flip-alcohol").click(function(){
        $("#panel-alcohol").slideToggle("slow");
    });

   
      $("#flip-special").click(function(){
        $("#panel-special").slideToggle("slow");
    });

        $("#flip-shisha").click(function(){
        $("#panel-shisha").slideToggle("slow");

    });

         $("#flip-order").click(function(){
        $("#panel-order").slideToggle("slow");

    });



  
});
</script>

<script type="text/javascript">
   setInterval("my_function();",1000);
    
    		function my_function(){

    	//alert(x);
    
    	
       	 $('#refresh').load(location.href + ' #refresh');

       	 	 $('#refresh-order').load(location.href + ' #refresh-order');
       	 	 $('#refresh2').load(location.href + ' #refresh2');
       	 	 $('#note').load(location.href + ' #note');
       	 	 $('#exit').load(location.href + ' #exit');

       	 document.getElementById("note").style.color = "skyblue";
       	 	
       console.clear();
}
     
     setInterval("my_function_note();",2000);
    
    		function my_function_note(){

    	//alert(x);
    
    	
       	 

       	 document.getElementById("note").style.color = "black";
       	 	
       console.clear();
}  

   
</script>



 
<style> 

 #flip,#menuname,#flip-Beverages,#flip-alcohol,#flip-special,#flip-shisha,#flip-order {
   
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
     padding: 10px;

   
   
}

#panel,#panel-Beverages,#panel-alcohol,#panel-special,#panel-shisha,#panel-order {
    padding: 10px;
    display: none;
}

.notificationorder{
	border-radius: 2px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.7);
    background-color: #dc0d17;
    background-image: linear-gradient(#fa3c45, #dc0d17);
    color: #fff;
    min-height: 13px;
    padding: 1px 3px;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
}
 

.growl-notification{
    position: fixed;
    top: 150px;
    right: 10px;
    z-index: 1000;
}

. .growl-notification {
    background: rgba(0,0,0,0.6);
    color: white;
    padding: 15px 30px;
    width: 200px;
    display: block;
    border-radius: 5px;
    margin-top: 15px;
}
    

</style>

		<script type="text/javascript">



 $(document).ready(function(){
		

 	
   // $("#fullScreen").click();


});
		



	function launchIntoFullscreen(element) {

  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}	

function toggleFullScreen() {
	 
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {

    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }
//$("#fullScreen").removeClass( "btn-info" ).addClass( "btn-danger");      
document.getElementById("fullScreen").value="Cancel FullScreen"; 
  } else { 

    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
 //   $("#fullScreen").removeClass( "btn-danger" ).addClass( "btn-info");  
    document.getElementById("fullScreen").value="FullScreen"; 
  }  
}
		

		

		function exit_customer()
		{



			window.location="<?php echo site_url('customer/menu/customer_logout'); ?>";
			
				
				
			
		
			
		}

		function check_password()
		{
			var valr = $("#psw-cnf").val();
			
			if(valr == 'Hogo007')
			{
				alert("Your Table Reset Successfully!");
				
					window.location="<?php echo site_url('customer/menu/logout'); ?>";
			}
			$("#psw-cnf").val('');
		}

			function setprofile(event)
			{
				order_id = $('#btnDelivery').attr('orderid');
				$.post("<?php echo site_url('customer/menu/profile'); ?>", "id="+ order_id + "&status=2");
			}
		</script>

		<script type="text/javascript">
		$(document).ready(function()
		{
		//$('.menudata').hide();
				
				type = 0;

				//remove the active class from all the list items
				
	/*			$('.menu-loading').show();
				$('.menurow').hide();
				
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/get_menu_items_all'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});*/
			
			// window.setInterval(scrollit, 5000);

// function scrollit() {
//     console.log(($("#scroller").scrollTop() + $("#scroller").innerHeight()))
//     console.log($("#scroller")[0].scrollHeight)

//     if(($("#scroller").scrollTop() + $("#scroller").innerHeight()) >= $("#scroller")[0].scrollHeight)   
//         $('#scroller').animate({ scrollTop: 0 }, 1000).delay(900);  
//     else   
//         $('#scroller').animate({ scrollTop: $("#scroller").scrollTop() + 170 }, 'slow',function(){

//     });

//     console.clear();
// }

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
					url: "<?php echo site_url('customer/menu/get_menu_items_all'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').slideToggle();
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

				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/get_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
					
					$('html, body').animate({
    scrollTop: $("#menuhead12"+type).offset().top
}, 200);
						// $('#menuitem'+type).html(data);
						$('.menuitem23').html(data);
						
						$('.menu-loading').hide();
						
					}
				});
			}

					function getBeveragesMenuItems(event){

				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();

				$('html, body').animate({
    scrollTop: $("#menubevhead"+type).offset().top
}, 200);

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/get_beverages_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
							
						if(data == '')
						{
						$('.menuitembev').html("<div>Empty Data </div>");	
						}else
						{				// $('#menuitem'+type).html(data);
						$('.menuitembev').html(data);
						}
						$('.menu-loading').hide();
						
					}
				});
			}

			function getSpecialOfferMenuItems(event){

				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();

				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/getSpecialOfferMenuItems'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						if(data == '')
						{
						$('.menuitem23').html("<div>Empty Data </div>");	
						}else
						{				// $('#menuitem'+type).html(data);
						$('.menuitem23').html(data);
						}
						$('.menu-loading').hide();
						
					}
				});
			}
		

			function getShishaMenuItems(event){

				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();

				

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/getShishaMenuItems'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						if(data == '')
						{
						$('.menuitem23').html("<div>Empty Data </div>");	
						}else
						{				// $('#menuitem'+type).html(data);
						$('.menuitem23').html(data);
						}
						$('.menu-loading').hide();
						
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
					url: "<?php echo site_url('customer/menu/search'); ?>",
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
					url: "<?php echo site_url('customer/menu/temp_your_order'); ?>",
					data: "type=" + 0,
					success: function(data, textStatus){
						$('.items').html(data);
						
					}
				});


			});
	
		</script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.cycle.all.js'; ?>"></script>
		<script type="text/javascript">
			$('.slide').cycle({
				fx: 'fade'
			});
		</script>
	</head>

	<body style="padding: 0px !important; background-color:#c5c5c5 !important; background-image:'' !important;">
		<?php //echo $menuheader; ?>

				
		<!-- <button id="fullscreen" onClick="fullscreen()">fullscreen</button>	 -->

  <!--  <PRE><?php print_r($this->session->all_userdata()); ?></PRE>   -->	
 


	<div role="tabpanel" style="background-color:#ffffff;" class="text-center">

  <!-- Nav tabs -->







    
  <span id="servertime" style="float:right"><?php echo date('D H-i') ?>
         <?php echo date('M d, Y') ?> 
         </span>

          <a href="#password-modal"  data-toggle="modal" >Free/ResetTable</a>&nbsp;&nbsp; &nbsp;</span>
         
  
| <input class="btn" type="submit" id="fullScreen" onClick="toggleFullScreen()" value="fullscreen">




             	| <span class="text-center" >Table Number : <span class="" style="border: 2px solid;padding:2px;"><?php echo $this->session->userdata('tablenumber');?></span></span>
         
  
  <span id="note">

       <?php if(sizeof($yourorder_total) == 0)
{ ?>
|  <span  class="text-center" id="" style="border: 2px solid;padding:2px;"> Note :- Please Click Exit Before Leaving  </span>
   
   <?php } ?> 
   </span>	           
  
  <ul class="nav nav-tabs" role="tablist" style="font-size:large;font-family:candy !important;background-color:#eee;font-size: 50px;" >
    <li style="padding: 10px;" role="presentation" class="active"><a  href="#home" aria-controls="home" role="tab" data-toggle="tab">Food</a>	</li>
    <li style="padding: 10px;"  role="presentation"><a href="#profile"  aria-controls="profile" role="tab" data-toggle="tab">Beverages\Alcohol</a></li>
    <li style="padding: 10px;"  role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Special offer</a></li>
    <li style="padding: 10px;"  role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Shisha</a></li>
    <li style="padding: 10px;"  role="presentation"><a href="#yourorder" aria-controls="yourorder" role="tab" data-toggle="tab">Your Order <span id="refresh" class="notificationorder" style="font-family:advanced_pixel_lcd !important; font-size:40px !important;" > : <?php echo sizeof($yourorder_total); ?> </span></a></li>

<li id="exit" style="padding: 10px;"  role="presentation">
<?php if(sizeof($yourorder_total) == 0)
{ ?>



    <a data-toggle="modal" href="#exit-modal"  >
     <span  class="notificationorder" style="font-family:advanced_pixel_lcd !important; font-size:40px !important;" > 
     EXIT </span></a>

<?php 
}
 ?>   
 </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content text-center">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="outer-frame rounded-6px"  style="margin-bottom:10px;">
						<div class="rightmenucol rounded-4px" style="">
							
<div class="accordion" id="accordion2" >
<?php foreach ($menutypes as $menutype) { ?>

	<div class="accordion-group" id="menuhead12<?php echo $menutype->id; ?>">
    <div class="accordion-heading"  style="background-repeat: repeat; background-image: url(<?php echo base_url() . 'assets/img/board.png'; ?>);  height: 100%; width: 100%;" >
	<a  style="color:white; text-align:center;text-decoration: none;font-family:LDFComicSansBold !important;" href="#menudiv<?php echo $menutype->id; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" onclick="getMenuItems(event)" type="<?php echo $menutype->id;?>" >
	
	<?php echo ucwords($menutype->menutype_name);?>

	<img style="float:right;" href="#menudiv<?php echo $menutype->id; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" onclick="getMenuItems(event)" type="<?php echo $menutype->id;?>" height="30px" width="20px" src="<?php echo base_url() . 'assets/img/down-arrow-circle-hi.png'; ?>">
	<p href="#menudiv<?php echo $menutype->id; ?>" type="<?php echo $menutype->id;?>" onclick="getMenuItems(event)"  style="font-size:10px !important;"><?php echo $menutype->menu_desc;?></p>
	

	</a>
	
    </div>

    <div  id="menudiv<?php echo $menutype->id; ?>" class="accordion-body collapse">
      <div class="accordion-inner">
      
      <div class="menuitem23" style="max-height:800px; overflow-y: scroll; margin-bottom:10px;">
      </div>

      </div>
      </div>


</div>
								<?php } ?> 
  
     
    
  </div>
  

						
							<div class="rightmenucontent">
								
								
								
								

								<?php echo $menucontent; ?>			
							</div>
							<!--<br class="clear" /><br/>-->
						</div>
					</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

    		<div class="outer-frame rounded-6px"  style="margin-bottom:10px;">
						<div class="rightmenucol rounded-4px" style="">
					<div class="accordion" id="accordion3">

					 <?php  foreach ($menu_beverages as $beverage) { ?>
					  <div class="accordion-group" style="background-color:white;" id="menubevhead<?php echo $beverage->id; ?>">
					    <div class="accordion-heading" style="background-repeat: repeat; background-image: url(<?php echo base_url() . 'assets/img/board.png'; ?>);  height: 100%; width: 100%;" >
					     <a  style="color:white; text-align:center;text-decoration: none;font-family:LDFComicSansBold !important;" onclick="getBeveragesMenuItems(event)" type="<?php echo $beverage->id;?>"class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#menubevdiv<?php echo $beverage->id; ?>">
					       <?php echo ucwords($beverage->menutype_name);?>

					       
	<img style="float:right;" href="#menubevdiv<?php echo $beverage->id; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" onclick="getBeveragesMenuItems(event)" type="<?php echo $beverage->id;?>" height="30px" width="20px" src="<?php echo base_url() . 'assets/img/down-arrow-circle-hi.png'; ?>">
	<p href="#menubevdiv<?php echo $beverage->id; ?>" 
	type="<?php echo $beverage->id;?>"
	 onclick="getBeveragesMenuItems(event)"  
	 style="font-size:10px !important;">
	 <?php echo $beverage->menu_desc;?>
	 </p>
	

	</a>
	
    </div>
	
					   
					    <div  id="menubevdiv<?php echo $beverage->id; ?>" class="accordion-body collapse">
						      <div class="accordion-inner">
						      
						      <div class="menuitembev" style="max-height:400px; overflow-y: scroll; margin-bottom:10px;">
						      </div>

						      </div>
     				 </div>
					  </div>
					  <?php } ?>

					</div>
					</div>
					</div>

					

    </div>
    <div role="tabpanel" class="tab-pane" id="messages">

    		<div class="outer-frame rounded-6px"  style="margin-bottom:10px;">
						<div class="rightmenucol rounded-4px" style="">
					

					<div class="accordion" id="accordion3">
					 <?php foreach ($menu_specialoffer as $specialoffer) { ?>
					  <div class="accordion-group" style="background-color:white;">
					    <div class="accordion-heading">
					     
					    		<a  style="color:white; text-align:center;text-decoration: none;font-family:LDFComicSansBold !important;" 
					    		onclick="getSpecialOfferMenuItems(event)" 
					    		type="<?php echo $specialoffer->id;?>"
					    		class="accordion-toggle" 
					    		data-toggle="collapse"
					    		 data-parent="#accordion3" 
					    		 href="#menuofferdiv<?php echo $specialoffer->id; ?>"
					    		>
	
	<?php echo ucwords($specialoffer->menutype_name);?>

	
	<img height="20px" width="20px" src="<?php echo base_url() . 'assets/img/down-arrow-circle-hi.png'; ?>">
	

	<p href="#menuofferdiv<?php echo $specialoffer->id; ?>" 
	type="<?php echo $specialoffer->id;?>" 
	onclick="getMenuItems(event)" 
	 style="font-size:10px !important;">

	<?php echo $specialoffer->menu_desc;?></p>
	

	</a>
	</div>
	  
					 
					   <div  id="menuoffierdiv<?php echo $specialoffer->id; ?>" class="accordion-body collapse">
						      <div class="accordion-inner">
						      
						      <div class="menuitem23" style="max-height:400px; overflow-y: scroll; margin-bottom:10px;">
						      </div>

						      </div>
     				 </div>
					  </div>
					  <?php } ?>

					</div>
					</div>
					</div>

    </div>
    <div role="tabpanel" class="tab-pane" id="settings">

<div class="outer-frame rounded-6px"  style="margin-bottom:10px;">
						<div class="rightmenucol rounded-4px" style="">
					<div class="accordion" id="accordion3">
					<?php //print_r($menu_shisha);?>
					 <?php foreach ($menu_shisha as $shisha) { ?>
					  <div class="accordion-group" style="background-color:white;">
					    <div class="accordion-heading">
					      <a  style="text-decoration: none;" onclick="getShishaMenuItems(event)" type="<?php echo $shisha->id;?>"class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#menushishadiv<?php echo $shisha->id; ?>">
					       <?php echo $shisha->menutype_name;?>

					       <div class="pull-right" >
	<img height="20px" width="20px" src="<?php echo base_url() . 'assets/img/down-arrow-circle-hi.png'; ?>">
	</div>
					      </a>
					    </div>
					    <div  id="menushishadiv<?php echo $shisha->id; ?>" class="accordion-body collapse">
						      <div class="accordion-inner">
						      
						      <div class="menuitem23" style="max-height:400px; overflow-y: scroll; margin-bottom:10px;">
						      </div>

						      </div>
     				 </div>
					  </div>
					  <?php } ?>

					</div>
					</div>
					</div>
    </div>

        <div role="tabpanel" class="tab-pane" id="yourorder">

		<div class="leftmenucontent" >
			
		   
		    <div style="max-height:500px; overflow-y: scroll;">    
		       
			
			<div class="items" >
				
				<input id="demo3" type="text" value="" name="demo_vertical2">
		   
			<script>
			    $("input[name='demo_vertical2']").TouchSpin({
			      verticalbuttons: true,
			      verticalupclass: 'glyphicon glyphicon-plus',
			      verticaldownclass: 'glyphicon glyphicon-minus'
			    });
			</script>
			

			</div>
				</div>
			
			<br class="clear" />
	
		<div style="position:fixed; width:100%" class="placeorder" id="refresh2">
		 	<?php if(sizeof($yourorder_total) != 0) {?>
			<a href="#placeorder-modal" class="btn btn-placeorder" data-toggle="modal" >
			<i class="icon-ok"></i> Place Order</a>
			<?php } ?>
		</div>
	</div>
</div>

    	</div>

  </div>

</div>	
		<div class="container-fluid" style="">
			<div class="row-fluid" >
				<div class="span9" >
				<?php if ($this->session->flashdata('successmsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('successmsg'); ?>
						</div>
				<?php endif; ?>
			<!--   <pre>
		
		<?php 
		//print_r($this->session->all_userdata());
		?>

		</pre>  -->
		

			


		<?php echo $moreinfo; ?>
		<?php echo $customize; ?>
		<?php echo $callwaiter; ?>
		<?php echo $drinkrefill; ?>
	
	<div class="modal hide fade"  id="placeorder-modal">
						<div class="modal-header cart-header-modal-top">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Click Yes To Confirm The Order</h3>
											

										</div>
							



										<div class="modal-footer">
										<center>
										<a data-dismiss="modal" class="btn btn-success" href="javascript:;"  onclick="placeOrder(event)" ><i class="icon-ok"></i> Yes, Confirm My Order</a>
											<a href="#" data-dismiss="modal" class="btn btn-danger">No, I Need To Change My Order</a>
						</center>
						</div>
			</div>

			<div class="modal hide fade"  id="password-modal">
						<div class="modal-header cart-header-modal-top">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Enter Password Then Reset </h3>
											

										</div>
							



										<div class="modal-footer">
										<center>
										
										Password : <input type="password" name="psw-cnf" id="psw-cnf" placeholder="Enter Password">
										<br><a data-dismiss="modal" class="btn btn-success" onclick="check_password()"  ><i class="icon-ok"></i> Yes, Confirm </a>
											<a href="#" data-dismiss="modal" class="btn btn-danger">No, I Am Not Waiter/Manager ! </a>
											
						</center>
						</div>
	</div>

	

<div class="modal hide fade"  id="exit-modal">
						<div class="modal-header cart-header-modal-top">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h3>Confirm Exit !</h3>
											

										</div>
							



										<div class="modal-footer">
										<center>
										
										
										<a data-dismiss="modal" class="btn btn-success" onclick="exit_customer()"  >
										<i class="icon-ok"></i> Yes, Confirm </a>
											<a href="#" data-dismiss="modal" class="btn btn-danger">No, I Wan't Continue ! </a>
											
						</center>
						</div>
	</div>


	
	</body>
</html>