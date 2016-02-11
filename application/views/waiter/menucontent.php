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
		url:"<?php echo site_url('waiter/menu/notification'); ?>",
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
		$('#ordertotal').html('$' + ordertotal);
		//alert(quantity);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('waiter/menu/quantityAdd'); ?>",
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
		$('#ordertotal').html('$' + ordertotal);

		//alert(quantity);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('waiter/menu/quantityMinus'); ?>",
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
			url: "<?php echo site_url('waiter/menu/moreinfo'); ?>",
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
		$('#ordertotal').html('$' + ordertotal);

		//add the item to the order list
		itemname = item.attr('itemname');
		itemimg = item.attr('itemimg');
		itemid = item.attr('itemid');
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
			url: "<?php echo site_url('waiter/menu/yourorder'); ?>",
			data: {"itemname":itemname,"itemimg":itemimg,"itemid":itemid,"ingredients":ingredients,"itemprice":itemprice},
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
			url: "<?php echo site_url('waiter/menu/deletefromtemp'); ?>",
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

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('waiter/menu/getingredients'); ?>",
			data: "menuitemid=" + itemid,
			success: function(data, textStatus){
				$('#ingr_list').html(data);
				$('#ingr_list').show();
				$('.ingr-loading').hide();
			}
		});
	}

	function ordereditem(menuid, ingredients, price, quantity)
	{
		//ordereditem object
		this.menuid = menuid;
		this.ingredients = ingredients;
		this.price = price;
		//this.quantity = quantity || '';
		this.quantity = quantity;
	}


	function placeOrder()
	{

		//make sure items have been selected
		ordereditems = new Array();
		$('.ordereditem').each(function(index){

			item = new ordereditem($(this).attr('itemid'), $(this).attr('ingredients'), $(this).attr('price'), $(this).attr('quantity'));
			ordereditems.push(item);
		});
		if (ordereditems.length == 0){
			return;
		}

		JSONitems = JSON.stringify(ordereditems);
		// alert(JSONitems); return;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('waiter/menu/placeorder'); ?>",
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
<div class="menuitems"  style="max-height:600px; overflow-y: scroll; margin-bottom:10px;">
	<div id="loading" class="hide menu-loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div class="alert alert-success hide" id="orderplaced">
		<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
		You have successfully placed an order. Your order is now <span id="orderstatus"><strong>being prepared.</strong></span>
	</div>
	<?php if ($this->session->flashdata('outstanding_msg') != ''): ?>
		<div class="alert alert-danger" id="outstanding_alert">
			<?php echo $this->session->flashdata('outstanding_msg'); ?>
		</div>
	<?php endif; ?>
	<form action="" id="menu_form" method="POST">
	<div class="row-fluid menurow" style="">
		<?php $index = 0;
		foreach ($menuitems as $menuitem): ?>
			<div class="span6 menuitem" style="<?php if ($index % 2 == 0) echo 'margin-left:0'; ?>">
				<?php if ($menuitem->picturepath == '' || $menuitem->picturepath == null): ?>
					<img src="<?php echo base_url() . 'assets/img/140x140.gif'; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="<?php echo $menuitem->name; ?>" />
				<?php else: ?>
					<img src="<?php echo $img_path . $menuitem->picturepath; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="<?php echo $menuitem->name; ?>" />
				<?php endif; ?>
				<span><?php echo $menuitem->name; ?></span>&nbsp;&nbsp;<br/><span><b>$<?php echo $menuitem->price; ?></b></span><br/><br/>
				<a href="#moreinfo-modal" itemid="<?php echo $menuitem->id; ?>" onclick="getMoreInfo(event)" class="btn" data-toggle="modal"><?php if ($menuitem->calories < 1000) echo "<i class='icon-heart'></i>"; ?> More Info</a>
				<br/><br/>
				<a href="#" itemid="<?php echo $menuitem->id; ?>" ingredients="All" itemimg="<?php echo $img_path . $menuitem->picturepath; ?>" onclick="addToOrder(event)" class="btn" itemname="<?php echo $menuitem->name; ?>" price="<?php echo $menuitem->price; ?>"><i class="icon-plus"></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href="#customize-modal" itemimg="<?php echo $img_path . $menuitem->picturepath; ?>" onclick="getIngredients(event)" itemprice="<?php echo $menuitem->price; ?>" itemname="<?php echo $menuitem->name; ?>" itemid="<?php echo $menuitem->id; ?>" class="btn" data-toggle="modal"><i class="icon-wrench"></i> Customize</a>
				<!-- <input type="hidden" value="">
				<input type="button" onclick="sub_menu();" value="abc"> -->
			</div>
			<?php $index = $index + 1; ?>
		<?php endforeach; ?>
	</div>
	</form>
</div>