<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Biryani House</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">

		.result_show
{
 position:absolute;
 width:218px;
 max-height: 200px;
 z-index: 1;
 background-color: white;
 overflow: scroll;
}
.form-horizontal input{
	height: 30px !important;
}
</style>
		<script type="text/javascript">


			function processminus() {
			//get form variables
			$('#type').val('Consume');
		var quantity = document.getElementById("quantity").value;
			var countper = document.getElementById("countpercent").value;
			var status=2;
			var available_quantity = document.getElementById( "available" ).value;
			//Calculate Percent
			//alert(quantity);
			if (quantity.length == 0) {

				alert('Enter Quantity !');
				document.getElementById('save').style.display = "none";
				document.getElementById('total_label').style.display = "none";
				document.getElementById('total_div').style.display = "none";
				return
			}
			
			if (parseInt(quantity) >= parseInt(countper)) {

				alert('Quantity Not Smaller Then Available Quantity !');
				document.getElementById('save').style.display = "none";
			}
			 else{

			 	percentage = (parseInt(countper)-parseInt(quantity));	
			
			document.getElementById('total_label').style.display = "block";
			document.getElementById('total_div').style.display = "block";

			document.getElementById('save').style.display = "block";
			
			
			document.getElementById('total_quantity').setAttribute('value',Math.round(percentage));

			document.getElementById('status').setAttribute('value',status);
			
		     
			 };
			
			
			}


			function processadd() {
			//get form variables
			$('#type').val('Inward');
			var status=1;
			var quantity = document.getElementById("quantity").value;
			var countper = document.getElementById("countpercent").value;

			var enter_quantity = document.getElementById( "quantity" ).value;

			
			//Calculate Percent
			percentage = (parseInt(quantity)+parseInt(countper));	
			
			document.getElementById('total_div').style.display = "block";
			document.getElementById('total_label').style.display = "block";
			if (enter_quantity != '')
			 {
			 	document.getElementById('save').style.display = "block";
			 };
			
			
			
			document.getElementById('total_quantity').setAttribute('value',Math.round(percentage));
			document.getElementById('status').setAttribute('value',status);
		     
			
			}

			function processForm() {
			//get form variables
			
			var thepercentage = form1.min_limit.options[form1.min_limit.selectedIndex].value;
			var quantity = document.getElementById( "quantity" ).value;
			var countper = document.getElementById( "countpercent" );
			
			//Calculate Percent
			percentage = (thepercentage * quantity) / 100;	
			countper.value =  Math.round(percentage);
			
			document.getElementById('countpercent').setAttribute('value',Math.round(percentage));
			document.getElementById('countpercent2').setAttribute('value',Math.round(percentage));
		     
			
			}

			/*function check()
			{

					var available_quantity = document.getElementById( "available" ).value;
					var enter_quantity = document.getElementById( "quantity" ).value;

					
					if (parseInt(enter_quantity) == '')
					 {
					 	percentage = 100;
					 	alert('Quantity Is Biger Then Available ');
					 	document.getElementById('quantity').setAttribute('value',percentage);
						
					 	document.getElementById('save').style.display = "none";
					}
				
			}*/

			
		</script>
		<script type="text/javascript">
			$(document).ready(function(){

				$('#quantity').on('keydown',function(e){
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
		<?php echo $dependencies; ?>
	</head>
	<body>
	<?php 
if(isset($ing_info) && !empty($ing_info)){
	 foreach ($ing_info as $ing) {
	$id = $ing->id; 	
$name = $ing->name;
$quantity = $ing->quantity;
$min_ingr = $ing->min_ingr;
$ing_type = $ing->ing_type;

}
}else{
$name = set_value('name');
$quantity = set_value('quantity');
$id = set_value('id');
$min_ingr = set_value('min_ingr');
$ing_type = set_value('ing_type');
}
	?>
		
		<div id="wrapper">
			<?php echo $header;?>
		    <?php echo $sidebar;?>
		    <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12 rounded-6px">
				<div class="panel panel-default">
                        <div class="panel-heading">
                            Ingredients
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                       			<form class="form-horizontal" id="tablesetupform" name="form1" 
                       			method="post"	
                       			action="<?php echo site_url('kitchen/ingredients/add/' . base64_encode($id)); ?>"
                       			 >
						<div class="control-group">
						<input type="hidden" id="id" value="<?php echo $id; ?>" class="" name="id" />

							<label class="control-label" for="tabletnumber">Ingredient</label>
							<div class="controls">
								
								


						<input type="text" value="<?php echo $name; ?>" id="devicenumber"  name="name" disabled/> 



					</div>
<br/>
					<label class="control-label" for="tabletnumber">Available Quantity</label>
							<div class="controls">
								<input type="text" id="countpercent" value="<?php echo $quantity; ?>" class="" name="" disabled />
								Min :<input style="width:60px;background:#5cb85c;" type="text" value="<?php echo $min_ingr; ?>" id="min_ingr"  name="min_ingr" readonly/> 
								<input type="hidden" id="available" value="<?php echo $quantity; ?>" class="" name="available"/>
							</div>								

								
							</div>
							<label class="control-label" for="tabletnumber">Enter Quantity</label>
							<div class="controls">
								<input requierd type="text" onkeyup="" id="quantity" class="validate[required] error" name="quantity" />
							&nbsp; <input value="<?php echo $ing_type; ?>"  style="width:60px; color:#FFF; background:#d9534f;   cursor:none !important;" type="text" id="min_ingr"  readonly/> 
							<input type="hidden" name="type" value="" id="type" />
							</div><br/>
							<div class="controls">
								<a class="btn btn-info" onclick="processadd()" >Add </a> &nbsp;&nbsp;&nbsp;
								 <a class="btn btn-success" onclick="processminus()" > Subtraction</a>&nbsp;&nbsp;&nbsp;
								 <a class="btn btn-danger" href="<?php echo site_url('kitchen/ingredients'); ?>" > Cancal</a>
							</div>
							<br>
							<label style="display:none;" class="control-label" id="total_label" for="tabletnumber">New Total Quantity</label>
							<div class="controls" id="total_div" style="display:none;">
							
								<input type="text" value="" id="total_quantity" class="validate[required]" name="total_quantity" readonly />

							</div>

							
							<input type="hidden" id="status" value="" class="" name="status"/>
							

						</div>
						<div id="save" class="form-actions nobottomspace" style="display:none; padding-left:0;text-align:center;background-color:inherit;border-color:#99A2B6">
							<a class="btn btn-info" onclick="$('#tablesetupform').submit()" id="save"  class="btn  transition">Save</a>&nbsp;&nbsp;
						
						</div>
					</form>
                            </div>
                            
                        </div>

                    </div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</body>

</html>