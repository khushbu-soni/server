<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.stepframemodal.js'; ?>"></script> 

<style type="text/css">
body {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 16px;
  font-size: 1rem;
  line-height: 21px;
  line-height: 1.3125rem;
  color: #222222;
  background-color: #fff;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
}

.header {
  font-size: 150%;
  margin-bottom: 1em;
  padding: .5em;
}

.button {
  display: inline-block;
  padding: 1em 1.5em;
  background-color: #E24813;
  float: left;
  margin-right: 2em;
  text-decoration: none;
  color: white;
}

.button:hover { background-color: #BE4813; }

.popup {
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.8);
  display: none;
  height: 100%;
  left: 0;
  /*opacity: 0;*/
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
  vertical-align: middle;
}

.popup-container {
  display: block;
  margin: 0 auto;
  padding: 24px;
  text-align: center;
  text-align: center;
}

.popup-content {
  padding: 2em;
  background-color: #fff;
  text-align: left;
  display: inline-block;
  position: relative;
  min-width: 50%;
  min-height: 200px;
}

.popup-close {
  background: none repeat scroll 0 0 #fff;
  cursor: pointer;
  display: block;
  font-size: 150%;
  line-height: 1.33333em;
  width: 1.3333em;
  height: 1.3333em;
  line-height: 130%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  z-index: 2;
  color: #222222;
}
</style>





<script type="text/javascript">
	function callWaiter(event){
		type = 0;
		//itemid = $(event.target).attr('order-id');
		//alert(itemid);
		$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
	}

	function requestDrinkRefill(event)
	{
		type = 1;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/notifications/drinkrefill'); ?>",
			data: "type=" + type,
			success: function(data, textstatus){
				if (data == '1'){
					$('#drinkrefillsuccess').show();
					$('#drinkrefillfail').hide();
				} else {
					$('#drinkrefillsuccess').hide();
					$('#drinkrefillfail').show();
				}
			}
		});
	}
</script>	

<script>
                                    function get_time() {
                                        var x = new Date()
                                        var x1 = x.toLocaleTimeString();// changing the display to UTC string
                                        $("#servertime").html(x1);
                                    }
                                    setInterval("get_time()", 100); // 1 minute    
                                </script>

                                
                                  
                                
	
<div class="mainheader navbar-fixed-top">
	<div class="titlebar" style="color:white;">
		<span class="title">Restaurant HOGO</span>
		 <span id="servertime" style="float:right"><?php echo date('D H-i') ?></span>
         <span class="big" style="float:right"><?php echo date('M d, Y') ?>&nbsp;&nbsp; &nbsp;</span>
        
                                  

		</div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

			    <form class="navbar-form pull-left" style="margin-left:16px;">
			    	<a href="<?php echo site_url('customer/menu'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Back</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <!-- 	<a href="<?php echo site_url('customer/payment'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i> Make Payments</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
			    	<a href="<?php echo site_url('customer/yourbill'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Your Bill</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	
            <a href="<?php echo site_url('customer/histry'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Review</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
			    	
			    <!-- 	<?php 
			    	if($this->session->userdata('waiter_id'))
								{ ?>
								<a href="<?php echo site_url('waiter/myorders'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Go To Your Order</a>
							<?php	 } ?>
								 -->
			    
			    </form>
			</div>
		</div>
	</div>
</div>

