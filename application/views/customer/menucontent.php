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
    margin-right: 12%;
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
<style type="text/css">
	
.btn-plus::after {
   background-image: url("<?php echo base_url() . 'assets/img/icons.png'; ?>");
    background-position: -440px -42px;
    height: 12px;
    margin-top: -6px;
   
    top: 50%;
    width: 10px;
}
.btn-plus::after {
    content: "";
    display: block;
    position: absolute;
}

.btn-remove-icon::after {
   background-image: url("<?php echo base_url() . 'assets/img/ICONEWHITE.png'; ?>");
    background-position: -458px 0px;
    height: 12px;
    margin-top: -6px;
   
    top: 50%;
    width: 13px;
}
.btn-remove-icon::after {
    content: "";
    display: block;
    position: absolute;
}

.btn-moreinfo::after {
   background-image: url("<?php echo base_url() . 'assets/img/ICONEWHITE.png'; ?>");
    background-position: 349px -97px;
    height: 12px;
    margin-top: -6px;
   
    top: 50%;
    width: 14px;
}
.btn-customize::after {
   background-image: url("<?php echo base_url() . 'assets/img/ICONEWHITE.png'; ?>");
    background-position: -360px -144px;
    height: 12px;
    margin-top: -6px;
   
    top: 50%;
    width: 14px;
}

  .menu-item {
    border: 1px solid #e5e5e5;
    padding: 10px;
   
}

.menu-item-header{
	background-color: #e5e5e5 !important;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    padding: 10px;
    position: relative;
    }
    .menu-price{
	color: #39b1c5 !important;
   
   
    	
    }

.menu-item:hover {
    box-shadow: 0px 0px 8px #BBB;
}

.btn-placeorder::after {
    content: "";
    display: block;
    position: absolute;
}
.btn-customize::after {
    content: "";
    display: block;
    position: absolute;
}


.btn-moreinfo::after {
    content: "";
    display: block;
    position: absolute;
}
*::after, *::before {
    box-sizing: border-box;
}
.btn-plus {
    padding-right: 37px;
    position: relative;
}
.btn-remove {
    padding-right: 37px;
    position: relative;

}
.btn-moreinfo {
    padding-right: 37px;
    position: relative;
}
.btn-customize {
    padding-right: 37px;
    position: relative;
}
.btn {
    font-weight: 500;
}
.btn-primary {
    background-color: #00b07a;
    border-color: #009768;
    color: #fff;
}
.btn-customize {
    background-color: #fd5c2a;
    border-color: #009768;
    color: #fff;
}
.btn-customize:hover {
    background-color: #ca2927;
    border-color: #ca2927;
    color: #fff;
}
.btn-remove {
    background-color: #ca2927;
    border-color: #009768;
    color: #fff;
}
.btn-remove:hover {
    background-color: #009768;
    border-color: #009768;
    color: #fff;
}
.btn-moreinfo {
    background-color: #92005c;
    border-color: #009768;
    color: #fff;
}
.btn-moreinfo:hover {
    background-color: #ca295c;
    border-color: #ca2927;
    color: #fff;
}
.btn-placeorder {

	width: 80%;
    background-color: #009768;
    border-color: #009768;
    color: #fff;
}
.btn-placeorder:hover {
    background-color: #ca295c;
    border-color: #ca2927;
    color: #fff;
}
.icon-search{
  position: absolute;
  top: 50%;
  margin-left: 17px;
  margin-top: 17px;
  z-index: 1;
  color: #4f5b66;
}
.btn {
    -moz-user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 2px;
    cursor: pointer;
    display: inline-block;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;


}

a {
    color: #333;
    text-decoration: none;
}
a {
    background-color: transparent;
}

	
</style>
<script type="text/javascript">
	ordertotal = 0;

	function selectIngredient(event){
		var count = 0;
		$('#customizeAddbtn').attr('ingredients', '');
		$('.ingr_box').each(function(index){
			if ($(this).attr('checked')){
				if (count == 0)
					ingredients = $('#customizeAddbtn').attr('ingredients') + $(this).attr('ingrname');
				else	
					ingredients = $('#customizeAddbtn').attr('ingredients') + ',' + $(this).attr('ingrname');
				$('#customizeAddbtn').attr('ingredients', ingredients);
				count = count + 1;
			}
		});
	}



function Notification()
{

	$.ajax({
		url:"<?php echo site_url('customer/menu/notification'); ?>",
		type:"POST",
		success:function(data){
			//href="#mainVideoMsg"
			$("#mainVideoMsg").show()
			$(".bill").html(data)
			/*if(data != 'No Notification')
			{
			 
				getHelp()
			}*/
			}
	});

	
}

