<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.stepframemodal.js'; ?>"></script> 

<style type="text/css">

@font-face {
   font-family: candy;
    src: url('<?php echo base_url() . 'assets/font/CANDY___.otf'?>');
  }

  body {
  font-family: Helvetica, Arial, sans-serif, candy;
  font-size: 16px;
  font-size: 1rem;
  line-height: 21px;
  line-height: 1.3125rem;
  color: #222222;
  background-color: #fff;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;



}
  .cart-header-modal-top {
       background: none repeat scroll 0 0 #bf5656;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
}
  .cart-header-modal-bottom {
   
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    position: relative;
    color:white;
    text-align: center;
     box-shadow: 0px 0px 8px #BBB;
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

 .link_button1 {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    
    border: solid 1px #000;
   /* text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.5);*/
    color: #FFF;
    font-family: Verdana;
   padding: 10px 20px 0px 20px;
    text-decoration: none;
    cursor: pointer;
    width: auto;
     height: 30px;
    float: right;
    
    margin-top: -9px;
 /*   background-color: #00b07a;
   
    background: none repeat scroll 0 0 #e8e8e8;*/
    border-bottom-left-radius: 2px;
    border-top-left-radius: 2px;
    
    left: 0;
    top: 0;
    

}

.profile {
   /* background-image: url("<?php echo base_url() . 'assets/img/icons.png'; ?>");
    background-position: -282px -107px;
    height: 19px;
    left: 5px;
    margin-top: -10px;
    top: 50%;
    width: 20px;*/
}
.profile::before {
    content: "";
    display: block;
    position: absolute;
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

         <nav data-toggle="collapse" class="nav-collapse">
        <ul style="list-style:none;"><li>
        <form  class="navbar-form pull-left" style="margin-left:16px;">
            <a href="<?php echo site_url('customer/info'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Exit</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href="<?php echo site_url('customer/menu'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-list icon-white"></i> Menu</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="<?php echo site_url('customer/yourbill'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Your Orders</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#callwaiter-modal"  onclick="callWaiter(event)" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-user icon-white"></i> Call a Waiter</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <a href="#refill-modal" onclick="requestDrinkRefill(event)" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-glass icon-white"></i> Drink Refill</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <!--  <a href="<?php echo site_url('customer/payment'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i> Make Payments</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
          
            
            <a href="<?php echo site_url('customer/histry'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Review</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            
          <!--  <?php 
            if($this->session->userdata('waiter_id'))
                { ?>
                <a href="<?php echo site_url('waiter/myorders'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i>Go To Your Order</a>
              <?php  } ?>
                 -->
         
          </form>

        </li>
        <a href="#profile-modal"  onclick="" data-toggle="modal">
        <li class="link_button1 ">
           <div class="profile" >
            
            <i class="icon-user icon-white"></i> Hi <?php echo $this->session->userdata('customername'); ?>
            
          </div>
        </li>
        </a>  
        </ul>
        </nav>

      </div>
    </div>
  </div>
</div>