function closed()
{
	//alert('sdfasd');
			$("#mainVideoMsg").slideUp()
			
			
	//setTimeout("getHelp()",7000);
}

	function quantityAdd(event) {
		itemid = $(event.target).attr('itemid');
		quantity = $(event.target).attr('quantity');
		price = $(event.target).attr('price');

		item = $(event.target);
		itemprice = item.attr('price');
		ordertotal = ordertotal + parseFloat(itemprice);

		$('#ordertotal').html('');
		$('#ordertotal').html('UGX' + ordertotal);
		//alert(quantity);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/quantityAdd'); ?>",
			data: "itemid=" + itemid + "&quantity=" + quantity + "&price=" + price,
			success: function(data, textStatus){
				
				$('div.items').html(data);
				//$('#yourorder').show();

				/*item_markup = "<div ingredients='" + ingredients + "' price='" + itemprice + "' itemid='" + itemid + "' class='ordereditem'><img src='" + itemimg + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + itemname + "<br/><b>$" + itemprice + "</b></span><br/><br/><a href='#' itemprice='" + itemprice + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		$('div.items').append(item_markup)*/
			}
		});
		//alert('add');
		//alert(itemid);

		
		// body...
	}

	function quantityMinus(event) {
		itemid = $(event.target).attr('itemid');
		quantity = $(event.target).attr('quantity');
		price = $(event.target).attr('price');
		//alert(price);
		item = $(event.target);

		itemprice = item.attr('price_og');
		//alert(itemprice);
		ordertotal = ordertotal - parseFloat(itemprice);

		$('#ordertotal').html('');
		$('#ordertotal').html('UGX' + ordertotal);

		//alert(quantity);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/quantityMinus'); ?>",
			data: "itemid=" + itemid + "&quantity=" + quantity + "&price=" + price,
			success: function(data, textStatus){
				
				$('div.items').html(data);
				//$('#yourorder').show();

				/*item_markup = "<div ingredients='" + ingredients + "' price='" + itemprice + "' itemid='" + itemid + "' class='ordereditem'><img src='" + itemimg + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + itemname + "<br/><b>$" + itemprice + "</b></span><br/><br/><a href='#' itemprice='" + itemprice + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		$('div.items').append(item_markup)*/
			}
		});
	}

	function getMoreInfo(event){
		itemid = $(event.target).attr('itemid');
		$('.moreinfo-loading').show();
		$('#moreinfo').hide();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/moreinfo'); ?>",
			data: "id=" + itemid,
			success: function(data, textStatus){
				$('.moreinfo-loading').hide();
				$('#moreinfo').html(data);
				$('#moreinfo').show();
			}
		});
	}

	
	

	function addToOrder(event){
		/*dataString = new Array();*/
		
		
		
		
		item = $(event.target);
		itemprice = item.attr('price');

		ordertotal = ordertotal + parseFloat(itemprice);

		$('#ordertotal').html('');
		$('#ordertotal').html('UGX' + ordertotal);

		//add the item to the order list
		itemname = item.attr('itemname');
		itemimg = item.attr('itemimg');
		itemid = item.attr('itemid');

		var notes = $( "#comment_ingredients" ).val();
		

		ingredients = item.attr('ingredients');
		
		

		

		//alert(itemname);
		/*$('.ordertotals').each(function(index){
			item = new ordertotals(itemid, itemprice, itemname, itemimg);
			
			dataString.push(item);
		});*/
		//alert(dataString.length);
	/*	if (dataString.length == 0)
		{
			//alert(dataString.length);
			//return;
		}*/

		//alert('zxdZ');
		
		
		


		/*var jsonString = JSON.stringify(dataString);*/
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/yourorder'); ?>",
			data: {"notes":notes,"itemname":itemname,"itemimg":itemimg,"itemid":itemid,"ingredients":ingredients,"itemprice":itemprice},
			success: function(data, textStatus){
				
				$('div.items').html(data);
				//$('#yourorder').show();

				/*item_markup = "<div ingredients='" + ingredients + "' price='" + itemprice + "' itemid='" + itemid + "' class='ordereditem'><img src='" + itemimg + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + itemname + "<br/><b>$" + itemprice + "</b></span><br/><br/><a href='#' itemprice='" + itemprice + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		
		$('div.items').append(item_markup)*/
			}
		});

		
		
		
	}

	function removeFromOrder(event){
		item = $(event.target);

		itemprice = item.attr('itemprice');
		itemid = item.attr('itemid');
		

		item.parent().remove();

		ordertotal = ordertotal - parseInt(itemprice);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/deletefromtemp'); ?>",
			data: {"itemid":itemid},
			success: function(data){
			$('div.items').html(data);	
			}
		});
		
	}

	function getIngredients(event)
	{
		item = $(event.target);
		itemid = item.attr('itemid');
		itemname = item.attr('itemname');
		itemprice = item.attr('itemprice');
		itemimg = item.attr('itemimg');
		//alert(itemid);
		$('#mealname').html(itemname);

		$('#customizeAddbtn').attr('itemname', itemname);
		$('#customizeAddbtn').attr('price', itemprice);
		$('#customizeAddbtn').attr('itemimg', itemimg);
		$('#customizeAddbtn').attr('itemid', itemid);
		
		//alert(itemid);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/getingredients'); ?>",
			data: "menuitemid=" + itemid,
			success: function(data, textStatus){
				$('#ingr_list').html(data);
				$('#ingr_list').show();
				$('.ingr-loading').hide();
			}
		});
	}

	function ordereditem(menuid, ingredients, price, quantity, notes)
	{
		//ordereditem object
		this.menuid = menuid;
		this.ingredients = ingredients;
		this.price = price;
		//this.quantity = quantity || '';
		this.quantity = quantity;
		this.notes = notes;
	}

	function placeOrder()
	{

		//make sure items have been selected

		ordereditems = new Array();
		$('.ordereditem').each(function(index){
			
			item = new ordereditem($(this).attr('itemid'), $(this).attr('ingredients'), $(this).attr('price'), $(this).attr('quantity'),$(this).attr('notes'));

			ordereditems.push(item);
		});
		if (ordereditems.length == 0){
			return;
		}

		JSONitems = JSON.stringify(ordereditems);
		// alert(JSONitems); return;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/placeorder'); ?>",
			data: "ordereditems=" + JSONitems,
			success: function(){
				$('#orderplaced').slideDown('fast');
				$('.items').html('');
				ordertotal = 0;
				$('#ordertotal').html('');
				$('#ordertotal').html('$' + ordertotal);
			}
		});
	}



	function sub_menu(){
		var formData = $("#menu_form").serializeArray();
         $.ajax({  
            type: "POST",  
            url: "menu/yourorder",  
            data: "formdata="+formData,  
             success: function(value)  
            {  
                //$("").html(value);     

            } 
        });
	}



</script>



